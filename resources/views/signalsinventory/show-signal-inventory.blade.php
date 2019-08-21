@extends('layouts.app')

@section('template_title')
    {!! trans('signalsinventory.showing-signals-inventory-title', ['code' => $vsignal->code]) !!}
@endsection

@section('template_fastload_css')
    .signal-image {
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
                            {!! trans('signalsinventory.showing-signals-inventory-title', ['code' => $vsignal->code]) !!}
                            <div class="float-right">
                                <a href="{{ route('signals-inventory.index') }}"
                                   class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('signalsinventory.tooltips.back-signals-inventories') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('signalsinventory.buttons.back-to-signals-inventories') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="@if ($vsignal->picture_fn) col-sm-6 col-md-6 @else col-sm-12 col-md-12 @endif">
                                <img src="@if ($vsignal->picture) {{ asset('storage/inventory/signals/'. $vsignal->picture) }} @else No picture @endif"
                                     alt="{{ $vsignal->picture }}"
                                     class="center-block mb-3 mt-4 signal-image">
                            </div>
                            @if ($vsignal->picture_fn)
                                <div class="col-sm-6 col-md-6">
                                    <img src="@if ($vsignal->picture) {{ asset('storage/inventory/signals/'. $vsignal->picture_fn) }} @else No picture @endif"
                                         alt="{{ $vsignal->picture_fn }}"
                                         class="center-block mb-3 mt-4 signal-image">
                                </div>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('signalsinventory.labelCode') }}
                                </strong>
                                @if ($vsignal->code) {{ $vsignal->code }} @else Sin código @endif
                            </div>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('signalsinventory.labelName') }}
                                </strong>
                                @if ($vsignal->name) {{ $vsignal->name }} @else Sin nombre @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('signalsinventory.labelGroup') }}
                                </strong>
                                @if ($vsignal->subgroup) {{ $vsignal->subgroup->group->name . ' (' . $vsignal->subgroup->group->code . ')'}} @else
                                    Sin grupo @endif
                            </div>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('signalsinventory.labelName') }}
                                </strong>
                                @if ($vsignal->subgroup) {{ $vsignal->subgroup->name . ' (' . $vsignal->subgroup->group->code . ')' }} @else
                                    Sin subgrupo @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('signalsinventory.labelVariation') }}
                                </strong>
                                @if ($vsignal->variations)
                                    <table class="table table-sm table-hover">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Dimensiones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($vsignal->variations as $variation)
                                            <tr>
                                                <td>{{ $variation->variation }}</td>
                                                <td>{{ $variation->signal_dimension->value }} @if ($variation->signal_dimension->value_fn)  {{ ' - ' . $variation->signal_dimension->value_fn }} @endif</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('signalsinventory.labelErpCode') }}
                                </strong>
                                @if ($vsignal->erp_code) {{ $vsignal->erp_code }} @else Sin código del ERP @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('signalsinventory.labelUsage') }}
                                </strong>
                                @if ($vsignal->usage) {{ $vsignal->usage }} @else Sin modo de uso @endif
                            </div>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('signalsinventory.labelDescription') }}
                                </strong>
                                @if ($vsignal->description ) {{ $vsignal->description  }} @else Sin descripción @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('signalsinventory.labelCreatedAt') }}
                                </strong>
                                @if ($vsignal->created_at) {{ $vsignal->created_at }} @else Sin fecha @endif
                            </div>

                            <div class="col-sm-6 col-6">
                                <strong class="text-larger">
                                    {{ trans('signalsinventory.labelUpdatedAt') }}
                                </strong>
                                @if ($vsignal->updated_at) {{ $vsignal->updated_at }} @else Sin fecha @endif
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-sm btn-success" href="{{ URL::to('/signals-inventory/create') }}"><i class="fa fa-plus-square"></i> Nuevo tipo de señal</a>
                            </div>
                            <div class="col-6">
                                <div class="btn-group float-right" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Continuar a...
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/vertical-signals/create') }}"><i class="fa fa-plus-square"></i> Nueva señal</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/intersections/create') }}"><i class="fa fa-plus-square"></i> Nueva intersección</a>
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
