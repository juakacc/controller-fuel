<?php

class Aquisicao {

  private $id;
  private $itens;
  private $data;
  private $competencia_id;

  public function __construct($itens = array(), $data, $competencia_id) {
    $this->itens = $itens;
    $this->data = data_para_banco($data);
    $this->competencia_id = $competencia_id;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getItens() {
    return $this->itens;
  }

  public function getData() {
    return $this->data;
  }

  public function getCompId() {
    return $this->competencia_id;
  }
}
