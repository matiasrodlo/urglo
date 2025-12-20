<?php
	$html = file_get_contents(__DIR__ . '/../index_desconectado.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_desconectado/header_desconectado.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_desconectado/footer_desconectado.html');
	
	$html = str_replace('{footer_desconectado}', $footer_desconectado, $html);
	$html = str_replace('{header_desconectado}', $header_desconectado, $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>