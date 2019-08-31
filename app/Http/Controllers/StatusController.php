<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        return view('statuses.index',compact($statuses,'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::all();
        return view('statuses.create',compact($statuses,'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'unique:statuses']          
            ]);
            $retorno = tap(new Status($attributes))->save();
            if ($retorno) {
            return redirect()->to(url('/statuses'))->with('status', 'Inserted');
            } else {
            return redirect()->to(url('/statuses'))->with('status', 'No Inserted');
            } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = Status::findOrFail($id);
        return view('statuses.show',compact($status,'status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = Status::findOrFail($id);
        return view('statuses.edit',compact($status,'status'));
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
        $attributes = $request->validate(
            [
                'name' => ['required'],
    ]);
    $retorno = \DB::table('statuses')
            ->where('id', $id)
            ->update($attributes);
    if ($retorno) {
        return redirect()->to(url('/statuses'))->with('status', '-' . __('updated'));
    } else {
        return redirect()->to(url('/statuses'))->with('status', '-' . __('nope'));
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $retorno = \DB::table('statuss')
        ->where('id', $id)
        ->update(['activa' => 0]);
if ($retorno) {
    return redirect()->to(url('/statuses'))->with('status', '-' . __('Desactivada'));
} else {
    return redirect()->to(url('/statuses'))->with('status', '-' . __('Ya habia sido desactivada'));
}
    }
}