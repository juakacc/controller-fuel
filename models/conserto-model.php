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
        $veiculo = VeiculoDao::getPorId($this->form_data['veiculo']);
        $comp = CompetenciaDao::getPorVeiculoData($veiculo, $this->form_data['data']);

        $conserto = new Conserto($this->form_data['servico'], $this->form_data['data'], $comp->getId());
        ConsertoDao::adicionarConserto($conserto);
        echo 'Gravado com sucesso';
      }
    }
  }
}
