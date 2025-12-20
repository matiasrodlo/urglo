<?php
	$html = file_get_contents(__DIR__ . '/../mensajes.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_user/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');

	
	$mensajes = $mensajes->bandeja_salida($id_usuario);

	if ($mensajes === false) {
		$mensajes = array();
	}

	$mensajes_salida_lista = '';
	for($i=0;$i<count($mensajes);$i++)
	{
		$datos_remitente = $usuarios->datos_usuario($mensajes[$i]['id_remitente']);
		$remitente = $datos_remitente[0]['usuario'];
		$tipo = $datos_remitente[0]['tipo'];
		$asunto = $mensajes[$i]['asunto'];
		$fecha = $mensajes[$i]['fecha'];
		$id_mensaje = $mensajes[$i]['id_mensaje'];
		
		$mensajes_salida_lista.='
		<li>
			<div class="msj">
				<span class="tip">'.$tipo.'</span>
				<span class="remitente">'.$remitente.'</span> 
				 -
				<span class="asunto-mensaje"><a href="'.RUTA_INDEX.'mensajes/'.$id_mensaje.'">'.$asunto.'</a></span>
			</div>
			<span class="fecha-mensaje">'.$fecha.'</span>
		</li>';
	}

	if(count($mensajes) === 0)
	{
		$html = str_replace('{lista_mensajes}', '<li>No hay ningún mensaje en la bandeja de salida.</li>', $html);	
	}
	else
	{
		$html = str_replace('{lista_mensajes}', $mensajes_salida_lista, $html);
	}

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>
