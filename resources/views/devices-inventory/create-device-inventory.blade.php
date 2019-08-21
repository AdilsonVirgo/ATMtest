@extends('layouts.app')

@section('template_title')
    {!! trans('device-inventory.create-new-device-inventory') !!}
@endsection

@section('template_linked_css')
    {{--@if(config('atm_app.enabledSelectizeJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.selectizeCssCDN') }}">
    @endif--}}
@endsection


@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('device-inventory.create-new-device-inventory') !!}
                            <div class="pull-right">
                                <a href="{{ route('devices-inventory.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('device-inventory.tooltips.back-device-inventories') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('device-inventory.buttons.back-to-device-inventories') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'devices-inventory.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('code') ? ' has-error ' : '' }}">
                            {!! Form::label('code', trans('forms.create_device_label_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('code', NULL, array('id' => 'code', 'class' => 'form-control', 'placeholder' => trans('forms.create_device_ph_code'))) !!}
                                    <div class="input-group-append">
                                        <label for="code" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_device_icon_code') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('code'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                            {!! Form::label('name', trans('forms.create_device_label_name'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('forms.create_device_ph_name'))) !!}
                                    <div class="input-group-append">
                                        <label for="name" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_device_icon_name') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('erp_code') ? ' has-error ' : '' }}">
                            {!! Form::label('erp_code', trans('forms.create_device_label_erp_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('erp_code', NULL, array('id' => 'erp_code', 'class' => 'form-control', 'placeholder' => trans('forms.create_device_ph_erp_code'))) !!}
                                    <div class="input-group-append">
                                        <label for="erp_code" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_device_icon_erp_code') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('erp_code'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('erp_code') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('dimensions') ? ' has-error ' : '' }}">
                            {!! Form::label('dimensions', trans('forms.create_device_label_dimensions'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('dimensions', NULL, array('id' => 'dimensions', 'class' => 'form-control', 'placeholder' => trans('forms.create_device_ph_dimensions'))) !!}
                                    <div class="input-group-append">
                                        <label for="dimensions" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_device_icon_dimensions') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('dimensions'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('dimensions') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('symbol') ? ' has-error ' : '' }}">
                            {!! Form::label('symbol', trans('forms.create_device_label_symbol'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::file('symbol', array('id' => 'symbol', 'placeholder' => trans('forms.create_device_ph_symbol'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="symbol">
                                            <i class="fa fa-fw {{ trans('forms.create_device_icon_symbol') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('symbol'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('symbol') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        {!! Form::button(trans('forms.create_device_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

@endsection

@section('footer_scripts')

@endsection
