<?php

class Evento {

  private $id;
  private $id_veiculo;
  private $data;
  private $nome;
  private $metrica_inicial;

  public function __construct($id_veiculo, $nome, $data, $metrica_inicial) {
    $this->id_veiculo = $id_veiculo;
    $this->data = data_para_banco($data);
    $this->nome = $nome;
    $this->metrica_inicial = $metrica_inicial;
  }

  // public function imprimir() {
  //   echo 'dadosCOMP: ' . $this->id . ' ' . $this->id_veiculo . ' ' .$this->data . ' ' .$this->nome . '<br />';
  // }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getIdVeiculo() {
    return $this->id_veiculo;
  }

  public function getData() {
    return $this->data;
  }

  public function getNome() {
    return $this->nome;
  }
  
  public function getMetricaInicial() {
    return $this->metrica_inicial;
  }
}
