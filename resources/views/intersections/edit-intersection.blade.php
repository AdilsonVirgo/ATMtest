@extends('layouts.app')

@section('template_title')
    {!! trans('intersections.editing-intersection', ['id' => $intersection->id]) !!}
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
                            {!! trans('intersections.editing-intersection', ['id' => $intersection->id]) !!}
                            <div class="pull-right">
                                <a href="{{ route('intersections.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('intersections.tooltips.back-intersections') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('intersections.buttons.back-to-intersections') !!}
                                </a>
                                <a href="{{ url('/intersections/' . $intersection->id) }}"
                                   class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('intersections.tooltips.back-intersections') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('intersections.buttons.back-to-intersection') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => ['intersections.update', $intersection->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-12">
                                <div id="map-canvas"></div>
                            </div>
                        </div>

                        <br>
                        <div class="form-group has-feedback row {{ $errors->has('latitude') ? ' has-error ' : '' }}">
                            {!! Form::label('latitude', trans('forms.create_vsignal_label_latitude'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('latitude', $intersection->latitude, array('id' => 'latitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_latitude'))) !!}
                                    <div class="input-group-append">
                                        <label for="latitude" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_latitude') }}"
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
                            {!! Form::label('longitude', trans('forms.create_vsignal_label_longitude'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('longitude', $intersection->longitude, array('id' => 'longitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_longitude'))) !!}
                                    <div class="input-group-append">
                                        <label for="longitude" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_longitude') }}"
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
                            {!! Form::label('google_address', trans('forms.create_vsignal_label_gaddress'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('google_address', $intersection->google_address, array('id' => 'google_address', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_gaddress'))) !!}
                                    <div class="input-group-append">
                                        <label for="google_address" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_gaddress') }}"
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

                        <div class="form-group has-feedback row {{ $errors->has('main_st') ? ' has-error ' : '' }}">
                            {!! Form::label('main_st', trans('forms.create_vsignal_label_main_st'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('main_st', $intersection->main_st, array('id' => 'main_st', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_main_st'))) !!}
                                    <div class="input-group-append">
                                        <label for="main_st" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_main_st') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('main_st'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('main_st') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('cross_st') ? ' has-error ' : '' }}">
                            {!! Form::label('cross_st', trans('forms.create_vsignal_label_cross_st'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('cross_st', $intersection->cross_st, array('id' => 'cross_st', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_cross_st'))) !!}
                                    <div class="input-group-append">
                                        <label for="cross_st" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_cross_st') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('cross_st'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('cross_st') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('comment') ? ' has-error ' : '' }}">
                            {!! Form::label('comment', trans('forms.create_vsignal_label_comment'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('comment', $intersection->comment, array('id' => 'comment', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_comment'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="comment">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_comment') }}"
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
                        {!! Form::button(trans('forms.save-changes'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-save')
    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-atm-edit', [
            'latitude' => $intersection->latitude,
            'longitude' => $intersection->longitude,
            'google_address' => $intersection->google_address,
        ])
    @endif
@endsection
