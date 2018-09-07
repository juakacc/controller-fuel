<?php include_once ABSPATH . '/views/_includes/header.php' ?>

<h3>Cadastro de veículo</h3>
<form class="form" method="post">
  <div class="form-group row">
    <label class="col-2" for="">Nome:</label>
    <div class="col-10">
      <input type="text" name="" value="" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-2" for="">Placa:</label>
    <div class="col-10">
      <input type="text" name="" value="" class="form-control">
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

<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
