@extends('layouts.app')

@section('template_title')
    {!! trans('intersections.showing-all-intersections') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .intersections-table {
            border: 0;
        }

        .intersections-table tr td:first-child {
            padding-left: 15px;
        }

        .intersections-table tr td:last-child {
            padding-right: 15px;
        }

        .intersections-table.table-responsive,
        .intersections-table.table-responsive table {
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
                                {!! trans('workorders.showing-all-workorders') !!}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (config('atm_app.enableSearch'))
                            @include('partials.search-workorders-form')
                        @endif

                        <div class="table-responsive intersections-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="intersection_count">
                                    {{ trans_choice('intersections.intersections-table.caption', 1, ['intersectionscount' => $workOrder->count()]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th class="no-search no-sort"></th>
                                    <th>{!! trans('workorders.workorder-table.user_id') !!}</th>
                                    <th>{!! trans('workorders.workorder-table.report_id') !!}</th>
                                    <th>{!! trans('workorders.workorder-table.description') !!}</th>
                                    <th>{!! trans('workorders.workorder-table.startdate') !!}</th>
                                    <th class="hidden-xs">{!! trans('workorders.workorder-table.state') !!}</th>
                                    <th>{!! trans('workorders.workorder-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="intersections_table">
                                @foreach($workOrder as $workOrders)
                                    <tr>
                                        <td>
                                            {!! Form::open(array('url' => 'workorders/' . $workOrders->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Cerrar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('workorders.buttons.cerrar_orden'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmClose', 'data-title' => 'Cerrar orden de trabajo', 'data-message' => '¿Está seguro que desea cerrar la orden de trabajo seleccionada?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>{{$workOrders->user->name}}</td>
                                        <td>{{$workOrders->report_id}}</td>
                                        <td>{{$workOrders->report->description}}</td>
                                        <td>{{$workOrders->start_date}}</td>
                                        @if($workOrders->state)
                                            <td>Abierta</td>
                                        @endif
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('workorders/' . $workOrders->id) }}"
                                               data-toggle="tooltip" title="Mostrar">
                                                {!! trans('workorders.buttons.show') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('workorders/' . $workOrders->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('workorders.buttons.edit') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('pdf/' . $workOrders->id) }}"
                                               data-toggle="tooltip" title="Editar">
                                                PDF
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                @if(config('atm_app.enableSearch'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-close-order')

@endsection

@section('footer_scripts')
    @if ($workOrderTotal > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.close-modal-workorder')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif

    @if(config('atm_app.enableSearch'))
        @include('scripts.search-intersections')
    @endif
@endsection
