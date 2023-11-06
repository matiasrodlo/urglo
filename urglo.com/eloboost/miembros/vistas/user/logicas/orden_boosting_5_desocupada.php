<?php
	$html = file_get_contents('vistas/user/orden_boosting_5_desocupada.html');
	$header_desconectado = file_get_contents('vistas/user/plantilla_user/header.html');
	$footer_desconectado = file_get_contents('vistas/user/plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$html = str_replace('{tipo}', $orden[0]['nombre'], $html);
	$html = str_replace('{precio}', $orden[0]['precio'], $html);

	$html = str_replace('{wins}', $orden[0]['wins'], $html);
	$html = str_replace('{wins_current}', $orden[0]['wins_current'], $html);

	$league = level($orden[0]['id_level_inicio'], $orden[0]['id_division_inicio']);
	$html = str_replace('{img_league}', $league['imagen'], $html);
	$html = str_replace('{level}', $league['nombre'], $html);


	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>