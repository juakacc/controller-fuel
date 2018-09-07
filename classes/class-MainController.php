<?php

class MainController {

  function load_model($model_name) {
    $name = ABSPATH . '/models/' . $model_name . '.php';
  }
}
