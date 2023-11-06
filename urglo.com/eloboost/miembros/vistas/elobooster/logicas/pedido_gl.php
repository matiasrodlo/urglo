<?php
	$id_boosting = $url[1];
	$orden = $pedidos->pedidos_gl($id_boosting);
	if($orden[0]['estado'] == 1)
	{
		header('Location: ../');
	}
	elseif($orden[0]['estado'] == 2)
	{
		require_once('vistas/elobooster/logicas/orden_boosting_1_activa.php');
	}
	elseif($orden[0]['estado'] == 3)
	{
		header('Location: ../');
	}
	elseif($orden[0]['estado'] == 4)
	{
		require_once('vistas/elobooster/logicas/orden_boosting_1_terminada.php');
	}
	elseif($orden[0]['estado'] == 5)
	{
		require_once('vistas/elobooster/logicas/orden_boosting_1_desocupada.php');
	}
?>