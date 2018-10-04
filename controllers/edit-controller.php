<?php

class EditController extends MainController {

  public function veiculo() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $model = $this->load_model('veiculo-model');

    $id = check_array($this->parameters, 0);
    if(! is_numeric($id)) {
      header('Location: ' . HOME_URI . 'list/veiculos');
      exit;
    }

    $veiculo = VeiculoDao::getPorId($id);
    if (! $veiculo) {
      header('Location: ' . HOME_URI . 'list/veiculos');
      exit;
    }
    require_once ABSPATH . '/views/edit/edit-veiculo-view.php';
  }

  public function abastecimento() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $id_abastecimento = check_array($this->parameters, 0);
    if (! is_numeric($id_abastecimento)) {
      header('Location: ' . HOME_URI . 'page-not-found');
      return;
    }
    $abastecimento = AbastecimentoDao::getPorId($id_abastecimento);
    if (! $abastecimento) {
      header('Location: ' . HOME_URI . 'page-not-found');
      return;
    }

    $model = $this->load_model('abastecimento-model');
    require_once ABSPATH . '/views/edit/edit-abastecimento-view.php';
  }

  public function conserto() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $id_conserto = check_array($this->parameters, 0);
    if (! is_numeric($id_conserto)) {
      header('Location: ' . HOME_URI . 'page-not-found');
      return;
    }
    $conserto = ConsertoDao::getPorId($id_conserto);
    if (! $conserto) {
      header('Location: ' . HOME_URI . 'page-not-found');
      return;
    }
    $model = $this->load_model('conserto-model');
    require_once ABSPATH . '/views/edit/edit-conserto-view.php';
  }

  public function aquisicao() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $id_aquisicao = check_array($this->parameters, 0);
    if (! is_numeric($id_aquisicao)) {
      header('Location: ' . HOME_URI . 'page-not-found');
      return;
    }
    $aquisicao = AquisicaoDao::getPorId($id_aquisicao);
    if (! $aquisicao) {
      header('Location: ' . HOME_URI . 'page-not-found');
      return;
    }
    $model = $this->load_model('aquisicao-model');
    require_once ABSPATH . '/views/edit/edit-aquisicao-view.php';
  }
}
