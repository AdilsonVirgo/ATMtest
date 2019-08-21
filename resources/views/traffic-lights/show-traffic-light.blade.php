@extends('layouts.app')

@section('template_title')
    {!! trans('traffic-lights.showing-traffic-light', ['code' => $traffic_light->code]) !!}
@endsection

@section('template_fastload_css')
    #map-canvas{
    min-height: 300px;
    height: 100%;
    width: 100%;
    }

    .pictureBg{
    background-image: url("@if ($traffic_light->picture) {{asset('storage/lights/' . $traffic_light->picture)}} @else {{asset('storage/signals/no-picture.png')}} @endif");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    min-height: 300px;
    }
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('traffic-lights.showing-traffic-light-title', ['code' => $traffic_light->code]) !!}
                            <div class="float-right">
                                <a href="{{ route('traffic-lights.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('traffic-lights.tooltips.back-traffic-lights') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('traffic-lights.buttons.back-to-traffic-lights') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 col-md-6 pictureBg">
                            </div>
                            <div class="col-sm-4 col-md-6" id="map-canvas">
                                map
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($traffic_light->code)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelCode') }}
                                    </strong>
                                    {{ $traffic_light->code }}
                                </div>
                            @endif

                            @if ($traffic_light->erp_code)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelErpCode') }}
                                    </strong>
                                    {{ $traffic_light->erp_code }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($traffic_light->brand)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelBrand') }}
                                    </strong>
                                    {{ $traffic_light->brand }}
                                </div>
                            @endif

                            @if ($traffic_light->model)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelModel') }}
                                    </strong>
                                    {{ $traffic_light->model }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($traffic_light->orientation)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelOrientation') }}
                                    </strong>
                                    {{ $traffic_light->orientation }}
                                </div>
                            @endif

                            @if ($traffic_light->state)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelState') }}
                                    </strong>
                                    {{ $traffic_light->state }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($traffic_light->regulator)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelRegulator') }}
                                    </strong>
                                    {{ $traffic_light->regulator->code }}
                                    | {{ $traffic_light->regulator->intersection->main_st }}
                                    y {{ $traffic_light->regulator->intersection->cross_st }}
                                </div>
                            @endif

                            @if ($traffic_light->light_type)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelType') }}
                                    </strong>
                                    {{ $traffic_light->light_type->name }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($traffic_light->intersection)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelIntersection') }}
                                    </strong>
                                    {{ $traffic_light->intersection->main_st }}
                                    y {{ $traffic_light->intersection->cross_st }}
                                </div>
                            @endif

                            @if ($traffic_light->traffic_pole)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelPole') }}
                                    </strong>
                                    {{ $traffic_light->traffic_pole->code }}
                                </div>
                            @elseif ($traffic_light->traffic_tensor)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelTensor') }}
                                    </strong>
                                    {{ $traffic_light->traffic_tensor->id }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($traffic_light->user)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelUser') }}
                                    </strong>
                                    {{ $traffic_light->user->full_name() }}
                                </div>
                            @endif

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('traffic-lights.labelComment') }}
                                </strong>
                                @if ($traffic_light->comment){{ $traffic_light->comment }} @else {{ 'Sin comentarios' }} @endif
                            </div>
                        </div>

                        <div class="row">
                            @if ($traffic_light->created_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelCreatedAt') }}
                                    </strong>
                                    {{ $traffic_light->created_at }}
                                </div>
                            @endif

                            @if ($traffic_light->updated_at)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('traffic-lights.labelUpdatedAt') }}
                                    </strong>
                                    {{ $traffic_light->updated_at }}
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>
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
            'latitude' => $traffic_light->intersection->latitude,
            'longitude' => $traffic_light->intersection->longitude,
            'code' => $traffic_light->code,
        ])
    @endif
@endsection
