@extends('layouts.app')

@section('template_title')
    {!! trans('intersections.showing-intersection', ['id' => $workOrder->id]) !!}
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
                            {!! trans('workorders.showing-workorder-title', ['id' => $workOrder->id]) !!}
                            <div class="float-right">
                                <a href="{{ route('workorders.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('intersections.tooltips.back-intersections') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('workorders.buttons.back-to-workorder') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <div class="row">
                            @if ($workOrder->id)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelorderId') }}
                                    </strong>
                                    {{ $workOrder->id }}
                                </div>
                            @endif
                        </div>    

                        <div class="row">
                            @if ($workOrder->user_id)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.workorder-table.user_id') }}
                                    </strong>
                                    {{ $workOrder->user->name }}
                                </div>
                            @endif

                            @if ($workOrder->report_id)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelReportId') }}
                                    </strong>
                                    {{ $workOrder->report_id }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if ($workOrder->start_date)

                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelStartDate') }}
                                    </strong>
                                    {{ $workOrder->start_date }}
                                </div>
                            @endif

                            @if ($workOrder->state)
                                <div class="col-sm-6 col-6">
                                    <strong class="text-larger">
                                        {{ trans('workorders.labelStatus') }}
                                    </strong>
                                    @if($workOrder->state)
                                        Abierta
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <span id="card_title">
                                                    {!! trans('workorders.showing-all-materials') !!}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="table-responsive intersections-table">
                                                <table class="table table-striped table-sm data-table">
                                                    <caption id="intersection_count">

                                                    </caption>
                                                    <thead class="thead">
                                                    <tr>
                                                        <th>{!! trans('workorders.materials-table.erp_code') !!}</th>
                                                        <th>{!! trans('workorders.materials-table.name') !!}</th>
                                                        <th>{!! trans('workorders.materials-table.quantity') !!}</th>
                                                        <th class="hidden-xs">{!! trans('workorders.materials-table.origen') !!}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="intersections_table">
                                                        @foreach($material as $materials)
                                                            <tr>
                                                                <td>{{$materials->erp_code}}</td>
                                                                <td>{{$materials->name}}</td>
                                                                <td>{{$materials->quantity}}</td>
                                                                @if($materials->origen)
                                                                    <td>STOCK</td>
                                                                @else
                                                                    <td>ALMACEN</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                      
                      
                        
                        <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('footer_scripts')
@endsection
