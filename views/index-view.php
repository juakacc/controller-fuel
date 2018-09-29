<?php
if (!defined('ABSPATH')) exit;

include_once ABSPATH . '/views/_includes/header.php'
?>

<div class="row">
  <div class="col">
    <h3>O que deseja fazer?</h3>
  </div>
</div>

<div class="row">
  <div class="col-7">
    <div class="p-2" style="background-color: #e3f2fd;">
      <h4><i class="fas fa-plus"></i> Registrar</h4>
      <div class="">
        <a href="<?= HOME_URI . 'register/veiculo'; ?>" class="btn btn-secondary"><i class="fas fa-shuttle-van"></i> Veículo</a>
        <a href="<?= HOME_URI . 'register/evento'; ?>" class="btn btn-secondary"><i class="fas fa-calendar-check"></i> Evento</a>
      </div>
    </div>
    <h6 class="mt-2">Acesso rápido</h6>
    <div class="">
      <a href="<?= HOME_URI . 'register/abastecimento'; ?>" class="btn btn-light"><i class="fas fa-oil-can"></i> Abastecimento</a>
      <a href="<?= HOME_URI . 'register/conserto'; ?>" class="btn btn-light"><i class="fas fa-wrench"></i> Conserto</a>
      <a href="<?= HOME_URI . 'register/aquisicao'; ?>" class="btn btn-light"><i class="fas fa-cog"></i> Aquisição</a>
    </div>
  </div>
  <div class="col">
    <h4><i class="fas fa-list-ol"></i> Listagens</h4>
    <div class="btn-group-vertical">
      <a href="<?= HOME_URI . 'list/veiculos'; ?>" class="btn btn-primary"><i class="fas fa-shuttle-van"></i> Veículos</a>
      <a href="<?= HOME_URI . 'list/eventos'; ?>" class="btn btn-primary"><i class="fas fa-calendar-check"></i> Eventos</a>
      <a href="<?= HOME_URI . 'list/abastecimentos'; ?>" class="btn btn-primary"><i class="fas fa-oil-can"></i> Abastecimentos</a>
      <a href="<?= HOME_URI . 'list/consertos'; ?>" class="btn btn-primary"><i class="fas fa-wrench"></i> Consertos</a>
      <a href="<?= HOME_URI . 'list/aquisicoes'; ?>" class="btn btn-primary"><i class="fas fa-cog"></i> Aquisições</a>
    </div>
  </div>
</div>

<?php include_once ABSPATH . '/views/_includes/footer.php' ?>
