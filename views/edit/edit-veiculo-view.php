<?php
if (!defined('ABSPATH')) exit;

$model->validar_form_editar();
include_once ABSPATH . '/views/_includes/header.php';
?>

<h3>Edição de veículo</h3>

<form class="form" method="post">
  <input type="hidden" name="id" value="<?= check_array($model->form_data, 'id'); ?>">

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
    <label class="col-form-label col-2" for="chassi">Chassi:</label>
    <div class="col-10">
      <input type="text" name="chassi" value="<?= check_array($model->form_data, 'chassi'); ?>" id="chassi" class="form-control" placeholder="(opcional)" >
      <small class="form-text text-danger">
        <?= check_array($model->form_msg, 'chassi'); ?>
      </small>
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
                <input type="checkbox" name="sem_placa" <?php if (check_array($model->form_data, 'sem_placa')): ?>checked<?php endif; ?> id="sem_placa">
              </div>
            </div>
            <input type="text" name="placa" value="<?= check_array($model->form_data, 'placa'); ?>" id="placa" class="form-control" placeholder="AAA-1111">
          </div>
          <small class="form-text text-danger">
            <?= check_array($model->form_msg, 'placa'); ?>
          </small>
        </div>
        <div class="col">
          <?php include_once ABSPATH . '/views/_includes/select_ufPlaca.php'; ?>
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
<script type="text/javascript" src="<?= HOME_URI ?>views/_js/forms/verifica-placa.js"></script>
