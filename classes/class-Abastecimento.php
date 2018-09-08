<?php

class Abastecimento {
  private $id;
  private $combustivel;
  private $qtd;
  private $data;
  private $id_competencia;

  public function __construct($combustivel, $qtd, $data, $id_competencia) {
    $this->combustivel = $combustivel;
    $this->qtd = $qtd;
    $this->data = data_para_banco($data);
    $this->id_competencia = $id_competencia;
  }

  public function imprimir() {
    echo 'dadosABAS: ' . $this->id . ' ' . $this->combustivel . ' ' .$this->qtd . ' ' .$this->data . ' ' .$this->id_competencia . '<br />';
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getCombustivel() {
    return $this->combustivel;
  }

  public function getQtd() {
    return $this->qtd;
  }

  public function getData() {
    return $this->data;
  }

  public function getCompId() {
    return $this->id_competencia;
  }
}
