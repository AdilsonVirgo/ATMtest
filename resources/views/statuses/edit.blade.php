@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a class="nav-link" href="{{url('/home') }}">Menu</a>
                    <div class="row">                      
                        <div class="col-sm-3"><a class="nav-link" href="{{url('/statuses') }}">Statuses Edit</a></div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <form method="post" action="{{url('/statuses/'.$status->id )}}">
                            {{method_field('PATCH')}}
                            {{ csrf_field() }} 
                            <div class="container">                                
                                <div class="row">
                                    <div>
                                        Nombre
                                    </div>
                                    <input id="name" value="{{$status->name}}" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus>                                                        
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
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
@endsection