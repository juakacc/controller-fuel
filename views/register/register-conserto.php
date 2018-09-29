<?php
if (!defined('ABSPATH')) exit;

$model->validar_form_adicionar();
$veiculos = VeiculoDao::getVeiculos();
include_once ABSPATH . '/views/_includes/header.php';
?>

<h3>Registro de serviço</h3>

<form class="form" method="post">
  <input type="hidden" name="" id="type" value="conserto">
  <div class="form-group row">
    <label for="veiculo" class="col-form-label col-2">Veículo:</label>
    <div class="col-10">
      <?php include_once ABSPATH . '/views/_includes/select_veiculo.php'; ?>
    </div>
  </div>

  <?php include_once ABSPATH . '/views/_includes/select_evento.php'; ?>

  <div class="form-group row">
    <label for="data" class="col-form-label col-2">Data:</label>
    <div class="col-10">
      <?php include_once ABSPATH . '/views/_includes/input_data.php'; ?>
    </div>
  </div>

  <div class="form-group row">
    <label for="servico" class="col-form-label col-2">Serviço:</label>
    <div class="col-10">
      <input type="text" name="servico" value="<?= check_array($model->form_data, 'servico'); ?>" id="servico" class="form-control" required>
      <small class="form-text text-danger">
        <?= check_array($model->form_msg, 'servico'); ?>
      </small>
    </div>
  </div>

  <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
</form>

<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
<script type="text/javascript" src="<?= HOME_URI ?>views/_js/forms/verifica-evento.js"></script>
