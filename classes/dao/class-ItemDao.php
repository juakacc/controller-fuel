<?php

class ItemDao {

  public static function adicionarItens($itens, $aquisicao_id) {
    $mysqli = getConexao();
    $sql = "INSERT INTO item (peca, qtd, aquisicao_id) VALUES (?,?,?)";

    if ($stmt = $mysqli->prepare($sql)) {

      foreach ($itens as $item) {
        $peca = $item->getPeca();
        $qtd = $item->getQtd();
        $stmt->bind_param("sii", $peca, $qtd, $aquisicao_id);
        $stmt->execute();
      }
      $stmt->close();
    }
    $mysqli->close();
  }

  public static function getPorAquisicaoId($aquisicao_id) {
    $mysqli = getConexao();
    $sql = "SELECT id, peca, qtd FROM item WHERE aquisicao_id = ?";
    $itens = array();

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("i", $aquisicao_id);
      $stmt->execute();
      $stmt->bind_result($id, $peca, $qtd);

      while ($stmt->fetch()) {
        $i = new Item($peca, $qtd);
        $i->setId($id);
        $itens[] = $i;
      }
    }
    $mysqli->close();
    return $itens;
  }
}
