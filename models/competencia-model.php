<?php

class CompetenciaModel extends MainModel {

  public function validar_form_adicionar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }
      // completa a data
      $this->form_data['referencia'] = '01/' . $this->form_data['referencia'];
      if (!validar_data($this->form_data['referencia'])) {
        $this->form_msg['referencia'] = 'Data inválida';
      }

      if (!is_numeric($this->form_data['km_inicial'])) {
        $this->form_msg['km_inicial'] = 'Quilometragem inválida';
      }
      // carro, referencia e quilometragem
      if (empty($this->form_msg)) {
        $comp = new Competencia($this->form_data['veiculo'], $this->form_data['referencia'],
          $this->form_data['km_inicial']);
        CompetenciaDao::adicionarComp($comp);
        echo 'Gravado com sucesso';
      }
    }
  }
}
