<?php

class ConsertoDao {

  public static function adicionarConserto(Conserto $c) {
    $mysqli = getConexao();
    $sql = "INSERT INTO conserto (servico, data, competencia_id) VALUES (?,?,?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssi", $c->getServico(), $c->getData(), $c->getCompId());
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function removerConserto($id) {
    $mysqli = getConexao();
    $sql = "DELETE FROM conserto WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getPorId($id) {
    $mysqli = getConexao();
    $sql = "SELECT servico, data, competencia_id FROM conserto WHERE id = ?";
    $s = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($servico, $data, $competencia_id);

        if ($stmt->fetch()) {
          $s = new Conserto($servico, $data, $competencia_id);
          $s->setId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $s;
  }

  public static function getConsertos() {
    $mysqli = getConexao();
    $consertos = array();
    $sql = "SELECT id, servico, data, competencia_id FROM conserto";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id, $servico, $data, $competencia_id);

        while ($stmt->fetch()) {
          $s = new Conserto($servico, $data, $competencia_id);
          $s->setId($id);
          $consertos[] = $s;
        }
        $stmt->close();
    }
    $mysqli->close();
    return $consertos;
  }
}
