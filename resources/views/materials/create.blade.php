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
                            {!! trans('materials.showing-all') !!}
                        </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <a class="btn btn-primary btn-sm" href="/statuses/create">
                                <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                {!! trans('materials.buttons.create-new') !!}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                        <form method="post" action="{{url('/materials')}}">
                        {{ csrf_field() }} 
                        <div class="row">

                            <div class="col-sm-3">
                                ERP
                            </div>
                            <div class="col-sm-9">
                                <input id="erp_code" type="text" class="form-control{{ $errors->has('erp_code') ? ' is-invalid' : '' }}" name="erp_code" required autofocus>                                                        
                                @if ($errors->has('erp_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('erp_code') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-sm-3">
                                Nombre
                            </div>
                            <div class="col-sm-9">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus>                                                        
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-sm-3">
                                Quantity
                            </div>
                            <div class="col-sm-9">
                                <input id="quantity" type="text" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" required autofocus>                                                        
                                @if ($errors->has('quantity'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                                @endif
                            </div>

                            Reporte
                            <select id="report_id"  class="form-control{{ $errors->has('report_id') ? ' is-invalid' : '' }}" name="report_id" value="{{ old('report_id') }}" required autofocus>
                                <option value="">Escoje...</option>
                                @foreach($reportes as $x => $tmercado) 
                                <option value="{{$tmercado->id}}">{{$tmercado->name}}</option>
                                @endforeach
                            </select> 
                            @if ($errors->has('report_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('report_id') }}</strong>
                            </span>
                            @endif

                            Origen
                            <select id="origen"  class="form-control{{ $errors->has('origen') ? ' is-invalid' : '' }}" name="origen" value="{{ old('origen') }}" required autofocus>
                                <option value="">Escoje...</option>                               
                                <option value="{{1}}">Stock</option>
                                <option value="{{0}}">Almacen</option>                               
                            </select> 
                            @if ($errors->has('origen'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('origen') }}</strong>
                            </span>
                            @endif

                            <button type="submit" class="btn btn-success margin-bottom-1 mb-1 align-right">Crear un nuevo material</button>
                        </div>
                    </form> 

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<!-- <form method="post" action="{{url('/materials')}}">
                        {{ csrf_field() }} 
                        <div class="row">

                            <div class="col-sm-3">
                                ERP
                            </div>
                            <div class="col-sm-9">
                                <input id="erp_code" type="text" class="form-control{{ $errors->has('erp_code') ? ' is-invalid' : '' }}" name="erp_code" required autofocus>                                                        
                                @if ($errors->has('erp_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('erp_code') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-sm-3">
                                Nombre
                            </div>
                            <div class="col-sm-9">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus>                                                        
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-sm-3">
                                Quantity
                            </div>
                            <div class="col-sm-9">
                                <input id="quantity" type="text" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" required autofocus>                                                        
                                @if ($errors->has('quantity'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                                @endif
                            </div>

                            Reporte
                            <select id="report_id"  class="form-control{{ $errors->has('report_id') ? ' is-invalid' : '' }}" name="report_id" value="{{ old('report_id') }}" required autofocus>
                                <option value="">Escoje...</option>
                                @foreach($reportes as $x => $tmercado) 
                                <option value="{{$tmercado->id}}">{{$tmercado->name}}</option>
                                @endforeach
                            </select> 
                            @if ($errors->has('report_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('report_id') }}</strong>
                            </span>
                            @endif

                            Origen
                            <select id="origen"  class="form-control{{ $errors->has('origen') ? ' is-invalid' : '' }}" name="origen" value="{{ old('origen') }}" required autofocus>
                                <option value="">Escoje...</option>                               
                                <option value="{{1}}">Stock</option>
                                <option value="{{0}}">Almacen</option>                               
                            </select> 
                            @if ($errors->has('origen'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('origen') }}</strong>
                            </span>
                            @endif

                            <button type="submit" class="btn btn-success margin-bottom-1 mb-1 float-right">Crear un nuevo material</button>
                        </div>
                    </form>      -->