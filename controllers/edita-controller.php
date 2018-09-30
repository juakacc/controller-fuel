<?php

class EditaController extends MainController {

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
}
