<?php

/**
* Class para responder requisições ajax
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
      $mysqli = getConexao();
      $sql = "SELECT tipo_metrica FROM veiculo WHERE id = ?";

      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($c);

        if ($stmt->fetch()) {
          $metrica = $c;
        }
        $stmt->close();
      }
      $mysqli->close();
    }
    if ($metrica == 'km') {
      echo 'Quilometragem';
    } else if ($metrica == 'hr') {
      echo 'Horário';
    } else {
      echo $metrica;
    }
  }

}
