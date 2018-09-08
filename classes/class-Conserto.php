<?php

class Conserto {

  private $id;
  private $servicos;
  private $data;
  private $id_competencia;

  public function __construct($servico, $data, $id_competencia) {
    $this->servicos = $servico;
    $this->data = data_para_banco($data);
    $this->id_competencia = $id_competencia;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getServico() {
    return $this->servicos;
  }

  public function getData() {
    return $this->data;
  }

  public function getCompId() {
    return $this->id_competencia;
  }
}
