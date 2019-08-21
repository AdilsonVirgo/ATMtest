@extends('layouts.app')

@section('template_title')
    {!! trans('device-inventory.editing-device-inventory', ['code' => $device->code]) !!}
@endsection

@section('template_fastload_css')
    .device-image {
    height: 100px;
    width: auto;
    }
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('device-inventory.editing-device-inventory', ['code' => $device->code]) !!}
                            <div class="pull-right">
                                <a href="{{ route('devices-inventory.index') }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('device-inventory.tooltips.back-to-device-inventories') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('device-inventory.buttons.back-to-device-inventories') !!}
                                </a>
                                <a href="{{ url('/devices-inventory/' . $device->id) }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('device-inventory.tooltips.back-to-device-inventory') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('device-inventory.buttons.back-to-device-inventory') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => ['devices-inventory.update', $device->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        @if ($device->symbol)
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <img src="@if ($device->symbol) {{ asset('storage/inventory/devices/'. $device->symbol) }} @else No symbol @endif"
                                         alt="{{ $device->symbol }}"
                                         class="center-block mb-3 mt-4 device-image">
                                </div>
                            </div>
                        @endif

                        <div class="form-group has-feedback row {{ $errors->has('code') ? ' has-error ' : '' }}">
                            {!! Form::label('code', trans('forms.create_device_label_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('code', $device->code, array('id' => 'code', 'class' => 'form-control', 'readonly' => true, 'placeholder' => trans('forms.create_device_ph_code'))) !!}
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
                                    {!! Form::text('name', $device->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('forms.create_device_ph_name'))) !!}
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
                                    {!! Form::text('erp_code', $device->erp_code, array('id' => 'erp_code', 'class' => 'form-control', 'placeholder' => trans('forms.create_device_ph_erp_code'))) !!}
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
                                    {!! Form::text('dimensions', $device->dimensions, array('id' => 'dimensions', 'class' => 'form-control', 'placeholder' => trans('forms.create_device_ph_dimensions'))) !!}
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

    <script type="text/javascript">
        var update_table = function () {
            $("#variations_tbl tbody tr").remove();
            var table = $("#variations_tbl tbody");

            if ($('#variations').val()) {
                var data = JSON.parse($("#variations").val());
                $.each(data, function (i, item) {
                    table.append('<tr><td scope="row">' + item.variation_name + '</td><td>' + item.dimension_text + '</td><td><button type="button" onclick="remove_dimension(\'' + item.variation_name + '\');" class="btn btn-sm btn-danger float-right">Eliminar</button></td></tr>');
                });

                if (data.length)
                    $("#variations_tbl").show();
                else
                    $("#variations_tbl").hide();
            }
        };

        var remove_dimension = function (name) {
            var data = JSON.parse($("#variations").val());

            data = $.grep(data, function (value) {
                return value.variation_name != name;
            });

            for (var i = 0; i < data.length; i++) {
                if (data[i].variation_name === name) {
                    data.splice(i, 1);
                    break;
                }
            }

            if (data.length) {
                $("#variations").val(JSON.stringify(data));
            } else {
                $("#variations").val('');
            }

            update_table();
        };

        $(document).ready(function () {
            $("#clear-variations").click(function () {
                $("#variations").val('');
                $("#variation").val('');
                $("#dimension").val('');

                update_table();
            });

            $("#add-variations").click(function () {
                var variation = $("#variation").val();
                var dimension = $("#dimension").val();
                var dimension_text = $("#dimension option:selected").text();

                if (variation != '' && dimension != '') {
                    var data = JSON.parse($("#variations").val() === '' ? '[]' : $("#variations").val());
                    var found = false;

                    $.each(data, function (i, item) {
                        if (item.variation_name === variation)
                            found = true;
                    });

                    if (!found) {
                        data.push({
                            dimension_id: dimension,
                            dimension_text: dimension_text,
                            variation_name: variation
                        });

                        if (data.length) {
                            $("#variations").val(JSON.stringify(data));
                        }

                        update_table();
                    } else {
                        alert('Ya existe una variación con ese nombre.');
                    }
                } else {
                    alert('Debe introducir un nombre y seleccionar una dimensión');
                }
            });

            update_table();
        });
    </script>
@endsection
