<?php

class CompetenciaModel extends MainModel {

  public function validar_form_adicionar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }
      // carro, referencia e quilometragem
      if (empty($this->form_msg)) {
        $comp = new Competencia($this->form_data['veiculo'], $this->form_data['referencia'], $this->form_data['km_inicial']);
        CompetenciaDao::adicionarComp($comp);
        echo 'Gravado com sucesso';
      }
    }
  }

  /**
  * Recupera os veículos para que o usuário possa escolher.
  */
  public function get_veiculos() {
    $veiculos = array();
    $car = new Veiculo('gol01', 'apv-8484');
    $veiculos[] = $car;
    return $veiculos;
  }
}
