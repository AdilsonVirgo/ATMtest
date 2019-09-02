@extends('layouts.app')

@section('template_title')
{!! trans('materials.showing-all') !!}
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
                            {!! trans('materials.showing-all') !!}
                        </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <a class="btn btn-primary btn-sm" href="/materials/create">
                                <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                {!! trans('materials.buttons.create-new') !!}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                   
                    Cantidad total :{{$materialstotal}}
                    <div class="row border">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th class="mobilehide">Quantity</th>                                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materials as $motive) 
                                <tr>
                                    <td>{{$motive->id}}</td>
                                    <td>{{$motive->name}}</td>
                                    <td class="mobilehide">{{$motive->quantity}}</td>
                                    <td><a class="btn btn-sm btn-success showbutton"
                                           href="{{ URL::to('materials/' . $motive->id) }}"
                                           data-toggle="tooltip" title="Show">
                                            {!! trans('materials.buttons.show') !!}
                                        </a>
                                        <a class="btn btn-sm btn-info editbutton"
                                           href="{{ URL::to('materials/' . $motive->id . '/edit') }}"
                                           data-toggle="tooltip" title="Edit">
                                            {!! trans('materials.buttons.edit') !!}
                                        </a>
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
