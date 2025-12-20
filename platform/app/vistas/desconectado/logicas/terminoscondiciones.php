<?php
	$html = file_get_contents(__DIR__ . '/../terminoscondiciones.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_desconectado/header_desconectado.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_desconectado/footer_desconectado.html');
	
	$html = str_replace('{footer_desconectado}', $footer_desconectado, $html);
	$html = str_replace('{header_desconectado}', $header_desconectado, $html);

	setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish');
	$fecha_actualizacion = strftime('%d de %B de %Y', time());
	if (!$fecha_actualizacion) {
		$fecha_actualizacion = date('d F Y');
	}
	
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	$html = str_replace('{fecha_actualizacion}', $fecha_actualizacion, $html);
	echo $html;
?>