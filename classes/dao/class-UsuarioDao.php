<?php

class UsuarioDao {

  public static function adicionarUsuario($usuario) {
    $mysqli = getConexao();
    $sql = "INSERT INTO usuario (username, password, user_session_id, name, email) VALUES (?,?,?,?,?)";
    $username = $usuario->getUsername();
    $password = $usuario->getPassword();
    $user_session_id = $usuario->getUserSessionId();
    $name = $usuario->getName();
    $email = $usuario->getEmail();

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("sssss", $username, $password, $user_session_id, $name, $email);
      $stmt->execute();
      $stmt->close();
    }
    $mysqli->close();
  }

  public static function getPorUserName($username) {
    $mysqli = getConexao();
    $sql = "SELECT id, password, name, email, user_session_id FROM usuario WHERE username = ?";
    $user = null;

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $stmt->bind_result($id, $password, $name, $email, $user_session_id);

      if ($stmt->fetch()) {
        $user = new Usuario($username, $password, $name, $email);
        $user->setId($id);
        $user->setUserSessionId($user_session_id);
      }
      $stmt->close();
    }
    $mysqli->close();
    return $user;
  }

  public static function updateSessionId($id, $session_id) {
    $mysqli = getConexao();
    $sql = "UPDATE usuario SET user_session_id = ? WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("si", $session_id, $id);
      $stmt->execute();
      $stmt->close();
    }
    $mysqli->close();
  }

}
