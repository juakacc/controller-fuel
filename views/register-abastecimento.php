<?php
$model->validar_form_adicionar();
$veiculos = VeiculoDao::getVeiculos();

include_once ABSPATH . '/views/_includes/header.php';
?>

<h3>Registro de abastecimento</h3>

<form class="form" method="post">
  <div class="form-group row">
    <label for="veiculo" class="col-form-label col-2">Veículo:</label>
    <div class="col-10">
      <?php include_once ABSPATH . '/views/_includes/select_veiculo.php'; ?>
    </div>
  </div>

  <div class="form-group row">
    <label for="combustivel" class="col-form-label col-2">Combustível:</label>
    <div class="col-10">
      <select class="form-control" name="combustivel" id="combustivel">
        <option value="gasolina" <?php if (check_array($model->form_data, 'combustivel') == 'gasolina'):?>selected<?php endif; ?>>
          Gasolina
        </option>
        <option value="diesel" <?php if (check_array($model->form_data, 'combustivel') == 'diesel'):?>selected<?php endif; ?>>
          Diesel
        </option>
        <option value="alcool" <?php if (check_array($model->form_data, 'combustivel') == 'alcool'):?>selected<?php endif; ?>>
          Álcool
        </option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="data" class="col-form-label col-2">Data:</label>
    <div class="col-10">
      <?php include_once ABSPATH . '/views/_includes/input_data.php'; ?>
    </div>
  </div>

  <div class="form-group row">
    <label for="qtd" class="col-form-label col-2">Quantidade:</label>
    <div class="col-10">
      <input type="text" name="qtd" value="<?= check_array($model->form_data, 'qtd'); ?>" class="form-control" id="qtd" placeholder="Litros" required>
      <small class="form-text text-danger">
        <?= check_array($model->form_msg, 'qtd'); ?>
      </small>
    </div>
  </div>

  <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
</form>

<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
