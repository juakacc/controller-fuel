<input type="text" name="data" value="<?= date('d/m/Y'); ?>" class="form-control" id="data" placeholder="dd/mm/aaaa">
<small class="form-text text-danger">
  <?= check_array($model->form_msg, 'data'); ?>
</small>
