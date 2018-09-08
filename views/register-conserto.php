<?php
$model->validar_form_adicionar();
$veiculos = VeiculoDao::getVeiculos();
include_once ABSPATH . '/views/_includes/header.php';
?>

<div class="row justify-content-center">
  <div class="col-8">
    <h3>Registro de serviço</h3>

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
        <label for="data" class="col-form-label col-2">Data:</label>
        <div class="col-10">
          <input type="text" name="data" value="<?= date('d/m/Y'); ?>" class="form-control" id="data" placeholder="dd/mm/aaaa">
        </div>
      </div>

      <div class="form-group row">
        <label for="servico" class="col-form-label col-2">Serviço:</label>
        <div class="col-10">
          <input type="text" name="servico" value="" id="servico" class="form-control">
        </div>
      </div>

      <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
    </form>
  </div>
</div>

<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
