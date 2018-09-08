<?php
if (!defined('ABSPATH')) exit;

$model->validar_form_adicionar();

include_once ABSPATH . '/views/_includes/header.php';
?>

<div class="row justify-content-center">
  <div class="col-8">
    <h3>Cadastro de veículo</h3>
    <form class="form" method="post">
      <div class="form-group row">
        <label class="col-form-label col-2" for="nome">Nome:</label>
        <div class="col-10">
          <input type="text" name="nome" value="" id="nome" class="form-control" autofocus>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-form-label col-2" for="placa">Placa:</label>
        <div class="col-10">
          <input type="text" name="placa" value="" id="placa" class="form-control">
        </div>
      </div>
      <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
    </form>
  </div>
</div>

<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
