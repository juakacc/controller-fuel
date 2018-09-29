<?php

class Abastecimento {
  private $id;
  private $combustivel;
  private $qtd;
  private $data;
  private $id_evento;

  public function __construct($combustivel, $qtd, $data, $id_evento) {
    $this->combustivel = $combustivel;
    $this->qtd = $qtd;
    $this->data = data_para_banco($data);
    $this->id_evento = $id_evento;
  }

  // public function imprimir() {
  //   echo 'dadosABAS: ' . $this->id . ' ' . $this->combustivel . ' ' .$this->qtd . ' ' .$this->data . ' ' .$this->id_evento . '<br />';
  // }

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

  public function getEventoId() {
    return $this->id_evento;
  }
}
