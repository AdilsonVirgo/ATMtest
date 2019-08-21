@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-tensors.showing-all-traffic-tensors') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .traffic-tensors-table {
            border: 0;
        }

        .traffic-tensors-table tr td:first-child {
            padding-left: 15px;
        }

        .traffic-tensors-table tr td:last-child {
            padding-right: 15px;
        }

        .traffic-tensors-table.table-responsive,
        .traffic-tensors-table.table-responsive table {
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
                                {!! trans('traffic-tensors.showing-all-traffic-tensors') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/traffic-tensors/create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    {!! trans('traffic-tensors.buttons.create-new') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(config('atm_app.enableSearch'))
                            @include('partials.search-traffic-tensors-form')
                        @endif

                        <div class="table-responsive traffic-tensors-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="traffic_tensors_count">
                                    {{ trans('traffic-tensors.traffic-tensors-table.caption', ['tensorscount' => $tensors->count(), 'tensorstotal' => $tensorstotal]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('traffic-tensors.traffic-tensors-table.state') !!}</th>
                                    <th>{!! trans('traffic-tensors.traffic-tensors-table.height') !!}</th>
                                    <th class="hidden-xs">{!! trans('traffic-tensors.traffic-tensors-table.material') !!}</th>
                                    <th class="hidden-xs">{!! trans('traffic-tensors.traffic-tensors-table.comment') !!}</th>
                                    <th>{!! trans('traffic-tensors.traffic-tensors-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="traffic_tensors_table">
                                @foreach($tensors as $tensor)
                                    <tr>
                                        <td>{{$tensor->state}}</td>
                                        <td>{{$tensor->height}}m</td>
                                        <td class="hidden-xs">{{$tensor->material}}</td>
                                        <td class="hidden-xs">{{$tensor->comment}}</td>
                                        <td>
                                            {!! Form::open(array('url' => 'traffic-tensors/' . $tensor->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('traffic-tensors.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar Intersección', 'data-message' => '¿Está seguro que desea eliminar el poste?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('traffic-tensors/' . $tensor->id) }}"
                                               data-toggle="tooltip" title="Mostrar">
                                                {!! trans('traffic-tensors.buttons.show') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('traffic-tensors/' . $tensor->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('traffic-tensors.buttons.edit') !!}
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
                                {{ $tensors->links() }}
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
    @if ((count($tensors) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif

    @if(config('atm_app.enableSearch'))
        @include('scripts.search-traffic-tensors')
    @endif
@endsection
