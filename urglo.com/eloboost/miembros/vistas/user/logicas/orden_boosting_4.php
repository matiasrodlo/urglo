<?php
	$orden = $pedidos->pedidos_ul($id_boosting);
	if($orden[0]['estado'] == 1)
	{
		require_once('vistas/user/logicas/orden_boosting_4_libre.php');
	}
	elseif($orden[0]['estado'] == 2)
	{
		require_once('vistas/user/logicas/orden_boosting_4_activa.php');
	}
	elseif($orden[0]['estado'] == 3)
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/boosting/mis_ordenes/');
	}
	elseif($orden[0]['estado'] == 4)
	{
		require_once('vistas/user/logicas/orden_boosting_4_terminada.php');
	}
	elseif($orden[0]['estado'] == 5)
	{
		require_once('vistas/user/logicas/orden_boosting_4_desocupada.php');
	}
?>