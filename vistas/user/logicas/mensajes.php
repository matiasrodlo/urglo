<?php
	$html = file_get_contents('vistas/user/mensajes.html');
	$header_desconectado = file_get_contents('vistas/user/plantilla_user/header.html');
	$footer_desconectado = file_get_contents('vistas/user/plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$mensajes_entrada_lista = '';
	$mensajes = $mensajes->bandeja_entrada($id_usuario);
	
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
					 -
					<span class="asunto-mensaje"><a href="http://urglo.com/miembros/mensajes/'.$id_mensaje.'">'.$asunto.'</a></span>
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
					<span class="asunto-mensaje"><a href="http://urglo.com/miembros/mensajes/'.$id_mensaje.'">'.$asunto.'</a></span>
				</div>
				<span class="fecha-mensaje">'.$fecha.'</span>
			</li>';
		}
	}

	if($mensajes == false)
	{
		$html = str_replace('{lista_mensajes}', '<li>No hay ningún mensaje en la bandeja de entrada.</li>', $html);	
	}
	else
	{
		$html = str_replace('{lista_mensajes}', $mensajes_entrada_lista, $html);
	}

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>