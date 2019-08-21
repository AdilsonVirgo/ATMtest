<?php

namespace App\Http\Controllers;

use App\Models\SignalDimension;
use App\Models\SignalInventory;
use App\Models\SignalSubgroup;
use App\Models\SignalVariation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;

class SignalInventoryController extends Controller
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
        $inventoriestotal = SignalInventory::count();
        if ($pagintaionEnabled) {
            $inventories = SignalInventory::orderby('code', 'asc')->paginate(config('atm_app.paginateListSize'));
        } else {
            $inventories = SignalInventory::orderby('code', 'asc')->all();
        }

        return View('signalsinventory.show-signal-inventories', compact('inventories', 'inventoriestotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dimensions = SignalDimension::all();
        $subgroups = SignalSubgroup::all();

        return view('signalsinventory.create-signal-inventory', compact('dimensions', 'subgroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), SignalInventory::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $picture_name = null;
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $picture_name = Str::random() . '.' . $picture->getClientOriginalExtension();
            $picture->storeAs('inventory/signals/', $picture_name);
        }

        $picture_name_fn = null;
        if ($request->hasFile('picture_fn')) {
            $picture = $request->file('picture_fn');
            $picture_name_fn = Str::random() . '.' . $picture->getClientOriginalExtension();
            $picture->storeAs('inventory/signals/', $picture_name_fn);
        }

        $vsignal = SignalInventory::create([
            'subgroup_id' => $request->input('subgroup'),
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'usage' => $request->input('usage'),
            'description' => $request->input('description'),
            'picture' => $picture_name,
            'picture_fn' => $picture_name_fn,
            'erp_code' => $request->input('erp_code') ? $request->input('erp_code') : null
        ]);

        $variations = json_decode($request->input('variations'));
        foreach ($variations as $variation) {
            SignalVariation::create([
                'signal_id' => $vsignal->id,
                'variation' => $variation->variation_name,
                'dimension_id' => $variation->dimension_id
            ]);
        }

        if ($vsignal->save()) {
            return redirect('signals-inventory/' . $vsignal->id)->with('success', trans('signalsinventory.createSuccess'));
        }

        return back()->with('error', trans('signalsinventory.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vsignal = SignalInventory::find($id);

        return view('signalsinventory.show-signal-inventory', compact('vsignal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vsignal = SignalInventory::findOrFail($id);

        if ($vsignal) {
            $dimensions = SignalDimension::all();
            $subgroups = SignalSubgroup::all();

            $signal_variations = $vsignal->variations;

            if ($signal_variations) {
                foreach ($signal_variations as $variation) {
                    $variats[] = [
                        'variation_name' => $variation->variation,
                        'dimension_text' => $variation->signal_dimension->value,
                        'dimension_id' => $variation->signal_dimension->id
                    ];
                }
            }

            $variations = json_encode($variats);

            return view('signalsinventory.edit-signal-inventory', compact('vsignal', 'dimensions', 'subgroups', 'variations'));
        }

        return back()->with('error', trans('signalsinventory.messages.show-error'));
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
        $validator = Validator::make($request->all(), [
            'subgroup' => 'required|numeric',
            'name' => 'required|min:1|max:100',
            'variations' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $vsignal = SignalInventory::find($id);
        if ($request->subgroup && $request->subgroup != $vsignal->subgroup_id) {
            $vsignal->subgroup_id = $request->subgroup;
        }

        if ($request->name && $request->name != $vsignal->name) {
            $vsignal->name = $request->name;
        }

        if ($request->usage && $request->usage != $vsignal->usage) {
            $vsignal->usage = $request->usage;
        }

        if ($request->description && $request->description != $vsignal->description) {
            $vsignal->description = $request->description;
        }

        if ($request->erp_code && $request->erp_code != $vsignal->erp_code) {
            $vsignal->erp_code = $request->erp_code;
        }

        $picture_name = null;
        $old_picture = null;
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $picture_name = Str::random() . '.' . $picture->getClientOriginalExtension();
            $picture->storeAs('inventory/signals/', $picture_name);
            $old_picture = public_path('storage/inventory/signals/' . $vsignal->picture);
            $vsignal->picture = $picture_name;
        }

        $picture_name_fn = null;
        $old_picture_fn = null;
        if ($request->hasFile('picture_fn')) {
            $picture = $request->file('picture_fn');
            $picture_name_fn = Str::random() . '.' . $picture->getClientOriginalExtension();
            $picture->storeAs('inventory/signals/', $picture_name_fn);
            $old_picture_fn = public_path('storage/inventory/signals/', $vsignal->picture_fn);
            $vsignal->picture_fn = $picture_name_fn;
        }

        $variations = json_decode($request->input('variations'));

        if (count($variations)) {
            $vsignal->variations()->delete();

            foreach ($variations as $variation) {
                $vsignal->variations()->create([
                    'variation' => $variation->variation_name,
                    'dimension_id' => $variation->dimension_id
                ]);
            }
        }

        if ($vsignal->save()) {
            if ($old_picture) {
                Storage::delete($old_picture);
            }

            if ($old_picture_fn) {
                Storage::delete($old_picture_fn);
            }

            return redirect('signals-inventory/' . $vsignal->id)->with('success', trans('signalsinventory.updateSuccess'));
        }

        return back()->with('error', trans('signalsinventory.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vsignal = SignalInventory::findOrFail($id);

        if ($vsignal) {
            $vsignal->variations()->delete();
            $vsignal->delete();
            return redirect('signals-inventory')->with('success', trans('signalsinventory.messages.delete-success'));
        }

        return back()->with('error', trans('signalsinventory.messages.delete-error'));
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

        $vsignals = SignalInventory::select('signals_inventory.id as signal_id',
            'signals_inventory.code as signal_code',
            'signals_inventory.name as signal_name',
            'signal_groups.name as group_name',
            'signal_groups.code as group_code',
            'signal_subgroups.name as subgroup_name',
            'signal_subgroups.code as subgroup_code')
            ->join('signal_subgroups', 'signals_inventory.subgroup_id', '=', 'signal_subgroups.id')
            ->join('signal_groups', 'signal_subgroups.group_id', '=', 'signal_groups.id')
            ->where('signals_inventory.code', 'like', '%' . $searchTerm . '%')
            ->orWhere('signals_inventory.erp_code', 'like', '%' . $searchTerm . '%')
            ->orWhere('signals_inventory.name', 'like', '%' . $searchTerm . '%')
            ->orWhere('signals_inventory.usage', 'like', '%' . $searchTerm . '%')
            ->orWhere('signals_inventory.description', 'like', '%' . $searchTerm . '%')
            ->orWhere('signal_subgroups.name', 'like', '%' . $searchTerm . '%')
            ->orWhere('signal_groups.name', 'like', '%' . $searchTerm . '%');


        $result = [];
        foreach ($vsignals->get() as $vsignal) {
            $result[] = [
                'id' => $vsignal->signal_id,
                'code' => $vsignal->signal_code,
                'erp_code' => $vsignal->erp_code,
                'name' => $vsignal->signal_name,
                'group' => $vsignal->group_name . ' (' . $vsignal->group_code . ')',
                'subgroup' => $vsignal->subgroup_name . ' (' . $vsignal->subgroup_code . ')',
                'variations' => $vsignal->variations()->count(),
            ];
        }

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
    }
}
