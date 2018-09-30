<?php

class RemoveController extends MainController {

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
    require_once ABSPATH . '/views/remove/remove-veiculo-view.php';
  }

  public function evento() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $model = $this->load_model('evento-model');

    $id = check_array($this->parameters, 0);
    if(! is_numeric($id)) {
      header('Location: ' . HOME_URI . 'list/eventos');
      exit;
    }

    $evento = EventoDao::getPorId($id);
    if (! $evento) {
      header('Location: ' . HOME_URI . 'list/eventos');
      exit;
    }
    require_once ABSPATH . '/views/remove/remove-evento-view.php';
  }

  public function abastecimento() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $model = $this->load_model('abastecimento-model');

    $id = check_array($this->parameters, 0);
    if(! is_numeric($id)) {
      header('Location: ' . HOME_URI . 'list/abastecimentos');
      exit;
    }

    $abastecimento = AbastecimentoDao::getPorId($this->parameters[0]);
    if (! $abastecimento) {
      header('Location: ' . HOME_URI . 'list/abastecimentos');
      exit;
    }
    require_once ABSPATH . '/views/remove/remove-abastecimento-view.php';
  }

  public function conserto() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $model = $this->load_model('conserto-model');

    $id = check_array($this->parameters, 0);
    if(! is_numeric($id)) {
      header('Location: ' . HOME_URI . 'list/consertos');
      exit;
    }

    $conserto = ConsertoDao::getPorId($this->parameters[0]);
    if(! $conserto) {
      header('Location: ' . HOME_URI . 'list/consertos');
      exit;
    }
    require_once ABSPATH . '/views/remove/remove-conserto-view.php';
  }

  public function aquisicao() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $model = $this->load_model('aquisicao-model');

    $id = check_array($this->parameters, 0);
    if(! is_numeric($id)) {
      header('Location: ' . HOME_URI . 'list/aquisicoes');
      exit;
    }

    $aquisicao = AquisicaoDao::getPorId($this->parameters[0]);
    if(! $aquisicao) {
      header('Location: ' . HOME_URI . 'list/aquisicoes');
      exit;
    }
    require_once ABSPATH . '/views/remove/remove-aquisicao-view.php';
  }
}
