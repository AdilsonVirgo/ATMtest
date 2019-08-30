<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller {

    
    public function __construct() {
        $this->middleware('auth');
    }
   

    public function index() {
        $motives = Motive::all();
        $statuses = Motive::all();
        $priorities = Motive::all();
        $alerts = Alert::all();
        //return view('alerts.index',['alerts','motives','statuses','priorities']);
        return view('alerts.index', compact($alerts, 'alerts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $alerts = Alert::all();
        $priorities = Priority::all();
        $motives = Motive::all();
        $statuses = Status::all();
        return view('alerts.create', compact('alerts', 'priorities', 'statuses', 'motives'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $provincia = new Alert();
        $provincia->place = $request->get('place');
        $provincia->user_id = auth()->user()->id;
        $provincia->priority_id = $request->get('priority_id');
        $provincia->status_id = 1; //el id no el nombre  1-pendiente
        $provincia->motive_id = $request->get('motive_id');
        $provincia->description = $request->get('description');
        $retorno = $provincia->save();
		$user = User::find(auth()->user()->id);	
				 
        $details = [ 'greeting' => 'Hi Artisan',
            'body' => 'This is my first notification ',
            'thanks' => 'Thank you for us!',
            'actionText' => 'View My Site',
            'actionURL' => url('/'),
            'alert_id' => 101
        ];
		$user->notify(new AlertCreatedNotification($details));
		dd('done');
        // dd($retorno);
        if ($retorno) {
            return redirect()->to(url('/alerts'))->with('status', 'Inserted');
        } else {
            return redirect()->to(url('/alerts'))->with('status', 'No Inserted');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function show(Alert $alert) {
        //$alert = Alerts::find($id);
        return view('alerts.show', compact($alert, 'alert'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function edit(Alert $alert) {
        // $status = Status::find($id);
        $alerts = Motive::all();
        $priorities = Priority::all();
        $motives = Motive::all();
        $statuses = Status::all();
        return view('alerts.edit', compact('alert', 'priorities', 'statuses', 'motives'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $attributes = [
            'place' => $request->get('place'), 'user_id' => auth()->user()->id,
            'priority_id' => $request->get('priority_id'), 'status_id' => $request->get('status_id'),
            'motive_id' => $request->get('motive_id'), 'description' => $request->get('description')
        ];
        $retorno = \DB::table('alerts')->where('id', $id)->update($attributes);
        if ($retorno) {
            return redirect()->to(url('/alerts'))->with('status', '-' . __('updated'));
        } else {
            return redirect()->to(url('/alerts'))->with('status', '-' . __('nope'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alert $alert) {
        //
    }
    public function completed(Request $request,$id){
       $retorno =  \DB::table('users')
                ->where('id', $id)
                ->update(['completed' => true]);
       return back();
    }
    
    
    ///////otros metodos
    public function reject(Request $request, $id) {       
        $retorno = \DB::table('alerts')->where('id', $id)->update(['status_id' => 3]);
        if ($retorno) {
            return redirect()->to(url('/alerts'))->with('status', '-' . __('rejected'));
        } else {
            return redirect()->to(url('/alerts'))->with('status', '-' . __('nope'));
        }
    }
     public function attend(Request $request, $id) {       
        $retorno = \DB::table('alerts')->where('id', $id)->update(['status_id' => 2]);
      //  dd($alert_id);//1-true  0-false
        $alerts = Alert::find($id);
        $reports = Report::all();
        if ($retorno) {
           return view('reports.created', compact('reports', 'alerts'));
        } else {
            return redirect()->to(url('/alerts'))->with('status', '-' . __('not possible'));
        }
        
        
    }

}
