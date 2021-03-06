<?php

class EventoDao {

  public static function adicionarEvento(Evento $e) {
    $mysqli = getConexao();
    $sql = "INSERT INTO evento (veiculo_id, nome, data, metrica_inicial, secretaria_id) VALUES (?,?,?,?,?)";
    $veiculo_id = $e->getIdVeiculo();
    $data = $e->getData();
    $nome = $e->getNome();
    $metrica_inicial = $e->getMetricaInicial();
    $secretaria = $e->getSecretaria();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("issdi", $veiculo_id, $nome, $data, $metrica_inicial, $secretaria);
        $stmt->execute();
        echo $stmt->error;
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function removerEvento($id) {
    $mysqli = getConexao();
    $sql = "DELETE FROM evento WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getEventos() {
    $mysqli = getConexao();
    $eventos = array();
    $sql = "SELECT id FROM evento";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id);

        while ($stmt->fetch()) {
            $c = EventoDao::getPorId($id);
            $eventos[] = $c;
        }
        $stmt->close();
    }
    $mysqli->close();
    return $eventos;
  }

  public static function getEventosPaginate($pagina, $qtd_por_pagina = QTD_POR_PAGE) {
    $mysqli = getConexao();
    $eventos = array();
    $sql = "SELECT COUNT(*) FROM evento";
    /* Verifica o número total de eventos */
    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->execute();
      // echo $stmt->error;
      $stmt->bind_result($qtd_total);

      if ($stmt->fetch()) {
        if ($qtd_total > 0 ) {
          $mysqli2 = getConexao();
          $sql2 = "SELECT id FROM evento ORDER BY data DESC LIMIT ?, ?";
          $inicio = ($pagina - 1) * $qtd_por_pagina;
          /* Pega os eventos que serão exibidos na paginação */
          if ($stmt2 = $mysqli2->prepare($sql2)) {
            $stmt2->bind_param("ii", $inicio, $qtd_por_pagina);
            $stmt2->execute();
            $stmt2->bind_result($id);

            while ($stmt2->fetch()) {
              $evento = EventoDao::getPorId($id);
              $eventos[] = $evento;
            }
            $stmt2->close();
          }
          $mysqli2->close();
        }
      }
      $stmt->close();
    }
    $mysqli->close();

    $retorno = array(
      'total_de_paginas' => ceil($qtd_total / $qtd_por_pagina),
      'eventos' => $eventos
    );
    return $retorno;
  }

  public static function getPorId($id) {
    $mysqli = getConexao();
    $sql = "SELECT nome, data, veiculo_id, metrica_inicial, secretaria_id FROM evento WHERE id = ?";
    $evento = null;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $stmt->bind_result($nome, $data, $veiculo_id, $metrica_inicial, $secretaria_id);

      if ($stmt->fetch()) {
        $evento = new Evento($veiculo_id, $nome, $data, $metrica_inicial, $secretaria_id);
        $evento->setId($id);
      }
      $stmt->close();
    }
    $mysqli->close();
    return $evento;
  }

  public static function getPorVeiculo($veiculo_id) {
    $mysqli = getConexao();
    $sql = "SELECT id FROM evento WHERE veiculo_id = ?";
    $eventos = array();

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("i", $veiculo_id);
      $stmt->execute();
      $stmt->bind_result($id);

      while ($stmt->fetch()) {
        $e = EventoDao::getPorId($id);
        $eventos[] = $e;
      }
      $stmt->close();
    }
    $mysqli->close();
    return $eventos;
  }

  public static function getUltimaMetrica($veiculo_id) {
    $mysqli = getConexao();
    $sql = "SELECT metrica_inicial FROM evento WHERE veiculo_id = ? ORDER BY metrica_inicial DESC LIMIT 1";
    $metrica = 0;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("i", $veiculo_id);
      $stmt->execute();
      $stmt->bind_result($metrica_inicial);

      if ($stmt->fetch()) {
        $metrica = $metrica_inicial;
      }
      $stmt->close();
     }
     $mysqli->close();
     return $metrica;
  }

  // public static function getComFiltro($id_filtro, $valor) {
  //   $competencias = array();
  //
  //   switch ($id_filtro) {
  //     case 1: // veículo
  //       $sql = "SELECT id AS i, veiculo_id, mes, ano, metrica_inicial FROM competencia
  //           WHERE veiculo_id IN (SELECT id FROM veiculo WHERE nome LIKE CONCAT('%',?,'%'))";
  //       break;
  //     case 2: // competencia
  //       $a = explode('/', $valor);
  //       if ((count($a) != 2) || ! is_numeric($a[0]) || ! is_numeric($a[1])) {
  //         return $competencias;
  //       }
  //       $sql = "SELECT id AS i, veiculo_id, mes, ano, metrica_inicial FROM competencia
  //           WHERE mes = ? AND ano = ?";
  //       break;
  //     case 3; // metrica
  //       $valor = strtolower($valor);
  //       if ($valor != 'km' && $valor != 'hr') {
  //         return $competencias;
  //       }
  //       $sql = "SELECT id AS i, veiculo_id, mes, ano, metrica_inicial FROM competencia
  //           WHERE veiculo_id IN (SELECT id FROM veiculo WHERE tipo_metrica LIKE CONCAT('%',?,'%'))";
  //       break;
  //   }
  //   $mysqli = getConexao();
  //
  //   if ($stmt = $mysqli->prepare($sql)) {
  //     if ($id_filtro == 2) {
  //       $stmt->bind_param("ii", $a[0], $a[1]);
  //     } else {
  //       $stmt->bind_param("s", $valor);
  //     }
  //     $stmt->execute();
  //     $stmt->bind_result($id, $veiculo_id, $mes, $ano, $metrica_inicial);
  //
  //     while ($stmt->fetch()) {
  //         $c = new Competencia($veiculo_id, $mes, $ano, $metrica_inicial);
  //         $c->setId($id);
  //         $competencias[] = $c;
  //     }
  //     $stmt->close();
  //   }
  //   $mysqli->close();
  //   return $competencias;
  // }
}
