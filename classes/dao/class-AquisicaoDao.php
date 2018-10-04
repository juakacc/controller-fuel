<?php

class AquisicaoDao {

  public static function adicionarAquisicao(Aquisicao $a) {
    $mysqli = getConexao();
    $sql = "INSERT INTO aquisicao (data, evento_id) VALUES (?,?)";
    $data = $a->getData();
    $evento_id = $a->getEventoId();
    $itens = $a->getItens();

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("si", $data, $evento_id);

        if ($stmt->execute()){
          $id = AquisicaoDao::getUltimoId();
          ItemDao::adicionarItens($itens, $id);
        }
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function getUltimoId() {
    $sql = "SELECT id FROM aquisicao ORDER BY id DESC LIMIT 1";
    $mysqli = getConexao();
    $id = 0;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($i);

        if ($stmt->fetch()) $id = $i;
        $stmt->close();
    }
    $mysqli->close();
    return $id;
  }

  public static function removerAquisicao($id) {
    $mysqli = getConexao();
    $sql = "DELETE FROM aquisicao WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    $mysqli->close();
  }

  public static function editarAquisicao(Aquisicao $a) {
    // Falta
  }

  public static function getPorId($id) {
    $mysqli = getConexao();
    $sql = "SELECT data, evento_id FROM aquisicao WHERE id = ?";
    $aquisicao = null;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $stmt->bind_result($data, $evento_id);

      if ($stmt->fetch()) {
        $itens = ItemDao::getPorAquisicaoId($id);
        $aquisicao = new Aquisicao($itens, $data, $evento_id);
        $aquisicao->setId($id);
      }
    }
    $mysqli->close();
    return $aquisicao;
  }

  public static function getAquisicoes() {
    $mysqli = getConexao();
    $sql = "SELECT id FROM aquisicao";
    $aquisicoes = array();

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->execute();
      $stmt->bind_result($id);

      while ($stmt->fetch()) {
        $a = AquisicaoDao::getPorId($id);
        $aquisicoes[] = $a;
      }
      $stmt->close();
    }
    $mysqli->close();
    return $aquisicoes;
  }

  public static function getPorEvento($evento_id) {
    $mysqli = getConexao();
    $sql = "SELECT id FROM aquisicao WHERE evento_id = ?";
    $aquisicao = null;

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $evento_id);
        $stmt->execute();
        $stmt->bind_result($id);

        if ($stmt->fetch()) {
          $aquisicao = AquisicaoDao::getPorId($id);
        }
        $stmt->close();
    }
    $mysqli->close();
    return $aquisicao;
  }

  // public static function eventoTem($evento_id) {
  //   $mysqli = getConexao();
  //   $tem = false;
  //   $sql = "SELECT id FROM aquisicao WHERE evento_id = ?";
  //
  //   if ($stmt = $mysqli->prepare($sql)) {
  //       $stmt->bind_param("i", $evento_id);
  //       $stmt->execute();
  //       $stmt->bind_result($id);
  //
  //       if ($stmt->fetch())
  //         $tem = true;
  //       $stmt->close();
  //   }
  //   $mysqli->close();
  //   return $tem;
  // }


}
