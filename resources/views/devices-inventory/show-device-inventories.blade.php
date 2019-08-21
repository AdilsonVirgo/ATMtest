@extends('layouts.app')

@section('template_title')
    {!! trans('device-inventory.showing-all-devices-inventories') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .devices-inventories-table {
            border: 0;
        }

        .devices-inventories-table tr td:first-child {
            padding-left: 15px;
        }

        .devices-inventories-table tr td:last-child {
            padding-right: 15px;
        }

        .devices-inventories-table.table-responsive,
        .devices-inventories-table.table-responsive table {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {!! trans('device-inventory.showing-all-devices-inventories') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/devices-inventory/create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    {!! trans('device-inventory.buttons.create-new') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('atm_app.enableSearch'))
                            @include('partials.search-devices-inventory-form')
                        @endif

                        <div class="table-responsive devices-inventories-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="inventory_count">
                                    {{ trans('device-inventory.devices-inventories-table.caption', ['inventoriescount' => $inventories->count(), 'inventoriestotal' => $inventoriestotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('device-inventory.devices-inventories-table.code') !!}</th>
                                    <th>{!! trans('device-inventory.devices-inventories-table.name') !!}</th>
                                    <th>{!! trans('device-inventory.devices-inventories-table.dimensions') !!}</th>
                                    <th>{!! trans('device-inventory.devices-inventories-table.erpcode') !!}</th>
                                    <th>{!! trans('device-inventory.devices-inventories-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="inventory_table">
                                @foreach($inventories as $inventory)
                                    <tr>
                                        <td>{{$inventory->code}}</td>
                                        <td>{{$inventory->name}}</td>
                                        <td>{{$inventory->dimensions}}</td>
                                        <td>{{$inventory->erp_code}}</td>
                                        <td>
                                            {!! Form::open(array('url' => 'devices-inventory/' . $inventory->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('device-inventory.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar señal', 'data-message' => '¿Está seguro que desea eliminar esta señal?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('devices-inventory/' . $inventory->id) }}"
                                               data-toggle="tooltip" title="Show">
                                                {!! trans('device-inventory.buttons.show') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('devices-inventory/' . $inventory->id . '/edit') }}"
                                               data-toggle="tooltip" title="Edit">
                                                {!! trans('device-inventory.buttons.edit') !!}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('atm_app.enableSearch'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('atm_app.enablePagination'))
                                {{ $inventories->links() }}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @if ((count($inventories) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('atm_app.enableSearch'))
        @include('scripts.search-devices-inventory')
    @endif
@endsection
