<?php

class VeiculoDao {

  public static function adicionarVeiculo(Veiculo $v) {
    $mysqli = getConexao();

    $sql = "INSERT INTO veiculo (nome, sem_placa, placa, tipo_metrica) VALUES (?,?,?,?)";
    $sem_placa = $v->getPlaca() == "";
    $nome = $v->getNome();
    $placa = $v->getPlaca();
    $tipo_metrica = $v->getTipoMetrica();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("siss", $nome, $sem_placa, $placa, $tipo_metrica);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function removerVeiculo($id) {
    $mysqli = getConexao();
    $sql = "DELETE FROM veiculo WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getVeiculos() {
    $mysqli = getConexao();
    $veiculos = array();
    $sql = "SELECT id, nome, placa, tipo_metrica FROM veiculo";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id, $nome, $placa, $tipo_metrica);

        while ($stmt->fetch()) {
            $c = new Veiculo($nome, $placa, $tipo_metrica);
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
    $sql = "SELECT nome, placa, tipo_metrica FROM veiculo WHERE id = ?";
    $veiculo = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($nome, $placa, $tipo_metrica);

        if ($stmt->fetch()) {
          $veiculo = new Veiculo($nome, $placa, $tipo_metrica);
          $veiculo->setId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $veiculo;
  }

  public static function getPorPlaca($placa) {
    $mysqli = getConexao();
    $sql = "SELECT id, nome, tipo_metrica FROM veiculo WHERE placa = ?";
    $veiculo = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $placa);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $tipo_metrica);

        if ($stmt->fetch()) {
          $veiculo = new Veiculo($nome, $placa, $tipo_metrica);
          $veiculo->setId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $veiculo;
  }
}
