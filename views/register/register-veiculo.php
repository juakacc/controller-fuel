<?php
if (!defined('ABSPATH')) exit;

$model->validar_form_adicionar();
include_once ABSPATH . '/views/_includes/header.php';
?>

<h3>Cadastro de veículo</h3>

<form class="form" method="post">
  <div class="form-group row">
    <label class="col-form-label col-2" for="nome">Nome:</label>
    <div class="col-10">
      <input type="text" name="nome" value="<?= check_array($model->form_data, 'nome'); ?>" id="nome" class="form-control" required autofocus placeholder="GOL-01...">
      <small class="form-text text-danger">
        <?= check_array($model->form_msg, 'nome'); ?>
      </small>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-form-label col-4" for="tipo_metrica">Tipo de métrica:</label>
    <div class="col">
      <select class="custom-select" name="tipo_metrica" id="tipo_metrica">
        <option value="km">Quilometragem</option>
        <option value="hr">Horário</option>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="combustivel" class="col-form-label col-4">Combustível padrão:</label>
    <div class="col">
      <?php include_once ABSPATH . '/views/_includes/select_combustivel.php' ?>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="row"> <!-- Linha dos campos -->
        <div class="col-4">
          <label class="col-form-label" for="placa">Veiculo sem placa?</label>
        </div>
        <div class="col">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" name="sem_placa" >
              </div>
            </div>
            <input type="text" name="placa" value="<?= check_array($model->form_data, 'placa'); ?>" id="placa" class="form-control" placeholder="AAA-1111">
          </div>
          <small class="form-text text-danger">
            <?= check_array($model->form_msg, 'placa'); ?>
          </small>
        </div>
      </div>
      <div class="row mb-2"> <!-- Linha da ajuda -->
        <div class="col">
          <small class="form-text text-success">Selecione a caixa, caso não tenha placa.</small>
        </div>
      </div>
    </div>
  </div>

  <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
</form>

<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
