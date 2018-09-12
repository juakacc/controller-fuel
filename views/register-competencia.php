<?php
if (! defined('ABSPATH')) exit;

$model->validar_form_adicionar();
$veiculos = VeiculoDao::getVeiculos();

include_once ABSPATH . '/views/_includes/header.php'
?>

<h3>Registro de competência</h3>

<form class="form" method="post">
  <div class="form-group row">
    <label for="veiculo" class="col-form-label col-2">Veículo:</label>
    <div class="col-10">
      <?php include_once ABSPATH . '/views/_includes/select_veiculo.php'; ?>
    </div>
  </div>

  <div class="form-group row">
    <label for="mes" class="col-form-label col-2">Referência:</label>
    <div class="col-5">
      <select class="form-control" name="mes" id="mes">
        <option value="01" <?php if (check_array($model->form_data, 'mes') == 1): ?>selected<?php endif; ?>>Janeiro</option>
        <option value="02" <?php if (check_array($model->form_data, 'mes') == 2): ?>selected<?php endif; ?>>Fevereiro</option>
        <option value="03" <?php if (check_array($model->form_data, 'mes') == 3): ?>selected<?php endif; ?>>Março</option>
        <option value="04" <?php if (check_array($model->form_data, 'mes') == 4): ?>selected<?php endif; ?>>Abril</option>
        <option value="05" <?php if (check_array($model->form_data, 'mes') == 5): ?>selected<?php endif; ?>>Maio</option>
        <option value="06" <?php if (check_array($model->form_data, 'mes') == 6): ?>selected<?php endif; ?>>Junho</option>
        <option value="07" <?php if (check_array($model->form_data, 'mes') == 7): ?>selected<?php endif; ?>>Julho</option>
        <option value="08" <?php if (check_array($model->form_data, 'mes') == 8): ?>selected<?php endif; ?>>Agosto</option>
        <option value="09" <?php if (check_array($model->form_data, 'mes') == 9): ?>selected<?php endif; ?>>Setembro</option>
        <option value="10" <?php if (check_array($model->form_data, 'mes') == 10): ?>selected<?php endif; ?>>Outubro</option>
        <option value="11" <?php if (check_array($model->form_data, 'mes') == 11): ?>selected<?php endif; ?>>Novembro</option>
        <option value="12" <?php if (check_array($model->form_data, 'mes') == 12): ?>selected<?php endif; ?>>Dezembro</option>
      </select>
    </div>
    <div class="col-5">
      <select class="form-control" name="ano">
        <!-- <option value="2017" <?php if (check_array($model->form_data, 'ano') == 2017): ?>selected<?php endif; ?>>2017</option> -->
        <option value="2018" <?php if (check_array($model->form_data, 'ano') == 2018): ?>selected<?php endif; ?>>2018</option>
        <option value="2019" <?php if (check_array($model->form_data, 'ano') == 2019): ?>selected<?php endif; ?>>2019</option>
        <option value="2020" <?php if (check_array($model->form_data, 'ano') == 2020): ?>selected<?php endif; ?>>2020</option>
        <option value="2021" <?php if (check_array($model->form_data, 'ano') == 2021): ?>selected<?php endif; ?>>2021</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="km_inicial" class="col-form-label col-3">Km/Hr inicial:</label>
    <div class="col">
      <input type="text" name="metrica_inicial" value="<?= check_array($model->form_data, 'metrica_inicial'); ?>" class="form-control" id="metrica_inicial" required placeholder="km / hr">
      <small class="form-text text-danger">
        <?= check_array($model->form_msg, 'metrica_inicial'); ?>
      </small>
    </div>
  </div>
  <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
</form>

<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
