<?php

class AbastecimentoDao {

  public static function adicionarAbastecimento(Abastecimento $a) {
    $mysqli = getConexao();
    $sql = "INSERT INTO abastecimento (combustivel, qtd, data, evento_id) VALUES (?,?,?,?)";
    $combustivel = $a->getCombustivel();
    $qtd = $a->getQtd();
    $data = $a->getData();
    $evento_id = $a->getEventoId();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sdsi", $combustivel, $qtd, $data, $evento_id);
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
    $sql = "SELECT combustivel, qtd, data, evento_id FROM abastecimento WHERE id = ?";
    $a = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($combustivel, $qtd, $data, $evento_id);

        if ($stmt->fetch()) {
          $a = new Abastecimento($combustivel, $qtd, $data, $evento_id);
          $a->setId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $a;
  }

  public static function getPorEvento($evento_id) {
    $mysqli = getConexao();
    $sql = "SELECT id FROM abastecimento WHERE evento_id = ?";
    $abastecimentos = array();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $evento_id);
        $stmt->execute();
        $stmt->bind_result($id);

        while ($stmt->fetch()) {
          $a = AbastecimentoDao::getPorId($id);
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
    $sql = "SELECT id FROM abastecimento";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id);

        while ($stmt->fetch()) {
          $a = AbastecimentoDao::getPorId($id);
          $abastecimentos[] = $a;
        }
        $stmt->close();
    }
    $mysqli->close();
    return $abastecimentos;
  }
}
