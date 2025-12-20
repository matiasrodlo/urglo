<?php
	$id_coaching = $url[2];
	$orden = $pedidos->pedidos_coaching($id_coaching);
	require_once('vistas/admin/logicas/pedido_coach.php');
?>