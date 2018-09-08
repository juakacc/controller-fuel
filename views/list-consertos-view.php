<?php
if (!defined('ABSPATH')) exit;

$consertos = ConsertoDao::getConsertos();
require_once ABSPATH . '/views/_includes/header.php';
?>

<div class="row justify-content-center">
  <div class="col-8">
    <h3>Listagem de consertos</h3>
    <a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="btn btn-secondary">Voltar</a>

    <table class="table mt-2">
      <tr>
        <th>ID</th>
        <th>Veículo</th>
        <th>Data</th>
        <th>Serviço</th>
      </tr>
      <?php foreach ($consertos as $c): ?>
        <tr>
          <td><?= $c->getId(); ?></td>

          <td>
            <?php
              $comp = CompetenciaDao::getPorId($c->getCompId());
              $veiculo = VeiculoDao::getPorId($comp->getIdVeiculo());
            ?>
            <?= $veiculo->getNome(); ?>
          </td>
          <td>
            <?= $c->getData(); ?>
          </td>
          <td>
            <?= $c->getServico(); ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
