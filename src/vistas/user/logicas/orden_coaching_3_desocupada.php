<?php
	$html = file_get_contents('vistas/user/orden_coaching_3_desocupada.html');
	$header_desconectado = file_get_contents('vistas/user/plantilla_user/header.html');
	$footer_desconectado = file_get_contents('vistas/user/plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');
	
	$html = str_replace('{tipo}', $orden[0]['nombre'], $html);
	$html = str_replace('{precio}', $orden[0]['precio'], $html);

	$html = str_replace('{wins}', $orden[0]['number_wins'], $html);
	$html = str_replace('{wins_current}', $orden[0]['number_wins_current'], $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>