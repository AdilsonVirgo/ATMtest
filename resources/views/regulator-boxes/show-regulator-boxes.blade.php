@extends('layouts.app')

@section('template_title')
    {!! trans('regulator-boxes.showing-all-regulator-boxes') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .regulator_boxes_table {
            border: 0;
        }

        .regulator_boxes_table tr td:first-child {
            padding-left: 15px;
        }

        .regulator_boxes_table tr td:last-child {
            padding-right: 15px;
        }

        .regulator_boxes_table.table-responsive,
        .regulator_boxes_table.table-responsive table {
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
                                {!! trans('regulator-boxes.showing-all-regulator-boxes') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/regulator-boxes/create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    {!! trans('regulator-boxes.buttons.create-new') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('atm_app.enableSearch'))
                            @include('partials.search-regulator-boxes-form')
                        @endif

                        <div class="table-responsive regulator_boxes_table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="regulator_boxes_count">
                                    {{ trans('regulator-boxes.regulator-boxes-table.caption', ['rbox_count' => $regulator_boxes->count(), 'rbox_total' => $regulator_box_total]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('regulator-boxes.regulator-boxes-table.code') !!}</th>
                                    <th>{!! trans('regulator-boxes.regulator-boxes-table.erp_code') !!}</th>
                                    <th>{!! trans('regulator-boxes.regulator-boxes-table.brand') !!}</th>
                                    <th>{!! trans('regulator-boxes.regulator-boxes-table.state') !!}</th>
                                    <th class="hidden-xs">{!! trans('regulator-boxes.regulator-boxes-table.google_address') !!}</th>
                                    <th>{!! trans('regulator-boxes.regulator-boxes-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="regulator_boxes_table">
                                @foreach($regulator_boxes as $regulator_box)
                                    <tr>
                                        <td>{{$regulator_box->code}}</td>
                                        <td>{{$regulator_box->erp_code}}</td>
                                        <td>{{$regulator_box->brand}}</td>
                                        <td>{{$regulator_box->state}}</td>
                                        <td class="hidden-xs">{{$regulator_box->google_address}}</td>
                                        <td>
                                            {!! Form::open(array('url' => 'regulator-boxes/' . $regulator_box->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('regulator-boxes.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar señal caja reguladora', 'data-message' => '¿Está seguro que desea eliminar esta caja reguladora?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('regulator-boxes/' . $regulator_box->id) }}"
                                               data-toggle="tooltip" title="Show">
                                                {!! trans('regulator-boxes.buttons.show') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('regulator-boxes/' . $regulator_box->id . '/edit') }}"
                                               data-toggle="tooltip" title="Edit">
                                                {!! trans('regulator-boxes.buttons.edit') !!}
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
                                {{ $regulator_boxes->links() }}
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
    @if ((count($regulator_boxes) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('atm_app.enableSearch'))
        @include('scripts.search-regulator-boxes')
    @endif
@endsection
