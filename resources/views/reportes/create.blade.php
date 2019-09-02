@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-6"> Crear una nueva Reporte                        
                        </div>
                        <div class="col-sm-12 col-md-6"> 
                             <a href="{{url('/reportes') }}" class="btn btn-light btn-sm float-right"
                                              data-toggle="tooltip" data-placement="left"
                                              title="{{ trans('reportes.tooltips.back-users') }}">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                {!! trans('reportes.buttons.back-to-reportes') !!}
                            </a>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="reporte">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <form method="post" action="{{url('/reportes')}}">
                            {{ csrf_field() }} 
                            <div class="container">                                
                                <div class="row">
                                    <div>
                                        Alerta
                                    </div>
                                    <input id="alert_id" value="{{$alert->id}}"type="text" class="form-control{{ $errors->has('alert_id') ? ' is-invalid' : '' }}" name="alert_id" required autofocus>                                                        
                                    @if ($errors->has('alert_id'))
                                    <span class="invalid-feedback" role="reporte">
                                        <strong>{{ $errors->first('alert_id') }}</strong>
                                    </span>
                                    @endif
                                     
                                     device
                                    <select id="device_id"  class="form-control{{ $errors->has('device_id') ? ' is-invalid' : '' }}" name="device_id" value="{{ old('device_id') }}" required autofocus>
                                        <option value="">Escoje...</option>
                                        @foreach($devices as $x => $device) 
                                        <option value="{{$device->id}}">{{$device->name}}</option>
                                        @endforeach
                                    </select> 
                                    @if ($errors->has('device_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('device_id') }}</strong>
                                    </span>
                                    @endif
                                    
                                    Assign to
                                    <select id="assign_id"  class="form-control{{ $errors->has('assign_id') ? ' is-invalid' : '' }}" name="assign_id" value="{{ old('assign_id') }}" required autofocus>
                                        <option value="">Escoje...</option>
                                        @foreach($collectors as $x => $escalera) 
                                        @if($escalera)
                                        @endif
                                        <option value="{{$escalera->id}}">{{$escalera->name}}</option>
                                        @endforeach
                                    </select> 
                                    @if ($errors->has('assign_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('assign_id') }}</strong>
                                    </span>
                                    @endif
                                    
                                    <div>
                                        Descripcion
                                    </div>
                                    <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required autofocus>                                                        
                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="reporte">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                    
                                     materials
                                    <select id="material_id"  class="form-control{{ $errors->has('material_id') ? ' is-invalid' : '' }}" name="material_id" value="{{ old('material_id') }}" autofocus>
                                        <option value="">Escoje...</option>
                                        @foreach($materials as $x => $device) 
                                        <option value="{{$device->id}}">{{$device->name}}</option>
                                        @endforeach
                                    </select> 
                                     @if ($errors->has('material_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('material_id') }}</strong>
                                    </span>
                                    @endif
                                    
                                    <div>
                                        cantidad
                                    </div>
                                    <input id="cantidad" type="text" class="form-control{{ $errors->has('cantidad') ? ' is-invalid' : '' }}" name="cantidad" required autofocus>                                                        
                                   
                                    
                                </div> <!--fin ROW-->
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">BTN</button>
                        </form>                 
                    </div>
                    <!--- fin otro row --->
<br/>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection