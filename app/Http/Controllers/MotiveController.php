<?php

namespace App\Http\Controllers;

use App\Models\Motive;
use Illuminate\Http\Request;

class MotiveController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      //  $motives = Motive::all();
      //  $motivestotal = Motive::count();
      /*  return view('motives.index', compact($motives, 'motives'));*/
       $pagintaionEnabled = config('atm_app.enablePagination');
        $motives = Motive::select();
        $motivestotal = Motive::count();
        if ($pagintaionEnabled) {
            $motives = $motives->paginate(config('atm_app.paginateListSize'));
        }
        return View('motives.show-motives', compact('motives', 'motivestotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $motives = Motive::all();
        return view('motives.create', compact($motives, 'motives'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $attributes = $request->validate([
            'name' => ['required', 'unique:motives'],
            'description' => []
        ]);
        $newone = new Motive($attributes);
        $retorno = tap($newone)->save();
        //notificar a todos los usuarios
       /* $users = \App\User::all();
        foreach($users as $user){
            $user->notify(new \App\Notifications\MotiveNotification($newone));
        }*/
        if ($retorno) {
            return redirect('motives/' . $newone->id)->with('success', trans('motives.createSuccess'));
        }
        return back()->with('error', trans('Error creando el motivo. Inténtelo de nuevo o contacte al administrador.'));
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $motive = Motive::findOrFail($id);
        return view('motives.show', compact($motive, 'motive'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $motive = Motive::findOrFail($id);
        return view('motives.edit', compact($motive, 'motive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $attributes = $request->validate(
                [
                    'name' => ['required'],
        ]);
        $retorno = \DB::table('motives')
                ->where('id', $id)
                ->update($attributes);
        if ($retorno) {
            return redirect()->to(url('/motives'))->with('status', '-' . __('updated'));
        } else {
            return redirect()->to(url('/motives'))->with('status', '-' . __('nope'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Motive::findOrFail($id)->delete();
        return redirect()->to(url('/motives'))->with('status', '-' . __('Desactivada'));
    }
    //
    public function search(Request $request)
    {
        $searchTerm = $request->input('vsignal_search_box');
        dd( $searchTerm);
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
