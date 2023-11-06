<?php
	$id_pedido = $url[1];
	$html = file_get_contents('vistas/elobooster/ver_pedido.html');
	$header_desconectado = file_get_contents('vistas/elobooster/plantilla_elo/header.html');
	$footer_desconectado = file_get_contents('vistas/elobooster/plantilla_elo/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$datos_pedido = $pedidos->datos_pedido($id_pedido);
	print_r($datos_pedido);
	$html = str_replace('{usuario_lol_pedido}', $datos_pedido[0]['usuario_lol'], $html);
	
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>