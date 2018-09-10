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
    <label for="" class="col-form-label col-2">Referência:</label>
    <div class="col-5">
      <select class="form-control" name="mes">
        <option value="01">Janeiro</option>
        <option value="02">Fevereiro</option>
        <option value="03">Março</option>
        <option value="04">Abril</option>
        <option value="05">Maio</option>
        <option value="06">Junho</option>
        <option value="07">Julho</option>
        <option value="08">Agosto</option>
        <option value="09">Setembro</option>
        <option value="10">Outubro</option>
        <option value="11">Novembro</option>
        <option value="12">Dezembro</option>
      </select>
    </div>
    <div class="col-5">
      <select class="form-control" name="ano">
        <option value="2017">2017</option>
        <option value="2018" selected>2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="km_inicial" class="col-form-label col-2">KM inicial:</label>
    <div class="col-10">
      <input type="text" name="km_inicial" value="<?= check_array($model->form_data, 'km_inicial'); ?>" class="form-control" id="km_inicial" placeholder="KM">
      <small class="form-text text-danger">
        <?= check_array($model->form_msg, 'km_inicial'); ?>
      </small>
    </div>
  </div>
  <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
</form>

<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
