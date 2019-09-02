@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">                      
                        <div class="col-6"><a class="nav-link" href="{{url('/motives') }}">Motives</a>

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

                    <form method="post" action="{{url('/motives')}}">
                        {{ csrf_field() }} 
                        <div class="row">
                            <div class="col-sm-3">
                                Nombre
                            </div>
                            <div class="col-sm-9">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus>                                                        
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-sm-3">
                                Descripcion
                            </div>
                            <div class="col-sm-9">
                                <input id="description" type="textarea" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" autofocus>                                                        
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>


                            <button type="submit" class="btn btn-success margin-bottom-1 mb-1 float-right">Crear un nuevo motivo</button>
                        </div>
                    </form>                 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection