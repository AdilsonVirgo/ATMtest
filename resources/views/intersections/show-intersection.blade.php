@extends('layouts.app')

@section('template_title')
    {!! trans('intersections.showing-intersection', ['id' => $intersection->id]) !!}
@endsection

@section('template_fastload_css')
    #map-canvas{
    min-height: 300px;
    height: 100%;
    width: 100%;
    }
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">

                <div class="card">

                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('intersections.showing-intersection-title', ['id' => $intersection->id]) !!}
                            <div class="float-right">
                                <a href="{{ route('intersections.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('intersections.tooltips.back-intersections') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('intersections.buttons.back-to-intersections') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="map-canvas">
                                map
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($intersection->latitude)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('intersections.labelLatitude') }}
                                    </strong>
                                    {{ $intersection->latitude }}
                                </div>
                            @endif

                            @if ($intersection->longitude)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('intersections.labelLongitude') }}
                                    </strong>
                                    {{ $intersection->longitude }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($intersection->main_st)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('intersections.labelMainStreet') }}
                                    </strong>
                                    {{ $intersection->main_st }}
                                </div>
                            @endif

                            @if ($intersection->cross_st)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('intersections.labelCrossStreet') }}
                                    </strong>
                                    {{ $intersection->cross_st }}
                                </div>
                            @endif
                        </div>

                            <div class="row">
                                @if ($intersection->google_address)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('intersections.labelGoogleAddress') }}
                                    </strong>
                                    {{ $intersection->google_address }}
                                </div>
                                @endif
                                @if ($intersection->comment)
                                    <div class="col-sm-6 col-6">
                                        <strong class="text-larger">
                                            {{ trans('intersections.labelComment') }}
                                        </strong>
                                        {{ $intersection->comment }}
                                    </div>
                                @endif
                            </div>

                        <div class="row">
                            @if ($intersection->created_at)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelCreatedAt') }}
                                    </strong>
                                    {{ $intersection->created_at }}
                                </div>

                            @endif

                            @if ($intersection->updated_at)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('verticalsignals.labelUpdatedAt') }}
                                    </strong>
                                    {{ $intersection->updated_at }}
                                </div>

                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-sm btn-success" href="{{ URL::to('/intersections/create') }}"><i class="fa fa-plus-square"></i> Nueva intersección</a>
                            </div>
                            <div class="col-6">
                                <div class="btn-group float-right" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Continuar a...
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/regulator-boxes/create') }}"><i class="fa fa-plus-square"></i> Nueva reguladora</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/traffic-tensors/create') }}"><i class="fa fa-plus-square"></i> Nuevo tensor</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/traffic-poles/create') }}"><i class="fa fa-plus-square"></i> Nuevo poste</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @if(config('atm_app.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-atm-show', [
            'latitude' => $intersection->latitude,
            'longitude' => $intersection->longitude,
            'code' => $intersection->id,
        ])
    @endif
@endsection
