<?php

class RemoveController extends MainController {

  public function veiculo() {

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

  public function competencia() {

    $model = $this->load_model('competencia-model');

    $id = check_array($this->parameters, 0);
    if(! is_numeric($id)) {
      header('Location: ' . HOME_URI . 'list/competencias');
      exit;
    }

    $competencia = CompetenciaDao::getPorId($id);
    if (! $competencia) {
      header('Location: ' . HOME_URI . 'list/competencias');
      exit;
    }
    require_once ABSPATH . '/views/remove/remove-competencia-view.php';
  }

  public function abastecimento() {

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
}