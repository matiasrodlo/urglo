<?php
	$id_trabajo = $url[1];
	$datos_trabajo = $trabajos->datos_trabajo($id_trabajo);
	if($datos_trabajo[0]['estado'] == '1')
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros/trabajos');
	}
	elseif($datos_trabajo[0]['estado'] == '2')
	{
		require_once('vistas/coach/logicas/ver_trabajo_activo.php');
	}
	elseif($datos_trabajo[0]['estado'] == '3')
	{
		require_once('vistas/coach/logicas/ver_trabajo_cancelado.php');
	}
	elseif($datos_trabajo[0]['estado'] == '4')
	{
		require_once('vistas/coach/logicas/ver_trabajo_terminado.php');
	}
?>