<?php
if (! defined('ABSPATH')) exit;

$competencias = CompetenciaDao::getPorVeiculo($veiculo->getId());
$url_filtrar = HOME_URI . 'detail/veiculo/' . $veiculo->getId() . '/';

$comp_id = check_array($this->parameters, 1);

if ($comp_id) {
  $abastecimentos = AbastecimentoDao::getPorCompetencia($comp_id);
  $consertos = ConsertoDao::getPorCompetencia($comp_id);
  $competencia = CompetenciaDao::getPorId($comp_id);
} else {
  $abastecimentos = array();
  $consertos = array();
}

require_once ABSPATH . '/views/_includes/header.php';
?>

<div class="row">
  <div class="col">
    <h3>Detalhes do veículo <?= $veiculo->getNome() ?></h3>
  </div>
</div>

<div class="row">
  <div class="col">
    <p>Placa: <?= $veiculo->getPlaca() ?></p>
  </div>
  <div class="">
    <?php if (isset($competencia)): ?>
      <p>Competência: <?= $competencia->getReferencia() ?></p>
    <?php endif; ?>
  </div>
</div>

<div class="row">
  <div class="col">
    <a href="<?= HOME_URI . 'list/veiculos'  ?>" class="btn btn-secondary">Voltar</a>
  </div>

  <div class="col" align="right">
    <div class="dropdown">Selecione uma
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Competência
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <?php foreach ($competencias as $c): ?>
          <a class="dropdown-item" href="<?= $url_filtrar . $c->getId() ?>"><?= $c->getReferencia() ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
    <h4>Abastecimentos realizados</h4>
    <table class="table">
      <tr>
        <th>Data</th>
        <th>Combustível</th>
        <th>Quantidade (litros)</th>
      </tr>
      <?php foreach ($abastecimentos as $a): ?>
        <tr>
          <td><?= data_para_mostrar($a->getData()) ?></td>
          <td><?= $a->getCombustivel() ?></td>
          <td><?= $a->getQtd() ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>

<div class="row">
  <div class="col">
    <h4>Consertos realizados</h4>
    <table class="table">
      <tr>
        <th>Data</th>
        <th>Serviço</th>
      </tr>
      <?php foreach ($consertos as $a): ?>
        <tr>
          <td><?= data_para_mostrar($a->getData()) ?></td>
          <td><?= $a->getServico() ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
