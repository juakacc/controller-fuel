<?php

class RemoveController extends MainController {

  public function veiculo() {

    $model = $this->load_model('veiculo-model');

    require_once ABSPATH . '/views/remove/remove-veiculo-view.php';
  }

  public function competencia() {

    $model = $this->load_model('competencia-model');

    require_once ABSPATH . '/views/remove/remove-competencia-view.php';
  }

  public function abastecimento() {

    $model = $this->load_model('abastecimento-model');

    require_once ABSPATH . '/views/remove/remove-abastecimento-view.php';
  }

  public function conserto() {

    $model = $this->load_model('conserto-model');

    require_once ABSPATH . '/views/remove/remove-conserto-view.php';
  }
}
