<?php
if (!defined('ABSPATH')) exit;

$model->validar_form_remover();

$competencia = CompetenciaDao::getPorId($this->parameters[0]);
require_once ABSPATH . '/views/_includes/header.php';
?>

<h3>Confirmar remoção de competência</h3>

<form class="form" method="post">
  <p>Deseja realmente remover a competência #<?= $competencia->getId() ?>?
    <span class="text-danger">(Essa ação não poderá ser desfeita)</span></p>
  <?php include_once ABSPATH . '/views/_includes/btn_forms.php'; ?>
</form>

<?php require_once ABSPATH . '/views/_includes/footer.php'; ?>
