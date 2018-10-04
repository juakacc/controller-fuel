<?php
if (!defined('ABSPATH')) exit;

$model->validar_form_editar();

include_once ABSPATH . '/views/_includes/header.php';
?>

<h3>Registro de abastecimento</h3>

<form class="form" method="post">
  <input type="hidden" name="id" value="<?= check_array($model->form_data, 'id'); ?>">

  <!-- <input type="hidden" name="" id="type" value="abastecimento"> -->
  <div class="form-group row">
    <label for="veiculo" class="col-form-label col-2">Veículo:</label>
    <div class="col-10">
      <input type="text" name="veiculo" value="<?= check_array($model->form_data, 'veiculo'); ?>" class="form-control" readonly>
    </div>
  </div>

  <div class="form-group row">
    <label for="veiculo" class="col-form-label col-2">Evento:</label>
    <div class="col-10">
      <input type="text" name="evento" value="<?= check_array($model->form_data, 'evento'); ?>" class="form-control" readonly>
    </div>
  </div>

  <small class="form-text text-danger">
    <?= check_array($model->form_msg, 'peca'); ?>
  </small>

  <div class="div-pecas">
    <?php if (isset($model->form_data['peca']) && count($model->form_data['peca']) >= 1): ?>
      <div class="form-group row">
        <label for="peca" class="col-form-label col-2">Peças:</label>
        <div class="col-5">
          <input type="text" name="peca[0]" value="<?= check_array($model->form_data['peca'], 0); ?>" id="peca" class="form-control" required>
        </div>
        <label for="qtd[1]" class="col-form-label col-1">QTD:</label>
        <div class="col-2">
          <input type="number" name="qtd[0]" class="form-control" value="<?= check_array($model->form_data['qtd'], 0); ?>" min="1">
        </div>
        <div class="col-2">
          <a href="#" class="btn btn-primary" id="btn-add"><i class="fas fa-plus-circle"></i></a>
        </div>
      </div>

      <?php for ($i=1; $i < count($model->form_data['peca']); $i++): ?>
        <div class="form-group row">
          <div class="col-2"></div>
          <div class="col-5">
            <input type="text" name="peca[]" value="<?= check_array($model->form_data['peca'], $i); ?>" id="peca" class="form-control" >
          </div>
          <label for="qtd[]" class="col-form-label col-1">QTD:</label>
          <div class="col-2">
            <input type="number" name="qtd[]" class="form-control" value="<?= check_array($model->form_data['qtd'], $i); ?>" min="1" required>
          </div>
          <div class="col"><a href="#" class="btn btn-danger remove_field"><i class="fas fa-minus-circle"></i></a></div>
        </div>
      <?php endfor; ?>

    <?php else: ?>
        <div class="form-group row">
          <label for="peca" class="col-form-label col-2">Peças:</label>
          <div class="col-5">
            <input type="text" name="peca[]" value="<?= check_array($model->form_data, 'peca'); ?>" id="peca" class="form-control" required>
          </div>
          <label for="qtd[1]" class="col-form-label col-1">QTD:</label>
          <div class="col-2">
            <input type="number" name="qtd[]" class="form-control" value="1" min="1">
          </div>
          <div class="col-2">
            <a href="#" class="btn btn-primary" id="btn-add"><i class="fas fa-plus-circle"></i></a>
          </div>
        </div>
    <?php endif; ?>
  </div>

  <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
</form>

<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
<script type="text/javascript" src="<?= HOME_URI ?>views/_js/forms/form_pecas.js"></script>
<!-- <script type="text/javascript" src="<?= HOME_URI ?>views/_js/forms/verifica-evento.js"></script> -->
