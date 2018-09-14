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
          $this->form_msg['data'] = 'Competência inexistente <a href=\'\'>teste</a>';
        }
      }

      if (strlen($this->form_data['peca']) == 0) {
        $this->form_msg['peca'] = 'Informe alguma aquisição';
      }

      if (empty($this->form_msg)) {
        $aquisicao = new Aquisicao($this->form_data['peca'], $this->form_data['data'],
          $comp->getId());
        AquisicaoDao::adicionarAquisicao($aquisicao);
        $_SESSION['messages'][] = 'Aquisição cadastrada com sucesso';
        header('Location: ' . HOME_URI . 'list/aquisicoes');
        exit;
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
