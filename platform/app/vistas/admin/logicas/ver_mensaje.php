<?php
	$html = file_get_contents(__DIR__ . '/../ver_mensaje.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');

	// Datos Usuario Remitente
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