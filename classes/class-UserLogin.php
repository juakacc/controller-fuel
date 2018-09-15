<?php

class UserLogin {

  public $login_error;

  public function check_userLogin() {

    if (isset($_SESSION['userdata']) &&
      ! empty($_SESSION['userdata']) &&
      is_array($_SESSION['userdata']) &&
      ! isset($_POST['userdata'])) {

        $userdata = $_SESSION['userdata'];
        $userdata['post'] = false;
    }

    if (isset($_POST['userdata']) &&
      ! empty($_POST['userdata']) &&
      is_array($_POST['userdata'])) {

        $userdata = $_POST['userdata'];
        $userdata['post'] = true;
    }

    if (! isset($userdata) || ! is_array($userdata)) {
      $this->logout();
      return;
    }

    if ($userdata['post'] === true) {
      $post = true;
    } else {
      $post = false;
    }
    unset($userdata['post']);

    if (empty($userdata)) {
      $this->logged_in = false;
      $this->login_error = null;
      $this->logout();
      return;
    }
    extract($userdata);

    if (! isset($username) || ! isset($password)) {
      $this->logged_in = false;
      $this->login_error = null;
      $this->logout();
      return;
    }

    $user_bd = UsuarioDao::getPorUserName($username);

    if (! $user_bd) {
      $this->logged_in = false;
      $this->login_error = 'Usuário inexistente';
      $this->logout();
      return;
    }

    if ($this->phpass->CheckPassword($password, $user_bd->getPassword())) {

      if (session_id() != $user_bd->getUserSessionId() && ! $post) {
        $this->logged_in = false;
        $this->login_error = 'Wrong session ID';
        $this->logout();
        return;
      }

      if ($post) {
        session_regenerate_id();
        $session_id = session_id();

        $_SESSION['userdata'] = $user_bd->getArray();
        $_SESSION['userdata']['password'] = $password;
        $_SESSION['userdata']['user_session_id'] = $session_id;

        UsuarioDao::updateSessionId($user_bd->getId(), $session_id);
      }

      $this->logged_in = true;
      $this->userdata = $_SESSION['userdata'];

      if (isset($_SESSION['goto_url'])) {
        $goto_url = urldecode($_SESSION['goto_url']);
        unset($_SESSION['goto_url']);
        header('Location: ' . $goto_url);
        exit;
      }
    } else {
      $this->logged_in = false;
      $this->login_error = 'Senha incorreto';
      $this->logout();
      return;
    }

  }

  protected function logout($redirect = false) {
    $_SESSION['userdata'] = array();
    unset($_SESSION['userdata']);
    session_regenerate_id();

    if ($redirect === true) {
      $this->goto_login();
    }
  }

  protected function goto_login() {
    if (defined('HOME_URI')) {
      $login_uri = HOME_URI . 'login/';

      $_SESSION['goto_url'] = urlencode($_SERVER['REQUEST_URI']);
      header('Location: ' . $login_uri);
      exit;
    }
    return;
  }

}
