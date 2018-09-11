<select class="form-control" name="veiculo" id="veiculo" autofocus>
  <?php foreach ($veiculos as $v): ?>
    <option value="<?= $v->getId(); ?>" <?php if (check_array($model->form_data, 'veiculo') == $v->getId()): ?>selected<?php endif ?>>
      <?= $v->getNome(); ?>
    </option>
  <?php endforeach; ?>
</select>
<small class="form-text text-danger">
  <?= check_array($model->form_msg, 'veiculo'); ?>
</small>
