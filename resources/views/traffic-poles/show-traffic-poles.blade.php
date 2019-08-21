@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-poles.showing-all-traffic-poles') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .traffic-poles-table {
            border: 0;
        }

        .traffic-poles-table tr td:first-child {
            padding-left: 15px;
        }

        .traffic-poles-table tr td:last-child {
            padding-right: 15px;
        }

        .traffic-poles-table.table-responsive,
        .traffic-poles-table.table-responsive table {
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
                                {!! trans('traffic-poles.showing-all-traffic-poles') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/traffic-poles/create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    {!! trans('traffic-poles.buttons.create-new') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('atm_app.enableSearch'))
                            @include('partials.search-traffic-poles-form')
                        @endif

                        <div class="table-responsive traffic-poles-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="traffic_poles_count">
                                    {{ trans('traffic-poles.traffic-poles-table.caption', ['polescount' => $poles->count(), 'polestotal' => $polestotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('traffic-poles.traffic-poles-table.code') !!}</th>
                                    <th>{!! trans('traffic-poles.traffic-poles-table.state') !!}</th>
                                    <th>{!! trans('traffic-poles.traffic-poles-table.height') !!}</th>
                                    <th class="hidden-xs">{!! trans('traffic-poles.traffic-poles-table.material') !!}</th>
                                    <th class="hidden-xs">{!! trans('traffic-poles.traffic-poles-table.google-address') !!}</th>
                                    <th class="hidden-xs">{!! trans('traffic-poles.traffic-poles-table.comment') !!}</th>
                                    <th>{!! trans('traffic-poles.traffic-poles-table.erp-code') !!}</th>
                                    <th>{!! trans('traffic-poles.traffic-poles-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="traffic_poles_table">
                                @foreach($poles as $pole)
                                    <tr>
                                        <td>{{$pole->code}}</td>
                                        <td>{{$pole->state}}</td>
                                        <td>{{$pole->height}}m</td>
                                        <td class="hidden-xs">{{$pole->material}}</td>
                                        <td class="hidden-xs">{{$pole->google_address}}</td>
                                        <td class="hidden-xs">{{$pole->comment}}</td>
                                        <td>{{$pole->erp_code}}</td>
                                        <td>
                                            {!! Form::open(array('url' => 'traffic-poles/' . $pole->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('traffic-poles.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar Intersección', 'data-message' => '¿Está seguro que desea eliminar el poste?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('traffic-poles/' . $pole->id) }}"
                                               data-toggle="tooltip" title="Mostrar">
                                                {!! trans('traffic-poles.buttons.show') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('traffic-poles/' . $pole->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('traffic-poles.buttons.edit') !!}
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
                                {{ $poles->links() }}
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
    @if ((count($poles) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif

    @if(config('atm_app.enableSearch'))
        @include('scripts.search-traffic-poles')
    @endif
@endsection
