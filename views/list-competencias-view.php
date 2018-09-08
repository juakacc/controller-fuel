<?php
if (!defined('ABSPATH')) exit;

$competencias = CompetenciaDao::getCompetencias();
require_once ABSPATH . '/views/_includes/header.php';
?>

<div class="row justify-content-center">
  <div class="col-8">
    <h3>Listagem de competências</h3>
    <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-secondary">Voltar</a>

    <table class="table mt-2">
      <tr>
        <th>ID</th>
        <th>Veículo</th>
        <th>Referência</th>
        <th>KM inicial</th>
      </tr>
      <?php foreach ($competencias as $c): ?>
        <tr>
          <td>
            <?= $c->getId(); ?>
          </td>
          <td>
            <?php $veiculo = VeiculoDao::getPorId($c->getIdVeiculo()); ?>
            <?= $veiculo->getNome(); ?>
          </td>
          <td>
            <?= $c->getReferencia(); ?>
          </td>
          <td>
            <?= $c->getKmInicial(); ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
