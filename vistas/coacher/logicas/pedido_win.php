<?php
	$id_coaching = $url[1];
	$orden = $pedidos->pedidos_win($id_coaching);
	if($orden[0]['estado'] == 1)
	{
		header('Location: ../');
	}
	elseif($orden[0]['estado'] == 2)
	{
		require_once('vistas/coacher/logicas/orden_coaching_5_activa.php');
	}
	elseif($orden[0]['estado'] == 3)
	{
		header('Location: ../');
	}
	elseif($orden[0]['estado'] == 4)
	{
		require_once('vistas/coacher/logicas/orden_coaching_5_terminada.php');
	}
	elseif($orden[0]['estado'] == 5)
	{
		require_once('vistas/coacher/logicas/orden_coaching_5_desocupada.php');
	}
?>