<?php
if (! defined('ABSPATH')) exit;

$model->validar_form_adicionar();
$veiculos = VeiculoDao::getVeiculos();

include_once ABSPATH . '/views/_includes/header.php'
?>

<div class="row justify-content-center">
  <div class="col-8">
    <h3>Registro de competência</h3>

    <form class="form" method="post">
      <div class="form-group row">
        <label for="veiculo" class="col-form-label col-2">Veículo:</label>
        <div class="col-10">
          <select class="form-control" name="veiculo" id="veiculo" autofocus>
            <?php foreach ($veiculos as $v): ?>
              <option value="<?= $v->getId(); ?>"><?= $v->getNome(); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label for="referencia" class="col-form-label col-2">Referência:</label>
        <div class="col-10">
          <input type="text" name="referencia" value="" class="form-control" id="referencia" placeholder="mm/aaaa">
        </div>
      </div>

      <div class="form-group row">
        <label for="km_inicial" class="col-form-label col-2">KM inicial:</label>
        <div class="col-10">
          <input type="text" name="km_inicial" value="" class="form-control" id="km_inicial" placeholder="KM">
        </div>
      </div>
      <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
    </form>
  </div>
</div>

<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
