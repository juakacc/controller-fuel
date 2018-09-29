<?php
if (!defined('ABSPATH')) exit;

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$r = EventoDao::getEventosPaginate($page);
$eventos = $r['eventos'];
$total_de_pages = $r['total_de_paginas'];

$q = check_array($_GET, 'q');
if ($q) {
  // $eompetencias = CompetenciaDao::getComFiltro(check_array($_GET, 'tipo_filtro'), $q);
} else { // Não filtrou

}

require_once ABSPATH . '/views/_includes/header.php';

$url_adicionar = HOME_URI . 'register/evento';
$url_editar = HOME_URI . 'edita/evento/';
$url_remover = HOME_URI . 'remove/evento/';

$url_registerAbastecimento = HOME_URI . 'register/abastecimento/';
$url_registerConserto = HOME_URI . 'register/conserto/';
$url_registerAquisicao = HOME_URI . 'register/aquisicao/';
?>

<div class="row">
  <div class="col">
    <h3>Listagem de Eventos</h3>
  </div>
</div>

<div class="row">
  <div class="col">
    <a href="<?= HOME_URI ?>" class="btn btn-secondary"><i class="fas fa-reply"></i> Voltar</a>
  </div>
  <div class="col">
    <a href="<?= HOME_URI ?>register/evento" class="btn btn-dark"><i class="fas fa-plus"></i> Evento</a>
  </div>
</div>

<!-- <div class="row mt-2">
  <div class="col">
    <form class="form-inline">
      <label class="my-1 mr-2" for="tipo-filtro">Filtrar por</label>
      <select class="custom-select my-1 mr-sm-2" id="tipo-filtro" name="tipo_filtro" onchange="alterarFiltro()">
        <option value="1" <?php if (check_array($_GET, 'tipo_filtro') == 1): ?>selected<?php endif; ?>>Veículo</option>
        <option value="2" <?php if (check_array($_GET, 'tipo_filtro') == 2): ?>selected<?php endif; ?>>Competência</option>
        <option value="3" <?php if (check_array($_GET, 'tipo_filtro') == 3): ?>selected<?php endif; ?>>Métrica</option>
      </select>
      <input type="text" name="q" id="q" placeholder="" class="form-control my-1 mr-sm-2" value="<?= check_array($_GET, 'q') ?>">
      <button type="submit" class="btn btn-primary my-1"><i class="fas fa-search"></i></button>
      <a href="<?= HOME_URI ?>list/competencias" class="btn btn-primary ml-2">Mostrar tudo</a>
    </form>
  </div>
</div> -->

<table class="table mt-2">
  <tr>
    <th></th><th>Nome</th><th>Veículo</th><th>Data</th><th>Métrica inicial</th><th>Opções</th>
  </tr>
  <?php foreach ($eventos as $e): ?>
    <tr> <!-- Dados da competencia -->
      <td> <!-- btn para mostrar/ocultar -->
        <a href="javascript:;" id="bt<?= $e->getId(); ?>" onclick="mostrar(<?= $e->getId(); ?>)" class="btn btn-outline-info" title="Expandir">
          <i id="ic<?= $e->getId(); ?>" class="fas fa-plus"></i>
        </a>
      </td>

      <td>
        <?= $e->getNome(); ?>
      </td>

      <td> <!-- veículo para detalhes -->
        <?php $veiculo = VeiculoDao::getPorId($e->getIdVeiculo()); ?>
        <a href="<?php echo HOME_URI . 'detail/veiculo/' . $veiculo->getId(); ?>"><?= $veiculo->getNome(); ?></a>
      </td>

      <td>
        <?= data_para_mostrar($e->getData()); ?>
      </td>

      <td>
        <?= $e->getMetricaInicial() . ' ' . $veiculo->getTipoMetrica() ?>
      </td>

      <td>
        <div>
          <a href="<?= $url_remover . $e->getId(); ?>" class="btn btn-outline-danger" title="Excluir"><i class="fas fa-minus-circle"></i></a>
          <a href="<?= $url_editar . $e->getId(); ?>" class="btn btn-outline-warning" title="Editar"><i class="fas fa-pencil-alt"></i></a>
        </div>
      </td>
    </tr>

    <div>
      <tr class="sub" id="div<?= $e->getId(); ?>"> <!-- Abastecimentos, consertos e aquisições da competencia -->
        <?php $abastecimentos = AbastecimentoDao::getPorEvento($e->getId()); ?>
        <?php $consertos = ConsertoDao::getPorEvento($e->getId()); ?>
        <?php $aquisicoes = AquisicaoDao::getPorEvento($e->getId()); ?>
        <td></td>
        <td colspan="5">
          <table class="table table-bordered">
            <tr> <!-- Combustíveis -->
              <td>Combustível</td>
              <td>
                <ul class="list-unstyled">
                  <?php foreach ($abastecimentos as $x): ?>
                    <li><a href="<?= HOME_URI . 'detail/abastecimento/' . $x->getId(); ?>"><?= $x->getQtd() . ' L'; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </td>
              <td>
                <?php if (empty($abastecimentos)): ?>
                  <a href="<?= $url_registerAbastecimento . $e->getId(); ?>" class="btn btn-dark"><i class="fas fa-plus"></i> Abastecimento</a>
                <?php endif; ?>
              </td>
            </tr>

            <tr> <!-- Serviços -->
              <td>Serviços</td>
              <td>
                <ul class="list-unstyled">
                  <?php foreach ($consertos as $x): ?>
                    <li><a href=""><?= $x->getServico(); ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </td>
              <td>
                <?php if (empty($consertos)): ?>
                  <a href="<?= $url_registerConserto . $e->getId(); ?>" class="btn btn-dark"><i class="fas fa-plus"></i> Conserto</a>
                <?php endif; ?>
              </td>
            </tr>

            <tr> <!-- Aquisiçoes -->
              <td>Aquisições</td>
              <td>
                <ul class="list-unstyled">
                  <?php foreach ($aquisicoes as $x): ?>
                    <?php foreach ($x->getItens() as $_): ?>
                      <li><?= $_->getPeca(); ?> :: <?= $_->getQtd(); ?></li>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                </ul>
              </td>
              <td>
                <?php if (empty($aquisicoes)): ?>
                  <a href="<?= $url_registerAquisicao . $e->getId(); ?>" class="btn btn-dark"><i class="fas fa-plus"></i> Aquisição</a>
                <?php endif; ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </div>
  <?php endforeach; ?>
</table>

<?php include_once ABSPATH . '/views/_includes/list_paginate.php'; ?>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
<script type="text/javascript" src="<?= HOME_URI ?>views/_js/list-competencias.js"></script>
