<?php

class AquisicaoModel extends MainModel {

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
        if (AquisicaoDao::getPorEvento($this->form_data['evento'])) {
          $this->form_msg['evento'] = 'Esse evento já tem uma aquisição cadastrada';
        } else {
          $this->form_data['data'] = EventoDao::getPorId($this->form_data['evento'])->getData();
        }
      }

      $itens = array();
      $pecas = $this->form_data['peca'];
      $qtds = $this->form_data['qtd'];
      if (!is_array($pecas) || !is_array($qtds))
        $this->form_msg['peca'] = 'erro nas peças';

      for ($i=0; $i < count($pecas); $i++) {
        if (strlen($pecas[$i]) != 0) {
          $itens[] = new Item($pecas[$i], $qtds[$i]);
        }
      }

      if (empty($this->form_msg)) {
        $aquisicao = new Aquisicao($itens, $this->form_data['data'], $this->form_data['evento']);
        AquisicaoDao::adicionarAquisicao($aquisicao);
        $_SESSION['messages'][] = 'Aquisição cadastrada com sucesso';
        header('Location: ' . HOME_URI . 'list/aquisicoes');
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

  public function validar_form_editar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }

      $itens = array();
      $pecas = $this->form_data['peca'];
      $qtds = $this->form_data['qtd'];
      if (!is_array($pecas) || !is_array($qtds))
        $this->form_msg['peca'] = 'erro nas peças';

      for ($i=0; $i < count($pecas); $i++) {
        if (strlen($pecas[$i]) != 0) {
          $itens[] = new Item($pecas[$i], $qtds[$i]);
        }
      }

      if (empty($this->form_msg)) {
        $aquisicao = new Aquisicao($itens, '', 1);
        $aquisicao->setId($this->form_data['id']);
        AquisicaoDao::editarAquisicao($aquisicao);
        $_SESSION['messages'][] = 'Aquisição editada com sucesso';
        header('Location: ' . HOME_URI . 'list/aquisicoes');
        exit;
      }
    } else { // abastecimento para editar
      $aquisicao = AquisicaoDao::getPorId(check_array($this->controller->parameters, 0));
      $evento = EventoDao::getPorId($aquisicao->getEventoId());
      $veiculo = VeiculoDao::getPorId($evento->getIdVeiculo());

      $pecas = array();
      $qtds = array();

      foreach ($aquisicao->getItens() as $item) {
        $pecas[] = $item->getPeca();
        $qtds[] = $item->getQtd();
      }

      $this->form_data = array(
        'id' => $aquisicao->getId(),
        'veiculo' => $veiculo->getNome(),
        'evento' => $evento->getNome(),
        'peca' => $pecas,
        'qtd' => $qtds
      );
    }
  }

  public function validar_form_remover() {
    $this->form_data = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      AquisicaoDao::removerAquisicao($this->controller->parameters[0]);
      $_SESSION['messages'][] = 'Aquisição removida com sucesso';
      header('Location: ' . HOME_URI . 'list/aquisicoes');
      exit;
    }
  }
}
