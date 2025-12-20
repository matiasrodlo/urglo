<?php
	$html = file_get_contents(__DIR__ . '/../mensajes.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');

	$mensajes_entrada_lista = '';
	$mensajes = $mensajes->bandeja_entrada($id_usuario);
	
	for($i=0;$i<count($mensajes);$i++)
	{
		$datos_remitente = $usuarios->datos_usuario($mensajes[$i]['id_remitente']);
		
		$remitente = isset($datos_remitente[0]['usuario']) ? $datos_remitente[0]['usuario'] : '';
		$tipo = isset($datos_remitente[0]['tipo']) ? $datos_remitente[0]['tipo'] : '';
		$asunto = isset($mensajes[$i]['asunto']) ? $mensajes[$i]['asunto'] : '(Sin asunto)';
		$fecha = isset($mensajes[$i]['fecha']) ? $mensajes[$i]['fecha'] : '';
		$id_mensaje = isset($mensajes[$i]['id_mensaje']) ? $mensajes[$i]['id_mensaje'] : '';
		$visto = isset($mensajes[$i]['visto']) ? $mensajes[$i]['visto'] : '0';

		if($visto == '0')
		{
			$mensajes_entrada_lista.='
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
		else
		{
			$mensajes_entrada_lista.='
			<li style="background-color:#f2f2f2;">
				<div class="msj">
					<span class="tip">'.$tipo.'</span>
					<span class="remitente">'.$remitente.'</span> 
					 -
					<span class="asunto-mensaje"><a href="'.RUTA_INDEX.'mensajes/'.$id_mensaje.'">'.$asunto.'</a></span>
				</div>
				<span class="fecha-mensaje">'.$fecha.'</span>
			</li>';
		}
	}

	if(count($mensajes) == 0 || empty($mensajes_entrada_lista))
	{
		$html = str_replace('{lista_mensajes}', '<li class="empty-state">No hay ningún mensaje en la bandeja de entrada.</li>', $html);	
	}
	else
	{
		$html = str_replace('{lista_mensajes}', $mensajes_entrada_lista, $html);
	}

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>
