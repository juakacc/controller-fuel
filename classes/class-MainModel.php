<?php

class MainModel {

  private $form_data;
  private $form_msg;
  public $controller;

  public function __construct($controller = null) {
    $this->form_data = array();
    $this->form_msg = array();
    $this->controller = $controller;
  }
}
