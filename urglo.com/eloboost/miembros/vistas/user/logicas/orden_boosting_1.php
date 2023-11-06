<?php
	$orden = $pedidos->pedidos_gl($id_boosting);
	if($orden[0]['estado'] == 1)
	{
		require_once('vistas/user/logicas/orden_boosting_1_libre.php');
	}
	elseif($orden[0]['estado'] == 2)
	{
		require_once('vistas/user/logicas/orden_boosting_1_activa.php');
	}
	elseif($orden[0]['estado'] == 3)
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/boosting/mis_ordenes/');
	}
	elseif($orden[0]['estado'] == 4)
	{
		require_once('vistas/user/logicas/orden_boosting_1_terminada.php');
	}
	elseif($orden[0]['estado'] == 5)
	{
		require_once('vistas/user/logicas/orden_boosting_1_desocupada.php');
	}
?>