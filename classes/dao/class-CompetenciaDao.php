<?php

class CompetenciaDao {

  public static function adicionarComp(Competencia $c) {
    $mysqli = getConexao();
    $sql = "INSERT INTO competencia (veiculo_id, mes, ano, metrica_inicial) VALUES (?,?,?,?)";
    $veiculo_id = $c->getIdVeiculo();
    $mes = $c->getMes();
    $ano = $c->getAno();
    $metrica_inicial = $c->getMetricaInicial();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("iiid", $veiculo_id, $mes, $ano, $metrica_inicial);
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
    $sql = "SELECT id, veiculo_id, mes, ano, metrica_inicial FROM competencia";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id, $veiculo_id, $mes, $ano, $metrica_inicial);

        while ($stmt->fetch()) {
            $c = new Competencia($veiculo_id, $mes, $ano, $metrica_inicial);
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
    $sql = "SELECT mes, ano, veiculo_id, metrica_inicial FROM competencia WHERE id = ?";
    $comp = null;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $stmt->bind_result($mes, $ano, $veiculo_id, $metrica_inicial);

      if ($stmt->fetch()) {
        $comp = new Competencia($veiculo_id, $mes, $ano, $metrica_inicial);
        $comp->setId($id);
      }
      $stmt->close();
    }
    $mysqli->close();
    return $comp;
  }

  public static function getPorVeiculo($veiculo_id) {
    $mysqli = getConexao();
    $sql = "SELECT id, mes, ano, metrica_inicial FROM competencia WHERE veiculo_id = ?";
    $competencias = array();

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("i", $veiculo_id);
      $stmt->execute();
      $stmt->bind_result($id, $mes, $ano, $metrica_inicial);

      while ($stmt->fetch()) {
        $comp = new Competencia($veiculo_id, $mes, $ano, $metrica_inicial);
        $comp->setId($id);
        $competencias[] = $comp;
      }
      $stmt->close();
    }
    $mysqli->close();
    return $competencias;
  }

  public static function getPorVeiculoData($veiculo_id, $mes, $ano) {
    $mysqli = getConexao();
    $sql = "SELECT id, metrica_inicial FROM competencia WHERE veiculo_id = ? AND mes = ? AND ano = ?";
    $comp = null;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("iii", $veiculo_id, $mes, $ano);
      $stmt->execute();
      $stmt->bind_result($id, $metrica_inicial);

      if ($stmt->fetch()) {
        $comp = new Competencia($veiculo_id, $mes, $ano, $metrica_inicial);
        $comp->setId($id);
      }
      $stmt->close();
    }
    $mysqli->close();

    if ($comp) {
      return $comp;
    } else {
      // Crio a competência
      return null;
    }
  }

  public static function getComFiltro($id_filtro, $valor) {
    $competencias = array();

    switch ($id_filtro) {
      case 1: // veículo
        $sql = "SELECT id AS i, veiculo_id, mes, ano, metrica_inicial FROM competencia
            WHERE veiculo_id IN (SELECT id FROM veiculo WHERE nome LIKE CONCAT('%',?,'%'))";
        break;
      case 2: // competencia
        $a = explode('/', $valor);
        if ((count($a) != 2) || ! is_numeric($a[0]) || ! is_numeric($a[1])) {
          return $competencias;
        }
        $sql = "SELECT id AS i, veiculo_id, mes, ano, metrica_inicial FROM competencia
            WHERE mes = ? AND ano = ?";
        break;
      case 3; // metrica
        $valor = strtolower($valor);
        if ($valor != 'km' && $valor != 'hr') {
          return $competencias;
        }
        $sql = "SELECT id AS i, veiculo_id, mes, ano, metrica_inicial FROM competencia
            WHERE veiculo_id IN (SELECT id FROM veiculo WHERE tipo_metrica LIKE CONCAT('%',?,'%'))";
        break;
    }
    $mysqli = getConexao();

    if ($stmt = $mysqli->prepare($sql)) {
      if ($id_filtro == 2) {
        $stmt->bind_param("ii", $a[0], $a[1]);
      } else {
        $stmt->bind_param("s", $valor);
      }
      $stmt->execute();
      $stmt->bind_result($id, $veiculo_id, $mes, $ano, $metrica_inicial);

      while ($stmt->fetch()) {
          $c = new Competencia($veiculo_id, $mes, $ano, $metrica_inicial);
          $c->setId($id);
          $competencias[] = $c;
      }
      $stmt->close();
    }
    $mysqli->close();
    return $competencias;
  }
}
