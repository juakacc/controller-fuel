<?php

class SecretariaDao {

  public static function getSecretarias() {
    $mysqli = getConexao();
    $sql = "SELECT id FROM secretaria";
    $secretarias = array();

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->execute();
      $stmt->bind_result($id);

      while ($stmt->fetch()) {
        $secretarias[] = SecretariaDao::getPorId($id);
      }
      $stmt->close();
    }
    $mysqli->close();
    return $secretarias;
  }

  public static function getPorId($id) {
    $mysqli = getConexao();
    $sql = "SELECT nome FROM secretaria WHERE id = ?";
    $secretaria = null;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $stmt->bind_result($nome);

      if ($stmt->fetch()) {
        $secretaria = new Secretaria($id, $nome);
      }
      $stmt->close();
    }
    $mysqli->close();
    return $secretaria;
  }
}
