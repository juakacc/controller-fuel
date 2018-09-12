<?php
if (!defined('ABSPATH')) exit;

$competencias = CompetenciaDao::getCompetencias();
require_once ABSPATH . '/views/_includes/header.php';

$url_adicionar = HOME_URI . 'register/competencia';
$url_editar = HOME_URI . 'edita/competencia/';
$url_remover = HOME_URI . 'remove/competencia/';
?>

<div class="row">
  <div class="col">
    <h3>Listagem de competências</h3>
  </div>
</div>

<div class="row">
  <div class="col">
    <a href="<?= HOME_URI ?>" class="btn btn-secondary">Voltar</a>
  </div>
  <div class="col">
    <a href="<?= HOME_URI ?>register/competencia" class="btn btn-dark">Adicionar competência</a>
  </div>
</div>

<table class="table mt-2">
  <tr>
    <th>ID</th><th>Veículo</th><th>Referência</th><th>KM inicial</th><th>Opções</th>
  </tr>
  <?php foreach ($competencias as $c): ?>
    <tr>
      <td>
        #<?= $c->getId(); ?>
      </td>
      <td>
        <?php $veiculo = VeiculoDao::getPorId($c->getIdVeiculo()); ?>
        <?= $veiculo->getNome(); ?>
      </td>
      <td>
        <?= $c->getReferencia(); ?>
      </td>
      <td>
        <?= $c->getMetricaInicial(); ?>
      </td>
      <td>
        <a href="<?= $url_remover . $c->getId(); ?>">Excluir</a><br>
        <a href="<?= $url_editar . $c->getId(); ?>">Editar</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
