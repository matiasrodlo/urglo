<?php
	$html = file_get_contents(__DIR__ . '/../termionosycondiciones.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_user/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>