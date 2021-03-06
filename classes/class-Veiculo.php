<?php

class Veiculo {

  private $id;
  private $nome;
  private $chassi;
  private $placa;
  private $uf_placa;
  private $combustivel_padrao;
  private $tipo_metrica;
  private $secretaria_padrao;

  public function __construct($nome, $chassi, $placa, $uf_placa, $tipo_metrica, $combustivel_padrao) {
    $this->nome = $nome;
    $this->chassi = $chassi;
    $this->placa = $placa;
    $this->uf_placa = $uf_placa;
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

  public function getChassi() {
    return $this->chassi;
  }

  public function getPlaca() {
    return $this->placa;
  }

  public function getPlacaMostrar() {
    if ($this->tem_placa())
      return $this->placa . '/' . $this->uf_placa;
    else
      return null;
  }

  public function getUFplaca() {
    return $this->uf_placa;
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

  public function getSecretariaPadrao() {
    return $this->secretaria_padrao;
  }

  public function setSecretariaPadrao($s) {
    $this->secretaria_padrao = $s;
  }
}
