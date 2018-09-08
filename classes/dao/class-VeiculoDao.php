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

  public static function getVeiculos() {
    $mysqli = getConexao();
    $veiculos = array();
    $sql = "SELECT id, nome, placa FROM veiculo";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id, $nome, $placa);

        while ($stmt->fetch()) {
            $c = new Veiculo($nome, $placa);
            $c->setId($id);
            $veiculos[] = $c;
        }
        $stmt->close();
    }
    $mysqli->close();
    return $veiculos;
  }

  public static function getPorId($id) {
    $mysqli = getConexao();
    $sql = "SELECT nome, placa FROM veiculo WHERE id = ?";
    $veiculo = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($nome, $placa);

        while ($stmt->fetch()) {
            $veiculo = new Veiculo($nome, $placa);
            $veiculo->setId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $veiculo;
  }
}
