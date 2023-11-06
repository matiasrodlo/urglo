<?php
	$id_boosting = $url[2];
	$pedido = $pedidos->pedidos_boosting($id_boosting);
	$tipo = $pedido[0]['tipo_pedido'];

	if($tipo == 1)
	{
		require_once('vistas/user/logicas/orden_boosting_1.php');
	}
	elseif($tipo == 2)
	{
		require_once('vistas/user/logicas/orden_boosting_2.php');
	}
	elseif($tipo == 3)
	{
		require_once('vistas/user/logicas/orden_boosting_3.php');
	}
	elseif($tipo == 4)
	{
		require_once('vistas/user/logicas/orden_boosting_4.php');
	}
	elseif($tipo == 5)
	{
		require_once('vistas/user/logicas/orden_boosting_5.php');
	}
	else
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/boosting/mis_ordenes/');
	}
?>