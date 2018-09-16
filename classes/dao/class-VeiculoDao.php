<?php

class VeiculoDao {

  public static function adicionarVeiculo(Veiculo $v) {
    $mysqli = getConexao();
    $sql = "INSERT INTO veiculo (nome, sem_placa, placa, combustivel_padrao, tipo_metrica) VALUES (?,?,?,?,?)";

    $sem_placa = $v->getPlaca() == "";
    $nome = $v->getNome();
    $placa = $v->getPlaca();
    $combustivel_padrao = $v->getCombustivelPadrao();
    $tipo_metrica = $v->getTipoMetrica();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sisss", $nome, $sem_placa, $placa, $combustivel_padrao, $tipo_metrica);
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

  public static function editarVeiculo(Veiculo $v) {
    $mysqli = getConexao();
    $sql = "UPDATE veiculo SET nome=?, sem_placa=?, placa=?, combustivel_padrao=? WHERE id = ?";

    $sem_placa = $v->getPlaca() == "";
    $nome = $v->getNome();
    $placa = $v->getPlaca();
    $combustivel_padrao = $v->getCombustivelPadrao();
    $id = $v->getId();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sissi", $nome, $sem_placa, $placa, $combustivel_padrao, $id);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getVeiculos() {
    $mysqli = getConexao();
    $veiculos = array();
    $sql = "SELECT id, nome, placa, combustivel_padrao, tipo_metrica FROM veiculo";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id, $nome, $placa, $combustivel_padrao, $tipo_metrica);

        while ($stmt->fetch()) {
            $c = new Veiculo($nome, $placa, $tipo_metrica, $combustivel_padrao);
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
    $sql = "SELECT nome, placa, combustivel_padrao, tipo_metrica FROM veiculo WHERE id = ?";
    $veiculo = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($nome, $placa, $combustivel_padrao, $tipo_metrica);

        if ($stmt->fetch()) {
          $veiculo = new Veiculo($nome, $placa, $tipo_metrica, $combustivel_padrao);
          $veiculo->setId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $veiculo;
  }

  public static function getPorPlaca($placa) {
    $mysqli = getConexao();
    $sql = "SELECT id, nome, combustivel_padrao, tipo_metrica FROM veiculo WHERE placa LIKE CONCAT('%',?,'%')";
    $veiculo = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $placa);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $combustivel_padrao, $tipo_metrica);

        if ($stmt->fetch()) {
          $veiculo = new Veiculo($nome, $placa, $tipo_metrica, $combustivel_padrao);
          $veiculo->setId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $veiculo;
  }

  public static function getPorPlacaEdit($placa, $id) {
    $mysqli = getConexao();
    $sql = "SELECT id FROM veiculo WHERE placa LIKE CONCAT('%',?,'%') AND id != ?";
    $veiculo = false;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("si", $placa, $id);
        $stmt->execute();
        $stmt->store_result();
        $veiculo = $stmt->num_rows == 1;
        $stmt->close();
    }
    $mysqli->close();
    return $veiculo;
  }
}
