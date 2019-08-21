@extends('layouts.app')

@section('template_title')
    {!! trans('regulator-boxes.create-new-regulator-box') !!}
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
                            {!! trans('regulator-boxes.create-new-regulator-box') !!}
                            <div class="pull-right">
                                <a href="{{ URL::to('regulator-boxes/') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('regulator-boxes.tooltips.back-regulator-boxes') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('regulator-boxes.buttons.back-to-regulator-boxes') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('id' => 'regulator_box_form', 'route' => 'regulator-boxes.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-12">
                                <div id="map-canvas"></div>
                            </div>
                        </div>

                        <br>
                        <div class="form-group has-feedback row {{ $errors->has('latitude') ? ' has-error ' : '' }}">
                            {!! Form::label('latitude', trans('forms.create_regulator_box_label_latitude'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('latitude', NULL, array('id' => 'latitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_regulator_box_ph_latitude'))) !!}
                                    <div class="input-group-append">
                                        <label for="latitude" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_regulator_box_icon_latitude') }}"
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
                            {!! Form::label('longitude', trans('forms.create_regulator_box_label_longitude'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('longitude', NULL, array('id' => 'longitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_regulator_box_ph_longitude'))) !!}
                                    <div class="input-group-append">
                                        <label for="longitude" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_regulator_box_icon_longitude') }}"
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
                            {!! Form::label('google_address', trans('forms.create_regulator_box_label_gaddress'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('google_address', NULL, array('id' => 'google_address', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_regulator_box_ph_gaddress'))) !!}
                                    <div class="input-group-append">
                                        <label for="google_address" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_regulator_box_icon_gaddress') }}"
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
                            {!! Form::label('code', trans('forms.create_regulator_box_label_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('code', NULL, array('id' => 'code', 'class' => 'form-control', 'placeholder' => trans('forms.create_regulator_box_ph_code'))) !!}
                                    <div class="input-group-append">
                                        <label for="code" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_regulator_box_icon_code') }}"
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
                            {!! Form::label('erp_code', trans('forms.create_regulator_box_label_erp_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('erp_code', NULL, array('id' => 'erp_code', 'class' => 'form-control', 'placeholder' => trans('forms.create_regulator_box_ph_erp_code'))) !!}
                                    <div class="input-group-append">
                                        <label for="erp_code" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_regulator_box_icon_erp_code') }}"
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

                        <div class="form-group has-feedback row {{ $errors->has('intersection') ? ' has-error ' : '' }}">
                            {!! Form::label('intersection', trans('forms.create_traffic_pole_label_intersection'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="intersection" id="intersection">
                                        <option value="">{{ trans('forms.create_traffic_pole_ph_intersection') }}</option>
                                        @if ($intersections)
                                            @foreach($intersections as $intersection)
                                                <option value="{{ $intersection->id }}" {{ old('intersection') == $intersection->id ? 'selected' : '' }}>{{ $intersection->main_st }}
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
                                                <option value="{{ $value }}" {{ old('state') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('brand') ? ' has-error ' : '' }}">
                            {!! Form::label('brand', trans('forms.create_regulator_box_label_brand'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="brand" id="brand">
                                        <option value="">{{ trans('forms.create_regulator_box_ph_brand') }}</option>
                                        @if ($brands)
                                            @foreach($brands as $id => $value)
                                                <option value="{{ $value }}" {{ old('brand') == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('picture_data_in') ? ' has-error ' : '' }}">
                            {!! Form::label('picture_in', trans('forms.create_regulator_box_label_picture_in'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::file('picture_in', array('id' => 'picture_in', 'placeholder' => trans('forms.create_regulator_box_ph_picture_in'))) !!}
                                    {!! Form::hidden("picture_data_in", null, array('id' => 'picture_data_in')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="picture_in">
                                            <i class="fa fa-fw {{ trans('forms.create_regulator_box_icon_picture_in') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('picture_data_in'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('picture_data_in') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('picture_data_out') ? ' has-error ' : '' }}">
                            {!! Form::label('picture_out', trans('forms.create_regulator_box_label_picture_out'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::file('picture_out', array('id' => 'picture_out', 'placeholder' => trans('forms.create_regulator_box_ph_picture'))) !!}
                                    {!! Form::hidden("picture_data_out", null, array('id' => 'picture_data_out')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="picture_out">
                                            <i class="fa fa-fw {{ trans('forms.create_regulator_box_icon_picture_out') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('picture_data_out'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('picture_data_out') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('comment') ? ' has-error ' : '' }}">
                            {!! Form::label('comment', trans('forms.create_regulator_box_label_comment'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('comment', NULL, array('id' => 'comment', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_regulator_box_ph_comment'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="comment">
                                            <i class="fa fa-fw {{ trans('forms.create_regulator_box_icon_comment') }}"
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

                        {!! Form::button(trans('forms.create_regulator_box_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-atm-create')
    @endif

    <script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>

    <script type="text/javascript">
        $(function () {
            $("#intersection").selectize({
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

            $("#brand").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });
        });
    </script>

    @include('scripts.resize-image-before-upload-rb')
@endsection
