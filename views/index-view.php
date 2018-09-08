<?php include_once ABSPATH . '/views/_includes/header.php' ?>

<div class="row">
  <div class="col">
    <p>O que deseja fazer?</p>

    <ul>
      <li><a href="<?= HOME_URI . 'register/veiculo'; ?>">Registrar Veículo</a></li>
      <li><a href="<?= HOME_URI . 'register/competencia'; ?>">Registrar Competência</a></li>
      <li><a href="<?= HOME_URI . 'register/abastecimento'; ?>">Registrar Abastecimento</a></li>
      <li><a href="<?= HOME_URI . 'register/conserto'; ?>">Registrar Conserto</a></li>
      <li><a href="<?= HOME_URI . 'register/aquisicao'; ?>">Registrar Aquisição</a></li>
    </ul>

    <ul>
      <li><a href="<?= HOME_URI . 'list/veiculos'; ?>">Listar Veículos</a></li>
      <li><a href="<?= HOME_URI . 'list/competencias'; ?>">Listar Competências</a></li>
      <li><a href="<?= HOME_URI . 'list/abastecimentos'; ?>">Listar Abastecimentos</a></li>
      <li><a href="<?= HOME_URI . 'list/consertos'; ?>">Listar Consertos</a></li>
    </ul>

  </div>
</div>
<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
