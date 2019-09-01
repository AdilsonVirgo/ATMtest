<?php

namespace App\Http\Controllers;


use App\Models\Intersection;
use App\Models\WorkOrder;
use App\Models\User;
use jeremykenedy\LaravelRoles\Models\Role;
use App\Models\Material;
use App\Models\Alert;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkOrderController extends Controller
{
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
        $paginationEnabled = config('atm_app.enablePagination');
        $workOrder = WorkOrder::whereState('1')->get();
        $workOrderTotal = $workOrder->count();
        $users = User::all();    

        if ($paginationEnabled) {
     //       $workOrder = $workOrder->paginate(config('atm_app.paginateListSize'));
        }

        return View('workorders.index', compact('workOrder', 'workOrderTotal','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $report = Report::find($id);
        return view('workorders.create', compact('report'));
    }

    public function createorder($id)
    {
        $atmOperatorRole = Role::whereName('ATM Operator')->first();
        $report = Report::find($id);
        $material = Material::whereReportId($report->id)->get();        
        $users = User::all();    
        $roles = Role::all();
        return view('workorders.create', compact('report','material','users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  $validator = Validator::make($request->all(), Intersection::rules());

     //   if ($validator->fails()) {
     //       return back()->withErrors($validator)->withInput();
     //   }
        
        $workOrder = WorkOrder::create([
            'user_id' => $request->get('user_id'),
            'report_id' => $request->input('report_id'),
            'start_date' => $request->input('start_date'),
            'state' => '1'
        ]);

        if ($workOrder) {
            return redirect('workorders')->with('success', trans('workorders.createSuccess'));
        }
        return back()->with('error', trans('Error creando la intersección. Inténtelo de nuevo o contacte al administrador.'));      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workOrder = WorkOrder::find($id);
        $material = Material::whereReportId($workOrder->report_id)->get();   
        return view('workorders.show-workorder', compact('workOrder','material'));      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workOrder = WorkOrder::find($id);        
        $material = Material::whereReportId($workOrder->report_id)->get();        
        $users = User::all();    
        $roles = Role::all();        
        return view('workorders.edit', compact('workOrder','users','roles','material'));       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $workOrder = WorkOrder::findOrFail($id);

        if ($request->get('user_id') && $workOrder->user_id != $request->input('user_id')) {
            $workOrder->user_id = $request->input('user_id');
        }

        if ($request->get('start_date') && $workOrder->start_date != $request->input('start_date')) {
            $workOrder->start_date = $request->input('start_date');
        }

        if ($workOrder->save()) {
            return redirect('workorders/' . $workOrder->id)->with('success', trans('workorders.updateSuccess'));
        }

        return back()->with('error', trans('workorders.update-workorders-error'));
        
    }

    public function materialsedit(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        if ($request->get('origen') && $workOrder->origen != $request->input('origen')) {
            $material->origen = $request->input('origen');
        }

        if ($material->save()) {
            return redirect('workorders/' . $material->id)->with('success', trans('workorders.updateMaterialsSuccess'));
        }

        return back()->with('error', trans('workorders.update-workorders-error'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasRole('atmadmin')) {
            $workOrder = WorkOrder::findOrFail($id);

            $workOrder->state = '0';
            
            $workOrder->save();
            return redirect('workorders')->with('success', trans('workorders.closeSuccess'));
        }else{
            return back()->with('error', trans('workorders.errorAuthSuccess'));       
        }    
    }
}
