<?php
	$html = file_get_contents('vistas/coacher/orden_coaching_4_terminada.html');
	$header_desconectado = file_get_contents('vistas/coacher/plantilla_elo/header.html');
	$footer_desconectado = file_get_contents('vistas/coacher/plantilla_elo/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$html = str_replace('{id_trabajo}', $orden[0]['id_pedido'], $html);
	$html = str_replace('{id_usuario}', $orden[0]['id_usuario'], $html);
	$html = str_replace('{tipo}', $orden[0]['nombre'], $html);
	$html = str_replace('{precio}', $orden[0]['precio'], $html);
	$html = str_replace('{precio_elo}', $orden[0]['precio_elo'], $html);
	$html = str_replace('{fecha}', $orden[0]['fecha'], $html);
	$html = str_replace('{hora}', $orden[0]['hora'], $html);

	$started = level($orden[0]['id_level_current'], '0');
	$html = str_replace('{img_started}', $started['imagen'], $html);
	$html = str_replace('{level_started}', $started['nombre'], $html);

	$current = level($orden[0]['id_level_current'], '0');
	$html = str_replace('{img_current}', $current['imagen'], $html);
	$html = str_replace('{level_current}', $current['nombre'], $html);
	
	$desired = level($orden[0]['id_level_llegada'], $orden[0]['id_division_llegada']);
	$html = str_replace('{img_desired}', $desired['imagen'], $html);
	$html = str_replace('{level_desired}', $desired['nombre'], $html);

	/////////// coacher /////////
	$elo = $usuarios->datos_usuario($orden[0]['id_coacher']);
	$elo_personal = $usuarios->datos_user_personal($orden[0]['id_coacher']);
	$html = str_replace('{user_coacher}', $elo[0]['usuario'], $html);
	$html = str_replace('{id_elo}', $orden[0]['id_coacher'], $html);
	$html = str_replace('{correo_paypal_elo}', $elo_personal[0]['pp_correo'], $html);
	$html = str_replace('{img_coacher}', $elo_personal[0]['img_perfil'], $html);

	////////////////////// CLIENTE ////////////////////////////
	$id_cliente = $orden[0]['id_usuario'];
	$datos_cliente = $usuarios->datos_usuario($id_cliente);
	$datos_personal_cliente = $usuarios->datos_user_personal($id_cliente);
	$server = $usuarios->server_lol($orden[0]['id_server_lol']);

	$html = str_replace('{usuario_user}', $datos_cliente[0]['usuario'], $html);
	$html = str_replace('{img_user}', $datos_personal_cliente[0]['img_perfil'], $html);
	$html = str_replace('{correo_paypal_user}', $datos_personal_cliente[0]['pp_correo'], $html);
	$html = str_replace('{usuario_lol}', $orden[0]['usuario_lol'], $html);
	$html = str_replace('{pass_lol}', $orden[0]['pass_lol'], $html);
	$html = str_replace('{server_lol_user}', $server[0]['nombre'], $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>