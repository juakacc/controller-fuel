<?php

class HomeController extends MainController {

  public function index() {
    include_once ABSPATH . '/views/index-view.php';
  }

}
