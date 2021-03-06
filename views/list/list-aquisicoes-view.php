<?php
if (!defined('ABSPATH')) exit;

$aquisicoes = AquisicaoDao::getAquisicoes();

$url_adicionar = HOME_URI . 'register/aquisicao';
$url_editar = HOME_URI . 'edit/aquisicao/';
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
    <th>Veículo</th><th>Secretaria</th><th>Data</th><th>Peça :: QTD</th><th>Opções</th>
  </tr>
  <?php foreach ($aquisicoes as $c): ?>
    <tr>
      <td>
        <?php
          $evento = EventoDao::getPorId($c->getEventoId());
          $veiculo = VeiculoDao::getPorId($evento->getIdVeiculo());
        ?>
        <?= $veiculo->getNome(); ?>
      </td>
      <td>
        <?php
          $secretaria = SecretariaDao::getPorId($evento->getSecretaria());
        ?>
        <?= $secretaria->getNome(); ?>
      </td>
      <td>
        <?= data_para_mostrar($c->getData()) ?>
      </td>
      <td>
        <ul class="list-group">
          <?php foreach ($c->getItens() as $item): ?>
            <li class="list-group-item"><?= $item->getPeca(); ?> :: <?= $item->getQtd(); ?></li>
          <?php endforeach; ?>
        </ul>
      </td>
      <td>
        <a href="<?= $url_remover . $c->getId(); ?>" class="btn btn-outline-danger" title="Excluir"><i class="fas fa-minus-circle"></i></a>
        <a href="<?= $url_editar . $c->getId(); ?>" class="btn btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
