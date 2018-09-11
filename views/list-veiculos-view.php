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
    <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-secondary">Voltar</a>
  </div>
  <div class="col">
    <a href="<?= $url_registrar; ?>" class="btn btn-dark">Adicionar veículo</a>
  </div>
</div>

<table class="table mt-2">
  <tr>
    <th>ID</th><th>Nome</th><th>Placa</th><th>Opções</th>
  </tr>
  <?php foreach ($veiculos as $v): ?>
    <tr>
      <td>#<?= $v->getId(); ?></td>
      <td><a href="<?php echo HOME_URI . 'detail/veiculo/' . $v->getId(); ?>"><?= $v->getNome(); ?></a></td>
      <td><?= $v->getPlaca(); ?></td>
      <td>
        <a href="<?= $url_remover . $v->getId(); ?>">Excluir</a><br>
        <a href="<?= $url_editar . $v->getId(); ?>">Editar</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
