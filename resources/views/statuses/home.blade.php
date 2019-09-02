@extends('layouts.app')

@section('template_title')
{!! trans('statuses.showing-all') !!}
@endsection

@section('template_linked_css')
@if(config('atm_app.enabledDatatablesJs'))
<link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
@endif
<style type="text/css" media="screen">
    .vsignals-table {
        border: 0;
    }

    .vsignals-table tr td:first-child {
        padding-left: 15px;
    }

    .vsignals-table tr td:last-child {
        padding-right: 15px;
    }

    .vsignals-table.table-responsive,
    .vsignals-table.table-responsive table {
        margin-bottom: 0;
    }
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
    @media only screen and (max-width: 425px) {
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

    }
    @media only screen and (max-width: 320px) {
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
                            {!! trans('statuses.showing-all') !!}
                        </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <a class="btn btn-primary btn-sm" href="/statuses/create">
                                <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                {!! trans('statuses.buttons.create-new') !!}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                   
                    Cantidad total :{{$statusestotal}}
                    <div class="row border">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th class="mobilehide">Description</th>                                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statuses as $status) 
                                <tr>
                                    <td>{{$status->id}}</td>
                                    <td>{{$status->name}}</td>
                                    <td class="mobilehide">{{$status->description}}</td>
                                    <td><a class="btn btn-sm btn-success showbutton"
                                           href="{{ URL::to('statuses/' . $status->id) }}"
                                           data-toggle="tooltip" title="Show">
                                            {!! trans('statuses.buttons.show') !!}
                                        </a>
                                        @role('atmadmin') 
                                        <a class="btn btn-sm btn-info editbutton"
                                           href="{{ URL::to('statuses/' . $status->id . '/edit') }}"
                                           data-toggle="tooltip" title="Edit">
                                            {!! trans('statuses.buttons.edit') !!}
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
