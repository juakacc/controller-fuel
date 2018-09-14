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

}
