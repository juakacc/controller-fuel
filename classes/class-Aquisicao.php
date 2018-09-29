<?php

class Aquisicao {

  private $id;
  private $itens;
  private $data;
  private $evento_id;

  public function __construct($itens = array(), $data, $evento_id) {
    $this->itens = $itens;
    $this->data = data_para_banco($data);
    $this->evento_id = $evento_id;
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

  public function getEventoId() {
    return $this->evento_id;
  }
}
