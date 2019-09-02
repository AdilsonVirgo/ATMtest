<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;


class MaterialController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pagintaionEnabled = config('atm_app.enablePagination');
        $materials = Material::all();
        $materialstotal = Material::count();
        return View('materials.home', compact('materials', 'materialstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $materials = Material::all();
        return view('materials.create', compact($materials, 'materials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $attributes = $request->validate([
            'name' => ['required', 'unique:materials'],
            'description' => []
        ]);
        $newone = new Material($attributes);
        $retorno = tap($newone)->save();
        //notificar a todos los usuarios
        /* $users = \App\User::all();
          foreach($users as $user){
          $user->notify(new \App\Notifications\MaterialNotification($newone));
          } */
        if ($retorno) {
            return redirect('materials/' . $newone->id)->with('success', trans('materials.createSuccess'));
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
        $material = Material::findOrFail($id);
        return view('materials.show', compact($material, 'material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $material = Material::findOrFail($id);
        return view('materials.edit', compact($material, 'material'));
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
        $retorno = \DB::table('materials')
                ->where('id', $id)
                ->update($attributes);
        if ($retorno) {
            return redirect('materials/' . $id)->with('success', trans('materials.createSuccess'));
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
        Material::findOrFail($id)->delete();
        return redirect('materials/' . $id)->with('success', trans('materials.createSuccess'));
    }

}
