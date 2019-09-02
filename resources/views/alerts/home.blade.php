@extends('layouts.app')

@section('template_title')
{!! trans('alerts.showing-all') !!}
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
        .attendbutton:before {
            content: "";
        }  
        .attendbutton:after {
            content: "A";
        }  
        .rejectbutton:before {
            content: "";
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
    }       
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
                            {!! trans('alerts.showing-all') !!}
                        </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <a class="btn btn-primary btn-sm" href="/alerts/create">
                                <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                {!! trans('alerts.buttons.create-new') !!}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @if(config('atm_app.enableSearch'))
                    @include('partials.search-alerts-form')
                    @endif
                    Cantidad total :{{$alertstotal}}
                    <div class="row border">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Place</th>
                                    <th class="mobilehide">Description</th>                                    
                                    <th class="mobilehide">Status</th>
                                    <th>Priority</th>
                                    <th class="mobilehide">Motive</th>                                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alerts as $alert) 
                                <tr class="@php 
                                    if($alert->status_id==1) { echo e('pending');} 
                                    if($alert->status_id==2) { echo e('attended');} 
                                    if($alert->status_id==3) { echo e('rejected');} 
                                    @endphp">
                                    <td>{{$alert->id}}</td>
                                    <td>{{$alert->place}}</td>
                                    <td class="mobilehide">{{$alert->description}}</td>
                                    <td class="mobilehide">{{$alert->status->name}}</td>
                                    <td>{{$alert->priority->name}}</td>
                                    <td class="mobilehide">{{$alert->motive->name}}</td>

                                    <td>
                                        @role('atmcollector|atmadmin')
                                        <a class="btn btn-sm btn-warning attendbutton text-white @php
                                           if($alert->status_id==2) { echo e('disabled');} @endphp"
                                           href="{{ URL::to('alerts/' . $alert->id.'/attend') }}"
                                           data-toggle="tooltip" title="Attend">
                                            {!! trans('alerts.buttons.attend') !!}
                                        </a>
                                        @endrole
                                        <a class="btn btn-sm btn-success showbutton"
                                           href="{{ URL::to('alerts/' . $alert->id) }}"
                                           data-toggle="tooltip" title="Show">
                                            {!! trans('alerts.buttons.show') !!}
                                        </a>
                                        <a class="btn btn-sm btn-info editbutton"
                                           href="{{ URL::to('alerts/' . $alert->id . '/edit') }}"
                                           data-toggle="tooltip" title="Edit">
                                            {!! trans('alerts.buttons.edit') !!}
                                        </a>
                                        @role('atmcollector|atmadmin')
                                        <a class="btn btn-sm btn-dark rejectbutton"
                                           href="{{ URL::to('alerts/' . $alert->id . '/reject') }}"
                                           data-toggle="tooltip" title="Reject">
                                            {!! trans('alerts.buttons.reject') !!}
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

@include('modals.modal-delete')

@endsection

@section('footer_scripts')
@if ((count($alerts) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
@include('scripts.datatables')
@endif
@include('scripts.delete-modal-script')
@include('scripts.save-modal-script')
@if(config('atm_app.tooltipsEnabled'))
@include('scripts.tooltips')
@endif
@if(config('atm_app.enableSearch'))
@include('scripts.search-alerts')
@endif
@endsection
