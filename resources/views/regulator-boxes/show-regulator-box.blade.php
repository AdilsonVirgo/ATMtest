@extends('layouts.app')

@section('template_title')
    {!! trans('regulator-boxes.showing-regulator-box', ['code' => $regulator->code]) !!}
@endsection

@section('template_fastload_css')
    .picture {
    height: 200px;
    width: auto;
    border: 2px solid #8eb4cb;
    }

    .pictureBg-in{
    background-image: url("@if ($regulator->picture_in) {{asset('storage/regulators/' . $regulator->picture_in)}} @else {{asset('storage/signals/no-picture.png')}} @endif");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 300px;
    }

    .pictureBg-out{
    background-image: url("@if ($regulator->picture_out) {{asset('storage/regulators/' . $regulator->picture_out)}} @else {{asset('storage/signals/no-picture.png')}} @endif");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 300px;
    }

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
                            {!! trans('regulator-boxes.showing-regulator-box-title', ['code' => $regulator->code]) !!}
                            <div class="float-right">
                                <a href="{{ URL::to('regulator-boxes/') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('regulator-boxes.tooltips.back-regulator-box') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('regulator-boxes.buttons.back-to-regulator-box') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-10 col-md-12" id="map-canvas">
                                map
                            </div>
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col-sm-4 col-md-6">
                                <strong class="text-larger">
                                    {{ trans('regulator-boxes.labelPicuteIn') }}
                                </strong>
                                <div class="pictureBg-in"></div>
                            </div>
                            <div class="col-sm-4 col-md-6">
                                <strong class="text-larger">
                                    {{ trans('regulator-boxes.labelPicuteOut') }}
                                </strong>
                                <div class="pictureBg-out"></div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('regulator-boxes.labelCode') }}
                                </strong>
                                {{ $regulator->code }}
                            </div>
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('regulator-boxes.labelErpCode') }}
                                </strong>
                                {{ $regulator->erp_code }}
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($regulator->latitude)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelLatitude') }}
                                    </strong>
                                    {{ $regulator->latitude }}
                                </div>
                            @endif

                            @if ($regulator->longitude)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelLongitude') }}
                                    </strong>
                                    {{ $regulator->longitude }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($regulator->intersection_id)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelIntersection') }}
                                    </strong>
                                    {{ $regulator->intersection->main_st }} y {{ $regulator->intersection->cross_st }}
                                </div>
                            @endif

                            @if ($regulator->google_address)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelGoogleAddress') }}
                                    </strong>
                                    {{ $regulator->google_address }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($regulator->brand)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelBrand') }}
                                    </strong>
                                    {{ $regulator->brand }}
                                </div>
                            @endif

                            @if ($regulator->state)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelState') }}
                                    </strong>
                                    {{ $regulator->state }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($regulator->comment)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelComment') }}
                                    </strong>
                                    {{ $regulator->comment }}
                                </div>
                            @endif
                            @if ($regulator->user)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelUser') }}
                                    </strong>
                                    {{ $regulator->user->full_name() }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($regulator->created_at)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelCreatedAt') }}
                                    </strong>
                                    {{ $regulator->created_at }}
                                </div>

                            @endif

                            @if ($regulator->updated_at)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('regulator-boxes.labelUpdatedAt') }}
                                    </strong>
                                    {{ $regulator->updated_at }}
                                </div>

                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-sm btn-success" href="{{ URL::to('/regulator-boxes/create') }}"><i class="fa fa-plus-square"></i> Nueva reguladora</a>
                            </div>
                            <div class="col-6">
                                <div class="btn-group float-right" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Continuar a...
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/traffic-poles/create') }}"><i class="fa fa-plus-square"></i> Nuevo poste</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/traffic-tensors/create') }}"><i class="fa fa-plus-square"></i> Nuevo tensor</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/traffic-lights/create') }}"><i class="fa fa-plus-square"></i> Nuevo semáforo</a>
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
            'latitude' => $regulator->latitude,
            'longitude' => $regulator->longitude,
            'code' => $regulator->code,
        ])
    @endif
@endsection
