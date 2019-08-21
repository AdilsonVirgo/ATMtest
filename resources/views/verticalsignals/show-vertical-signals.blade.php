@extends('layouts.app')

@section('template_title')
    {!! trans('verticalsignals.showing-all-vsignals') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .vsignals-table {
            border: 0;
        }

        .vsignals-table tr td:first-child {
            padding-left: 15px;
        }

        .vsignals-table tr td:last-child {
            padding-right: 15px;
        }

        .vsignals-table.table-responsive,
        .vsignals-table.table-responsive table {
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
                                {!! trans('verticalsignals.showing-all-vsignals') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/vertical-signals/create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    {!! trans('verticalsignals.buttons.create-new') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('atm_app.enableSearch'))
                            @include('partials.search-vsignals-form')
                        @endif

                        <div class="table-responsive vsignals-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="vsignal_count">
                                    {{ trans('verticalsignals.vsignals-table.caption', ['vsignalscount' => $vsignals->count(), 'vsignalstotal' => $vsignalstotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('verticalsignals.vsignals-table.code') !!}</th>
                                    <th>{!! trans('verticalsignals.vsignals-table.creator') !!}</th>
                                    <th>{!! trans('verticalsignals.vsignals-table.state') !!}</th>
                                    <th>{!! trans('verticalsignals.vsignals-table.fastener') !!}</th>
                                    <th>{!! trans('verticalsignals.vsignals-table.material') !!}</th>
                                    <th>{!! trans('verticalsignals.vsignals-table.normative') !!}</th>
                                    <th>{!! trans('verticalsignals.vsignals-table.google_address') !!}</th>
                                    <th>{!! trans('verticalsignals.vsignals-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="vsignals_table">
                                @foreach($vsignals as $vsignal)
                                    <tr>
                                        <td>{{$vsignal->code}}</td>
                                        <td>{{$vsignal->user->full_name()}}</td>
                                        <td>{{$vsignal->state}}</td>
                                        <td>{{$vsignal->fastener}}</td>
                                        <td>{{$vsignal->material}}</td>
                                        <td>{{$vsignal->normative}}</td>
                                        <td>{{$vsignal->google_address}}</td>
                                        @role('atmadmin')
                                        <td>
                                            {!! Form::open(array('url' => 'vertical-signals/' . $vsignal->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('verticalsignals.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar señal vertical', 'data-message' => '¿Está seguro que desea eliminar esta señal?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endrole
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('vertical-signals/' . $vsignal->id) }}"
                                               data-toggle="tooltip" title="Show">
                                                {!! trans('verticalsignals.buttons.show') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('vertical-signals/' . $vsignal->id . '/edit') }}"
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
                                {{ $vsignals->links() }}
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
    @if ((count($vsignals) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('atm_app.enableSearch'))
        @include('scripts.search-vsignals')
    @endif
@endsection
