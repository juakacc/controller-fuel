<?php

class AbastecimentoDao {

  public static function adicionarAbastecimento(Abastecimento $a) {
    $mysqli = getConexao();
    $sql = "INSERT INTO abastecimento (combustivel, qtd, data, competencia_id) VALUES (?,?,?,?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sdsi", $a->getCombustivel(), $a->getQtd(), $a->getData(), $a->getCompId());
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getAbastecimentos() {
    $mysqli = getConexao();
    $abastecimentos = array();
    $sql = "SELECT id, combustivel, qtd, data, competencia_id FROM abastecimento";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($id, $combustivel, $qtd, $data, $competencia_id);

        while ($stmt->fetch()) {
          $a = new Abastecimento($combustivel, $qtd, $data, $competencia_id);
          $a->setId($id);
          $abastecimentos[] = $a;
        }
        $stmt->close();
    }
    $mysqli->close();
    return $abastecimentos;
  }
}
