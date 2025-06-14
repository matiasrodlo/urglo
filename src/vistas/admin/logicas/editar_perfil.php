<?php
	$html = file_get_contents('vistas/admin/editar_perfil.html');
	$header_desconectado = file_get_contents('vistas/admin/plantilla_admin/header.html');
	$footer_desconectado = file_get_contents('vistas/admin/plantilla_admin/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$html = str_replace('{nombre}', $datos_personal[0]['nombre'], $html);
	$html = str_replace('{apellido}', $datos_personal[0]['apellido'], $html);
	$html = str_replace('{correo}', $datos_personal[0]['correo'], $html);
	$html = str_replace('{pp_email}', $datos_personal[0]['pp_correo'], $html);
	$html = str_replace('{telefono}', $datos_personal[0]['telefono'], $html);
	$html = str_replace('{pais}', $datos_personal[0]['pais'], $html);
	$html = str_replace('{username_lol}', $datos_lol[0]['username'], $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>