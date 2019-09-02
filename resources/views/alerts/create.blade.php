@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-6"> Crear una nueva Alerta                        
                        </div>
                        <div class="col-sm-12 col-md-6"> 
                             <a href="{{url('/alerts') }}" class="btn btn-light btn-sm float-right"
                                              data-toggle="tooltip" data-placement="left"
                                              title="{{ trans('alerts.tooltips.back-users') }}">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                {!! trans('alerts.buttons.back-to-alerts') !!}
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
                        <form method="post" action="{{url('/alerts')}}">
                            {{ csrf_field() }} 
                            <div class="container">                                
                                <div class="row">
                                    <div>
                                        Nombre Lugar
                                    </div>
                                    <input id="place" type="text" class="form-control{{ $errors->has('place') ? ' is-invalid' : '' }}" name="place" required autofocus>                                                        
                                    @if ($errors->has('place'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('place') }}</strong>
                                    </span>
                                    @endif

                                    prioridad
                                    <select id="priority_id"  class="form-control{{ $errors->has('priority_id') ? ' is-invalid' : '' }}" name="priority_id" value="{{ old('priority_id') }}" required autofocus>
                                        <option value="">Escoje...</option>
                                        @foreach($priorities as $x => $tmercado) 
                                        <option value="{{$tmercado->id}}">{{$tmercado->name}}</option>
                                        @endforeach
                                    </select> 
                                    @if ($errors->has('priority_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('priority_id') }}</strong>
                                    </span>
                                    @endif

                                    Motivo
                                    <select id="motive_id"  class="form-control{{ $errors->has('motive_id') ? ' is-invalid' : '' }}" name="motive_id" value="{{ old('motive_id') }}" required autofocus>
                                        <option value="">Escoje...</option>
                                        @foreach($motives as $x => $tmercado) 
                                        <option value="{{$tmercado->id}}">{{$tmercado->name}}</option>
                                        @endforeach
                                    </select> 
                                    @if ($errors->has('motive_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('motive_id') }}</strong>
                                    </span>
                                    @endif

                                    <div>
                                        Descripcion
                                    </div>
                                    <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required autofocus>                                                        
                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif

                                </div> <!--fin ROW-->
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">BTN</button>
                        </form>                 
                    </div>
                    <!--- fin otro row --->
<br/>
                    <div class="container">
                        <button class="btn btn-warning" href="#politica" data-toggle="collapse">☰ Reporte Aqui Directo</button>
                        <div id="politica" class="collapse">
                            <div class="row">
                                <form method="post" action="{{url('/reports')}}">
                                    {{ csrf_field() }} 
                                    <div class="container">                                
                                        <div class="row">
                                            <div class="col-sm col-md-6">
                                                Device_id
                                            </div>
                                            <div class="col-sm col-md-6">
                                                <input id="device_id" type="text" name="device_id" required autofocus>  
                                            </div>   
                                            <div class="col-sm col-md-6">
                                                Description   
                                            </div>
                                            <div class="col-sm col-md-6">
                                                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required autofocus>                                                        

                                            </div> 
                                           

                                        </div> <!--fin ROW-->
                                    </div>
                                    <button type="submit">BTN</button>
                                </form>                 
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection