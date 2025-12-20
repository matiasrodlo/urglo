<?php
	$id_trabajo = $url[1];
	$html = file_get_contents(__DIR__ . '/../ver_trabajo_terminado.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_coach/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_coach/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');
	require_once(__DIR__ . '/menu.php');
	
	$coach = $usuarios->datos_usuario($datos_trabajo[0]['id_coach']);
	$personal_coach = $usuarios->datos_user_personal($datos_trabajo[0]['id_coach']);
	$cliente = $usuarios->datos_usuario($datos_trabajo[0]['id_usuario']);
	$personal_cliente = $usuarios->datos_user_personal($datos_trabajo[0]['id_usuario']);
	//print_r($datos_trabajo);
	
	$html = str_replace('{usuario_lol_trabajo}', $cliente[0]['usuario'], $html);
	$html = str_replace('{img_user}', $personal_cliente[0]['img_perfil'], $html);
	$html = str_replace('{user_coach}', $coach[0]['usuario'], $html);
	$html = str_replace('{img_coach}', $personal_coach[0]['img_perfil'], $html);
	$html = str_replace('{horas_compradas}', $datos_trabajo[0]['horas_contratadas'], $html);
	$html = str_replace('{horas_restantes}', $datos_trabajo[0]['horas_restantes'], $html);
	$html = str_replace('{tipo}', $datos_trabajo[0]['tipo'], $html);
	$html = str_replace('{id_trabajo}', $datos_trabajo[0]['id_trabajo_coach'], $html);
	$html = str_replace('{id_usuario}', $datos_trabajo[0]['id_usuario'], $html);
	$html = str_replace('{id_coach}', $datos_trabajo[0]['id_coach'], $html);
	$html = str_replace('{intereses}', $datos_trabajo[0]['intereses'], $html);
	$html = str_replace('{mensaje}', $datos_trabajo[0]['mensaje'], $html);

	/////////////////////// CHAT //////////////////////////
	$id_creador = $datos_trabajo[0]['id_usuario'];
	$id_user_responde = $datos_trabajo[0]['id_coach'];
	$chat = $mensajes->conversacion($id_creador, $id_user_responde);
	$html = str_replace('{id_conver}', $chat[0]['id_conversacion'], $html);
	$html = str_replace('{chat}', '', $html);
	///////////////////////////////////////////////////////

	$horas_compradas = $datos_trabajo[0]['horas_contratadas'];
	$horas_restantes = $datos_trabajo[0]['horas_restantes'];
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
		$porcentaje = substr($porcentaje, 0, 2);
	}
	$html = str_replace('{porcentaje_progress}', $porcentaje, $html);
	
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>