<?php
	$html = file_get_contents('vistas/elobooster/orden_boosting_2_desocupada.html');
	$header_desconectado = file_get_contents('vistas/elobooster/plantilla_elo/header.html');
	$footer_desconectado = file_get_contents('vistas/elobooster/plantilla_elo/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$html = str_replace('{tipo}', $orden[0]['nombre'], $html);
	$html = str_replace('{precio}', $orden[0]['precio'], $html);

	////////////////////// CLIENTE ////////////////////////////
	$id_cliente = $orden[0]['id_usuario'];
	$datos_cliente = $usuarios->datos_usuario($id_cliente);
	$datos_personal_cliente = $usuarios->datos_user_personal($id_cliente);
	$server = $usuarios->server_lol($orden[0]['id_server_lol']);

	$html = str_replace('{usuario_user}', $datos_cliente[0]['usuario'], $html);
	$html = str_replace('{img_user}', $datos_personal_cliente[0]['img_perfil'], $html);
	$html = str_replace('{correo_paypal_user}', $datos_personal_cliente[0]['pp_correo'], $html);
	$html = str_replace('{nick_lol}', $orden[0]['nick_lol'], $html);
	$html = str_replace('{server_lol_user}', $server[0]['nombre'], $html);

	////////////////////// PEDIDO /////////////////////////////
	$html = str_replace('{id_pedido}', $orden[0]['id_pedido'], $html);
	
	$league = level($orden[0]['id_level'], $orden[0]['id_division']);
	$html = str_replace('{img_league}', $league['imagen'], $html);
	$html = str_replace('{level}', $league['nombre'], $html);

	$html = str_replace('{games}', $orden[0]['games'], $html);
	$html = str_replace('{games_current}', $orden[0]['games_current'], $html);

	$html = str_replace('{precio}', $orden[0]['precio'], $html);
	$html = str_replace('{precio_elo}', $orden[0]['precio_elo'], $html);
	$html = str_replace('{fecha}', $orden[0]['fecha'], $html);
	$html = str_replace('{hora}', $orden[0]['hora'], $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>