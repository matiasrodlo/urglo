<?php
	$id_trabajo = $url[2];
	$html = file_get_contents('vistas/admin/trabajo_activo.html');
	$header_desconectado = file_get_contents('vistas/admin/plantilla_admin/header.html');
	$footer_desconectado = file_get_contents('vistas/admin/plantilla_admin/footer.html');
		
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$trabajo = $trabajos->datos_trabajo($id_trabajo);

	$coach = $usuarios->datos_usuario($trabajo[0]['id_coach']);
	$personal_coach = $usuarios->datos_user_personal($trabajo[0]['id_coach']);
	//print_r($coach);
	//print_r($trabajo);
	//print_r($personal_coach);
	$horas_compradas = $trabajo[0]['horas_contratadas'];
	$horas_restantes = $trabajo[0]['horas_restantes'];
	if($horas_restantes == '0')
	{
		$porcentaje = '100';
	}
	elseif($horas_restantes == $horas_compradas)
	{
		$porcentaje = '0';
	}
	else
	{
		$porcentaje = ($horas_restantes*100)/$horas_compradas;
		$x = $porcentaje;
		$porcentaje = 100 - $x;
	}
	$html = str_replace('{porcentaje_progress}', $porcentaje, $html);
	$html = str_replace('{horas_compradas}', $horas_compradas, $html);
	$html = str_replace('{horas_restantes}', $horas_restantes, $html);

	$html = str_replace('{precio_total}', $trabajo[0]['total'], $html);
	$html = str_replace('{user_coach}', $coach[0]['usuario'], $html);
	$html = str_replace('{img_coach}', $personal_coach[0]['img_perfil'], $html);
	$html = str_replace('{tipo}', $trabajo[0]['tipo'], $html);
	$html = str_replace('{id_trabajo}', $trabajo[0]['id_trabajo_coach'], $html);
	
	/////////////////////// CHAT //////////////////////////
	$html = str_replace('{chat}', '', $html);
	///////////////////////////////////////////////////////

	$html = str_replace('{id_usuario}', $trabajo[0]['id_usuario'], $html);
	$html = str_replace('{id_coach}', $trabajo[0]['id_coach'], $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>