<div class="modal fade modal-danger" id="editmaterial" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          Confirmar
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">close</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="card-body">
                {!! Form::open(array('route' => ['materialsedit', $materials->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                {!! csrf_field() !!}
               
                <br>
                <div class="form-group has-feedback row {{ $errors->has('report_id') ? ' has-error ' : '' }}">
                    {!! Form::label('report_id', trans('workorders.editorigen'), array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <select class="form-control" id="user_id" name="origen">
                                @if($materials->origen)
                                    <option value="1" selected>STOCK</option>                      
                                    <option value="0">ALMACEN</option>
                                @else
                                    <option value="1">STOCK</option>                      
                                    <option value="0" selected>ALMACEN</option>                               
                                @endif
                            </select>
                        </div>
                        @if ($errors->has('report_id'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('report_id') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        {!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> Cancelar', array('class' => 'btn btn-outline pull-left btn-light', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
        {!! Form::button('<i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> Guardar', array('class' => 'btn btn-danger pull-right', 'type' => 'button', 'id' => 'confirm' )) !!}
      </div>
    </div>
  </div>
</div>
