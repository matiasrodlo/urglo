<?php
	$html = file_get_contents('vistas/user/orden_coaching_1_terminada.html');
	$header_desconectado = file_get_contents('vistas/user/plantilla_user/header.html');
	$footer_desconectado = file_get_contents('vistas/user/plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$html = str_replace('{tipo}', $orden[0]['nombre'], $html);
	$html = str_replace('{precio}', $orden[0]['precio'], $html);

	$started = level($orden[0]['id_level_inicio'], $orden[0]['id_division_inicio']);
	$html = str_replace('{img_started}', $started['imagen'], $html);
	$html = str_replace('{level_started}', $started['nombre'], $html);

	$current = level($orden[0]['id_level_current'], $orden[0]['id_division_current']);
	$html = str_replace('{img_current}', $current['imagen'], $html);
	$html = str_replace('{level_current}', $current['nombre'], $html);
	
	$desired = level($orden[0]['id_level_llegada'], $orden[0]['id_division_llegada']);
	$html = str_replace('{img_desired}', $desired['imagen'], $html);
	$html = str_replace('{level_desired}', $desired['nombre'], $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>