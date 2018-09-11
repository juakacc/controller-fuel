<?php
if (!defined('ABSPATH')) exit;

$abastecimentos = AbastecimentoDao::getAbastecimentos();
require_once ABSPATH . '/views/_includes/header.php';

$url_adicionar = HOME_URI . 'register/abastecimento';
$url_remover = HOME_URI . 'remove/abastecimento/';
$url_editar = HOME_URI . 'edita/abastecimento/';
?>

<div class="row">
  <div class="col">
    <h3>Listagem de abastecimentos</h3>
  </div>
</div>

<div class="row">
  <div class="col">
    <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-secondary">Voltar</a>
  </div>
  <div class="col">
    <a href="<?= HOME_URI ?>register/abastecimento" class="btn btn-dark">Adicionar abastecimento</a>
  </div>
</div>

<table class="table mt-2">
  <tr>
    <th>ID</th><th>Carro</th><th>Data</th><th>Combustível</th><th>Quantidade (litros)</th><th>Opções</th>
  </tr>
  <?php foreach ($abastecimentos as $a): ?>
    <tr>
      <td>
        #<?= $a->getId(); ?>
      </td>
      <td>
        <?php
          $comp = CompetenciaDao::getPorId($a->getCompId());
          $veiculo = VeiculoDao::getPorId($comp->getIdVeiculo());
        ?>
        <?= $veiculo->getNome(); ?>
      </td>
      <td>
        <?= data_para_mostrar($a->getData()); ?>
      </td>
      <td>
        <?= $a->getCombustivel(); ?>
      </td>
      <td>
        <?= $a->getQtd(); ?>
      </td>
      <td>
        <a href="<?= $url_remover . $a->getId(); ?>">Excluir</a><br>
        <a href="<?= $url_editar . $a->getId(); ?>">Editar</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
