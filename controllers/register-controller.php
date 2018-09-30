<?php

class RegisterController extends MainController {

  public function veiculo() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $model = $this->load_model('veiculo-model');

    require_once ABSPATH . '/views/register/register-veiculo.php';
  }

  public function evento() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $model = $this->load_model('evento-model');
    require_once ABSPATH . '/views/register/evento-register-view.php';
  }

  public function abastecimento() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $model = $this->load_model('abastecimento-model');
    require_once ABSPATH . '/views/register/register-abastecimento.php';
  }

  public function conserto() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $model = $this->load_model('conserto-model');
    require_once ABSPATH . '/views/register/register-conserto.php';
  }

  public function aquisicao() {
    if (! $this->logged_in) {
      $this->logout(true);
      return;
    }
    $model = $this->load_model('aquisicao-model');
    require_once ABSPATH . '/views/register/register-aquisicao.php';
  }
}
