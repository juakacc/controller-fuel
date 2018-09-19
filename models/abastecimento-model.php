<?php

class AbastecimentoModel extends MainModel {

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

      $this->form_data['qtd'] = str_replace(',', '.', $this->form_data['qtd']);

      if (! is_numeric($this->form_data['qtd'])) {
        $this->form_data['qtd'] = '';
        $this->form_msg['qtd'] = 'Quantidade inválida';
      }

      if (empty($this->form_msg)) {
        $abastecimento = new Abastecimento($this->form_data['combustivel'], $this->form_data['qtd'],
          $this->form_data['data'], $this->form_data['evento']);

        AbastecimentoDao::adicionarAbastecimento($abastecimento);
        $_SESSION['messages'][] = 'Abastecimento cadastrado com sucesso';
        header('Location: ' . HOME_URI . 'list/abastecimentos');
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
      AbastecimentoDao::removerAbastecimento($this->controller->parameters[0]);
      $_SESSION['messages'][] = 'Abastecimento removido com sucesso';
      header('Location: ' . HOME_URI . 'list/abastecimentos');
      exit;
    }
  }
}
