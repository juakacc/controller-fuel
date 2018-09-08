<?php
if (!defined('ABSPATH')) exit;

$veiculos = VeiculoDao::getVeiculos();
require_once ABSPATH . '/views/_includes/header.php';
?>

<div class="row justify-content-center">
  <div class="col-8">
    <h3>Listagem de veículos</h3>
    <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-secondary">Voltar</a>

    <table class="table mt-2">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Placa</th>
      </tr>
      <?php foreach ($veiculos as $v): ?>
        <tr>
          <td><?= $v->getId(); ?></td>
          <td><?= $v->getNome(); ?></td>
          <td><?= $v->getPlaca(); ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
