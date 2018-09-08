<?php

class Competencia {

  private $id;
  private $id_veiculo;
  private $referencia;
  private $km_inicial;

  public function __construct($id_veiculo, $referencia, $km_inicial) {
    $this->id_veiculo = $id_veiculo;
    $this->referencia = transformarParaBanco($referencia);
    $this->km_inicial = $km_inicial;
  }

  public function getId() {
    return $this->id;
  }

  public function getIdVeiculo() {
    return $this->id_veiculo;
  }

  public function getReferencia() {
    return $this->referencia;
  }

  public function getKmInicial() {
    return $this->km_inicial;
  }
}
