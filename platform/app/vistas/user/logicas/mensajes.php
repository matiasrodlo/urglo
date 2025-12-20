<?php
	$html = file_get_contents(__DIR__ . '/../mensajes.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_user/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');

	$mensajes_entrada_lista = '';
	$mensajes = $mensajes->bandeja_entrada($id_usuario);
	
	if($mensajes == false)
	{
		$mensajes_entrada_lista = '<li style="text-align:center;padding:40px 16px;color:#999;font-size:13px;font-weight:300;">No hay mensajes en tu bandeja de entrada</li>';
	}
	else
	{
		for($i=0;$i<count($mensajes);$i++)
	{
		$datos_remitente = $usuarios->datos_usuario($mensajes[$i]['id_remitente']);
		$remitente = $datos_remitente[0]['usuario'];
		$tipo = $datos_remitente[0]['tipo'];
		$asunto = $mensajes[$i]['asunto'];
		$fecha = $mensajes[$i]['fecha'];
		$id_mensaje = $mensajes[$i]['id_mensaje'];
		$visto = $mensajes[$i]['visto'];

		if($visto == '1')
		{
			$mensajes_entrada_lista.='
			<li>
				<div class="msj">
					<span class="tip">'.$tipo.'</span>
					<span class="remitente">'.$remitente.'</span>
					<span class="asunto-mensaje"><a href="'.RUTA_INDEX.'mensajes/'.$id_mensaje.'">'.$asunto.'</a></span>
				</div>
				<span class="fecha-mensaje">'.$fecha.'</span>
			</li>';
		}
		else
		{
			$mensajes_entrada_lista.='
			<li style="background-color:#f8f9fa;">
				<div class="msj">
					<span class="tip">'.$tipo.'</span>
					<span class="remitente">'.$remitente.'</span>
					<span class="asunto-mensaje"><a href="'.RUTA_INDEX.'mensajes/'.$id_mensaje.'" style="font-weight:500;">'.$asunto.'</a></span>
				</div>
				<span class="fecha-mensaje">'.$fecha.'</span>
			</li>';
		}
		}
	}

	$html = str_replace('{lista_mensajes}', $mensajes_entrada_lista, $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>
