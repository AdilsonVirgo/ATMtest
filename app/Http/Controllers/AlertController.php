<?php

namespace App\Http\Controllers;

use App\Models\Alert;
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

class AlertController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function search(Request $request) {
        $searchTerm = $request->input('alert_search_box');
        $searchRules = [
            'alert_search_box' => 'required',
        ];
        $searchMessages = [
            'alert_search_box.required' => 'Search term is required',
            'alert_search_box.string' => 'Search term has invalid characters',
            'alert_search_box.max' => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                        json_encode($validator),
                            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
     
        $alerts = Alert::where('state', 'like', '%' . $searchTerm . '%')
                ->orWhere('latitude', 'like', '%' . $searchTerm . '%')
                ->orWhere('longitude', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%');

        $result = [];
        foreach ($alerts->get() as $alert) {
            $result[] = [
                'id' => $alert->id,
                'creator' => $alert->user->full_name(),
                'state' => $alert->state,
                'latitude' => $alert->latitude,
                'longitude' => $alert->longitude,
                'description' => $alert->description
            ];
        }

        return response()->json([
                    json_encode($result),
                        ], Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pagintaionEnabled = config('atm_app.enablePagination');
        $alerts = Alert::select();
        $alertstotal = Alert::count();

        if ($pagintaionEnabled) {
            $alerts = $alerts->paginate(config('atm_app.paginateListSize'));
        }

        //return View('verticalsignals.show-vertical-signals', compact('alerts', 'alertstotal'));
        return View('alerts.home', compact('alerts', 'alertstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $sinventories = SignalInventory::all();
        $materials = json_decode(Configuration::where('code', 'material')->first()->values);
        $fasteners = json_decode(Configuration::where('code', 'fijacion')->first()->values);
        $normatives = json_decode(Configuration::where('code', 'normativa')->first()->values);
        $orientations = json_decode(Configuration::where('code', 'direction')->first()->values);
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);

        return view('alerts.create', compact(
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function show(Alert $alert) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function edit(Alert $alert) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alert $alert) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alert $alert) {
        //
    }

}
