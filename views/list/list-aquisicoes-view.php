<?php
if (!defined('ABSPATH')) exit;

$aquisicoes = AquisicaoDao::getAquisicoes();

$url_adicionar = HOME_URI . 'register/aquisicao';
$url_editar = HOME_URI . 'edita/aquisicao/';
$url_remover = HOME_URI . 'remove/aquisicao/';

require_once ABSPATH . '/views/_includes/header.php';
?>

<div class="row">
  <div class="col">
    <h3>Listagem de aquisições</h3>
  </div>
</div>

<div class="row">
  <div class="col">
    <a href="<?= HOME_URI ?>" class="btn btn-secondary"><i class="fas fa-reply"></i> Voltar</a>
  </div>
  <div class="col">
    <a href="<?= HOME_URI ?>register/aquisicao" class="btn btn-dark"><i class="fas fa-plus"></i> Aquisição</a>
  </div>
</div>

<table class="table mt-2">
  <tr>
    <th>ID</th><th>Veículo</th><th>Data</th><th>Peça</th><th>Opções</th>
  </tr>
  <?php foreach ($aquisicoes as $c): ?>
    <tr>
      <td>#<?= $c->getId(); ?></td>

      <td>
        <?php
          $comp = CompetenciaDao::getPorId($c->getCompId());
          $veiculo = VeiculoDao::getPorId($comp->getIdVeiculo());
        ?>
        <?= $veiculo->getNome(); ?>
      </td>
      <td>
        <?= data_para_mostrar($c->getData()) ?>
      </td>
      <td>
        <ul>
          <?php foreach ($c->getItens() as $item): ?>
            <li><?= $item->getPeca(); ?> : <?= $item->getQtd(); ?></li>
          <?php endforeach; ?>
        </ul>
      </td>
      <td>
        <a href="<?= $url_remover . $c->getId(); ?>"><i class="fas fa-minus-circle"></i> Excluir</a><br>
        <a href="<?= $url_editar . $c->getId(); ?>">Editar</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
