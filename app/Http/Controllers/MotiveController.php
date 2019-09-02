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
        return View('motives.home', compact('motives', 'motivestotal'));
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
            return redirect('motives/' . $id)->with('success', trans('motives.createSuccess'));
        }
        return back()->with('error', trans('Error creando el motivo. Inténtelo de nuevo o contacte al administrador.'));
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Motive::findOrFail($id)->delete();
       return redirect('motives/' . $id)->with('success', trans('motives.createSuccess'));
    }
    //
}
