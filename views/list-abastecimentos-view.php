<?php
if (!defined('ABSPATH')) exit;

$abastecimentos = AbastecimentoDao::getAbastecimentos();
require_once ABSPATH . '/views/_includes/header.php';
?>

<div class="row justify-content-center">
  <div class="col-8">
    <h3>Listagem de abastecimentos</h3>
    <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-secondary">Voltar</a>

    <table class="table mt-2">
      <tr>
        <th>ID</th><th>Carro</th><th>Data</th><th>Combustível</th><th>Quantidade (litros)</th>
      </tr>
      <?php foreach ($abastecimentos as $a): ?>
        <tr>
          <td>
            <?= $a->getId(); ?>
          </td>
          <td>
            <?php
              $comp = CompetenciaDao::getPorId($a->getCompId());
              $veiculo = VeiculoDao::getPorId($comp->getIdVeiculo());
            ?>
            <?= $veiculo->getNome(); ?>
          </td>
          <td>
            <?= $a->getData(); ?>
          </td>
          <td>
            <?= $a->getCombustivel(); ?>
          </td>
          <td>
            <?= $a->getQtd(); ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
