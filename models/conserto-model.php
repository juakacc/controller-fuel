<?php

class ConsertoModel extends MainModel {

  public function validar_form_adicionar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }

      if (! validar_data($this->form_data['data'])) {
        $this->form_msg['data'] = 'Data inválida';
      }

      if (strlen($this->form_data['servico']) == 0) {
        $this->form_msg['servico'] = 'Informe algum conserto';
      }

      if (empty($this->form_msg)) {
        $conserto = new Conserto($this->form_data['servico'],
          $this->form_data['data'], $this->form_data['evento']);
        ConsertoDao::adicionarConserto($conserto);
        $_SESSION['messages'][] = 'Conserto cadastrado com sucesso';
        header('Location: ' . HOME_URI . 'list/consertos');
        exit;
      }
    } else { // GET - caso já venha com o evento definido
      $id = check_array($this->controller->parameters, 0);
      if (is_numeric($id)) {
        $this->form_data['evento'] = $id;
        $evento = EventoDao::getPorId($id);
        $this->form_data['veiculo'] = $evento->getIdVeiculo();
      }
    }
  }

  public function validar_form_remover() {
    $this->form_data = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      ConsertoDao::removerConserto($this->controller->parameters[0]);
      $_SESSION['messages'][] = 'Conserto removido com sucesso';
      header('Location: ' . HOME_URI . 'list/consertos');
      exit;
    }
  }

}
