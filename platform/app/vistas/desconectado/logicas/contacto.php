<?php
if(!isset($_POST['category']))
{
	$html = file_get_contents(__DIR__ . '/../contacto.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_desconectado/header_desconectado.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_desconectado/footer_desconectado.html');
	
	$html = str_replace('{footer_desconectado}', $footer_desconectado, $html);
	$html = str_replace('{header_desconectado}', $header_desconectado, $html);

	$lista_server = $usuarios->lista_server_lol();
	$lista_server_lol = '';
	for($i=0;$i<count($lista_server);$i++)
	{
		$lista_server_lol.='<option value="'.$lista_server[$i]['id_server'].'">'.$lista_server[$i]['nombre'].'</option>';
	}
	
	$html = str_replace('{lista_server_lol}', $lista_server_lol, $html);
	$html = str_replace('{mensaje}', '', $html);
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
}
else
{
	$html = file_get_contents(__DIR__ . '/../contacto.html');


	$email = $resultado[$i]['correo'];
	mail ( "contacto@urglo.com,d@urglo.com" , 'Nuevo '.$_POST['category'].' - Urglo.com' , "Buenas Administracion,\nTe mandamos este mensaje porque hay un nuevo contacto desde el sitio web de un visitante.\n\nCategoria: ".$_POST['category']."\nEmail: ".$_POST['email']."\nMensaje: ".$_POST['message']."\n\nSaludos\nUrglo.com - Administracion", 'From: '.$_POST['email'] . "\r\n" .
    'Reply-To: '.$_POST['email'] . "\r\n" .
    'X-Mailer: PHP/' . phpversion());
					
	$html = str_replace('{mensaje}', '<div id="resultado" class="alert alert-info alert-block">Gracias por contactarnos</div>', $html);


	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_desconectado/header_desconectado.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_desconectado/footer_desconectado.html');
	
	$html = str_replace('{footer_desconectado}', $footer_desconectado, $html);
	$html = str_replace('{header_desconectado}', $header_desconectado, $html);

	$lista_server = $usuarios->lista_server_lol();
	$lista_server_lol = '';
	for($i=0;$i<count($lista_server);$i++)
	{
		$lista_server_lol.='<option value="'.$lista_server[$i]['id_server'].'">'.$lista_server[$i]['nombre'].'</option>';
	}
	
	$html = str_replace('{lista_server_lol}', $lista_server_lol, $html);
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;

}
?>