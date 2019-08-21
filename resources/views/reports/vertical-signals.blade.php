@extends('layouts.app')

@section('template_title')
    {!! trans('reports.vertical-signals.title') !!}
@endsection

@section('template_linked_css')
    @if(config('atm_app.enabledSelectizeJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.selectizeCssCDN') }}">
    @endif

    @if(config('atm_app.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('atm_app.datatablesCssCDN') }}">
    @endif
@endsection

@section('template_fastload_css')
    #map-canvas{
    min-height: 500px;
    height: 100%;
    width: 100%;
    }

    .signal_picture {
    height: 200px;
    width: auto;
    }

    .gm-style-iw {
    width: 600px;
    }

    .card-horizontal {
    display: flex;
    flex: 1 1 auto;
    }

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

    #signal-picture{
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        min-height: 300px;
    }

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <strong>{!! trans('reports.vertical-signals.filters') !!}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('partials.signals-filter', [
                            'inventories' => $sinventories,
                            'states' => $states,
                            'materials' => $materials,
                            'fasteners' => $fasteners,
                            'parishes' => $parishes,
                            'neighborhoods' => $neighborhoods
                        ])
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-white bg-primary">

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <strong>{!! trans('reports.vertical-signals.title') !!}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div id="map-canvas">
                                Sin acceso al servicio de mapas de Google.
                            </div>
                        </div>

                        <br/>

                        <div class="row">
                            <div class="table-responsive vsignals-table">
                                @include('partials.signals-table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-vsignal');

@endsection

@section('footer_scripts')
    <script type="text/javascript" src="{{ config('atm_app.selectizeJsCDN') }}"></script>

    <script type="text/javascript">
        $(function() {
            $("#signal").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#state").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#material").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#fastener").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#parish").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });

            $("#neighborhood").selectize({
                allowClear: true,
                create: false,
                highlight: true,
                diacritics: true
            });
        });
    </script>

    @include('scripts.google-maps-signal-reports')
    @include('scripts.filter-vertical-signals')
@endsection
