<?php

class Usuario {

  private $id;
  private $username;
  private $password;
  private $name;
  private $email;
  private $user_session_id;

  public function __construct($username, $password, $name, $email) {
    $this->username = $username;
    $this->password = $password;
    $this->name = $name;
    $this->email = $email;
  }

  public function getArray() {
    return array(
      'id'              => $this->id,
      'username'        => $this->username,
      'password'        => $this->password,
      'name'            => $this->name,
      'email'           => $this->email,
      'user_session_id' => $this->user_session_id
    );
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getUsername() {
    return $this->username;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getName() {
    return $this->name;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setUserSessionId($id) {
    $this->user_session_id = $id;
  }

  public function getUserSessionId() {
    return $this->user_session_id;
  }
}
