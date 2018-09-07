<?php

class VeiculoDao {

  public static function adicionarVeiculo(Veiculo $v) {
    $mysqli = getConexao();
    $sql = "INSERT INTO veiculo (nome, placa) VALUES (?,?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ss", $v->getNome(), $v->getPlaca());
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }
}
