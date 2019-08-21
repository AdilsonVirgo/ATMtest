@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-poles.editing-traffic-pole', ['code' => $traffic_pole->code]) !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledSelectizeJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.selectizeCssCDN') }}">
    @endif
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
                            {!! trans('traffic-poles.editing-traffic-pole', ['code' => $traffic_pole->code]) !!}
                            <div class="pull-right">
                                <a href="{{ route('traffic-poles.index') }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('traffic-poles.tooltips.back-to-traffic-poles') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('traffic-poles.buttons.back-to-traffic-poles') !!}
                                </a>
                                <a href="{{ url('/traffic-poles/' . $traffic_pole->id) }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('traffic-poles.tooltips.back-to-traffic-poles') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('traffic-poles.buttons.back-to-traffic-poles') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['traffic-poles.update', $traffic_pole->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-12">
                                <div id="map-canvas"></div>
                            </div>
                        </div>

                        <br>
                        <div class="form-group has-feedback row {{ $errors->has('latitude') ? ' has-error ' : '' }}">
                            {!! Form::label('latitude', trans('forms.create_traffic_pole_label_latitude'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('latitude', $traffic_pole->latitude , array('id' => 'latitude', 'readonly' => true, 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_traffic_pole_ph_latitude'))) !!}
                                    <div class="input-group-append">
                                        <label for="latitude" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_pole_icon_latitude') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('latitude'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('latitude') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('longitude') ? ' has-error ' : '' }}">
                            {!! Form::label('longitude', trans('forms.create_traffic_pole_label_longitude'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('longitude', $traffic_pole->longitude, array('id' => 'longitude', 'readonly' => true, 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_traffic_pole_ph_longitude'))) !!}
                                    <div class="input-group-append">
                                        <label for="longitude" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_pole_icon_longitude') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('longitude'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('longitude') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('google_address') ? ' has-error ' : '' }}">
                            {!! Form::label('google_address', trans('forms.create_traffic_pole_label_gaddress'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('google_address', $traffic_pole->google_address, array('id' => 'google_address', 'readonly' => true, 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_traffic_pole_ph_gaddress'))) !!}
                                    <div class="input-group-append">
                                        <label for="google_address" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_pole_icon_gaddress') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('google_address'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('google_address') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('code') ? ' has-error ' : '' }}">
                            {!! Form::label('code', trans('forms.create_traffic_pole_label_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('code', $traffic_pole->code, array('id' => 'code', 'readonly' => true, 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_pole_ph_code'))) !!}
                                    <div class="input-group-append">
                                        <label for="code" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_pole_icon_code') }}"
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
                            {!! Form::label('erp_code', trans('forms.create_traffic_pole_label_erp_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('erp_code', $traffic_pole->erp_code, array('id' => 'erp_code', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_pole_ph_erp_code'))) !!}
                                    <div class="input-group-append">
                                        <label for="erp_code" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_pole_icon_erp_code') }}"
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

                        <div class="form-group has-feedback row {{ $errors->has('height') ? ' has-error ' : '' }}">
                            {!! Form::label('height', trans('forms.create_traffic_pole_label_height'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('height', $traffic_pole->height, array('id' => 'height', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_pole_ph_height'))) !!}
                                    <div class="input-group-append">
                                        <label for="height" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_pole_icon_height') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('height'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('height') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('atm_own') ? ' has-error ' : '' }}">
                            {!! Form::label('atm_own', trans('forms.create_traffic_pole_label_atm_own'), array('class' => 'col-md-3 form-check-label')); !!}
                            <div class="col-md-9">
                                {!! Form::checkbox('atm_own', 1, $traffic_pole->atm_own, array('id' => 'atm_own')) !!}
                                @if ($errors->has('atm_own'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('atm_own') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('intersection') ? ' has-error ' : '' }}">
                            {!! Form::label('intersection', trans('forms.create_traffic_pole_label_intersection'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="intersection" id="intersection">
                                        <option value="">{{ trans('forms.create_traffic_pole_ph_intersection') }}</option>
                                        @if ($intersections)
                                            @foreach($intersections as $intersection)
                                                <option value="{{ $intersection->id }}" {{ $traffic_pole->intersection_id == $intersection->id ? 'selected' : '' }}>{{ $intersection->main_st }}
                                                    y {{ $intersection->cross_st }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('state') ? ' has-error ' : '' }}">
                            {!! Form::label('state', trans('forms.create_traffic_pole_label_state'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="state" id="state">
                                        <option value="">{{ trans('forms.create_traffic_pole_ph_state') }}</option>
                                        @if ($states)
                                            @foreach($states as $id => $value)
                                                <option value="{{ $value }}" {{ $traffic_pole->state == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('material') ? ' has-error ' : '' }}">
                            {!! Form::label('material', trans('forms.create_traffic_pole_label_material'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="material" id="material">
                                        <option value="">{{ trans('forms.create_traffic_pole_ph_material') }}</option>
                                        @if ($materials)
                                            @foreach($materials as $id => $value)
                                                <option value="{{ $value }}" {{ $traffic_pole->material == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('comment') ? ' has-error ' : '' }}">
                            {!! Form::label('comment', trans('forms.create_traffic_pole_label_comment'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('comment', $traffic_pole->comment, array('id' => 'comment', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_pole_ph_comment'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="comment">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_pole_icon_comment') }}"
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
            $("#intersection").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#material").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#state").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });
        });
    </script>

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-atm-edit', [
            'latitude' => $traffic_pole->latitude,
            'longitude' => $traffic_pole->longitude,
            'google_address' => $traffic_pole->google_address
        ])
    @endif
@endsection
