<?php

class VeiculoModel extends MainModel {

  public function validar_form_adicionar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }

      if (strlen($this->form_data['nome']) == 0) {
        $this->form_msg['nome'] = 'Digite um nome para o veículo';
      }

      if (! check_array($this->form_data, 'sem_placa')) {
        if (strlen($this->form_data['placa']) == 0) {
          $this->form_msg['placa'] = 'Digite uma placa válida';
        }
      }

      // Verificar placa já existente

      if (empty($this->form_msg)) {
        $veiculo = new Veiculo($this->form_data['nome'], $this->form_data['placa']);
        VeiculoDao::adicionarVeiculo($veiculo);
        $_SESSION['messages'][] = 'Veículo adicionado com sucesso';
        header('Location: ' . HOME_URI . 'list/veiculos');
        exit;
      }
    }
  }

  public function validar_form_remover() {
    $this->form_data = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      VeiculoDao::removerVeiculo($this->controller->parameters[0]);
      $_SESSION['messages'][] = 'Veículo removido com sucesso';
      header('Location: ' . HOME_URI . 'list/veiculos');
      exit;
    }
  }
}
