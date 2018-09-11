<?php

class CompetenciaDao {

  public static function adicionarComp(Competencia $c) {
    $mysqli = getConexao();
    $sql = "INSERT INTO competencia (veiculo_id, mes, ano, km) VALUES (?,?,?,?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("iiid", $c->getIdVeiculo(), $c->getMes(), $c->getAno(), $c->getKmInicial());
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function removerComp($id) {
    $mysqli = getConexao();
    $sql = "DELETE FROM competencia WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getCompetencias() {
    $mysqli = getConexao();
    $competencias = array();
    $sql = "SELECT id, veiculo_id, mes, ano, km FROM competencia";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id, $veiculo_id, $mes, $ano, $km);

        while ($stmt->fetch()) {
            $c = new Competencia($veiculo_id, $mes, $ano, $km);
            $c->setId($id);
            $competencias[] = $c;
        }
        $stmt->close();
    }
    $mysqli->close();
    return $competencias;
  }

  public static function getPorId($id) {
    $mysqli = getConexao();
    $sql = "SELECT mes, ano, veiculo_id, km FROM competencia WHERE id = ?";
    $comp = null;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $stmt->bind_result($mes, $ano, $veiculo_id, $km);

      if ($stmt->fetch()) {
        $comp = new Competencia($veiculo_id, $mes, $ano, $km);
        $comp->setId($id);
      }
      $stmt->close();
    }
    $mysqli->close();
    return $comp;
  }

  public static function getPorVeiculoData($veiculo_id, $mes, $ano) {
    $mysqli = getConexao();
    $sql = "SELECT id, km FROM competencia WHERE veiculo_id = ? AND mes = ? AND ano = ?";
    $comp = null;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("iii", $veiculo_id, $mes, $ano);
      $stmt->execute();
      $stmt->bind_result($id, $km);

      if ($stmt->fetch()) {
        $comp = new Competencia($veiculo_id, $mes, $ano, $km);
        $comp->setId($id);
      }
      $stmt->close();
    }
    $mysqli->close();

    if ($comp) {
      return $comp;
    } else {
      // Crio a competência
    }
  }
}
