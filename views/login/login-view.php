<?php

include_once ABSPATH . '/views/_includes/header.php';
?>

<h3>Login</h3>

<form class="form" method="post">
  <?php
		if ( $this->login_error ) {
			echo '<tr><td colspan="2" class="error">' . $this->login_error . '</td></tr>';
		}
	?>
  <div class="form-group row">
    <label for="" class="col-form-label col">Username</label>
    <div class="col">
      <input type="text" name="userdata[username]" value="" class="form-control">
    </div>
  </div>

  <div class="form-group row">
    <label for="" class="col-form-label col">Password</label>
    <div class="col">
      <input type="password" name="userdata[password]" value="" class="form-control">
    </div>
  </div>
  <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
</form>

<?php include_once ABSPATH . '/views/_includes/footer.php'; ?>
