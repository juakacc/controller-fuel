<?php

class EventoModel extends MainModel {

  public function validar_form_adicionar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }

      if (strlen(check_array($this->form_data, 'nome')) == 0) {
        $this->form_msg['nome'] = 'Informe um nome válido';
      }

      if (! validar_data($this->form_data['data'])) {
        $this->form_msg['data'] = 'Data inválida';
      }

      $this->form_data['metrica_inicial'] = metrica_para_banco($this->form_data['metrica_inicial']);

      if (! is_numeric($this->form_data['metrica_inicial'])) {
        $this->form_data['metrica_inicial'] = '';
        $this->form_msg['metrica_inicial'] = 'Quilometragem/Horário inválido';
      } else {
        $last_metrica = EventoDao::getUltimaMetrica($this->form_data['veiculo']);
        if ($this->form_data['metrica_inicial'] < $last_metrica) {
          $this->form_msg['metrica_inicial'] = 'A última métrica registrada foi: ' . $last_metrica;
        }
      }

      if (empty($this->form_msg)) {
        $evento = new Evento($this->form_data['veiculo'], $this->form_data['nome'],
          $this->form_data['data'], $this->form_data['metrica_inicial']);
        EventoDao::adicionarEvento($evento);
        $_SESSION['messages'][] = 'Evento cadastrado com sucesso';
        header('Location: ' . HOME_URI . 'list/eventos');
        exit;
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
