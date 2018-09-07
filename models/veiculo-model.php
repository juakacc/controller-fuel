<?php

class VeiculoModel extends MainModel {

  public function validar_form_adicionar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }
      // Nome e placa
      if (empty($this->form_msg)) {
        $veiculo = new Veiculo($this->form_data['nome'], $this->form_data['placa']);
        VeiculoDao::adicionarVeiculo($veiculo);
        echo 'Gravado com sucesso';
      }
    }
  }
}
