<?php
	$html = file_get_contents('vistas/admin/enviar_mensaje.html');
	$header_desconectado = file_get_contents('vistas/admin/plantilla_admin/header.html');
	$footer_desconectado = file_get_contents('vistas/admin/plantilla_admin/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>