<?php include_once ABSPATH . '/views/_includes/header.php' ?>

<div class="row">
  <div class="col">
    <h3>Registro de abastecimento</h3>

    <form class="form" method="post">
      <div class="form-group row">
        <label for="" class="label-form col-2">Veículo:</label>
        <div class="col-10">
          <select class="form-control" name="">
            <option value="">Carro1</option>
            <option value="">Carro2</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="label-form col-2">Combustível:</label>
        <div class="col-10">
          <select class="form-control" name="">
            <option value="gasolina">Gasolina</option>
            <option value="diesel">Diesel</option>
            <option value="alcool">Álcool</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="label-form col-2">Data:</label>
        <div class="col-10">
          <input type="text" name="" value="" class="form-control" placeholder="dd/mm/aaaa">
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="label-form col-2">Quantidade:</label>
        <div class="col-10">
          <input type="text" name="" value="" class="form-control" placeholder="Litros">
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
