@extends('layouts.app')

@section('template_title')
    Bienvenido {{ Auth::user()->name }}
@endsection

@section('head')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <img src="{{ asset('images/atm.png') }}">
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="text-center">
                            <strong>Señales verticales</strong>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            <a href="{{ URL::to('/vertical-signals/') }}"><h4><strong>{{ $total_vsignals }} total</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="text-center">
                            <strong>Intersecciones</strong>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            <a href="{{ URL::to('/intersections/') }}"><h4><strong>{{$total_intersections }} total</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="text-center">
                            <strong>Cajas reguladoras</strong>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            <a href="{{ URL::to('/regulator-boxes/') }}"><h4><strong>{{ $total_rboxes }} total</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="text-center">
                            <strong>Postes de tráfico</strong>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            <a href="{{ URL::to('/traffic-poles/') }}"><h4><strong>{{ $total_poles }} total</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="text-center">
                            <strong>Tensores</strong>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            <a href="{{ URL::to('/traffic-tensors/') }}"><h4><strong>{{ $total_tensors }} total</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="text-center">
                            <strong>Semáforos</strong>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="text-center">
                            <a href="{{ URL::to('/traffic-lights/') }}"><h4><strong>{{ $total_lights }} total</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection