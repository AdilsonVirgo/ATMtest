@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a class="nav-link" href="{{url('/home') }}">Menu</a>
                    <div class="row">                      
                        <div class="col-sm-3"><a class="nav-link" href="{{url('/motives/create') }}">MotivesCreate</a></div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                    <ul>
                        @foreach ($motives as $provincia)
                            <li>
                                <a style="color: red;" href="{{url('/motives/'.$provincia->id) }}">
                                    {{$provincia->name}}
                                </a>
                            </li>                                               
                        @endforeach
                        </ul>                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection