@extends('layouts.app')

@section('template_title')
    {!! trans('workorders.create-new-workorder') !!}
@endsection

@section('template_fastload_css')
    #map-canvas{
    min-height: 300px;
    height: 100%;
    width: 100%;
    }
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('workorders.editing-workorder') !!}
                            <div class="pull-right">
                                <a href="{{ route('workorders.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('intersections.tooltips.back-intersections') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('workorders.buttons.back-to-workorder') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['workorders.update', $workOrder->id], 'role' => 'form')) !!}

                        {!! csrf_field() !!}

                        <br>
                        <div class="form-group has-feedback row {{ $errors->has('user_id') ? ' has-error ' : '' }}">
                            {!! Form::label('Usuario', trans('forms.create_workorder_label_userId'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="form-control" id="user_id" name="user_id">
                                        @foreach($users as $user)
                                            @foreach ($user->roles as $user_role)
                                                @if ($user_role->name == 'ATM Operator')
                                                    @if($user->id == $workOrder->user_id)
                                                        <option value="{{ $user->id }}" selected="{{ $user->id }}">
                                                            {{ $user->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $user->id }}">
                                                            {{ $user->name }}
                                                        </option>                                                    
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>

                                    <div class="input-group-append">
                                        <label for="user_id" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_latitude') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('user_id'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('report_id') ? ' has-error ' : '' }}">
                            {!! Form::label('report_id', trans('forms.create_workorder_label_reportId'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('report_id', $workOrder->report_id , array('id' => 'report_id', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_workorder_ph_reportId'))) !!}
                                    <div class="input-group-append">
                                        <label for="report_id" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_workorder_icon_reportId') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('report_id'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('report_id') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('main_st') ? ' has-error ' : '' }}">
                            {!! Form::label('start_date', trans('forms.create_workorder_label_startdate'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    
                                    {!! Form::date('start_date', $workOrder->start_date, array('id' => 'start_date', 'class' => 'form-control', 'placeholder' => trans('forms.create_workorder_ph_startdate'))) !!}
                                    <div class="input-group-append">
                                        <label for="start_date" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_workorder_icon_startdate') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('start_date'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>                        
                        
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <span id="card_title">
                                                    {!! trans('workorders.showing-all-materials') !!}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="table-responsive intersections-table">
                                                <table class="table table-striped table-sm data-table">
                                                    <caption id="intersection_count">

                                                    </caption>
                                                    <thead class="thead">
                                                    <tr>
                                                        <th>{!! trans('workorders.materials-table.erp_code') !!}</th>
                                                        <th>{!! trans('workorders.materials-table.name') !!}</th>
                                                        <th>{!! trans('workorders.materials-table.quantity') !!}</th>
                                                        <th class="hidden-xs">{!! trans('workorders.materials-table.origen') !!}</th>
                                                        <th>{!! trans('workorders.workorder-table.actions') !!}</th>                                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody id="intersections_table">
                                                    @foreach($material as $materials)
                                                        <tr>
                                                            <td>{{$materials->erp_code}}</td>
                                                            <td>{{$materials->name}}</td>
                                                            <td>{{$materials->quantity}}</td>
                                                            @if($materials->origen)
                                                                <td>STOCK</td>
                                                            @else
                                                                <td>ALMACEN</td>
                                                            @endif
                                                            <td>
                                                                {!! Form::open(array('url' => 'workorders/' . $materials->id . '/edit', 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Cerrar')) !!}
                                                                {!! Form::hidden('_method', 'PUT') !!}
                                                                {!! Form::button(trans('workorders.buttons.edit_materials'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#editmaterial', 'data-title' => 'Editar el Origen del Material', 'data-message' => '')) !!}
                                                                {!! Form::close() !!}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                      

                        {!! Form::button(trans('workorders.save-edit-workorder'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-edit-material')
    
@endsection

@section('footer_scripts')
    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-atm-create')
    @endif
    
    @include('scripts.edit-modal-script')
@endsection

