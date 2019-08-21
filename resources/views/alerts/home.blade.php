@extends('layouts.app')

@section('template_title')
{!! trans('verticalsignals.alerts') !!}
@endsection

@section('template_linked_css')
@if(config('atm_app.enabledDatatablesJs'))
<link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
@endif
<style type="text/css" media="screen">
    .alerts-table {
        border: 0;
    }

    .alerts-table tr td:first-child {
        padding-left: 15px;
    }

    .alerts-table tr td:last-child {
        padding-right: 15px;
    }

    .alerts-table.table-responsive,
    .alerts-table.table-responsive table {
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
                            {!! trans('verticalsignals.alerts') !!}
                        </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <a class="btn btn-primary btn-sm" href="/alerts/create">
                                <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                {!! trans('verticalsignals.buttons.create-new') !!}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    @if(config('atm_app.enableSearch'))
                    @include('partials.search-alerts-form')
                    @endif

                    <div class="table-responsive alerts-table">
                        <table class="table table-striped table-sm data-table">
                            <caption id="alert_count">
                                {{ trans('verticalsignals.alerts-table.caption', ['alertscount' => $alerts->count(), 'alertstotal' => $alertstotal]) }}
                            </caption>
                            <thead class="thead">
                                <tr>
                                    <th>{!! trans('verticalsignals.alerts-table.creator') !!}</th>
                                    <th>{!! trans('verticalsignals.alerts-table.state') !!}</th>
                                    <th>{!! trans('verticalsignals.alerts-table.latitude') !!}</th>
                                    <th>{!! trans('verticalsignals.alerts-table.longitude') !!}</th>
                                    <th>{!! trans('verticalsignals.alerts-table.comment') !!}</th>
                                    <th>{!! trans('verticalsignals.alerts-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                            </thead>
                            <tbody id="alerts_table">
                                @foreach($alerts as $alert)
                                <tr>
                                    <td>{{$alert->user->full_name()}}</td>
                                    <td>{{$alert->state}}</td>
                                    <td>{{$alert->latitude}}</td>
                                    <td>{{$alert->longitude}}</td>
                                    <td>{{$alert->description}}</td>
                                    @role('atmadmin')
                                    <td>
                                        {!! Form::open(array('url' => 'alerts/' . $alert->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button(trans('verticalsignals.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar alerta', 'data-message' => '¿Está seguro que desea eliminar esta alerta?')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    @endrole
                                    <td>
                                        <a class="btn btn-sm btn-success btn-block"
                                           href="{{ URL::to('alerts/' . $alert->id) }}"
                                           data-toggle="tooltip" title="Show">
                                            {!! trans('verticalsignals.buttons.show') !!}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info btn-block"
                                           href="{{ URL::to('alerts/' . $alert->id . '/edit') }}"
                                           data-toggle="tooltip" title="Edit">
                                            {!! trans('verticalsignals.buttons.edit') !!}
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
                        {{ $alerts->links() }}
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
@if ((count($alerts) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
@include('scripts.datatables')
@endif
@include('scripts.delete-modal-script')
@include('scripts.save-modal-script')
@if(config('atm_app.tooltipsEnabled'))
@include('scripts.tooltips')
@endif
@if(config('atm_app.enableSearch'))
@include('scripts.search-alerts')
@endif
@endsection
