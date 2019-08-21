@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-lights.showing-all-traffic-lights') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .traffic-lights-table {
            border: 0;
        }

        .traffic-lights-table tr td:first-child {
            padding-left: 15px;
        }

        .traffic-lights-table tr td:last-child {
            padding-right: 15px;
        }

        .traffic-lights-table.table-responsive,
        .traffic-lights-table.table-responsive table {
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
                                {!! trans('traffic-lights.showing-all-traffic-lights') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/traffic-lights/create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    {!! trans('traffic-lights.buttons.create-new') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('atm_app.enableSearch'))
                            @include('partials.search-traffic-lights-form')
                        @endif

                        <div class="table-responsive traffic-lights-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="traffic_lights_count">
                                    {{ trans('traffic-lights.traffic-lights-table.caption', ['lightscount' => $lights->count(), 'lightstotal' => $lightstotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('traffic-lights.traffic-lights-table.code') !!}</th>
                                    <th>{!! trans('traffic-lights.traffic-lights-table.erp-code') !!}</th>
                                    <th>{!! trans('traffic-lights.traffic-lights-table.brand') !!}</th>
                                    <th class="hidden-xs">{!! trans('traffic-lights.traffic-lights-table.model') !!}</th>
                                    <th>{!! trans('traffic-lights.traffic-lights-table.state') !!}</th>
                                    <th>{!! trans('traffic-lights.traffic-lights-table.orientation') !!}</th>
                                    <th>{!! trans('traffic-lights.traffic-lights-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="traffic_lights_table">
                                @foreach($lights as $tensor)
                                    <tr>
                                        <td>{{$tensor->code}}</td>
                                        <td>{{$tensor->erp_code}}</td>
                                        <td>{{$tensor->brand}}</td>
                                        <td class="hidden-xs">{{$tensor->model}}</td>
                                        <td>{{$tensor->state}}</td>
                                        <td>{{$tensor->orientation}}</td>
                                        <td>
                                            {!! Form::open(array('url' => 'traffic-lights/' . $tensor->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('traffic-lights.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar Intersección', 'data-message' => '¿Está seguro que desea eliminar el semáforo?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('traffic-lights/' . $tensor->id) }}"
                                               data-toggle="tooltip" title="Mostrar">
                                                {!! trans('traffic-lights.buttons.show') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('traffic-lights/' . $tensor->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('traffic-lights.buttons.edit') !!}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                @if(config('atm_app.enableSearch'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>

                            @if(config('atm_app.enablePagination'))
                                {{ $lights->links() }}
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
    @if ((count($lights) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif

    @if(config('atm_app.enableSearch'))
        @include('scripts.search-traffic-lights')
    @endif
@endsection
