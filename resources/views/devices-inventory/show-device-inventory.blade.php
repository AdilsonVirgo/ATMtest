@extends('layouts.app')

@section('template_title')
    {!! trans('device-inventory.showing-device-inventory-title', ['code' => $device->code]) !!}
@endsection

@section('template_fastload_css')
    .device-image {
    height: 100px;
    width: auto;
    }
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">

                <div class="card">

                    <div class="card-header text-white bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('device-inventory.showing-device-inventory-title', ['code' => $device->code]) !!}
                            <div class="float-right">
                                <a href="{{ route('devices-inventory.index') }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('device-inventory.tooltips.back-device-inventories') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('device-inventory.buttons.back-to-device-inventories') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($device->symbol)
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <img src="@if ($device->symbol) {{ asset('storage/inventory/devices/'. $device->symbol) }} @else No symbol @endif"
                                         alt="{{ $device->symbol }}"
                                         class="center-block mb-3 mt-4 device-image">
                                </div>
                            </div>
                        @endif

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('device-inventory.labelCode') }}
                                </strong>
                                @if ($device->code) {{ $device->code }} @else Sin código @endif
                            </div>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('device-inventory.labelName') }}
                                </strong>
                                @if ($device->name) {{ $device->name }} @else Sin nombre @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('device-inventory.labelDimensions') }}
                                </strong>
                                @if ($device->dimensions) {{ $device->dimensions }} @else Sin dimensiones @endif
                            </div>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('device-inventory.labelErpCode') }}
                                </strong>
                                @if ($device->erp_code) {{ $device->erp_code }} @else Sin código del ERP @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-sm btn-success" href="{{ URL::to('/devices-inventory/create') }}"><i
                                            class="fa fa-plus-square"></i> Nuevo dispositivo</a>
                            </div>
                            <div class="col-6">
                                <div class="btn-group float-right" role="group">
                                    <button id="btnGroupDrop1" type="button"
                                            class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        Continuar a...
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm"
                                                                                                  href="{{ URL::to('/intersections/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nueva intersección</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm"
                                           href="{{ URL::to('/regulator-boxes/create') }}"><i
                                                    class="fa fa-plus-square"></i> Nueva reguladora</a>

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
@endsection
