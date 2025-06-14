<?php
	$id_trabajo = $url[2];
	$html = file_get_contents('vistas/admin/trabajo_cancelado.html');
	$header_desconectado = file_get_contents('vistas/admin/plantilla_admin/header.html');
	$footer_desconectado = file_get_contents('vistas/admin/plantilla_admin/footer.html');
		
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$pedido = $trabajos->datos_trabajo($id_trabajo);
	$coach = $usuarios->datos_usuario($pedido[0]['id_coach']);
	//print_r($coach);
	//print_r($pedido);

	$datos_coach_personal = $usuarios->datos_user_personal($pedido[0]['id_coach']);
	$datos_coach = $usuarios->datos_coach($pedido[0]['id_coach']);
	$html = str_replace('{precio_personal}', $datos_coach[0]['precio'], $html);
	$html = str_replace('{precio_team}', $datos_coach[0]['precio_team'], $html);
	$html = str_replace('{correo_paypal_coach}', $datos_coach_personal[0]['pp_correo'], $html);
	$html = str_replace('{img_coach}', $datos_coach_personal[0]['img_perfil'], $html);
	$html = str_replace('{user_coach}', $coach[0]['usuario'], $html);
	$html = str_replace('{tipo}', $pedido[0]['tipo'], $html);

	$datos_user_personal = $usuarios->datos_user_personal($pedido[0]['id_usuario']);
	$usuario = $usuarios->datos_usuario($pedido[0]['id_usuario']);
	$html = str_replace('{user_user}', $usuario[0]['usuario'], $html);
	$html = str_replace('{nicklol_user}', $pedido[0]['nick_lol'], $html);
	$html = str_replace('{pp_usuario}', $datos_user_personal[0]['pp_correo'], $html);
	$html = str_replace('{img_user}', $datos_user_personal[0]['img_perfil'], $html);

	$serverlol = $usuarios->server_lol($pedido[0]['id_lol_server']);
	$html = str_replace('{server_lol_user}', $serverlol[0]['nombre'], $html);

	$html = str_replace('{horas_contratadas}', $pedido[0]['horas_contratadas'], $html);
	$html = str_replace('{precio_total}', $pedido[0]['total'], $html);
	$html = str_replace('{intereses}', $pedido[0]['intereses'], $html);
	$html = str_replace('{fecha_pedido}', $pedido[0]['fecha'], $html);
	$html = str_replace('{hora_pedido}', $pedido[0]['hora'], $html);
	$html = str_replace('{pedido}', $pedido[0]['id_trabajo_coach'], $html);
	$html = str_replace('{mensaje_coach}', $pedido[0]['mensaje'], $html);
	
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>