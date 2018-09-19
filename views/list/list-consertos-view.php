<?php
if (!defined('ABSPATH')) exit;

$consertos = ConsertoDao::getConsertos();
require_once ABSPATH . '/views/_includes/header.php';

$url_adicionar = HOME_URI . 'register/conserto';
$url_editar = HOME_URI . 'edita/conserto/';
$url_remover = HOME_URI . 'remove/conserto/';
?>

<div class="row">
  <div class="col">
    <h3>Listagem de consertos</h3>
  </div>
</div>

<div class="row">
  <div class="col">
    <a href="<?= HOME_URI ?>" class="btn btn-secondary"><i class="fas fa-reply"></i> Voltar</a>
  </div>
  <div class="col">
    <a href="<?= HOME_URI ?>register/conserto" class="btn btn-dark"><i class="fas fa-plus"></i> Conserto</a>
  </div>
</div>

<table class="table mt-2">
  <tr>
    <th>ID</th><th>Veículo</th><th>Data</th><th>Serviço</th><th>Opções</th>
  </tr>
  <?php foreach ($consertos as $c): ?>
    <tr>
      <td>#<?= $c->getId(); ?></td>

      <td>
        <?php
          $evento = EventoDao::getPorId($c->getEventoId());
          $veiculo = VeiculoDao::getPorId($evento->getIdVeiculo());
        ?>
        <?= $veiculo->getNome(); ?>
      </td>
      <td>
        <?= data_para_mostrar($c->getData()) ?>
      </td>
      <td>
        <?= $c->getServico(); ?>
      </td>
      <td>
        <a href="<?= $url_remover . $c->getId(); ?>" class="btn btn-outline-danger" title="Excluir"><i class="fas fa-minus-circle"></i></a>
        <a href="<?= $url_editar . $c->getId(); ?>" class="btn btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
