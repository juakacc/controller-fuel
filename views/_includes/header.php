<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?= HOME_URI ?>views/_css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="icon" type="imagem/png" href="<?= HOME_URI ?>/views/_includes/car.svg" />
    <title>Controle de veículos - PMO</title>
  </head>
  <body class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="<?= HOME_URI ?>">PMO - Veículos</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?= HOME_URI ?>"><i class="fas fa-home"></i> Início</a>
          </li>
          <!--
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
        </ul>

        <?php if (isset($this->logged_in) && $this->logged_in): ?>
          <span class="navbar-text mr-2">Bem-vindo, <?= $this->userdata['name']; ?></span>
          <a href="<?= HOME_URI . 'login/sair'; ?>" class="btn btn-outline-danger"><i class="fas fa-sign-in-alt"></i> Sair</a>
        <?php else: ?>
          <span class="navbar-text mr-2">Bem-vindo, Cidadão</span>
          <a href="<?= HOME_URI . 'login'; ?>" class="btn btn-outline-primary"><i class="fas fa-sign-in-alt"></i> Área restrita</a>
        <?php endif; ?>
      </div>
    </nav>

    <div class="row">
      <div class="col">
        <h1>Gerenciamento de combustíveis/serviços - PMO</h1>
      </div>
    </div>

    <!-- <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= HOME_URI ?>">Início</a></li>
        <?php foreach ($this->breadcrumb as $key => $value): ?>
          <li class="breadcrumb-item active" aria-current="page"><a href="<?= $value ?>"><?= $key ?></a></li>
        <?php endforeach; ?>
      </ol>
    </nav> -->

    <div class="row justify-content-center">
      <div class="col-10">
        <div> <!-- mensagens -->
          <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
            <?php foreach ($_SESSION['messages'] as $msg): ?>
              <div class="alert alert-primary" role="alert">
                <?= $msg ?>
              </div>
            <?php endforeach; ?>
            <?php $_SESSION['messages'] = array(); ?>
          <?php endif; ?>
        </div>
