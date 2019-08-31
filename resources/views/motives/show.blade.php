@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-success">
                    <div class="row">                      
                        <div class="col-6"><a class="nav-link text-white" href="{{url('/motives') }}">Motives</a>

                        </div>
                        <div class="col-6"><a href="{{url('/motives') }}" class="btn btn-light btn-sm float-right"
                                              data-toggle="tooltip" data-placement="left"
                                              title="{{ trans('signalsinventory.tooltips.back-users') }}">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                {!! trans('motives.buttons.back-to-motives') !!}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">

                            <div class="card">

                                <div class="col-6">
                                    <span class="text-muted">Nombre<button type="button" class="btn btn-sm btn-outline-secondary">{{$motive->name}}</button></span>
                                    <br/>
                                </div>
                                <div class="col-6">
                                       <br/>
                                    <span class="text-muted">Descripcion<button type="button" class="btn btn-sm btn-outline-secondary">{{$motive->created_at}}</button></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                     <div class="clearfix"></div>
                        <div class="border-bottom"></div>

                        <br/>
                     <div class="row">
                            <div class="col-6">
                                <a class="btn btn-sm btn-success" href="{{ URL::to('/alerts/create') }}"><i class="fa fa-plus-square"></i> Nueva Alerta</a>
                            </div>
                            <div class="col-6">
                                <div class="btn-group float-right" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Continuar a...
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/statuses/create') }}"><i class="fa fa-plus-square"></i> Nueva Estado</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item btn btn-sm" href="{{ URL::to('/statuses/create') }}"><i class="fa fa-plus-square"></i> Nuevo Prioridad</a>
                                         </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection