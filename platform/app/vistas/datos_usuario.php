<?php
/************************** Usuario Logeado ************************************/
	$id_usuario = $_SESSION['id_usuario'];
	$datos_cuenta = $usuarios->datos_usuario($id_usuario);
	$datos_personal = $usuarios->datos_user_personal($id_usuario);
	$html = str_replace('{username_platform}', $datos_cuenta[0]['usuario'], $html);
	$html = str_replace('{correo_user}', $datos_personal[0]['correo'], $html);
	$html = str_replace('{user_profile_img}', $datos_personal[0]['img_perfil'], $html);
	$html = str_replace('{img_perfil}', $datos_personal[0]['img_perfil'], $html);
	$pais_usuario = $datos_personal[0]['pais'];
	$vistos = $mensajes->mensajes_visto($id_usuario, '0');
	if($vistos == '')
	{
		$html = str_replace('{mensajes_recibidos}', '0', $html);
		$html = str_replace('{css_msj}', '', $html);
	}
	else
	{	$mensajes_recibidos = count($vistos);
		$html = str_replace('{mensajes_recibidos}', $mensajes_recibidos, $html);
		$html = str_replace('{css_msj}', 'style="background-color: #4da54e"', $html);
	}
	$time = time();
	$html = str_replace('{time}', $time, $html);
/*******************************************************************************/
?>