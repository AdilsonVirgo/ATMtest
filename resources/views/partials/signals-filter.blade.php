<div class="row">
    <div class="col-md-12">
        {!! Form::open(array('id' => 'vsignal-filters', 'route' => 'vsignal-filters', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
        {!! csrf_field() !!}

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>{!! Form::label('signal', trans('forms.create_vsignal_label_inventory'), array('class' => 'control-label')); !!}</strong>
                    <select name="signal" id="signal">
                        <option value="">{{ trans('forms.create_vsignal_ph_inventory') }}</option>
                        @if ($inventories)
                            @foreach($inventories as $inventory)
                                <option value="{{ $inventory->id }}" {{ old('signal') == $inventory->id ? 'selected' : '' }}>{{ $inventory->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>{!! Form::label('state', trans('forms.create_vsignal_label_state'), array('class' => 'control-label')); !!}</strong>
                    <select name="state" id="state">
                        <option value="">{{ trans('forms.create_vsignal_ph_state') }}</option>
                        @if ($states)
                            @foreach($states as $id => $value)
                                <option value="{{ $value }}" {{ old('state') == $value ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>{!! Form::label('material', trans('forms.create_vsignal_label_material'), array('class' => 'control-label')); !!}</strong>
                    <select name="material" id="material">
                        <option value="">{{ trans('forms.create_vsignal_ph_material') }}</option>
                        @if ($materials)
                            @foreach($materials as $i => $value)
                                <option value="{{ $value }}" {{ old('material') == $value ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>{!! Form::label('fastener', trans('forms.create_vsignal_label_fastener'), array('class' => 'control-label')); !!}</strong>
                    <select name="fastener" id="fastener">
                        <option value="">{{ trans('forms.create_vsignal_ph_fastener') }}</option>
                        @if ($fasteners)
                            @foreach($fasteners as $i => $value)
                                <option value="{{ $value }}" {{ old('fastener') == $value ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
{{--

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>{!! Form::label('parish', trans('forms.create_vsignal_label_parish'), array('class' => 'control-label')); !!}</strong>
                    <select name="parish" id="parish">
                        <option value="">{{ trans('forms.create_vsignal_ph_parish') }}</option>
                        @if ($parishes)
                            @foreach($parishes as $tem)
                                <option value="{{ $tem->parish }}" {{ old('parish') == $tem->parish ? 'selected' : '' }}>{{ $tem->parish }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <strong>{!! Form::label('neighborhood', trans('forms.create_vsignal_label_neighborhood'), array('class' => 'control-label')); !!}</strong>
                    <select name="neighborhood" id="neighborhood">
                        <option value="">{{ trans('forms.create_vsignal_ph_neighborhood') }}</option>
                        @if ($neighborhoods)
                            @foreach($neighborhoods as $item)
                                <option value="{{ $item->neighborhood }}" {{ old('neighborhood') == $item->neighborhood ? 'selected' : '' }}>{{ $item->neighborhood }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
--}}

        <div class="row">
            <div class="col-md-8">
                {!! Form::button('<i class="fa fa-fw fa-undo" aria-hidden="true"></i> ' . trans('forms.clear_vsignal_button_text'), array('class' => 'btn btn-sm btn-secondary margin-bottom-1 mb-1 float-right','type' => 'reset', 'id' => 'filter-reset')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::button('<i class="fa fa-fw fa-filter" aria-hidden="true"></i> ' . trans('forms.filter_vsignal_button_text'), array('class' => 'btn btn-sm btn-success margin-bottom-1 mb-1 float-right','type' => 'button', 'id' => 'filter-submit')) !!} &nbsp;&nbsp;
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>