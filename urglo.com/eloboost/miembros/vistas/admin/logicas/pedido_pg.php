<?php
	$id_boosting = $url[2];
	$orden = $pedidos->pedidos_pg($id_boosting);
	if($orden[0]['estado'] == 1)
	{
		require_once('vistas/admin/logicas/orden_boosting_3_libre.php');
	}
	elseif($orden[0]['estado'] == 2)
	{
		require_once('vistas/admin/logicas/orden_boosting_3_activa.php');
	}
	elseif($orden[0]['estado'] == 3)
	{
		require_once('vistas/admin/logicas/orden_boosting_3_cancelada.php');
	}
	elseif($orden[0]['estado'] == 4)
	{
		require_once('vistas/admin/logicas/orden_boosting_3_terminada.php');
	}
	elseif($orden[0]['estado'] == 5)
	{
		require_once('vistas/admin/logicas/orden_boosting_3_desocupada.php');
	}
?>