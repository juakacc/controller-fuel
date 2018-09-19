<?php

class Conserto {

  private $id;
  private $servicos;
  private $data;
  private $id_evento;

  public function __construct($servico, $data, $id_evento) {
    $this->servicos = $servico;
    $this->data = data_para_banco($data);
    $this->id_evento = $id_evento;
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

  public function getEventoId() {
    return $this->id_evento;
  }
}
