<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\SignalInventory;
use App\Models\VerticalSignal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sinventories = SignalInventory::all();
        $parishes = VerticalSignal::select('parish')->distinct('parish')->get();
        $neighborhoods = VerticalSignal::select('neighborhood')->distinct('neighborhood')->get();
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);
        $materials = json_decode(Configuration::where('code', 'material')->first()->values);
        $fasteners = json_decode(Configuration::where('code', 'fijacion')->first()->values);

        return view('reports.vertical-signals', compact('sinventories', 'parishes', 'neighborhoods', 'states', 'materials', 'fasteners'));
    }

    public function search(Request $request)
    {
        $signals = VerticalSignal::select();

        if ($request->input('signal')) {
            $signals = $signals->where('signal_id', '=', $request->signal);
        }

        if ($request->input('state')) {
            $signals = $signals->where('state', '=', $request->state);
        }

        if ($request->input('material')) {
            $signals = $signals->where('material', '=', $request->material);
        }

        if ($request->input('fastener')) {
            $signals = $signals->where('fastener', '=', $request->fastener);
        }

        if ($request->input('parish')) {
            $signals = $signals->where('parish', '=', $request->parish);
        }

        if ($request->input('neighborhood')) {
            $signals = $signals->where('neighborhood', '=', $request->neighborhood);
        }

        $signals = $signals->get();
        $result = [];

        foreach ($signals as $vsignal) {
            $picture = asset('storage/signals/no-picture.png');

            if ($vsignal->picture && Storage::exists('signals/' . $vsignal->picture)) {
                $picture = asset('storage/signals/' . $vsignal->picture);
            }

            $result[] = [
                'id' => $vsignal->id,
                'code' => $vsignal->code,
                'latitude' => $vsignal->latitude,
                'longitude' => $vsignal->longitude,
                'picture' => $picture,
                'google_address' => $vsignal->google_address,
                'neighborhood' => $vsignal->neighborhood,
                'parish' => $vsignal->parish,
                'state' => $vsignal->state,
                'material' => $vsignal->material,
                'fastener' => $vsignal->fastener,
                'comment' => $vsignal->comment,
                'group' => $vsignal->signal_inventory->subgroup->group->name . ' (' . $vsignal->signal_inventory->subgroup->group->code . ')',
                'subgroup' => $vsignal->signal_inventory->subgroup->name . ' (' . $vsignal->signal_inventory->subgroup->code . ')',
            ];
        }

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
    }
}
