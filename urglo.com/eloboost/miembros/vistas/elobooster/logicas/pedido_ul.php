<?php
	$id_boosting = $url[1];
	$orden = $pedidos->pedidos_ul($id_boosting);
	if($orden[0]['estado'] == 1)
	{
		header('Location: ../');
	}
	elseif($orden[0]['estado'] == 2)
	{
		require_once('vistas/elobooster/logicas/orden_boosting_4_activa.php');
	}
	elseif($orden[0]['estado'] == 3)
	{
		header('Location: ../');
	}
	elseif($orden[0]['estado'] == 4)
	{
		require_once('vistas/elobooster/logicas/orden_boosting_4_terminada.php');
	}
	elseif($orden[0]['estado'] == 5)
	{
		require_once('vistas/elobooster/logicas/orden_boosting_4_desocupada.php');
	}
?>