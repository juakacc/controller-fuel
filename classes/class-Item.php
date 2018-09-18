<?php

class Item {

  private $id;
  private $id_aquisicao;
  private $peca;
  private $qtd;

  public function __construct($peca, $qtd) {
    $this->peca = $peca;
    $this->qtd = $qtd;
  }

  public function getPeca() {
    return $this->peca;
  }

  public function getQtd() {
    return $this->qtd;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getIdAquisicao() {
    return $this->id_aquisicao;
  }

  public function setIdAquisicao($id) {
    $this->id_aquisicao = $id;
  }

}
