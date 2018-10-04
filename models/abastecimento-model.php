<?php

class AbastecimentoModel extends MainModel {

  public function validar_form_adicionar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }

      if (! isset($this->form_data['evento'])) {
        $this->form_msg['evento'] = 'Nenhum evento selecionado';
      } else {
        if (AbastecimentoDao::getPorEvento($this->form_data['evento'])) {
          $this->form_msg['evento'] = 'Esse evento já tem um abastecimento cadastrado';
        } else {
          $this->form_data['data'] = EventoDao::getPorId($this->form_data['evento'])->getData();
        }
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

  public function validar_form_editar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }

      $this->form_data['qtd'] = litros_para_banco($this->form_data['qtd']);

      if (! is_numeric($this->form_data['qtd'])) {
        $this->form_data['qtd'] = '';
        $this->form_msg['qtd'] = 'Quantidade inválida';
      }

      if (empty($this->form_msg)) {
        $abastecimento = new Abastecimento($this->form_data['combustivel'], $this->form_data['qtd'],'', 1);
        $abastecimento->setId($this->form_data['id']);

        AbastecimentoDao::editarAbastecimento($abastecimento);
        $_SESSION['messages'][] = 'Abastecimento editado com sucesso';
        header('Location: ' . HOME_URI . 'list/abastecimentos');
        exit;
      }
    } else { // abastecimento para editar
      $abastecimento = AbastecimentoDao::getPorId(check_array($this->controller->parameters, 0));
      $evento = EventoDao::getPorId($abastecimento->getEventoId());
      $veiculo = VeiculoDao::getPorId($evento->getIdVeiculo());

      $this->form_data = array(
        'id' => $abastecimento->getId(),
        'veiculo' => $veiculo->getNome(),
        'evento' => $evento->getNome(),
        'combustivel' => $abastecimento->getCombustivel(),
        'qtd' => $abastecimento->getQtd()
      );
    }
  }
}
