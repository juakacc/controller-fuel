<?php

class RegisterController {

  public function carro() {

    $model = $this->load_model('veiculo-model');

    require_once ABSPATH . '/views/register-veiculo.php';
  }

  public function competencia() {
    require_once ABSPATH . '/views/register-competencia.php';
  }

  public function abastecimento() {
    require_once ABSPATH . '/views/register-abastecimento.php';
  }

  public function conserto() {
    require_once ABSPATH . '/views/register-conserto.php';
  }
}
