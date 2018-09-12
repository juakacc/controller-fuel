<?php

class Competencia {

  private $id;
  private $id_veiculo;
  private $mes;
  private $ano;
  private $metrica_inicial;

  public function __construct($id_veiculo, $mes, $ano, $metrica_inicial) {
    $this->id_veiculo = $id_veiculo;
    $this->mes = $mes;
    $this->ano = $ano;
    $this->metrica_inicial = $metrica_inicial;
  }

  public function imprimir() {
    echo 'dadosCOMP: ' . $this->id . ' ' . $this->id_veiculo . ' ' .$this->mes . ' ' .$this->ano . '<br />';
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getIdVeiculo() {
    return $this->id_veiculo;
  }

  public function getMes() {
    return $this->mes;
  }

  public function getAno() {
    return $this->ano;
  }

  public function getReferencia() {
    return mostrar_mes($this->mes) . '/' . $this->ano;
  }

  public function getMetricaInicial() {
    return $this->metrica_inicial;
  }
}
