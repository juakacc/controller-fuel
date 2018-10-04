<?php

class ConsertoDao {

  public static function adicionarConserto(Conserto $c) {
    $mysqli = getConexao();
    $sql = "INSERT INTO conserto (servico, data, evento_id) VALUES (?,?,?)";
    $servico = $c->getServico();
    $data = $c->getData();
    $evento_id = $c->getEventoId();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssi", $servico, $data, $evento_id);
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

  public static function editarConserto(Conserto $c) {
    $mysqli = getConexao();
    $sql = "UPDATE conserto SET servico = ? WHERE id = ?";
    $servico = $c->getServico();
    $id = $c->getId();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("si", $servico, $id);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getPorId($id) {
    $mysqli = getConexao();
    $sql = "SELECT servico, data, evento_id FROM conserto WHERE id = ?";
    $s = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($servico, $data, $evento_id);

        if ($stmt->fetch()) {
          $s = new Conserto($servico, $data, $evento_id);
          $s->setId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $s;
  }

  public static function getPorEvento($evento_id) {
    $mysqli = getConexao();
    $sql = "SELECT id FROM conserto WHERE evento_id = ?";
    $servico = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $evento_id);
        $stmt->execute();
        $stmt->bind_result($id);

        if ($stmt->fetch()) {
          $servico = ConsertoDao::getPorId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $servico;
  }

  public static function getConsertos() {
    $mysqli = getConexao();
    $consertos = array();
    $sql = "SELECT id FROM conserto";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id);

        while ($stmt->fetch()) {
          $s = ConsertoDao::getPorId($id);
          $consertos[] = $s;
        }
        $stmt->close();
    }
    $mysqli->close();
    return $consertos;
  }

  // public static function eventoTem($evento_id) {
  //   $mysqli = getConexao();
  //   $tem = false;
  //   $sql = "SELECT id FROM conserto WHERE evento_id = ?";
  //
  //   if ($stmt = $mysqli->prepare($sql)) {
  //       $stmt->bind_param("i", $evento_id);
  //       $stmt->execute();
  //       $stmt->bind_result($id);
  //
  //       if ($stmt->fetch())
  //         $tem = true;
  //       $stmt->close();
  //   }
  //   $mysqli->close();
  //   return $tem;
  // }
}
