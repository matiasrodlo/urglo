<?php
	$html = file_get_contents(__DIR__ . '/../registrar_usuario.html');
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
?>