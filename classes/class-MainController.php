<?php

class MainController extends UserLogin {

  public $parameters = array();
  public $phpass;
  private $login_required = false;

  public $breadcrumb;

  public function __construct($parameters = null) {
    $this->parameters = $parameters;
    $this->phpass = new PasswordHash(8, false);
    $this->breadcrumb = array();

    $this->check_userLogin();
  }

  public function load_model($model_name = false) {
    if (! $model_name) return;

    $model_name = strtolower($model_name);
    $model_path = ABSPATH . '/models/' . $model_name . '.php';

    if (file_exists($model_path)) {
      require_once $model_path;

      $model_name = explode('/', $model_name);
      $model_name = end($model_name);

      $model_name = preg_replace('/[^a-zA-Z0-9]/is', '', $model_name);

      if (class_exists($model_name)) {
        return new $model_name($this);
      }
    }
  }
}
