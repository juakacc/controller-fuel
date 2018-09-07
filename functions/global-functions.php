<?php

function __autoload($class_name) {
  $name = ABSPATH . '/classes/class-' . $class_name . '.php';

  if (! file_exists($name)) {
    require_once ABSPATH . '/includes/404.php';
    return;
  }
  require_once $name;
}

function check_array($array, $key) {
  if (isset($array[$key]) && ! empty($array[$key])) {
    return $array[$key];
  }
  return null;
}
