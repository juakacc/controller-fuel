<?php

class RegisterController extends MainController {

  public function veiculo() {

    $model = $this->load_model('veiculo-model');

    require_once ABSPATH . '/views/register/register-veiculo.php';
  }

  public function competencia() {

    $model = $this->load_model('competencia-model');
    require_once ABSPATH . '/views/register/register-competencia.php';
  }

  public function abastecimento() {
    $model = $this->load_model('abastecimento-model');
    require_once ABSPATH . '/views/register/register-abastecimento.php';
  }

  public function conserto() {
    $model = $this->load_model('conserto-model');
    require_once ABSPATH . '/views/register/register-conserto.php';
  }

  public function aquisicao() {
    $model = $this->load_model('aquisicao-model');
    require_once ABSPATH . '/views/register/register-aquisicao.php';
  }
}
