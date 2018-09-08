<?php

class CompetenciaDao {

  public static function adicionarComp(Competencia $c) {
    $mysqli = getConexao();
    $sql = "INSERT INTO competencia (veiculo_id, referencia, km) VALUES (?,?,?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("isd", $c->getIdVeiculo(), $c->getReferencia(), $c->getKmInicial());
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getCompetencias() {
    $mysqli = getConexao();
    $competencias = array();
    $sql = "SELECT id, veiculo_id, referencia, km FROM competencia";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id, $veiculo_id, $referencia, $km);

        while ($stmt->fetch()) {
            $c = new Competencia($veiculo_id, $referencia, $km);
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
    $sql = "SELECT referencia, veiculo_id, km FROM competencia WHERE id = ?";
    $comp = null;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $stmt->bind_result($referencia, $veiculo_id, $km);

      if ($stmt->fetch()) {
        $comp = new Competencia($veiculo_id, $referencia, $km);
        $comp->setId($id);
      }
      $stmt->close();
    }
    $mysqli->close();
    return $comp;
  }

  public static function getPorVeiculoData(Veiculo $veiculo, $data) {
    $data = data_para_banco($data);
    // 2018-01-10 - > 2018-01-01
    $referencia = substr($data, 0, 8);
    $referencia .= '01';
    $veiculo_id = $veiculo->getId();

    $mysqli = getConexao();
    $sql = "SELECT id, km FROM competencia WHERE veiculo_id = ? AND referencia = ?";
    $comp = null;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("is", $veiculo_id, $referencia);
      $stmt->execute();
      $stmt->bind_result($id, $km);

      if ($stmt->fetch()) {
        $comp = new Competencia($veiculo_id, $referencia, $km);
        $comp->setId($id);
      }
      $stmt->close();
    }
    $mysqli->close();
    return $comp;
  }
}
