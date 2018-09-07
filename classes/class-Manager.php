<?php

class Manager {

  private $controller;
  private $method;
  private $parameters;
  private $page_not_found = '/includes/404.php';

  public function __construct() {
    $this->get_url_data();

    if (! $this->controller) {
      require_once ABSPATH . '/controllers/home-controller.php';
      $this->controller = new HomeController();
      $this->controller->index();
      return;
    }

    if (! file_exists(ABSPATH . '/controllers/' . $this->controller . '.php')) {
      require_once ABSPATH . $this->page_not_found;
      return;
    }

    require_once ABSPATH . '/controllers/' . $this->controller . '.php';

    $this->controller = preg_replace('/[^a-zA-Z]/i', '', $this->controller);

    if (! class_exists($this->controller)) {
      require_once ABSPATH . $this->page_not_found;
      return;
    }

    $this->controller = new $this->controller($this->parameters);

    $this->method = preg_replace('/[^a-zA-Z]/i', '', $this->method);

    if (method_exists($this->controller, $this->method)) {
      $this->controller->{$this->method}($this->parameters);
      return;
    }

    if (method_exists($this->controller, 'index')) {
      $this->controller->index($this->parameters);
      return;
    }

    require_once ABSPATH . $this->page_not_found;
    return;
  }

  private function get_url_data() {

    if (isset($_GET['path'])) {

      $path = $_GET['path'];

      $path = rtrim($path, '/');
      $path = filter_var($path, FILTER_SANITIZE_URL);

      $path = explode('/', $path);

      $this->controller = check_array($path, 0);
      $this->controller .= '-controller';
      $this->method = check_array($path, 1);

      if (check_array($path, 2)) {
        unset($path[0]);
        unset($path[1]);
        $this->parameters = array_values($path);
      }
    }

    if (defined(DEBUG) && DEBUG) {
			echo $this->controlador . '<br>';
			echo $this->acao        . '<br>';
			echo '<pre>';
			   print_r( $this->parametros );
			echo '</pre>';
    }

  }

}
