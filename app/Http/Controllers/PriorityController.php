<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Priority;

class PriorityController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pagintaionEnabled = config('atm_app.enablePagination');
        $priorities = Priority::all();
        $prioritiestotal = Priority::count();
        return View('priorities.home', compact('priorities', 'prioritiestotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $prioritys = Priority::all();
        return view('priorities.create', compact($prioritys, 'prioritys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $attributes = $request->validate([
            'name' => ['required', 'unique:priorities']
        ]);
        $newone = new Priority($attributes);
        $retorno = tap($newone)->save();
        if ($retorno) {
            return redirect('priorities/' . $newone->id)->with('success', trans('motives.createSuccess'));
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
        $priority = Priority::findOrFail($id);
        return view('priorities.show', compact($priority, 'priority'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $priority = Priority::findOrFail($id);
        return view('priorities.edit', compact($priority, 'priority'));
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
        $retorno = \DB::table('priorities')
                ->where('id', $id)
                ->update($attributes);
        if ($retorno) {
            return redirect()->to(url('/priorities'))->with('status', '-' . __('updated'));
        } else {
            return redirect()->to(url('/priorities'))->with('status', '-' . __('nope'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $retorno = \DB::table('priorities')
                ->where('id', $id)
                ->update(['activa' => 0]);
        if ($retorno) {
            return redirect()->to(url('/priorities'))->with('status', '-' . __('Desactivada'));
        } else {
            return redirect()->to(url('/priorities'))->with('status', '-' . __('Ya habia sido desactivada'));
        }
    }

}
