<?php
	$id_mensaje = $url[1];
	$html = file_get_contents('vistas/coach/ver_mensaje.html');
	$header_desconectado = file_get_contents('vistas/coach/plantilla_coach/header.html');
	$footer_desconectado = file_get_contents('vistas/coach/plantilla_coach/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');
	require_once('vistas/coach/logicas/menu.php');

	// Datos Usuario Remitente
	$id_receptor = $_SESSION['id_usuario'];
	$resultado = $mensajes->ver_mensaje($id_mensaje, $id_receptor);
	$id_remitente = $resultado[0]['id_remitente'];
	$datos_usuario_remitente = $usuarios->datos_usuario($id_remitente);
	$usuario_remitente = $datos_usuario_remitente[0]['usuario'];

	// Datos del Mensaje
	$modificar = $mensajes->modificar_estado($resultado[0]['id_mensaje']);
	$asunto = $resultado[0]['asunto'];
	$contenido_mensaje = $resultado[0]['contenido'];
	$fecha_envio = $resultado[0]['fecha'];
	$hora_envio = $resultado[0]['hora'];

	$html = str_replace('{asunto}', $asunto, $html);
	$html = str_replace('{contenido_mensaje}', $contenido_mensaje, $html);
	$html = str_replace('{fecha_envio}', $fecha_envio, $html);
	$html = str_replace('{hora_envio}', $hora_envio, $html);
	$html = str_replace('{usuario_remitente}', $usuario_remitente, $html);
	$html = str_replace('{id_receptor}', $id_remitente, $html);
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>