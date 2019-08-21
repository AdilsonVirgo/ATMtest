<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\VerticalSignal;
use App\Models\SignalInventory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Image;
use Validator;

class VerticalSignalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');
        $vsignals = VerticalSignal::select();
        $vsignalstotal = VerticalSignal::count();

        if ($pagintaionEnabled) {
            $vsignals = $vsignals->paginate(config('atm_app.paginateListSize'));
        }

        return View('verticalsignals.show-vertical-signals', compact('vsignals', 'vsignalstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sinventories = SignalInventory::all();
        $materials = json_decode(Configuration::where('code', 'material')->first()->values);
        $fasteners = json_decode(Configuration::where('code', 'fijacion')->first()->values);
        $normatives = json_decode(Configuration::where('code', 'normativa')->first()->values);
        $orientations = json_decode(Configuration::where('code', 'direction')->first()->values);
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);

        return view('verticalsignals.create-vertical-signal', compact(
                'sinventories',
                'materials',
                'fasteners',
                'normatives',
                'orientations',
                'states')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), VerticalSignal::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $picture_name = null;
        if ($request->input('picture_data')) {
            $picture_data = $request->input('picture_data');

            $ext = null;
            if (strpos($picture_data, 'data:image/jpeg;base64,') === 0) {
                $picture_data = str_replace('data:image/jpeg;base64,', '', $picture_data);
                $ext = '.jpg';
            }
            if (strpos($picture_data, 'data:image/png;base64,') === 0) {
                $picture_data = str_replace('data:image/png;base64,', '', $picture_data);
                $ext = '.png';
            }

            $picture_name = Str::random() . '.' . $ext;
            $picture_data = str_replace(' ', '+', $picture_data);
            $data = base64_decode($picture_data);

            if (!file_put_contents(storage_path('app/public_html/signals/') . $picture_name, $data)) {
                return back()->with('error', trans('Error guardando la imagen. Inténtelo de nuevo o contacte al administrador.'));
            }
        }

        $vsignal = VerticalSignal::create([
            'user_id' => Auth::user()->id,
            'code' => $request->input('code'),
            'signal_id' => $request->input('inventory'),
            'picture' => $picture_name,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'comment' => $request->input('comment'),
            'orientation' => $request->input('orientation'),
            'google_address' => $request->input('google_address'),
            'state' => $request->input('state'),
            'normative' => $request->input('normative'),
            'fastener' => $request->input('fastener'),
            'material' => $request->input('material'),
            'erp_code' => $request->input('erp_code'),
        ]);

        $vsignal->save();

        return redirect('vertical-signals/' . $vsignal->id)->with('success', trans('verticalsignals.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vsignal = VerticalSignal::find($id);

        return view('verticalsignals.show-vertical-signal', compact('vsignal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vsignal = VerticalSignal::findOrFail($id);
        $sinventories = SignalInventory::all();
        $materials = json_decode(Configuration::where('code', 'material')->first()->values);
        $fasteners = json_decode(Configuration::where('code', 'fijacion')->first()->values);
        $normatives = json_decode(Configuration::where('code', 'normativa')->first()->values);
        $orientations = json_decode(Configuration::where('code', 'direction')->first()->values);
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);

        return view('verticalsignals.edit-vertical-signal', compact(
                'vsignal',
                'sinventories',
                'materials',
                'fasteners',
                'normatives',
                'orientations',
                'states')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vsignal = VerticalSignal::findOrFail($id);

        if ($request->get('latitude') && $vsignal->latitude != $request->input('latitude')) {
            $vsignal->latitude = $request->input('latitude');
        }

        if ($request->get('longitude') && $vsignal->longitude != $request->input('longitude')) {
            $vsignal->longitude = $request->input('longitude');
        }

        if ($request->get('google_address') && $vsignal->google_address != $request->input('google_address')) {
            $vsignal->google_address = $request->input('google_address');
        }

        if ($request->get('comment') && $vsignal->comment != $request->input('comment')) {
            $vsignal->comment = $request->input('comment');
        }

        if ($request->get('orientation') && $vsignal->orientation != $request->input('orientation')) {
            $vsignal->orientation = $request->input('orientation');
        }

        if ($request->get('state') && $vsignal->state != $request->input('state')) {
            $vsignal->state = $request->input('state');
        }

        if ($request->get('normative') && $vsignal->normative != $request->input('normative')) {
            $vsignal->normative = $request->input('normative');
        }

        if ($request->get('fastener') && $vsignal->fastener != $request->input('fastener')) {
            $vsignal->fastener = $request->input('fastener');
        }

        if ($request->get('material') && $vsignal->material != $request->input('material')) {
            $vsignal->material = $request->input('material');
        }

        if ($request->get('erp_code') && $vsignal->erp_code != $request->input('erp_code')) {
            $vsignal->erp_code = $request->input('erp_code');
        }

        $old_picture = null;
        $picture_name = null;
        if ($request->input('picture_data')) {
            $picture_data = $request->input('picture_data');

            $ext = null;
            if (strpos($picture_data, 'data:image/jpeg;base64,') === 0) {
                $picture_data = str_replace('data:image/jpeg;base64,', '', $picture_data);
                $ext = '.jpg';
            }
            if (strpos($picture_data, 'data:image/png;base64,') === 0) {
                $picture_data = str_replace('data:image/png;base64,', '', $picture_data);
                $ext = '.png';
            }

            $picture_name = Str::random() . '.' . $ext;
            $old_picture = public_path('/storage/signals/' . $vsignal->picture);
            $picture_data = str_replace(' ', '+', $picture_data);
            $data = base64_decode($picture_data);

            if (!file_put_contents(storage_path('app/public_html/signals/') . $picture_name, $data)) {
                return back()->with('error', trans('Error guardando la imagen. Inténtelo de nuevo o contacte al administrador.'));
            }

            $vsignal->picture = $picture_name;
        }

        $vsignal->user_id = Auth::user()->id;

        if ($vsignal->save()) {
            if ($old_picture) {
                Storage::delete($old_picture);
            }

            return redirect('vertical-signals/' . $vsignal->id)->with('success', trans('verticalsignals.updateSuccess'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vsignal = VerticalSignal::findOrFail($id);

        if (Auth::user()->hasRole('atmadmin')) {
            //Storage::delete('signals/' . $vsignal->picture);
            $vsignal->delete();
            return redirect('vertical-signals')->with('success', trans('verticalsignals.messages.delete-success'));
        }

        return back()->with('error', trans('verticalsignals.messages.delete-error'));
    }

    /**
     * Method to search the users.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('vsignal_search_box');
        $searchRules = [
            'vsignal_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'vsignal_search_box.required' => 'Search term is required',
            'vsignal_search_box.string' => 'Search term has invalid characters',
            'vsignal_search_box.max' => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $vsignals = VerticalSignal::where('code', 'like', '%' . $searchTerm . '%')
            ->orWhere('erp_code', 'like', '%' . $searchTerm . '%')
            ->orWhere('google_address', 'like', '%' . $searchTerm . '%')
            ->orWhere('state', 'like', '%' . $searchTerm . '%')
            ->orWhere('normative', 'like', '%' . $searchTerm . '%')
            ->orWhere('fastener', 'like', '%' . $searchTerm . '%')
            ->orWhere('material', 'like', '%' . $searchTerm . '%')
            ->orWhere('comment', 'like', '%' . $searchTerm . '%');

        $result = [];
        foreach ($vsignals->get() as $vsignal) {
            $result[] = [
                'id' => $vsignal->id,
                'code' => $vsignal->code,
                'erp_code' => $vsignal->erp_code,
                'creator' => $vsignal->user->full_name(),
                'state' => $vsignal->state,
                'fastener' => $vsignal->fastener,
                'material' => $vsignal->material,
                'normative' => $vsignal->normative,
                'google_address' => $vsignal->google_address
            ];
        }

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
    }
}
