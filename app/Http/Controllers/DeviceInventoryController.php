<?php

namespace App\Http\Controllers;

use App\Models\DevicesInventory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DeviceInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagintaionEnabled = config('atm_app.enablePagination');
        $inventoriestotal = DevicesInventory::count();
        if ($pagintaionEnabled) {
            $inventories = DevicesInventory::orderby('code', 'asc')->paginate(config('atm_app.paginateListSize'));
        } else {
            $inventories = DevicesInventory::orderby('code', 'asc')->all();
        }

        return View('devices-inventory.show-device-inventories', compact('inventories', 'inventoriestotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('devices-inventory.create-device-inventory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), DevicesInventory::rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $symbol_name = null;
        if ($request->hasFile('symbol')) {
            $symbol = $request->file('symbol');
            $symbol_name = $request->input('code') . '.' . $symbol->getClientOriginalExtension();
            $symbol->storeAs('inventory/devices/', $symbol_name);
        }

        $device = DevicesInventory::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'dimensions' => $request->input('dimensions'),
            'erp_code' => $request->input('erp_code') ? $request->input('erp_code') : null,
            'symbol' => $symbol_name
        ]);

        if ($device) {
            return redirect('devices-inventory/' . $device->id)->with('success', trans('devices-inventory.createSuccess'));
        }

        return back()->with('error', trans('devices-inventory.messages.create-error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = DevicesInventory::findOrFail($id);

        if ($device) {
            return view('devices-inventory.show-device-inventory', compact('device'));
        }

        return back()->with('error', trans('device-inventory.messages.show-error'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $device = DevicesInventory::findOrFail($id);

        if ($device) {
            return view('devices-inventory.edit-device-inventory', compact('device'));
        }

        return back()->with('error', trans('device-inventory.messages.show-error'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:100'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $device = DevicesInventory::find($id);

        if ($device) {
            if ($request->name && $request->name != $device->name_id) {
                $device->name = $request->name;
            }

            if ($request->erp_code && $request->erp_code != $device->erp_code_id) {
                $device->erp_code = $request->erp_code;
            }

            if ($request->dimensions && $request->dimensions != $device->dimensions_id) {
                $device->dimensions = $request->dimensions;
            }

            $device_name = null;
            $old_symbol = null;
            if ($request->hasFile('symbol')) {
                $symbol = $request->file('symbol');
                $device_name = $device->code . '.' . $symbol->getClientOriginalExtension();

                if ($device->symbol) {
                    $old_symbol = public_path('storage/inventory/devices/' . $device->symbol);
                    Storage::delete($old_symbol);
                }
                $symbol->storeAs('inventory/devices/', $device_name);

                $device->symbol = $device_name;
            }

            if ($device->save()) {
                return redirect('devices-inventory/' . $device->id)->with('success', trans('device-inventory.updateSuccess'));
            }
        }

        return back()->with('error', trans('device-inventory.messages.update-error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = DevicesInventory::findOrFail($id);

        if ($device) {
            $device->delete();
            return redirect('devices-inventory')->with('success', trans('device-inventory.messages.delete-success'));
        }

        return back()->with('error', trans('device-inventory.messages.delete-error'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('device_search_box');
        $searchRules = [
            'device_search_box' => 'required|string|max:255',
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

        $result = DevicesInventory::where('code', 'like', '%' . $searchTerm . '%')
            ->orWhere('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('dimensions', 'like', '%' . $searchTerm . '%')
            ->orWhere('erp_code', 'like', '%' . $searchTerm . '%')->get();

        return response()->json([
            json_encode($result),
        ], Response::HTTP_OK);
    }
}
