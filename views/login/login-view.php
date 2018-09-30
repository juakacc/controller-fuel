<?php
include_once ABSPATH . '/views/_includes/header.php';
?>

<h3>Login</h3>

<form class="form" method="post">
  <?php if ($this->login_error): ?>
    <span class="form-text text-danger"><?= $this->login_error; ?></span>
	<?php endif; ?>

  <div class="form-group row">
    <label for="" class="col-form-label col-2">Usuário</label>
    <div class="col">
      <input type="text" name="userdata[username]" value="" class="form-control" required autofocus>
    </div>
  </div>

  <div class="form-group row">
    <label for="" class="col-form-label col-2">Senha</label>
    <div class="col">
      <input type="password" name="userdata[password]" value="" class="form-control" required >
    </div>
  </div>
  <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
</form>

<?php include_once ABSPATH . '/views/_includes/footer.php'; ?>
