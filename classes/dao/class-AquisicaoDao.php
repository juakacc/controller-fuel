<?php

class AquisicaoDao {

  public static function adicionarAquisicao(Aquisicao $a) {
    $mysqli = getConexao();
    $sql = "INSERT INTO aquisicao (peca, data, competencia_id) VALUES (?,?,?)";
    $peca = $a->getPeca();
    $data = $a->getData();
    $comp_id = $a->getCompId();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssi", $peca, $data, $comp_id);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
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
    $sql = "SELECT peca, data, competencia_id FROM aquisicao WHERE id = ?";
    $aquisicao = null;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $stmt->bind_result($peca, $data, $competencia_id);

      if ($stmt->fetch()) {
        $aquisicao = new Aquisicao($peca, $data, $competencia_id);
        $aquisicao->setId($id);
      }
    }
    $mysqli->close();
    return $aquisicao;
  }

  public static function getAquisicoes() {
    $mysqli = getConexao();
    $sql = "SELECT id, peca, data, competencia_id FROM aquisicao";
    $aquisicoes = array();

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->execute();
      $stmt->bind_result($id, $peca, $data, $competencia_id);

      while ($stmt->fetch()) {
        $a = new Aquisicao($peca, $data, $competencia_id);
        $a->setId($id);
        $aquisicoes[] = $a;
      }
      $stmt->close();
    }
    $mysqli->close();
    return $aquisicoes;
  }
}
