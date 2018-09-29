<div class="form-group row">
  <label for="veiculo" class="col-form-label col-2">Evento:</label>
  <div class="col-10">
    <select class="custom-select" name="evento" id="select-event" required>

    </select>
    <small class="form-text text-danger">
      <?= check_array($model->form_msg, 'evento'); ?>
    </small>
  </div>
</div>
