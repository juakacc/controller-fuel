<?php

class AbastecimentoDao {

  public static function adicionarAbastecimento(Abastecimento $a) {
    $mysqli = getConexao();
    $sql = "INSERT INTO abastecimento (combustivel, qtd, data, competencia_id) VALUES (?,?,?,?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sdsi", $a->getCombustivel(), $a->getQtd(), $a->getData(), $a->getCompId());
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function removerAbastecimento($id) {
    $mysqli = getConexao();
    $sql = "DELETE FROM abastecimento WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getPorId($id) {
    $mysqli = getConexao();
    $sql = "SELECT combustivel, qtd, data, competencia_id FROM abastecimento WHERE id = ?";
    $a = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($combustivel, $qtd, $data, $competencia_id);

        if ($stmt->fetch()) {
          $a = new Abastecimento($combustivel, $qtd, $data, $competencia_id);
          $a->setId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $a;
  }

  public static function getPorCompetencia($comp_id) {
    $mysqli = getConexao();
    $sql = "SELECT id, combustivel, qtd, data FROM abastecimento WHERE competencia_id = ?";
    $abastecimentos = array();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $comp_id);
        $stmt->execute();
        $stmt->bind_result($id, $combustivel, $qtd, $data);

        while ($stmt->fetch()) {
          $a = new Abastecimento($combustivel, $qtd, $data, $comp_id);
          $a->setId($id);
          $abastecimentos[] = $a;
        }
        $stmt->close();
    }
    $mysqli->close();
    return $abastecimentos;
  }

  public static function getAbastecimentos() {
    $mysqli = getConexao();
    $abastecimentos = array();
    $sql = "SELECT id, combustivel, qtd, data, competencia_id FROM abastecimento";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id, $combustivel, $qtd, $data, $competencia_id);

        while ($stmt->fetch()) {
          $a = new Abastecimento($combustivel, $qtd, $data, $competencia_id);
          $a->setId($id);
          $abastecimentos[] = $a;
        }
        $stmt->close();
    }
    $mysqli->close();
    return $abastecimentos;
  }
}
