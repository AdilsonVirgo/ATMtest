<?php

namespace App\Http\Controllers;

use App\Models\TrafficPole;
use App\Models\TrafficTensor;
use App\Models\Configuration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TrafficTensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');
        $tensors = TrafficTensor::select();
        $tensorstotal = TrafficTensor::count();

        if ($pagintaionEnabled) {
            $tensors = $tensors->paginate(config('atm_app.paginateListSize'));
        }

        return View('traffic-tensors.show-traffic-tensors', compact('tensors', 'tensorstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $traffic_poles = TrafficPole::all();
        $materials = json_decode(Configuration::where('code', 'material')->first()->values);
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);

        return view('traffic-tensors.create-traffic-tensor', compact('traffic_poles', 'materials', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), TrafficTensor::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $tensor = TrafficTensor::create([
            'user_id' => Auth::user()->id,
            'state' => $request->input('state'),
            'height' => $request->input('height'),
            'material' => $request->input('material'),
            'comment' => $request->input('comment')
        ]);

        if ($tensor) {
            foreach ($request->input('poles') as $pole_id) {
                $tensor->poles()->attach($pole_id);
            }

            return redirect('traffic-tensors/' . $tensor->id)->with('success', trans('traffic-tensors.createSuccess'));
        }

        return back()->with('error', trans('traffic-tensors.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        $traffic_tensor = TrafficTensor::find($id);

        return view('traffic-tensors.show-traffic-tensor', compact('traffic_tensor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        $traffic_tensor = TrafficTensor::find($id);

        if ($traffic_tensor) {
            $traffic_poles = TrafficPole::all();
            $materials = json_decode(Configuration::where('code', 'material')->first()->values);
            $states = json_decode(Configuration::where('code', 'estado')->first()->values);

            return view('traffic-tensors.edit-traffic-tensor', compact('traffic_tensor', 'traffic_poles', 'materials', 'states'));
        }

        return back()->with('error', trans('traffic-tensors.messages.show-error'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        $traffic_tensor = TrafficTensor::find($id);

        if ($traffic_tensor) {
            if ($request->state && $request->state != $traffic_tensor->state) {
                $traffic_tensor->state = $request->state;
            }

            if ($request->height && $request->height != $traffic_tensor->height) {
                $traffic_tensor->height = $request->height;
            }

            if ($request->material && $request->material != $traffic_tensor->material) {
                $traffic_tensor->material = $request->material;
            }

            if ($request->comment && $request->comment != $traffic_tensor->comment) {
                $traffic_tensor->comment = $request->comment;
            }

            if ($request->input('poles')) {
                $traffic_tensor->poles()->detach();

                foreach ($request->input('poles') as $pole_id) {
                    $traffic_tensor->poles()->attach($pole_id);
                }
            }

            if ($traffic_tensor->save()) {
                return redirect('traffic-tensors/' . $traffic_tensor->id)->with('success', trans('traffic-tensors.updateSuccess'));
            }
        }

        return back()->with('error', trans('traffic-tensors.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $tensor = TrafficTensor::find($id);

        if ($tensor) {
            foreach ($tensor->poles as $pole) {
                $tensor->poles()->detach($pole->id);
            }
            $tensor->delete();

            return redirect('traffic-tensors')->with('success', trans('traffic-tensors.messages.delete-success'));
        }

        return back()->with('error', trans('device-tensors.messages.delete-error'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('traffic_tensor_search_box');
        $searchRules = [
            'traffic_tensor_search_box' => 'required|string|max:255',
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

        $result = TrafficTensor::where('state', 'like', '%' . $searchTerm . '%')
            ->orWhere('material', 'like', '%' . $searchTerm . '%')
            ->orWhere('comment', 'like', '%' . $searchTerm . '%')
            ->orWhere('height', '=', $searchTerm)->get();

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
    }

    public function today()
    {
        return response()->json(TrafficTensor::where('updated_at', '>=', Carbon::today())->get(), Response::HTTP_OK);
    }

    public function all()
    {
        return response()->json(TrafficTensor::all(), Response::HTTP_OK);
    }
}
