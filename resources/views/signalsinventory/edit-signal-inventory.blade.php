@extends('layouts.app')

@section('template_title')
    {!! trans('signalsinventory.editing-signals-inventory', ['code' => $vsignal->code]) !!}
@endsection

@section('template_fastload_css')
    .signal-image {
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
                            {!! trans('signalsinventory.editing-signals-inventory', ['code' => $vsignal->code]) !!}
                            <div class="pull-right">
                                <a href="{{ route('signals-inventory.index') }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="{{ trans('signalsinventory.tooltips.back-to-signals-inventories') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('signalsinventory.buttons.back-to-signals-inventories') !!}
                                </a>
                                <a href="{{ url('/signals-inventory/' . $vsignal->id) }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('signalsinventory.tooltips.back-to-signals-inventory') }}">
                                    <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                    {!! trans('signalsinventory.buttons.back-to-signals-inventory') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => ['signals-inventory.update', $vsignal->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="@if ($vsignal->picture_fn) col-sm-6 col-md-6 @else col-sm-12 col-md-12 @endif">
                                <img src="@if ($vsignal->picture) {{ asset('storage/inventory/signals/'. $vsignal->picture) }} @else No picture @endif"
                                     alt="{{ $vsignal->picture }}"
                                     class="center-block mb-3 mt-4 signal-image">
                            </div>
                            @if ($vsignal->picture_fn)
                                <div class="col-sm-6 col-md-6">
                                    <img src="@if ($vsignal->picture) {{ asset('storage/inventory/signals/'. $vsignal->picture_fn) }} @else No picture @endif"
                                         alt="{{ $vsignal->picture_fn }}"
                                         class="center-block mb-3 mt-4 signal-image">
                                </div>
                            @endif
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('code') ? ' has-error ' : '' }}">
                            {!! Form::label('code', trans('forms.create_vsignal_label_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('code', $vsignal->code, array('id' => 'code', 'class' => 'form-control', 'readonly' => true, 'placeholder' => trans('forms.create_vsignal_ph_code'))) !!}
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

                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                            {!! Form::label('name', trans('forms.create_vsignal_label_name'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('name', $vsignal->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_name'))) !!}
                                    <div class="input-group-append">
                                        <label for="name" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_name') }}"
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

                        <div class="form-group has-feedback row {{ $errors->has('subgroup') ? ' has-error ' : '' }}">
                            {!! Form::label('subgroup', trans('forms.create_vsignal_label_subgroup'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="custom-select form-control" name="subgroup" id="subgroup">
                                        <option value="">{{ trans('forms.create_vsignal_ph_subgroup') }}</option>
                                        @if ($subgroups)
                                            @foreach($subgroups as $subgroup)
                                                <option value="{{ $subgroup->id }}" {{ $vsignal->subgroup_id == $subgroup->id ? 'selected' : '' }}>{{ $subgroup->group->name }}
                                                    - {{ $subgroup->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="subgroup">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_subgroup') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('subgroup'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('subgroup') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('picture') ? ' has-error ' : '' }}">
                            {!! Form::label('picture', trans('forms.create_vsignal_label_picture'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::file('picture', NULL, array('id' => 'picture', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_picture'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="picture">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_picture') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('picture'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('picture') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('picture_fn') ? ' has-error ' : '' }}">
                            {!! Form::label('picture_fn', trans('forms.create_vsignal_label_picture_fn'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::file('picture_fn', NULL, array('id' => 'picture_fn', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_picture_fn'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="picture_fn">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_picture_fn') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('picture_fn'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('picture_fn') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <hr/>
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <strong>Inserte las distintas variaciones de la señal. Debe crear al menos una.</strong>
                            </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('variation') ? ' has-error ' : '' }}">
                            {!! Form::label('variation', trans('forms.create_vsignal_label_variation'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('variation', NULL, array('id' => 'variation', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_variation'))) !!}
                                    <div class="input-group-append">
                                        <label for="variation" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_variation') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('variation'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('variation') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('dimension') ? ' has-error ' : '' }}">
                            {!! Form::label('dimension', trans('forms.create_vsignal_label_dimension'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="custom-select form-control" name="dimension" id="dimension">
                                        <option value="">{{ trans('forms.create_vsignal_ph_dimension') }}</option>
                                        @if ($dimensions)
                                            @foreach($dimensions as $dimension)
                                                <option value="{{ $dimension->id }}">{{ $dimension->value }} @if ($dimension->value_fn) {{ ' - ' . $dimension->value_fn }} @endif</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <label for="dimension" class="input-group-text">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_dimension') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('dimension'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('dimension') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11">
                                {!! Form::button("Adicionar", array('class' => 'btn btn-sm btn-info margin-bottom-1 mb-1 float-right','type' => 'button', 'id' => 'add-variations')) !!}
                                &nbsp;
                            </div>
                            <div class="col-md-1">
                                {!! Form::button("Limpiar", array('class' => 'btn btn-sm btn-secondary margin-bottom-1 mb-1 float-right','type' => 'button', 'id' => 'clear-variations')) !!}
                            </div>
                            {!! Form::hidden("variations", $variations, array('id' => 'variations')) !!}
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="variations_tbl" class="table table-sm table-hover" style="display: none">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Dimensiones</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr/>

                        <div class="form-group has-feedback row {{ $errors->has('usage') ? ' has-error ' : '' }}">
                            {!! Form::label('usage', trans('forms.create_vsignal_label_usage'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('usage', $vsignal->usage, array('id' => 'usage', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_usage'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="usage">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_usage') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('usage'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('usage') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', trans('forms.create_vsignal_label_description'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::textarea('description', $vsignal->description, array('id' => 'description', 'rows' => '3', 'class' => 'form-control', 'placeholder' => trans('forms.create_vsignal_ph_description'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="description">
                                            <i class="fa fa-fw {{ trans('forms.create_vsignal_icon_description') }}"
                                               aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
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
