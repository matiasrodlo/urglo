<?php
	$orden = $pedidos->pedidos_win($id_coaching);
	if($orden[0]['estado'] == 1)
	{
		require_once('vistas/user/logicas/orden_coaching_5_libre.php');
	}
	elseif($orden[0]['estado'] == 2)
	{
		require_once('vistas/user/logicas/orden_coaching_5_activa.php');
	}
	elseif($orden[0]['estado'] == 3)
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros/coaching/mis_ordenes/');
	}
	elseif($orden[0]['estado'] == 4)
	{
		require_once('vistas/user/logicas/orden_coaching_5_terminada.php');
	}
	elseif($orden[0]['estado'] == 5)
	{
		require_once('vistas/user/logicas/orden_coaching_5_desocupada.php');
	}
?>