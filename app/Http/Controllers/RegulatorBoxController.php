<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Intersection;
use App\Models\RegulatorBox;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegulatorBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');
        $regulator_boxes = RegulatorBox::select();
        $regulator_box_total = RegulatorBox::count();

        if ($pagintaionEnabled) {
            $regulator_boxes = $regulator_boxes->paginate(config('atm_app.paginateListSize'));
        }

        return View('regulator-boxes.show-regulator-boxes', compact('regulator_boxes', 'regulator_box_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $intersections = Intersection::all();
        $states = json_decode(Configuration::where('code', 'estado')->first()->values);
        $brands = json_decode(Configuration::where('code', 'brand')->first()->values);

        return View('regulator-boxes.create-regulator-box', compact('intersections', 'states', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), RegulatorBox::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $picture_in = null;
        if ($request->input('picture_data_in')) {
            $picture_data_in = $request->input('picture_data_in');

            $ext = null;
            if (strpos($picture_data_in, 'data:image/jpeg;base64,') === 0) {
                $picture_data_in = str_replace('data:image/jpeg;base64,', '', $picture_data_in);
                $ext = '.jpg';
            }
            if (strpos($picture_data_in, 'data:image/png;base64,') === 0) {
                $picture_data_in = str_replace('data:image/png;base64,', '', $picture_data_in);
                $ext = '.png';
            }

            $picture_in = Str::random() . '.' . $ext;
            $picture_data_in = str_replace(' ', '+', $picture_data_in);
            $data = base64_decode($picture_data_in);

            if (!file_put_contents(storage_path('app/public_html/regulators/') . $picture_in, $data)) {
                return back()->with('error', trans('Error guardando la imagen. Inténtelo de nuevo o contacte al administrador.'));
            }
        }

        $picture_out = null;
        if ($request->input('picture_data_out')) {
            $picture_data_out = $request->input('picture_data_out');

            $ext = null;
            if (strpos($picture_data_out, 'data:image/jpeg;base64,') === 0) {
                $picture_data_out = str_replace('data:image/jpeg;base64,', '', $picture_data_out);
                $ext = '.jpg';
            }
            if (strpos($picture_data_out, 'data:image/png;base64,') === 0) {
                $picture_data_out = str_replace('data:image/png;base64,', '', $picture_data_out);
                $ext = '.png';
            }

            $picture_out = Str::random() . '.' . $ext;
            $picture_data_out = str_replace(' ', '+', $picture_data_out);
            $data = base64_decode($picture_data_out);

            if (!file_put_contents(storage_path('app/public_html/regulators/') . $picture_out, $data)) {
                return back()->with('error', trans('Error guardando la imagen. Inténtelo de nuevo o contacte al administrador.'));
            }
        }

        $regulator = RegulatorBox::create([
            'user_id' => Auth::user()->id,
            'intersection_id' => $request->input('intersection'),
            'code' => $request->input('code'),
            'brand' => $request->input('brand'),
            'state' => $request->input('state'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'google_address' => $request->input('google_address'),
            'picture_in' => $picture_in,
            'picture_out' => $picture_out,
            'comment' => $request->input('comment'),
            'erp_code' => $request->input('erp_code'),
        ]);

        if ($regulator) {
            return redirect('regulator-boxes/' . $regulator->id)->with('success', trans('regulator-boxes.createSuccess'));
        }

        return back()->with('error', trans('regulator-boxes.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $regulator = RegulatorBox::find($id);

        return view('regulator-boxes.show-regulator-box', compact('regulator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regulator_box = RegulatorBox::find($id);

        if ($regulator_box) {
            $intersections = Intersection::all();
            $states = json_decode(Configuration::where('code', 'estado')->first()->values);
            $brands = json_decode(Configuration::where('code', 'brand')->first()->values);

            return View('regulator-boxes.edit-regulator-box', compact('regulator_box', 'intersections', 'states', 'brands'));
        }

        return back()->with('error', trans('regulator-boxes.messages.show-error'));
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
        $regulator = RegulatorBox::find($id);

        if ($regulator) {
            if ($request->latitude && $request->latitude != $regulator->latitude) {
                $regulator->latitude = $request->latitude;
            }

            if ($request->longitude && $request->longitude != $regulator->longitude) {
                $regulator->longitude = $request->longitude;
            }

            if ($request->google_address && $request->google_address != $regulator->google_address) {
                $regulator->google_address = $request->google_address;
            }

            if ($request->erp_code && $request->erp_code != $regulator->erp_code) {
                $regulator->erp_code = $request->erp_code;
            }

            if ($request->intersection && $request->intersection != $regulator->intersection_id) {
                $regulator->intersection_id = $request->intersection;
            }

            if ($request->state && $request->state != $regulator->state) {
                $regulator->state = $request->state;
            }

            if ($request->brand && $request->brand != $regulator->brand) {
                $regulator->brand = $request->brand;
            }

            if ($request->comment && $request->comment != $regulator->comment) {
                $regulator->comment = $request->comment;
            }

            $picture_in = null;
            $old_picture_in = null;
            if ($request->input('picture_data_in')) {
                $picture_data_in = $request->input('picture_data_in');

                $ext = null;
                if (strpos($picture_data_in, 'data:image/jpeg;base64,') === 0) {
                    $picture_data_in = str_replace('data:image/jpeg;base64,', '', $picture_data_in);
                    $ext = '.jpg';
                }
                if (strpos($picture_data_in, 'data:image/png;base64,') === 0) {
                    $picture_data_in = str_replace('data:image/png;base64,', '', $picture_data_in);
                    $ext = '.png';
                }

                $picture_in = Str::random() . '.' . $ext;
                $picture_data_in = str_replace(' ', '+', $picture_data_in);
                $data = base64_decode($picture_data_in);

                if (!file_put_contents(storage_path('app/public_html/regulators/') . $picture_in, $data)) {
                    return back()->with('error', trans('Error guardando la imagen. Inténtelo de nuevo o contacte al administrador.'));
                }

                $old_picture_in = public_path('/storage/regulators/' . $regulator->picture_in);
                $regulator->picture_in = $picture_in;
            }

            $picture_out = null;
            $old_picture_out = null;
            if ($request->input('picture_data_out')) {
                $picture_data_out = $request->input('picture_data_out');

                $ext = null;
                if (strpos($picture_data_out, 'data:image/jpeg;base64,') === 0) {
                    $picture_data_out = str_replace('data:image/jpeg;base64,', '', $picture_data_out);
                    $ext = '.jpg';
                }
                if (strpos($picture_data_out, 'data:image/png;base64,') === 0) {
                    $picture_data_out = str_replace('data:image/png;base64,', '', $picture_data_out);
                    $ext = '.png';
                }

                $picture_out = Str::random() . '.' . $ext;
                $picture_data_out = str_replace(' ', '+', $picture_data_out);
                $data = base64_decode($picture_data_out);

                if (!file_put_contents(storage_path('app/public_html/regulators/') . $picture_out, $data)) {
                    return back()->with('error', trans('Error guardando la imagen. Inténtelo de nuevo o contacte al administrador.'));
                }

                $old_picture_out = public_path('/storage/regulators/' . $regulator->picture_out);
                $regulator->picture_out = $picture_out;
            }

            if ($regulator->save()) {
                if ($old_picture_in) {
                    Storage::delete($old_picture_in);
                }

                if ($old_picture_out) {
                    Storage::delete($old_picture_out);
                }

                return redirect('regulator-boxes/' . $regulator->id)->with('success', trans('regulator-boxes.updateSuccess'));
            }
        }

        return back()->with('error', trans('regulator-boxes.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $regulator = RegulatorBox::find($id);

        if ($regulator && $regulator->delete()) {
            return redirect('regulator-boxes')->with('success', trans('regulator-boxes.messages.delete-success'));
        }

        return back()->with('error', trans('regulator-boxes.messages.delete-error'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('regulator_search_box');
        $searchRules = [
            'regulator_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'regulator_search_box.required' => 'Search term is required',
            'regulator_search_box.string' => 'Search term has invalid characters',
            'regulator_search_box.max' => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $result = RegulatorBox::where('state', 'like', '%' . $searchTerm . '%')
            ->orWhere('brand', 'like', '%' . $searchTerm . '%')
            ->orWhere('comment', 'like', '%' . $searchTerm . '%')
            ->orWhere('code', 'like', '%' . $searchTerm . '%')
            ->orWhere('erp_code', 'like', '%' . $searchTerm . '%')
            ->orWhere('google_address', 'like', '%' . $searchTerm . '%')->get();

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
    }

    public function today()
    {
        return response()->json(RegulatorBox::where('updated_at', '>=', Carbon::today())->get(), Response::HTTP_OK);
    }

    public function all()
    {
        return response()->json(RegulatorBox::all(), Response::HTTP_OK);
    }
}
