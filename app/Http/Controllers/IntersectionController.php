<?php

namespace App\Http\Controllers;

use App\Models\Intersection;
use App\Models\VerticalSignal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IntersectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');
        $intersections = Intersection::select();
        $intersectionstotal = Intersection::count();

        if ($pagintaionEnabled) {
            $intersections = $intersections->paginate(config('atm_app.paginateListSize'));
        }

        return View('intersections.show-intersections', compact('intersections', 'intersectionstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intersections.create-intersection');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Intersection::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $intersection = Intersection::create([
            'main_st' => $request->input('main_st'),
            'cross_st' => $request->input('cross_st'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'google_address' => $request->input('google_address'),
            'comment' => $request->input('comment'),
        ]);

        if ($intersection) {
            return redirect('intersections/' . $intersection->id)->with('success', trans('intersections.createSuccess'));
        }

        return back()->with('error', trans('Error creando la intersección. Inténtelo de nuevo o contacte al administrador.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $intersection = Intersection::find($id);
        return view('intersections.show-intersection', compact('intersection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $intersection = Intersection::find($id);
        return view('intersections.edit-intersection', compact('intersection'));
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
        $intersection = Intersection::findOrFail($id);

        if ($request->get('latitude') && $intersection->latitude != $request->input('latitude')) {
            $intersection->latitude = $request->input('latitude');
        }

        if ($request->get('longitude') && $intersection->longitude != $request->input('longitude')) {
            $intersection->longitude = $request->input('longitude');
        }

        if ($request->get('google_address') && $intersection->google_address != $request->input('google_address')) {
            $intersection->google_address = $request->input('google_address');
        }

        if ($request->get('comment') && $intersection->comment != $request->input('comment')) {
            $intersection->comment = $request->input('comment');
        }

        if ($request->get('main_st') && $intersection->main_st != $request->input('main_st')) {
            $intersection->main_st = $request->input('main_st');
        }

        if ($request->get('cross_st') && $intersection->cross_st != $request->input('cross_st')) {
            $intersection->cross_st = $request->input('cross_st');
        }

        if ($intersection->save()) {
            return redirect('intersections/' . $intersection->id)->with('success', trans('verticalsignals.message.update-intersection-success'));
        }

        return back()->with('error', trans('verticalsignals.message.update-intersection-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $intersection = Intersection::findOrFail($id);

        if (Auth::user()->hasRole('atmadmin')) {
            $intersection->delete();
            return redirect('intersections')->with('success', trans('intersections.messages.delete-success'));
        }

        return back()->with('error', trans('verticalsignals.messages.delete-error'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('intersection_search_box');
        $searchRules = [
            'intersection_search_box' => 'required|string|max:255',
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

        $intersections = Intersection::where('main_st', 'like', '%' . $searchTerm . '%')
            ->orWhere('cross_st', 'like', '%' . $searchTerm . '%')->get();

        return response()->json([
            json_encode($intersections),
        ], Response::HTTP_OK);
    }

    public function today()
    {
        return response()->json(Intersection::where('updated_at', '>=', Carbon::today())->get(), Response::HTTP_OK);
    }

    public function all()
    {
        return response()->json(Intersection::all(), Response::HTTP_OK);
    }
}
