<?php

class Veiculo {

  private $id;
  private $nome;
  private $placa;

  public function __construct($nome, $placa) {
    $this->nome = $nome;
    $this->placa = $placa;
  }

  public function getId() {
    return $this->id;
  }

  public function getNome() {
    return $this->nome;
  }

  public function getPlaca() {
    return $this->placa;
  }

}
