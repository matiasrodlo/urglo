<?php
	$html = file_get_contents('vistas/coacher/enviar_mensaje.html');
	$header_desconectado = file_get_contents('vistas/coacher/plantilla_elo/header.html');
	$footer_desconectado = file_get_contents('vistas/coacher/plantilla_elo/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>