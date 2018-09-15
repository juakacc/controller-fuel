<?php

class LoginController extends MainController {

  public function index() {
    require_once ABSPATH . '/views/login/login-view.php';
  }

  public function sair() {
    $this->logout();
    header('Location: ' . HOME_URI);
    exit;
  }
}
