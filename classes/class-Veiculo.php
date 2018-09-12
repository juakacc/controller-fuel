<?php

class Veiculo {

  private $id;
  private $nome;
  private $placa;
  private $tipo_metrica;

  public function __construct($nome, $placa, $tipo_metrica) {
    $this->nome = $nome;
    $this->placa = $placa;
    $this->tipo_metrica = $tipo_metrica;
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
    if ($this->placa == '')
      return 'Sem placa';
    return $this->placa;
  }

  public function getTipoMetrica() {
    return $this->tipo_metrica;
  }

}
