<?php

class EventoModel extends MainModel {

  public function validar_form_adicionar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }

      // if (CompetenciaDao::getPorVeiculoData($this->form_data['veiculo'],
      //     $this->form_data['mes'], $this->form_data['ano'])) {
      //   $this->form_msg['veiculo'] = 'Competência já registrada';
      // }

      $this->form_data['metrica_inicial'] = str_replace('.', '', $this->form_data['metrica_inicial']);
      $this->form_data['metrica_inicial'] = str_replace(':', '', $this->form_data['metrica_inicial']);

      if (! is_numeric($this->form_data['metrica_inicial'])) {
        $this->form_data['metrica_inicial'] = '';
        $this->form_msg['metrica_inicial'] = 'Quilometragem/Horário inválido';
      }

      if (empty($this->form_msg)) {
        $evento = new Evento($this->form_data['veiculo'], $this->form_data['nome'],
          $this->form_data['data'], $this->form_data['metrica_inicial']);
        EventoDao::adicionarEvento($evento);
        $_SESSION['messages'][] = 'Evento cadastrado com sucesso';
        header('Location: ' . HOME_URI . 'list/eventos');
        exit;
      }
    } else {

      if (is_numeric($this->controller->parameters[0]) && is_numeric($this->controller->parameters[1])
        && is_numeric($this->controller->parameters[2])) {
        $this->form_data['mes'] = $this->controller->parameters[0];
        $this->form_data['ano'] = $this->controller->parameters[1];
        $this->form_data['veiculo'] = $this->controller->parameters[2];
      }
    }
  }

  public function validar_form_remover() {
    $this->form_data = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      EventoDao::removerEvento($this->controller->parameters[0]);
      $_SESSION['messages'][] = 'Evento removido com sucesso';
      header('Location: ' . HOME_URI . 'list/eventos');
      exit;
    }
  }
}
