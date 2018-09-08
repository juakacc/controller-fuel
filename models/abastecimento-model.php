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

      if (!is_numeric($this->form_data['qtd'])) {
        $this->form_msg['qtd'] = 'Quantidade inválida';
      }

      if (empty($this->form_msg)) {
        $veiculo = VeiculoDao::getPorId($this->form_data['veiculo']);
        $comp = CompetenciaDao::getPorVeiculoData($veiculo, $this->form_data['data']);

        $abastecimento = new Abastecimento($this->form_data['combustivel'], $this->form_data['qtd'],
          $this->form_data['data'], $comp->getId());
        AbastecimentoDao::adicionarAbastecimento($abastecimento);
        echo 'Gravado com sucesso';
      }
    }
  }
}
