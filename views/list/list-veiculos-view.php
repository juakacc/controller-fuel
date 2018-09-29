<?php
if (!defined('ABSPATH')) exit;

$veiculos = VeiculoDao::getVeiculos();
require_once ABSPATH . '/views/_includes/header.php';

$url_registrar = HOME_URI . 'register/veiculo';
$url_editar = HOME_URI . 'edita/veiculo/';
$url_remover = HOME_URI . 'remove/veiculo/';
?>

<div class="row">
  <div class="col">
    <h3>Listagem de veículos</h3>
  </div>
</div>

<div class="row">
  <div class="col">
    <a href="<?= HOME_URI ?>" class="btn btn-secondary"><i class="fas fa-reply"></i> Voltar</a>
  </div>
  <div class="col">
    <a href="<?= $url_registrar; ?>" class="btn btn-dark"><i class="fas fa-plus"></i> Veículo</a>
  </div>
</div>

<table class="table mt-2">
  <tr>
    <th>ID</th><th>Nome</th><th>Placa</th><th>Chassi</th><th>Opções</th>
  </tr>
  <?php foreach ($veiculos as $v): ?>
    <tr>
      <td>#<?= $v->getId(); ?></td>
      <td><a href="<?php echo HOME_URI . 'detail/veiculo/' . $v->getId(); ?>"><?= $v->getNome(); ?></a></td>
      <td><?= mostrar_placa($v->getPlacaMostrar()); ?></td>
      <td><?= $v->getChassi(); ?></td>
      <td>
        <a href="<?= $url_remover . $v->getId(); ?>" class="btn btn-outline-danger"><i class="fas fa-minus-circle"></i> Excluir</a>
        <a href="<?= $url_editar . $v->getId(); ?>" class="btn btn-outline-warning"><i class="fas fa-pencil-alt"></i> Editar</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
