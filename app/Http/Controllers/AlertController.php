<?php

namespace App\Http\Controllers;
use App\Models\DevicesInventory;
use App\Models\Alert;
use App\Models\Motive;
use App\Models\Status;
use App\Models\Priority;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\AlertCreatedNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AlertController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $motives = Motive::all();
        $statuses = Status::all();
        $priorities = Priority::all();
        $alerts = Alert::all();
        $alertstotal = Alert::count();
        return view('alerts.home', compact('alerts', 'priorities', 'motives', 'statuses', 'alertstotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $alerts = Alert::all();
        $devices = DevicesInventory::all();
        $priorities = Priority::all();
        $motives = Motive::all();
        $statuses = Status::all();
        return view('alerts.create', compact('alerts', 'priorities', 'statuses', 'motives','devices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
       // dd($request);//back verification device_id if collector
        $pendiente_id = DB::table('statuses')->where('name', 'pendiente')->first();

        $alertaux = new Alert();
        $alertaux->place = $request->get('place');
        $alertaux->user_id = auth()->user()->id;
        $alertaux->priority_id = $request->get('priority_id');
        $alertaux->status_id = $pendiente_id->id; //el id no el nombre  1-pendiente2-atendido3-desetimado cuando pase por 2,llenar el completed
        $alertaux->motive_id = $request->get('motive_id');
        $alertaux->description = $request->get('description');
        $retorno = $alertaux->save();
        if (auth()->user()->getRoles()[0]->level == 2) {
            //cambiar el pendiente de la alertas
            $aux = new Report();
            $aux->user_id = auth()->user()->id;
            $aux->alert_id = $alertaux->id;
            $aux->status_id = $pendiente_id->id; 
            $aux->device_id = $request->get('device_id');
            $aux->assign_id = auth()->user()->id;
            $aux->description = $alertaux->description;
            $rep = $aux->save();    
            //dd($aux); 
        } else {
            //notificar a todo el mundo notificacion grupal
            $users = User::all();
            foreach ($users as $user) {
                $user->notify(new \App\Notifications\AlertNotificacion($alertaux));
            }
        }
        if ($retorno) {
            return redirect('alerts/' . $alertaux->id)->with('success', trans('alerts.createSuccess'));
        }
        return back()->with('error', trans('Error creando la alerta. Inténtelo de nuevo o contacte al administrador.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function show(Alert $alert) {
        //$alert = Alerts::find($id);
        //si alguna notificaccion tiene este data id, en este user marcalas como leida
        // si alguien marca una alerta como atendida, se da por leida para todos o se puede eliminar como quieran ver pros y contra
        //restringir las alertas a los users de admin/operators/y escaleras
        $user = auth()->user();
        if ($user->unreadNotifications) {
            foreach ($user->unreadNotifications as $notification) {
                if ($notification->data['id'] == $alert->id) {//chequear las alertas como tipo
                    $notification->markAsRead();
                }
            }
        }
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

    public function completed(Request $request, $id) {
        $retorno = \DB::table('users')
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
        $atendido = DB::table('statuses')->where('name', 'atendido')->first();
        $retorno = DB::table('alerts')->where('id', $id)->update(['status_id' => $atendido->id]);
        $n = DB::table('notifications')->where([['data->id', '1'], ['type', '=', 'App\Notifications\AlertNotificacion']])->update(['read_at' => now()]); //$user->notifications()->delete();

        $reportes = Report::all();
        $user = auth()->user();
        $users = User::all();
        $alert = Alert::find($id);
        $statuses = Status::all();
        $devices = DevicesInventory::all();
        $materials = Material::all();
        $reportestotal = Report::count();
        $filtered = $users->reject(function ($item, $key) {
            return $item->getRoles()[0]->level <> 2;
        });
        $collectors = $filtered->all();
        if ($retorno) {
            return view('reportes.create', compact('reportes', 'user', 'alert', 'statuses', 'devices', 'collectors', 'materials', 'reportestotal'));
        }
        return back()->with('error', trans('Error creando la alerta. Inténtelo de nuevo o contacte al administrador.'));
    }

}
