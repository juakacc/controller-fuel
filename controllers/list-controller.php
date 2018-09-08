<?php

class ListController extends MainController {

  public function veiculos() {

    require_once ABSPATH . '/views/list-veiculos-view.php';
  }

  public function competencias() {
    require_once ABSPATH . '/views/list-competencias-view.php';
  }

  public function abastecimentos() {
    require_once ABSPATH . '/views/list-abastecimentos-view.php';
  }

  public function consertos() {
    require_once ABSPATH . '/views/list-consertos-view.php';
  }
}
