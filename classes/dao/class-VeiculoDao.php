<?php

class VeiculoDao {

  public static function adicionarVeiculo(Veiculo $v) {
    $mysqli = getConexao();
    $sql = "INSERT INTO veiculo (nome, chassi, sem_placa, placa, uf_placa, combustivel_padrao, tipo_metrica, secretaria_padrao) VALUES (?,?,?,?,?,?,?,?)";

    $sem_placa = $v->getPlaca() == "";
    $nome = $v->getNome();
    $chassi = $v->getChassi();
    $placa = $v->getPlaca();
    $uf_placa = $v->getUFPlaca();
    $combustivel_padrao = $v->getCombustivelPadrao();
    $tipo_metrica = $v->getTipoMetrica();
    $secretaria_padrao = $v->getSecretariaPadrao();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssissssi", $nome, $chassi, $sem_placa, $placa, $uf_placa, $combustivel_padrao, $tipo_metrica, $secretaria_padrao);
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
    $sql = "UPDATE veiculo SET nome=?, chassi=?, sem_placa=?, placa=?, uf_placa=?, combustivel_padrao=? WHERE id = ?";

    $sem_placa = $v->getPlaca() == "";
    $nome = $v->getNome();
    $chassi = $v->getChassi();
    $placa = $v->getPlaca();
    $uf_placa = $v->getUFplaca();
    $combustivel_padrao = $v->getCombustivelPadrao();
    $id = $v->getId();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssisssi", $nome, $chassi, $sem_placa, $placa, $uf_placa, $combustivel_padrao, $id);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getVeiculos() {
    $mysqli = getConexao();
    $veiculos = array();
    $sql = "SELECT id FROM veiculo";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id);

        while ($stmt->fetch()) {
            $veiculos[] = VeiculoDao::getPorId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $veiculos;
  }

  public static function getPorId($id) {
    $mysqli = getConexao();
    $sql = "SELECT nome, chassi, placa, uf_placa, combustivel_padrao, tipo_metrica, secretaria_padrao FROM veiculo WHERE id = ?";
    $veiculo = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($nome, $chassi, $placa, $uf_placa, $combustivel_padrao, $tipo_metrica, $secretaria_padrao);

        if ($stmt->fetch()) {
          $veiculo = new Veiculo($nome, $chassi, $placa, $uf_placa, $tipo_metrica, $combustivel_padrao);
          $veiculo->setSecretariaPadrao($secretaria_padrao);
          $veiculo->setId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $veiculo;
  }

  public static function getPorPlaca($placa) {
    $mysqli = getConexao();
    $sql = "SELECT id FROM veiculo WHERE placa LIKE CONCAT('%',?,'%')";
    $veiculo = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $placa);
        $stmt->execute();
        $stmt->bind_result($id);

        if ($stmt->fetch()) {
          $veiculo = VeiculoDao::getPorId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $veiculo;
  }

  public static function getPorNome($nome) {
    $mysqli = getConexao();
    $sql = "SELECT id FROM veiculo WHERE nome LIKE CONCAT('%',?,'%')";
    $veiculo = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $stmt->bind_result($id);

        if ($stmt->fetch()) {
          $veiculo = VeiculoDao::getPorId($id);
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
