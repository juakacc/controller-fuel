<?php

class AquisicaoModel extends MainModel {

  public function validar_form_adicionar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }

      if (! validar_data($this->form_data['data'])) {
        $this->form_msg['data'] = 'Data inválida';
      } else {
        $d = explode('/', $this->form_data['data']);
        // Verificar competência
        $comp = CompetenciaDao::getPorVeiculoData($this->form_data['veiculo'], $d[1], $d[2]);
        if (! $comp) {
          $url_register = HOME_URI . 'register/competencia/' . $d[1] . '/' . $d[2] . '/' . $this->form_data['veiculo'];
          $this->form_msg['data'] = 'Competência inexistente. <a href=\''. $url_register . '\'>Cadastrar</a>';
        }
      }

      $itens = array();
      $pecas = $this->form_data['peca'];
      $qtds = $this->form_data['qtd'];

      for ($i=0; $i < count($pecas); $i++) {
        if (strlen($pecas[$i]) != 0) {
          $itens[] = new Item($pecas[$i], $qtds[$i]);
        }
        // echo 'p: ' . $pecas[$i] . ' qtd: ' . $qtds[$i] . '<br />';
      }

      if (empty($this->form_msg)) {
        $aquisicao = new Aquisicao($itens, $this->form_data['data'], $comp->getId());
        AquisicaoDao::adicionarAquisicao($aquisicao);
        $_SESSION['messages'][] = 'Aquisição cadastrada com sucesso';
        // header('Location: ' . HOME_URI . 'list/aquisicoes');
        // exit;
      }
    } else { // GET - caso já venha com o veículo definido
      if (is_numeric(check_array($_GET, 'veiculo'))) {
        $this->form_data['veiculo'] = check_array($_GET, 'veiculo');
      }
    }
  }

  public function validar_form_remover() {
    $this->form_data = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

      $_SESSION['messages'][] = 'Conserto removido com sucesso';
      header('Location: ' . HOME_URI . 'list/consertos');
      exit;
    }
  }
}
