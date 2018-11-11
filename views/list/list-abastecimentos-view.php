<?php
if (!defined('ABSPATH')) exit;

$abastecimentos = AbastecimentoDao::getAbastecimentos();
require_once ABSPATH . '/views/_includes/header.php';

$url_adicionar = HOME_URI . 'register/abastecimento';
$url_remover = HOME_URI . 'remove/abastecimento/';
$url_editar = HOME_URI . 'edit/abastecimento/';
?>

<div class="row">
  <div class="col">
    <h3>Listagem de abastecimentos</h3>
  </div>
</div>

<div class="row">
  <div class="col">
    <a href="<?= HOME_URI ?>" class="btn btn-secondary"><i class="fas fa-reply"></i> Voltar</a>
  </div>
  <div class="col">
    <a href="<?= HOME_URI ?>register/abastecimento" class="btn btn-dark"><i class="fas fa-plus"></i> Abastecimento</a>
  </div>
</div>

<table class="table mt-2">
  <tr>
    <th>Carro</th><th>Secretaria</th><th>Data</th><th>Combustível</th><th>Quantidade</th><th>Opções</th>
  </tr>
  <?php foreach ($abastecimentos as $a): ?>
    <tr>
      <td>
        <?php
          $evento = EventoDao::getPorId($a->getEventoId());
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
        <?= data_para_mostrar($a->getData()); ?>
      </td>
      <td>
        <?= $a->getCombustivel(); ?>
      </td>
      <td>
        <?= metrica_para_mostrar($a->getQtd()) . ' L'; ?>
      </td>
      <td>
        <a href="<?= $url_remover . $a->getId(); ?>" class="btn btn-outline-danger" title="Excluir"><i class="fas fa-minus-circle"></i></a>
        <a href="<?= $url_editar . $a->getId(); ?>" class="btn btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
