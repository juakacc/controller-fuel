<?php
if (!defined('ABSPATH')) exit;

$evento = EventoDao::getPorId($abastecimento->getEventoId());
$veiculo = VeiculoDao::getPorId($evento->getIdVeiculo());

include_once ABSPATH . '/views/_includes/header.php';
?>

<a href="<?= $_SERVER['REQUEST_URI'] ?>">Voltar</a>

Veículo: <?= $veiculo->getNome(); ?><br>
Data: <?= data_para_mostrar($abastecimento->getData()); ?><br>
Tipo de combustível: <?= $abastecimento->getCombustivel(); ?><br>
Quantidade: <?= $abastecimento->getQtd(); ?>

<?php include_once ABSPATH . '/views/_includes/footer.php'; ?>
