@extends('layouts.app')

@section('template_title')
{!! trans('reportes.showing-all') !!}
@endsection

@section('template_linked_css')
@if(config('atm_app.enabledDatatablesJs'))
<link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
@endif
<style type="text/css" media="screen">
    table{
        width: 50%;
    }
    td, th{
        border: 1px solid orange;
    }

    .editbutton:before {
        content: "Editar :";
    }
    .showbutton:before {
        content: "Ver :";
    }
    .deletebutton:before {
        content: "Borrar :";
    }
    .attendbutton:before {
        content: "Atender :";
    }
    .rejectbutton:before {
        content: "Desestimar :";
    }
    @media only screen and (max-width: 768px) {
        .mobilehide{
            display: none;
        }
        .editbutton:before {
            content: "";
        }  
        .editbutton:after {
            content: "E";
        }
        .showbutton:before {
            content: "";
        }  
        .showbutton:after {
            content: "V";
        }
        .deletebutton:before {
            content: "";
        }  
        .deletebutton:after {
            content: "B";
        }
        .attendbutton:before {
            content: "A";
        }  
        .rejectbutton:after {
            content: "D";
        }

    }
    @media only screen and (max-width: 600px) {
        .mobilehide{
            display: none;
        }
        .editbutton:before {
            content: "";
        }  
        .editbutton:after {
            content: "";
        }
        .showbutton:before {
            content: "";
        }  
        .showbutton:after {
            content: "";
        }
        .deletebutton:before {
            content: "";
        }  
        .deletebutton:after {
            content: "";
        }
        .attendbutton:before {
            content: "";
        }  
        .attendbutton:after {
            content: "";
        }
        .rejectbutton:before {
            content: "";
        }  
        .rejectbutton:after {
            content: "";
        }

    }
    .pending{
        background-color: lightyellow;
    }
    .attended{
        background-color: lightgray;
    }
    .rejected{
        background-color: grey;
        text-decoration: line-through;
    }       //
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {!! trans('reportes.showing-all') !!}
                        </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <a class="btn btn-primary btn-sm" href="/reportes/create">
                                <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                {!! trans('reportes.buttons.create-new') !!}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @if(config('atm_app.enableSearch'))
                    @include('partials.search-reportes-form')
                    @endif
                    Cantidad total :{{$reportestotal}}
                    <div class="row border">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Owner</th>
                                    <th>Alert</th>
                                    <th class="mobilehide">Status</th>
                                    <th class="mobilehide">Device</th>
                                    <th class="mobilehide">Assign</th>
                                    <th class="mobilehide">Material</th>
                                    <th class="mobilehide">Description</th>                                   
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reportes as $reporte) 
                                <tr class="@php 
                                    if($reporte->status_id==1) { echo e('pending');} 
                                    if($reporte->status_id==2) { echo e('attended');} 
                                    if($reporte->status_id==3) { echo e('rejected');} 
                                    @endphp">
                                    <td>{{$reporte->id}}</td>
                                    <td>{{$reporte->user_id}}</td>
                                    <td>{{$reporte->alert_id}}</td>
                                    <td class="mobilehide">{{$reporte->status->name}}</td>
                                    <td class="mobilehide">{{$reporte->device_id}}</td>
                                    <td class="mobilehide">{{$reporte->assign_id}}</td>
                                    <td class="mobilehide">
                                        @foreach($reporte->materials()->get() as $m)
                                        -{{$m->name}}
                                        @endforeach
                                        
                                    </td>
                                    <td class="mobilehide">{{$reporte->description}}</td>
                                    <td>
                                        @role('atmoperator|atmadmin')
                                        <a class="btn btn-sm btn-warning attendbutton text-white"
                                           href="{{ URL::to('createorder/' . $reporte->id) }}"
                                           data-toggle="tooltip" title="Crear">
                                            {!! trans('reportes.buttons.attend') !!}
                                        </a>
                                        @endrole
                                        <a class="btn btn-sm btn-success showbutton"
                                           href="{{ URL::to('reportes/' . $reporte->id) }}"
                                           data-toggle="tooltip" title="Show">
                                            {!! trans('reportes.buttons.show') !!}
                                        </a>
                                        <a class="btn btn-sm btn-info editbutton"
                                           href="{{ URL::to('reportes/' . $reporte->id . '/edit') }}"
                                           data-toggle="tooltip" title="Edit">
                                            {!! trans('reportes.buttons.edit') !!}
                                        </a>
                                        @role('atmcollector|atmadmin')
                                        <a class="btn btn-sm btn-dark rejectbutton text-white"
                                           href="{{ URL::to('reportes/' . $reporte->id.'/reject') }}"
                                           data-toggle="tooltip" title="Reject">
                                            {!! trans('reportes.buttons.reject') !!}
                                        </a>
                                        @endrole
                                    </td>
                                </tr>     

                                @endforeach

                            </tbody>
                        </table>
                    </div> <!--fin ROW-->


                </div>
            </div>
        </div>
    </div>
</div>


@endsection
