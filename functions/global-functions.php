<?php

function getConexao() {
  return new mysqli(DB_LOCAL, DB_USER, DB_PASS, DB_BASE);
}

function __autoload($class_name) {
  $name = ABSPATH . '/classes/class-' . $class_name . '.php';
  $name2 = ABSPATH . '/classes/dao/class-' . $class_name . '.php';

  if (! file_exists($name) && ! file_exists($name2)) {
    require_once ABSPATH . '/includes/404.php';
    return;
  }
  if (file_exists($name)) require_once $name;
  if (file_exists($name2)) require_once $name2;
}

function check_array($array, $key) {
  if (isset($array[$key]) && ! empty($array[$key])) {
    return $array[$key];
  }
  return null;
}

**
 * Valida uma data no formato dd/mm/aaaa ou aaaa-mm-dd,
 * retornando um boolean de acordo
 * com o resultado
 * @param $data
 * @return bool
 */
function validar_data($data) {
    $padrao = "/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/";
    $padrao2 = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/";

    if (preg_match($padrao, $data)) {
        $a = explode('/', $data);
        return checkdate($a[1], $a[0], $a[2]);
    } else if (preg_match($padrao2, $data)) {
        $a = explode('-', $data);
        return checkdate($a[1], $a[2], $a[0]);
    } else {
        return false;
    }
}

// recebe no formato aaaa-mm-dd
// retorna no formato dd/mm/aaaa
function mostrar_data($data) {
    $a = explode('-', $data);
    return $a[2] . '/' . $a[1] . '/' . $a[0];
}

// recebe no formato dd/mm/aaaa
// retorna no formato aaaa-mm-dd
function transformarParaBanco($data) {
    $a = explode('/', $data);
    return $a[2] . '-' . $a[1] . '-' . $a[0];
}
