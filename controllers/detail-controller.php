<?php

class DetailController extends MainController {

  public function veiculo() {
    $model = $this->load_model('veiculo-model');

    $id_veiculo = check_array($this->parameters, 0);

    if (! is_numeric($id_veiculo)) {
      header('Location: ' . HOME_URI . 'page-not-found');
      exit;
    }

    $veiculo = VeiculoDao::getPorId($id_veiculo);
    if (! $veiculo) {
      header('Location: ' . HOME_URI . 'list/veiculos');
      exit;
    }
    require_once ABSPATH . '/views/detail/detail-veiculo-view.php';
  }

  public function abastecimento() {
    $id_abastecimento = check_array($this->parameters, 0);

    if (!is_numeric($id_abastecimento)) {
      header('Location: ' . HOME_URI . 'page-not-found');
      exit;
    }
    $abastecimento = AbastecimentoDao::getPorId($id_abastecimento);
    if (! $abastecimento) {
      header('Location: ' . HOME_URI . 'page-not-found');
      exit;
    }
    // Verificar página
    require_once ABSPATH . '/views/detail/detail-abastecimento-view.php';
  }

  public function conserto() {

  }

  public function aquisicao() {

  }

  public function evento() {
    
  }
}
