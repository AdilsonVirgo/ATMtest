<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\DevicesInventory;
use App\Models\Intersection;
use App\Models\RegulatorBox;
use App\Models\TrafficLight;
use App\Models\TrafficPole;
use App\Models\TrafficTensor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TrafficLightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pagintaionEnabled = config('atm_app.enablePagination');
        $lights = TrafficLight::select();
        $lightstotal = TrafficLight::count();

        if ($pagintaionEnabled) {
            $lights = $lights->paginate(config('atm_app.paginateListSize'));
        }

        return View('traffic-lights.show-traffic-lights', compact('lights', 'lightstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $intersections = Intersection::all();
        $traffic_poles = TrafficPole::with('intersection')->get();
        $traffic_tensors = TrafficTensor::all();
        $traffic_regulators = RegulatorBox::all();

        if (count($traffic_regulators) == 0 && (count($traffic_poles) == 0 || count($traffic_tensors) == 0)) {
            return redirect('/traffic-lights')->with('error', 'Aun no existen reguladoras de tráfico, postes o tensores. Debe crearlos antes.');
        }

        $light_types = DevicesInventory::where('name', 'like', '%SEMAFORO%')->get();
        $brands = json_decode(Configuration::where('code', 'brand')->first()->values);
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);
        $orientations = json_decode(Configuration::where('code', 'direction')->first()->values);

        return view('traffic-lights.create-traffic-light', compact('intersections', 'traffic_poles', 'traffic_tensors', 'traffic_regulators', 'light_types', 'brands', 'states', 'orientations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), TrafficLight::rules());

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

            if (!file_put_contents(storage_path('app/public_html/lights/') . $picture_name, $data)) {
                return back()->with('error', trans('Error guardando la imagen. Inténtelo de nuevo o contacte al administrador.'));
            }
        }

        $traffic_light = TrafficLight::create([
            'code' => $request->input('code'),
            'erp_code' => $request->input('erp_code'),
            'user_id' => Auth::user()->id,
            'type_id' => $request->input('light_type'),
            'intersection_id' => $request->input('intersection'),
            'tensor_id' => $request->input('tensor'),
            'pole_id' => $request->input('pole'),
            'regulator_id' => $request->input('regulator'),
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'state' => $request->input('state'),
            'picture' => $picture_name,
            'orientation' => $request->input('orientation'),
            'comment' => $request->input('comment')
        ]);

        if ($traffic_light) {
            return redirect('traffic-lights/' . $traffic_light->id)->with('success', trans('traffic-lights.createSuccess'));
        }

        return back()->with('error', trans('traffic-lights.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $traffic_light = TrafficLight::find($id);

        return view('traffic-lights.show-traffic-light', compact('traffic_light'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $traffic_light = TrafficLight::find($id);

        if ($traffic_light) {
            $intersections = Intersection::all();
            $traffic_poles = TrafficPole::all();
            $traffic_tensors = TrafficTensor::all();
            $traffic_regulators = RegulatorBox::all();
            $light_types = DevicesInventory::where('name', 'like', '%SEMAFORO%')->get();
            $brands = json_decode(Configuration::where('code', 'brand')->first()->values);
            $states = json_decode(Configuration::where('code', 'estado')->first()->values);
            $orientations = json_decode(Configuration::where('code', 'direction')->first()->values);

            return view('traffic-lights.edit-traffic-light', compact('traffic_light', 'intersections', 'traffic_poles', 'traffic_tensors', 'traffic_regulators', 'light_types', 'brands', 'states', 'orientations'));
        }

        return back()->with('error', trans('traffic-lights.messages.show-error'));
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
        $traffic_light = TrafficLight::find($id);

        if ($traffic_light) {
            if ($request->erp_code && $request->erp_code != $traffic_light->erp_code) {
                $traffic_light->erp_code = $request->erp_code;
            }

            if ($traffic_light->user_id != Auth::user()->id) {
                $traffic_light->user_id = Auth::user()->id;
            }

            if ($request->light_type && $request->light_type != $traffic_light->type_id) {
                $traffic_light->type_id = $request->light_type;
            }

            if ($request->intersection && $request->intersection != $traffic_light->intersection_id) {
                $traffic_light->intersection_id = $request->intersection;
            }

            if ($request->tensor && $request->tensor != $traffic_light->tensor_id) {
                $traffic_light->tensor_id = $request->tensor;
            }

            if ($request->tensor == null && $traffic_light->tensor_id != null) {
                $traffic_light->tensor_id = null;
            }

            if ($request->pole && $request->pole != $traffic_light->pole_id) {
                $traffic_light->pole_id = $request->pole;
            }

            if ($request->pole == null && $traffic_light->pole_id != null) {
                $traffic_light->pole_id = null;
            }

            if ($request->regulator && $request->regulator != $traffic_light->regulator_id) {
                $traffic_light->regulator_id = $request->regulator;
            }

            if ($request->brand && $request->brand != $traffic_light->brand) {
                $traffic_light->brand = $request->brand;
            }

            if ($request->model && $request->model != $traffic_light->model) {
                $traffic_light->model = $request->model;
            }

            if ($request->state && $request->state != $traffic_light->state) {
                $traffic_light->state = $request->state;
            }

            if ($request->orientation && $request->orientation != $traffic_light->orientation) {
                $traffic_light->orientation = $request->orientation;
            }

            if ($request->comment && $request->comment != $traffic_light->comment) {
                $traffic_light->comment = $request->comment;
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
                $old_picture = public_path('/storage/lights/' . $traffic_light->picture);
                $picture_data = str_replace(' ', '+', $picture_data);
                $data = base64_decode($picture_data);

                if (!file_put_contents(storage_path('app/public_html/lights/') . $picture_name, $data)) {
                    return back()->with('error', trans('Error guardando la imagen. Inténtelo de nuevo o contacte al administrador.'));
                }

                $traffic_light->picture = $picture_name;
            }

            if ($traffic_light->save()) {
                if ($old_picture) {
                    Storage::delete($old_picture);
                }

                return redirect('traffic-lights/' . $traffic_light->id)->with('success', trans('traffic-lights.updateSuccess'));
            }
        }

        return back()->with('error', trans('traffic-lights.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $traffic_light = TrafficLight::find($id);

        if ($traffic_light) {
            $traffic_light->delete();

            return redirect('traffic-lights')->with('success', trans('traffic-lights.messages.delete-success'));
        }

        return back()->with('error', trans('device-lights.messages.delete-error'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('traffic_light_search_box');
        $searchRules = [
            'traffic_light_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'traffic_light_search_box.required' => 'Search term is required',
            'traffic_light_search_box.string' => 'Search term has invalid characters',
            'traffic_light_search_box.max' => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $result = TrafficLight::where('code', 'like', '%' . $searchTerm . '%')
            ->orWhere('erp_code', 'like', '%' . $searchTerm . '%')
            ->orWhere('state', 'like', '%' . $searchTerm . '%')
            ->orWhere('brand', 'like', '%' . $searchTerm . '%')
            ->orWhere('model', 'like', '%' . $searchTerm . '%')
            ->orWhere('orientation', 'like', '%' . $searchTerm . '%')
            ->orWhere('comment', 'like', '%' . $searchTerm . '%')->get();

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
    }
}
