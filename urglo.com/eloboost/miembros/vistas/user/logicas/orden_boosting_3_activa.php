<?php
	$html = file_get_contents('vistas/user/orden_boosting_3_activa.html');
	$header_desconectado = file_get_contents('vistas/user/plantilla_user/header.html');
	$footer_desconectado = file_get_contents('vistas/user/plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$html = str_replace('{id_trabajo}', $orden[0]['id_pedido'], $html);
	$html = str_replace('{tipo}', $orden[0]['nombre'], $html);
	$html = str_replace('{id_usuario}', $orden[0]['id_usuario'], $html);
	$html = str_replace('{precio}', $orden[0]['precio'], $html);
	$html = str_replace('{estado_user}', $orden[0]['estado_user'], $html);
	$html = str_replace('{estado_elo}', $orden[0]['estado_elo'], $html);
	
	$html = str_replace('{wins}', $orden[0]['number_wins'], $html);
	$html = str_replace('{wins_current}', $orden[0]['number_wins_current'], $html);

	////////////// CHAT ///////////////////
	$html = str_replace('{chat}', '', $html);

	/////////// Elobooster /////////
	$elo = $usuarios->datos_usuario($orden[0]['id_elobooster']);
	$html = str_replace('{user_elobooster}', $elo[0]['usuario'], $html);
	$html = str_replace('{id_elo}', $orden[0]['id_elobooster'], $html);

	///////////////// PORCENTAJE ////////////
	if($orden[0]['number_wins'] == 0)
	{
		$progress = 0;
	}
	else
	{
		$progress = $orden[0]['number_wins_current']*100/$orden[0]['number_wins'];
	}
	$html = str_replace('{porcentaje_progress}', $progress, $html);
	
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>