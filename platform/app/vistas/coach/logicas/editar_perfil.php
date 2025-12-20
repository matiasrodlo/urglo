<?php
	$html = file_get_contents(__DIR__ . '/../editar_perfil.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_coach/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_coach/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');
	require_once(__DIR__ . '/menu.php');

	$html = str_replace('{nombre}', isset($datos_personal[0]['nombre']) ? $datos_personal[0]['nombre'] : '', $html);
	$html = str_replace('{apellido}', isset($datos_personal[0]['apellido']) ? $datos_personal[0]['apellido'] : '', $html);
	$html = str_replace('{correo}', isset($datos_personal[0]['correo']) ? $datos_personal[0]['correo'] : '', $html);
	$html = str_replace('{pp_email}', isset($datos_personal[0]['pp_correo']) ? $datos_personal[0]['pp_correo'] : '', $html);
	$html = str_replace('{telefono}', isset($datos_personal[0]['telefono']) ? $datos_personal[0]['telefono'] : '', $html);
	$html = str_replace('{pais}', isset($datos_personal[0]['pais']) ? $datos_personal[0]['pais'] : '', $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>