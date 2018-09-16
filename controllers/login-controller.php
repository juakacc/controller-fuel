<?php

class LoginController extends MainController {

  public function index() {

    if ($this->logged_in) {
      header('Location: ' . HOME_URI);
      exit;
    }
    require_once ABSPATH . '/views/login/login-view.php';
  }

  public function sair() {
    $this->logout();
    header('Location: ' . HOME_URI);
    exit;
  }
}
