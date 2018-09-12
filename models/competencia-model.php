<?php

class CompetenciaModel extends MainModel {

  public function validar_form_adicionar() {
    $this->form_data = array();
    $this->form_msg =  array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      foreach ($_POST as $key => $value) {
        $this->form_data[$key] = $value;
      }

      if (CompetenciaDao::getPorVeiculoData($this->form_data['veiculo'],
          $this->form_data['mes'], $this->form_data['ano'])) {
        $this->form_msg['veiculo'] = 'Competência já registrada';
      }

      $this->form_data['metrica_inicial'] = str_replace('.', '', $this->form_data['metrica_inicial']);
      $this->form_data['metrica_inicial'] = str_replace(':', '', $this->form_data['metrica_inicial']);

      if (! is_numeric($this->form_data['metrica_inicial'])) {
        $this->form_data['metrica_inicial'] = '';
        $this->form_msg['metrica_inicial'] = 'Quilometragem/Horário inválido';
      }

      if (empty($this->form_msg)) {
        $comp = new Competencia($this->form_data['veiculo'], $this->form_data['mes'],
          $this->form_data['ano'], $this->form_data['metrica_inicial']);
        CompetenciaDao::adicionarComp($comp);
        $_SESSION['messages'][] = 'Competência cadastrada com sucesso';
        header('Location: ' . HOME_URI . 'list/competencias');
        exit;
      }
    }
  }

  public function validar_form_remover() {
    $this->form_data = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
      CompetenciaDao::removerComp($this->controller->parameters[0]);
      $_SESSION['messages'][] = 'Competência removida com sucesso';
      header('Location: ' . HOME_URI . 'list/competencias');
      exit;
    }
  }
}
