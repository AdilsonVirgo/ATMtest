@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-tensors.editing-traffic-tensor', ['id' => $traffic_tensor->id]) !!}
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
                            {!! trans('traffic-tensors.editing-traffic-tensor', ['id' => $traffic_tensor->id]) !!}
                            <div class="pull-right">
                                <a href="{{ route('traffic-tensors.index') }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('traffic-tensors.tooltips.back-to-traffic-tensors') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('traffic-tensors.buttons.back-to-traffic-tensors') !!}
                                </a>
                                <a href="{{ url('/traffic-tensors/' . $traffic_tensor->id) }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('traffic-tensors.tooltips.back-to-traffic-tensors') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('traffic-tensors.buttons.back-to-traffic-tensors') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['traffic-tensors.update', $traffic_tensor->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}
                        <div class="form-group has-feedback row {{ $errors->has('height') ? ' has-error ' : '' }}">
                            {!! Form::label('height', trans('forms.create_traffic_tensor_label_height'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('height', $traffic_tensor->height, array('id' => 'height', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_tensor_ph_height'))) !!}
                                    <div class="input-group-append">
                                        <label for="height" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_tensor_icon_height') }}"
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

                        <div class="form-group has-feedback row {{ $errors->has('poles') ? ' has-error ' : '' }}">
                            {!! Form::label('poles', trans('forms.create_traffic_tensor_label_poles'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="poles[]" id="poles">
                                        <option value="">{{ trans('forms.create_traffic_tensor_ph_poles') }}</option>
                                        @if ($traffic_poles)
                                            @foreach($traffic_poles as $traffic_pole)
                                                <option value="{{ $traffic_pole->id }}">{{ $traffic_pole->code }} | {{ $traffic_pole->intersection->main_st }} y {{ $traffic_pole->intersection->cross_st }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('state') ? ' has-error ' : '' }}">
                            {!! Form::label('state', trans('forms.create_traffic_tensor_label_state'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="state" id="state">
                                        <option value="">{{ trans('forms.create_traffic_tensor_ph_state') }}</option>
                                        @if ($states)
                                            @foreach($states as $id => $value)
                                                <option value="{{ $value }}" {{ $traffic_tensor->state == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('material') ? ' has-error ' : '' }}">
                            {!! Form::label('material', trans('forms.create_traffic_tensor_label_material'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select name="material" id="material">
                                        <option value="">{{ trans('forms.create_traffic_tensor_ph_material') }}</option>
                                        @if ($materials)
                                            @foreach($materials as $id => $value)
                                                <option value="{{ $value }}" {{ $traffic_tensor->material == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('comment') ? ' has-error ' : '' }}">
                            {!! Form::label('comment', trans('forms.create_traffic_tensor_label_comment'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('comment', $traffic_tensor->comment, array('id' => 'comment', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_traffic_tensor_ph_comment'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="comment">
                                            <i class="fa fa-fw {{ trans('forms.create_traffic_tensor_icon_comment') }}"
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
            $("#poles").selectize({
                allowClear: true,
                plugins: ['remove_button'],
                selectOnTab: true,
                maxItems: null,
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
    @endif
@endsection
