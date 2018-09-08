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
}
