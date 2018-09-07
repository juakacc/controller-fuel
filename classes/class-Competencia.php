<?php

class Competencia {

  private $id;
  private $id_veiculo;
  private $referencia;
  private $km_inicial;

  public function __construct($id_veiculo, $referencia, $km_inicial) {
    $this->id_veiculo = $id_veiculo;
    $this->referencia = $referencia;
    $this->km_inicial = $km_inicial;
  }
}
