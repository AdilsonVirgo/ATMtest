@extends('layouts.app')

@section('template_title')
    {!! trans('verticalsignals.editing-vsignal', ['code' => $vsignal->code]) !!}
@endsection

@section('template_fastload_css')
    .picture {
    height: 200px;
    width: auto;
    border: 2px solid #8eb4cb;
    }

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
                            {!! trans('verticalsignals.editing-vsignal', ['code' => $vsignal->code]) !!}
                            <div class="pull-right">
                                <a href="{{ URL::to('vertical-signals/') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('verticalsignals.tooltips.back-vsignals') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('verticalsignals.buttons.back-to-vsignals') !!}
                                </a>
                                <a href="{{ URL::to('vertical-signals/'. $vsignal->id) }}"
                                   class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('verticalsignals.tooltips.back-vsignal') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('verticalsignals.buttons.back-to-vsignal') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('id' => 'vsignal_form', 'route' => ['vertical-signals.update', $vsignal->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-sm-4 col-md-6">
                                <img src="{{ asset('storage/signals/'. $vsignal->picture) }}"
                                     class="center-block mb-3 mt-4 picture">
                            </div>
                            <div class="col-sm-4 col-md-6" id="map-canvas">
                                map
                            </div>
                        </div>

                        <br>
                        <div class="form-group has-feedback row {{ $errors->has('latitude') ? ' has-error ' : '' }}">
                            {!! Form::label('latitude', trans('forms.create_vsignal_label_latitude'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('latitude', $vsignal->latitude, array('id' => 'latitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_latitude'))) !!}
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
                                    {!! Form::text('longitude', $vsignal->longitude, array('id' => 'longitude', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_longitude'))) !!}
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
                                    {!! Form::text('google_address', $vsignal->google_address, array('id' => 'google_address', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_gaddress'))) !!}
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

                        <div class="form-group has-feedback row {{ $errors->has('code') ? ' has-error ' : '' }}">
                            {!! Form::label('code', trans('forms.create_vsignal_label_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('code', $vsignal->code, array('id' => 'code', 'class' => 'form-control', 'readonly' => 'readonly', 'placeholder' => trans('forms.create_vsignal_ph_code'))) !!}
                                    <div class="input-group-append">
                                        <label for="code" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_code') }}"
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
                            {!! Form::label('erp_code', trans('forms.create_vsignal_label_erp_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('erp_code', $vsignal->erp_code, array('id' => 'erp_code', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_erp_code'))) !!}
                                    <div class="input-group-append">
                                        <label for="erp_code" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_erp_code') }}"
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

                        <div class="form-group has-feedback row {{ $errors->has('inventory') ? ' has-error ' : '' }}">
                            {!! Form::label('inventory', trans('forms.create_vsignal_label_inventory'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="custom-select form-control" name="inventory" id="inventory">
                                        <option value="">{{ trans('forms.create_vsignal_ph_inventory') }}</option>
                                        @if ($sinventories)
                                            @foreach($sinventories as $sinventory)
                                                <option value="{{ $sinventory->id }}" {{ $vsignal->signal_id == $sinventory->id ? 'selected' : '' }}>{{ $sinventory->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="inventory">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_inventory') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('inventory'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('inventory') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('fastener') ? ' has-error ' : '' }}">
                            {!! Form::label('fastener', trans('forms.create_vsignal_label_fastener'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="custom-select form-control" name="fastener" id="fastener">
                                        <option value="">{{ trans('forms.create_vsignal_ph_fastener') }}</option>
                                        @if ($fasteners)
                                            @foreach($fasteners as $i => $value)
                                                <option value="{{ $value }}" {{ $vsignal->fastener == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="fastener">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_fastener') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('fastener'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('fastener') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('material') ? ' has-error ' : '' }}">
                            {!! Form::label('material', trans('forms.create_vsignal_label_material'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="custom-select form-control" name="material" id="material">
                                        <option value="">{{ trans('forms.create_vsignal_ph_material') }}</option>
                                        @if ($materials)
                                            @foreach($materials as $i => $value)
                                                <option value="{{ $value }}" {{ $vsignal->material == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="material">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_material') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('material'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('material') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('normative') ? ' has-error ' : '' }}">
                            {!! Form::label('normative', trans('forms.create_vsignal_label_normative'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="custom-select form-control" name="normative" id="normative">
                                        <option value="">{{ trans('forms.create_vsignal_ph_normative') }}</option>
                                        @if ($normatives)
                                            @foreach($normatives as $i => $value)
                                                <option value="{{ $value }}" {{ $vsignal->normative == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="normative">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_normative') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('normative'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('normative') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('state') ? ' has-error ' : '' }}">
                            {!! Form::label('state', trans('forms.create_vsignal_label_state'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="custom-select form-control" name="state" id="state">
                                        <option value="">{{ trans('forms.create_vsignal_ph_state') }}</option>
                                        @if ($states)
                                            @foreach($states as $i => $value)
                                                <option value="{{ $value }}" {{ $vsignal->state == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="state">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_state') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('state'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('orientation') ? ' has-error ' : '' }}">
                            {!! Form::label('orientation', trans('forms.create_vsignal_label_orientation'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="custom-select form-control" name="orientation" id="orientation">
                                        <option value="">{{ trans('forms.create_vsignal_ph_orientation') }}</option>
                                        @if ($orientations)
                                            @foreach($orientations as $i => $value)
                                                <option value="{{ $value }}" {{ $vsignal->orientation == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="orientation">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_orientation') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('orientation'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('orientation') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('picture_data') ? ' has-error ' : '' }}">
                            {!! Form::label('picture', trans('forms.create_vsignal_label_picture'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::file('picture', NULL, array('id' => 'picture', 'placeholder' => trans('forms.create_vsignal_ph_picture'))) !!}
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
                            {!! Form::label('comment', trans('forms.create_vsignal_label_comment'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('comment', $vsignal->comment, array('id' => 'comment', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_comment'))) !!}
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
            'latitude' => $vsignal->latitude,
            'longitude' => $vsignal->longitude,
            'google_address' => $vsignal->google_address,
        ])
    @endif

    @include('scripts.resize-image-before-upload')
@endsection
