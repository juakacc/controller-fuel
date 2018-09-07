<?php
if (! defined('ABSPATH')) exit;

$model->validar_form_adicionar();
$veiculos = $model->get_veiculos();

include_once ABSPATH . '/views/_includes/header.php'
?>

<div class="row">
  <div class="col">
    <h3>Registro de competência</h3>

    <form class="form" method="post">
      <div class="form-group row">
        <label for="" class="label-form col-2">Veículo:</label>
        <div class="col-10">
          <select class="form-control" name="veiculo">
            <?php foreach ($veiculos as $v): ?>
              <option value="<?= $v->getId(); ?>"><?= $v->getNome(); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="label-form col-2">Referência:</label>
        <div class="col-10">
          <input type="text" name="referencia" value="" class="form-control" placeholder="dd/mm/aaaa">
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="label-form col-2">Quilometragem inicial:</label>
        <div class="col-10">
          <input type="text" name="km_inicial" value="" class="form-control" placeholder="KM">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <button type="submit" name="button" class="btn btn-primary">Gravar</button>
        </div>
        <div class="col">
          <a href="#" class="btn btn-secondary">Voltar</a>
        </div>
      </div>

    </form>
  </div>
</div>

<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
