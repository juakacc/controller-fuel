<?php

/**
* Class apenas para responder requisições ajax
*/
class AjaxController {

  public function verificarCombustivel() {
    $id = check_array($_POST, 'id_veiculo');
    $combustivel = '';

    if ($id) {
      $mysqli = getConexao();
      $sql = "SELECT combustivel_padrao FROM veiculo WHERE id = ?";

      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($c);

        if ($stmt->fetch()) {
          $combustivel = $c;
        }
        $stmt->close();
      }
      $mysqli->close();
    }
    echo $combustivel;
  }

  public function verificarMetrica() {
    $id = check_array($_POST, 'id_veiculo');
    $metrica = '';

    if ($id) {
      $v = VeiculoDao::getPorId($id);
      $metrica = $v->getTipoMetrica();
      
      $last_metrica = EventoDao::getUltimaMetrica($id);
      $last_metrica .= ' ' . $metrica;
      $metrica = ($metrica == 'km') ? 'Quilometragem' : 'Horário';
    }

    $m = array(
      'tipo_metrica' => $metrica,
      'last_metrica' => $last_metrica
    );

    header('Content-type: application/json');
    echo json_encode($m);
    // echo $metrica;
  }

  public function recuperarEventos() {
    $veiculo_id = check_array($_POST, 'id_veiculo');
    $type = check_array($_POST, 'type');
    $eventos = array();

    if ($veiculo_id) {
      $mysqli = getConexao();
      // $sql = "SELECT id, nome, data, metrica_inicial FROM evento WHERE veiculo_id = ?";
      $sql = "SELECT id, nome, data, metrica_inicial FROM evento e WHERE veiculo_id = ? AND NOT EXISTS (SELECT * FROM $type WHERE evento_id = e.id)";

      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $veiculo_id);
        $stmt->execute();
        $stmt->bind_result($id, $nome, $data, $metrica_inicial);

        while ($stmt->fetch()) {
          $eventos[] = array(
            'id' => $id,
            'nome' => $nome,
            'data' => data_para_mostrar($data),
            'metrica' => $metrica_inicial
          );
        }
        $stmt->close();
      }
      $mysqli->close();
    }
    header('Content-type: application/json');
    echo json_encode($eventos);
  }
}
