<?php

class AquisicaoDao {

  public static function adicionarAquisicao(Aquisicao $a) {
    $mysqli = getConexao();
    $sql = "INSERT INTO aquisicao (data, competencia_id) VALUES (?,?)";
    $data = $a->getData();
    $comp_id = $a->getCompId();
    $itens = $a->getItens();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("si", $data, $comp_id);

        if ($stmt->execute()){
          $id = AquisicaoDao::getUltimoId();
          ItemDao::adicionarItens($itens, $id);
        }
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getUltimoId() {
    $sql = "SELECT id FROM aquisicao ORDER BY id DESC LIMIT 1";
    $mysqli = getConexao();
    $id = 0;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($i);

        if ($stmt->fetch()) $id = $i;
        $stmt->close();
    }
    $mysqli->close();
    return $id;
  }

  public static function removerAquisicao($id) {
    $mysqli = getConexao();
    $sql = "DELETE FROM aquisicao WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getPorId($id) {
    $mysqli = getConexao();
    $sql = "SELECT data, competencia_id FROM aquisicao WHERE id = ?";
    $aquisicao = null;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $stmt->bind_result($data, $competencia_id);

      if ($stmt->fetch()) {
        $itens = ItemDao::getPorAquisicaoId($id);
        $aquisicao = new Aquisicao($itens, $data, $competencia_id);
        $aquisicao->setId($id);
      }
    }
    $mysqli->close();
    return $aquisicao;
  }

  public static function getAquisicoes() {
    $mysqli = getConexao();
    $sql = "SELECT id FROM aquisicao";
    $aquisicoes = array();

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->execute();
      $stmt->bind_result($id);

      while ($stmt->fetch()) {
        $a = AquisicaoDao::getPorId($id);
        $aquisicoes[] = $a;
      }
      $stmt->close();
    }
    $mysqli->close();
    return $aquisicoes;
  }

  public static function getPorCompetencia($comp_id) {
    $mysqli = getConexao();
    $sql = "SELECT id FROM aquisicao WHERE competencia_id = ?";
    $aquisicoes = array();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $comp_id);
        $stmt->execute();
        $stmt->bind_result($id);

        while ($stmt->fetch()) {
          $a = AquisicaoDao::getPorId($id);
          $aquisicoes[] = $a;
        }
        $stmt->close();
    }
    $mysqli->close();
    return $aquisicoes;
  }
}
