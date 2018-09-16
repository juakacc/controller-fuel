<?php

class Veiculo {

  private $id;
  private $nome;
  private $placa;
  private $combustivel_padrao;
  private $tipo_metrica;

  public function __construct($nome, $placa, $tipo_metrica, $combustivel_padrao) {
    $this->nome = $nome;
    $this->placa = $placa;
    $this->tipo_metrica = $tipo_metrica;
    $this->combustivel_padrao = $combustivel_padrao;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getNome() {
    return $this->nome;
  }

  public function getPlaca() {
    return $this->placa;
  }

  public function tem_placa() {
    return $this->placa != '';
  }

  public function getTipoMetrica() {
    return $this->tipo_metrica;
  }

  public function getCombustivelPadrao() {
    return $this->combustivel_padrao;
  }
}
