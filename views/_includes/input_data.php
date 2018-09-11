<input type="text" name="data"
value="<?php if (check_array($model->form_data, 'data')): ?><?= check_array($model->form_data, 'data'); ?><?php else: ?><?= date('d/m/Y'); ?><?php endif; ?>"
class="form-control" id="data" placeholder="dd/mm/aaaa">

<small class="form-text text-danger">
  <?= check_array($model->form_msg, 'data'); ?>
</small>
