<?php
	$id_trabajo = $url[2];
	$trabajo = $trabajos->datos_trabajo($id_trabajo);
	if($trabajo[0]['estado'] == '1')
	{
		require_once('vistas/user/logicas/orden_coach_libre.php');
	}
	elseif($trabajo[0]['estado'] == '2')
	{
		require_once('vistas/user/logicas/orden_coach_activa.php');
	}
	elseif($trabajo[0]['estado'] == '3')
	{
		header('Location: '.RUTA_INDEX.'coachs/mis_ordenes/');
	}
	elseif($trabajo[0]['estado'] == '4')
	{
		require_once('vistas/user/logicas/orden_coach_terminada.php');
	}
?>