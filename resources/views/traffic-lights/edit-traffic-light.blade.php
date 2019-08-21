@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-lights.editing-traffic-light', ['code' => $traffic_light->code]) !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledSelectizeJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.selectizeCssCDN') }}">
    @endif
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
                            {!! trans('traffic-lights.editing-traffic-light', ['code' => $traffic_light->code]) !!}
                            <div class="pull-right">
                                <a href="{{ route('traffic-lights.index') }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('traffic-lights.tooltips.back-to-traffic-lights') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('traffic-lights.buttons.back-to-traffic-lights') !!}
                                </a>
                                <a href="{{ url('/traffic-lights/' . $traffic_light->id) }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('traffic-lights.tooltips.back-to-traffic-lights') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('traffic-lights.buttons.back-to-traffic-lights') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['traffic-lights.update', $traffic_light->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('code') ? ' has-error ' : '' }}">
                            {!! Form::label('code', trans('forms.create_traffic_light_label_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('code', $traffic_light->code, array('id' => 'code', 'readonly' => true, 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_light_ph_code'))) !!}
                                    <div class="input-group-append">
                                        <label for="code" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_light_icon_code') }}"
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

                        <div class="form-group has-feedback row {{ $errors->has('erp_code') ? ' has-error ' : '' }}">
                            {!! Form::label('erp_code', trans('forms.create_traffic_light_label_erp_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('erp_code', $traffic_light->erp_code, array('id' => 'erp_code', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_light_ph_erp_code'))) !!}
                                    <div class="input-group-append">
                                        <label for="erp_code" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_light_icon_erp_code') }}"
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

                        <div class="form-group has-feedback row {{ $errors->has('light_type') ? ' has-error ' : '' }}">
                            {!! Form::label('light_type', trans('forms.create_traffic_light_label_light_type'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="light_type" id="light_type">
                                        <option value="">{{ trans('forms.create_traffic_light_ph_light_type') }}</option>
                                        @if ($light_types)
                                            @foreach($light_types as $type)
                                                <option value="{{ $type->id }}" {{ $traffic_light->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('state') ? ' has-error ' : '' }}">
                            {!! Form::label('state', trans('forms.create_traffic_light_label_state'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="state" id="state">
                                        <option value="">{{ trans('forms.create_traffic_light_ph_state') }}</option>
                                        @if ($states)
                                            @foreach($states as $id => $value)
                                                <option value="{{ $value }}" {{ $traffic_light->state == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('brand') ? ' has-error ' : '' }}">
                            {!! Form::label('brand', trans('forms.create_traffic_light_label_brand'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="brand" id="brand">
                                        <option value="">{{ trans('forms.create_traffic_light_ph_brand') }}</option>
                                        @if ($brands)
                                            @foreach($brands as $id => $value)
                                                <option value="{{ $value }}" {{ $traffic_light->brand == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('model') ? ' has-error ' : '' }}">
                            {!! Form::label('model', trans('forms.create_traffic_light_label_model'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('model', $traffic_light->model, array('id' => 'model', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_light_ph_model'))) !!}
                                    <div class="input-group-append">
                                        <label for="model" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_light_icon_model') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('model'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('model') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('orientation') ? ' has-error ' : '' }}">
                            {!! Form::label('orientation', trans('forms.create_traffic_light_label_orientation'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="orientation" id="orientation">
                                        <option value="">{{ trans('forms.create_traffic_light_ph_orientation') }}</option>
                                        @if ($orientations)
                                            @foreach($orientations as $id => $value)
                                                <option value="{{ $value }}" {{ $traffic_light->orientation == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('intersection') ? ' has-error ' : '' }}">
                            {!! Form::label('intersection', trans('forms.create_traffic_light_label_intersection'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="intersection" id="intersection">
                                        <option value="">{{ trans('forms.create_traffic_light_ph_intersection') }}</option>
                                        @if ($intersections)
                                            @foreach($intersections as $intersection)
                                                <option value="{{ $intersection->id }}" {{ $traffic_light->intersection_id == $intersection->id ? 'selected' : '' }}>{{ $intersection->main_st }} y {{ $intersection->cross_st }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('regulator') ? ' has-error ' : '' }}">
                            {!! Form::label('regulator', trans('forms.create_traffic_light_label_regulator'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="regulator" id="regulator">
                                        <option value="">{{ trans('forms.create_traffic_light_ph_regulator') }}</option>
                                        @if ($traffic_regulators)
                                            @foreach($traffic_regulators as $traffic_regulator)
                                                <option value="{{ $traffic_regulator->id }}" {{ $traffic_light->regulator_id == $traffic_regulator->id ? 'selected' : '' }}>{{ $traffic_regulator->code }} - {{ $traffic_regulator->brand }} | {{ $traffic_regulator->intersection->main_st }} y {{ $traffic_regulator->intersection->cross_st }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('pole') ? ' has-error ' : '' }}">
                            {!! Form::label('pole', trans('forms.create_traffic_light_label_pole'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="pole" id="pole">
                                        <option value="">{{ trans('forms.create_traffic_light_ph_pole') }}</option>
                                        @if ($traffic_poles)
                                            @foreach($traffic_poles as $traffic_pole)
                                                <option value="{{ $traffic_pole->id }}" {{ $traffic_light->pole_id == $traffic_pole->id ? 'selected' : '' }}>{{ $traffic_pole->code }} | {{ $traffic_pole->intersection->main_st }} y {{ $traffic_pole->intersection->cross_st }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('tensor') ? ' has-error ' : '' }}">
                            {!! Form::label('tensor', trans('forms.create_traffic_light_label_tensor'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="tensor" id="tensor">
                                        <option value="">{{ trans('forms.create_traffic_light_ph_tensor') }}</option>
                                        @if ($traffic_tensors)
                                            @foreach($traffic_tensors as $tensor)
                                                <option value="{{ $tensor->id }}" {{ $traffic_light->tensor_id == $tensor->id ? 'selected' : '' }}>{{ $tensor->id }} | {{ $tensor->intersection()->main_st }} y {{ $tensor->intersection()->cross_st }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('picture_data') ? ' has-error ' : '' }}">
                            {!! Form::label('picture', trans('forms.create_vsignal_label_picture'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::file('picture', array('id' => 'picture', 'placeholder' => trans('forms.create_vsignal_ph_picture'))) !!}
                                    {!! Form::hidden("picture_data", null, array('id' => 'picture_data')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="picture">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_picture') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('picture_data'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('picture_data') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('comment') ? ' has-error ' : '' }}">
                            {!! Form::label('comment', trans('forms.create_traffic_light_label_comment'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('comment', $traffic_light->comment, array('id' => 'comment', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_light_ph_comment'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="comment">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_light_icon_comment') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        {!! Form::button(trans('forms.save-changes'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>

    <script type="text/javascript">
        $(function () {
            $("#pole").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#light_type").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#intersection").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#regulator").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#tensor").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#state").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#brand").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });

            $("#orientation").selectize({
                allowClear: true,
                create: false,
                selectOnTab: true,
                highlight: true,
                diacritics: true
            });
        });
    </script>

    @include('scripts.resize-image-before-upload')

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-atm-show', [
            'latitude' => $traffic_light->intersection->latitude,
            'longitude' => $traffic_light->intersection->longitude,
            'code' => $traffic_light->code,
        ])
    @endif
@endsection
