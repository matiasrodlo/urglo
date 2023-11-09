<?php
	$id_coaching = $url[2];
	$pedido = $pedidos->pedidos_coaching($id_coaching);
	$tipo = $pedido[0]['tipo_pedido'];

	if($tipo == 1)
	{
		require_once('vistas/user/logicas/orden_coaching_1.php');
	}
	elseif($tipo == 2)
	{
		require_once('vistas/user/logicas/orden_coaching_2.php');
	}
	elseif($tipo == 3)
	{
		require_once('vistas/user/logicas/orden_coaching_3.php');
	}
	elseif($tipo == 4)
	{
		require_once('vistas/user/logicas/orden_coaching_4.php');
	}
	elseif($tipo == 5)
	{
		require_once('vistas/user/logicas/orden_coaching_5.php');
	}
	else
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros/coaching/mis_ordenes/');
	}
?>