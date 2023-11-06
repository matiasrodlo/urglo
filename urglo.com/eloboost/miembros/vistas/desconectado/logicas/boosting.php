<?php
	$html = file_get_contents('vistas/desconectado/boosting.html');
	$header_desconectado = file_get_contents('vistas/desconectado/plantilla_desconectado/header_desconectado.html');
	$footer_desconectado = file_get_contents('vistas/desconectado/plantilla_desconectado/footer_desconectado.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	$servers = $usuarios->lista_server_lol();
	$lista_servers = '';
	for($i=0;$i<count($servers);$i++)
	{
		$lista_servers.='<option value="'.$servers[$i]['id_server'].'">'.$servers[$i]['nombre'].'</option>';
	}
	$html = str_replace('{lista_servers}', $lista_servers, $html);
	
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>