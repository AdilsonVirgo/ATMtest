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
                                {!! trans('intersections.showing-all-intersections') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <a class="btn btn-primary btn-sm" href="/intersections/create">
                                    <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                    {!! trans('intersections.buttons.create-new') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (config('atm_app.enableSearch'))
                            @include('partials.search-intersections-form')
                        @endif

                        <div class="table-responsive intersections-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="intersection_count">
                                    {{ trans_choice('intersections.intersections-table.caption', 1, ['intersectionscount' => $intersections->count()]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>{!! trans('intersections.intersections-table.main_st') !!}</th>
                                    <th>{!! trans('intersections.intersections-table.cross_st') !!}</th>
                                    <th class="hidden-xs">{!! trans('intersections.intersections-table.latitude') !!}</th>
                                    <th class="hidden-xs">{!! trans('intersections.intersections-table.longitude') !!}</th>
                                    <th>{!! trans('intersections.intersections-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="intersections_table">
                                @foreach($intersections as $intersection)
                                    <tr>
                                        <td>{{$intersection->main_st}}</td>
                                        <td>{{$intersection->cross_st}}</td>
                                        <td class="hidden-xs">{{$intersection->latitude}}</td>
                                        <td class="hidden-xs">{{$intersection->longitude}}</td>
                                        <td>
                                            {!! Form::open(array('url' => 'intersections/' . $intersection->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Eliminar')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('intersections.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Eliminar Intersección', 'data-message' => '¿Está seguro que desea eliminar la intersección?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block"
                                               href="{{ URL::to('intersections/' . $intersection->id) }}"
                                               data-toggle="tooltip" title="Mostrar">
                                                {!! trans('intersections.buttons.show') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block"
                                               href="{{ URL::to('intersections/' . $intersection->id . '/edit') }}"
                                               data-toggle="tooltip" title="Editar">
                                                {!! trans('intersections.buttons.edit') !!}
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
                                {{ $intersections->links() }}
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
    @if ((count($intersections) > config('atm_app.datatablesJsStartCount')) && config('atm_app.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif

    @if(config('atm_app.enableSearch'))
        @include('scripts.search-intersections')
    @endif
@endsection
