<?php

class Aquisicao {

  private $id;
  private $peca;
  private $data;
  private $competencia_id;

  public function __construct($peca, $data, $competencia_id) {
    $this->peca = $peca;
    $this->data = data_para_banco($data);
    $this->competencia_id = $competencia_id;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getPeca() {
    return $this->peca;
  }

  public function getData() {
    return $this->data;
  }

  public function getCompId() {
    return $this->competencia_id;
  }
}
