<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Intersection;
use App\Models\TrafficPole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TrafficPoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');
        $poles = TrafficPole::select();
        $polestotal = TrafficPole::count();

        if ($pagintaionEnabled) {
            $poles = $poles->paginate(config('atm_app.paginateListSize'));
        }

        return View('traffic-poles.show-traffic-poles', compact('poles', 'polestotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $intersections = Intersection::all();
        $materials = json_decode(Configuration::where('code', 'material')->first()->values);
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);

        return view('traffic-poles.create-traffic-pole', compact('intersections', 'materials', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), TrafficPole::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $pole = TrafficPole::create([
            'user_id' => Auth::user()->id,
            'intersection_id' => $request->input('intersection'),
            'code' => $request->input('code'),
            'erp_code' => $request->input('erp_code'),
            'state' => $request->input('state'),
            'atm_own' => $request->input('atm_own'),
            'height' => $request->input('height'),
            'material' => $request->input('material'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'google_address' => $request->input('google_address'),
            'comment' => $request->input('comment')
        ]);

        if ($pole) {
            return redirect('traffic-poles/' . $pole->id)->with('success', trans('traffic-poles.createSuccess'));
        }

        return back()->with('error', trans('traffic-poles.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $traffic_pole = TrafficPole::find($id);

        if ($traffic_pole) {
            return view('traffic-poles.show-traffic-pole', compact('traffic_pole'));
        }

        return back()->with('error', trans('traffic-poles.messages.show-error'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $traffic_pole = TrafficPole::find($id);

        if ($traffic_pole) {
            $intersections = Intersection::all();
            $materials = json_decode(Configuration::where('code', 'material')->first()->values);
            $states = json_decode(Configuration::where('code', 'estado')->first()->values);

            return view('traffic-poles.edit-traffic-pole', compact('traffic_pole', 'intersections', 'materials', 'states'));
        }

        return back()->with('error', trans('traffic-poles.messages.show-error'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $traffic_pole = TrafficPole::find($id);

        if ($traffic_pole) {
            if ($request->intersection && $request->intersection != $traffic_pole->intersection_id) {
                $traffic_pole->intersection_id = $request->intersection;
            }

            if ($request->erp_code && $request->erp_code != $traffic_pole->erp_code) {
                $traffic_pole->erp_code = $request->erp_code;
            }

            if ($request->state && $request->state != $traffic_pole->state) {
                $traffic_pole->state = $request->state;
            }

            if ($request->atm_own) {
                $traffic_pole->atm_own = 1;
            }
            else {
                $traffic_pole->atm_own = 0;
            }

            if ($request->height && $request->height != $traffic_pole->height) {
                $traffic_pole->height = $request->height;
            }

            if ($request->material && $request->material != $traffic_pole->material) {
                $traffic_pole->material = $request->material;
            }

            if ($request->latitude && $request->latitude != $traffic_pole->latitude) {
                $traffic_pole->latitude = $request->latitude;
            }

            if ($request->longitude && $request->longitude != $traffic_pole->longitude) {
                $traffic_pole->longitude = $request->longitude;
            }

            if ($request->google_address && $request->google_address != $traffic_pole->google_address) {
                $traffic_pole->google_address = $request->google_address;
            }

            if ($request->comment && $request->comment != $traffic_pole->comment) {
                $traffic_pole->comment = $request->comment;
            }

            if ($traffic_pole->save()) {
                return redirect('traffic-poles/' . $traffic_pole->id)->with('success', trans('traffic-poles.updateSuccess'));
            }
        }

        return back()->with('error', trans('traffic-poles.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pole = TrafficPole::findOrFail($id);

        if ($pole) {
            $pole->delete();
            return redirect('traffic-poles')->with('success', trans('traffic-poles.messages.delete-success'));
        }

        return back()->with('error', trans('device-poles.messages.delete-error'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('traffic_pole_search_box');
        $searchRules = [
            'traffic_pole_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'device_search_box.required' => 'Search term is required',
            'device_search_box.string' => 'Search term has invalid characters',
            'device_search_box.max' => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $result = TrafficPole::where('code', 'like', '%' . $searchTerm . '%')
            ->orWhere('state', 'like', '%' . $searchTerm . '%')
            ->orWhere('material', 'like', '%' . $searchTerm . '%')
            ->orWhere('google_address', 'like', '%' . $searchTerm . '%')
            ->orWhere('comment', 'like', '%' . $searchTerm . '%')
            ->orWhere('height', '=', $searchTerm)
            ->orWhere('erp_code', 'like', '%' . $searchTerm . '%')->get();

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
    }

    public function today()
    {
        return response()->json(TrafficPole::with('intersection')->where('updated_at', '>=', Carbon::today())->get(), Response::HTTP_OK);
    }

    public function all()
    {
        return response()->json(TrafficPole::with('intersection')->get(), Response::HTTP_OK);
    }
}
