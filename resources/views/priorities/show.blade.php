@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a class="nav-link" href="{{url('/home') }}">Menu</a>
                <h5 class="text-right">
                            <a style="color: red; font-style: italic" href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('disable-form').submit();">                                                                    
                                <i class="fas fa-minus-circle"></i>        
                                {{ __('Eliminar') }}    
                            </a>
                        </h5>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                    
                    <form id="disable-form" action="{{ url('/motives/'.$motive->id )}}" method="POST" style="display: none;">
                        {{method_field('DELETE')}}
                        @csrf
                    </form>

                    <ul>
                                        <li class="list-group-item ">
                                            
                                                <h2><i id="map" class="fas fa-map-marked-alt"></i></h2>
                                                <h6>Nombre</h6>
                                           
                                            <span class="text-muted"><button type="button" class="btn btn-sm btn-outline-secondary">{{$motive->name}}</button></span>
                                        </li>
                                        <li class="list-group-item ">
                                            
                                                <h2><i id="map" class="fas fa-map-marked-alt"></i></h2>
                                                <h6>Created At</h6>
                                            
                                            <span class="text-muted"><button type="button" class="btn btn-sm btn-outline-secondary">{{$motive->created_at}}</button></span>
                                        </li>
                                        
                                       
                                        
                                    </ul>              
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection