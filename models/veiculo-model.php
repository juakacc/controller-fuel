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
        if (! validar_placa($this->form_data['placa'])) {
          $this->form_msg['placa'] = 'Digite uma placa válida';
        } else {
          $this->form_data['placa'] = strtoupper($this->form_data['placa']);
          // Verifica se a placa já está cadastrada
          if (VeiculoDao::getPorPlaca($this->form_data['placa'])) {
            $this->form_msg['placa'] = 'Placa já cadastrada';
          }
        }
      }

      if (empty($this->form_msg)) {
        $veiculo = new Veiculo($this->form_data['nome'], $this->form_data['placa'],
          $this->form_data['tipo_metrica'], $this->form_data['combustivel']);
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

  public function validar_form_editar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && ! empty($_POST)) {
      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }
      // verificar nome
      if (strlen($this->form_data['nome']) == 0) {
        $this->form_msg['nome'] = 'Digite um nome para o veículo';
      }

      if (! check_array($this->form_data, 'sem_placa')) {
        if (! validar_placa($this->form_data['placa'])) {
          $this->form_msg['placa'] = 'Digite uma placa válida';
        } else {
          $this->form_data['placa'] = strtoupper($this->form_data['placa']);
          // Verifica se a placa já está cadastrada
          if (VeiculoDao::getPorPlacaEdit($this->form_data['placa'], $this->form_data['id'])) {
            $this->form_msg['placa'] = 'Essa placa já pertence a outro carro';
          }
        }
      } else {
        $this->form_data['placa'] = '';
      }

      if (empty($this->form_msg)) {
        $veiculo = new Veiculo($this->form_data['nome'], $this->form_data['placa'],
          '', $this->form_data['combustivel']);
        $veiculo->setId($this->form_data['id']);

        VeiculoDao::editarVeiculo($veiculo);
        $_SESSION['messages'][] = 'Veículo editado com sucesso';
        header('Location: ' . HOME_URI . 'list/veiculos');
        exit;
      }
    } else {
      $veiculo = $veiculo = VeiculoDao::getPorId(check_array($this->controller->parameters, 0));
      $this->form_data = array(
        'id'           => $veiculo->getId(),
        'nome'         => $veiculo->getNome(),
        'tipo_metrica' => $veiculo->getTipoMetrica(),
        'combustivel'  => $veiculo->getCombustivelPadrao(),
        'sem_placa'    => ! $veiculo->tem_placa(),
        'placa'        => $veiculo->getPlaca()
      );
    }
  }
}
