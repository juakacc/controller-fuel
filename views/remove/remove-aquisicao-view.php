<?php
if (!defined('ABSPATH')) exit;

$model->validar_form_remover();

require_once ABSPATH . '/views/_includes/header.php';
?>

<h3>Confirmar remoção de aquisição</h3>

<form class="form" method="post">
  <p>Deseja realmente remover a aquisição #<?= $aquisicao->getId() ?>?
    <span class="text-danger">(Essa ação não poderá ser desfeita)</span></p>
  <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
</form>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
