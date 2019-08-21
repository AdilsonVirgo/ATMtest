<div class="modal fade modal-danger" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true" tabindex="-1">
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
        <p>Delete this user?</p>
      </div>
      <div class="modal-footer">
        {!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> Cancelar', array('class' => 'btn btn-outline pull-left btn-light', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
        {!! Form::button('<i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> Confirmar', array('class' => 'btn btn-danger pull-right', 'type' => 'button', 'id' => 'confirm' )) !!}
      </div>
    </div>
  </div>
</div>
