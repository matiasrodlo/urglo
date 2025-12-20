<?php
	$id_trabajo = $url[2];
	$html = file_get_contents(__DIR__ . '/../orden_coach_terminada.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_user/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');

	$trabajo = $trabajos->datos_trabajo($id_trabajo);

	$coach = $usuarios->datos_usuario($trabajo[0]['id_coach']);
	$personal_coach = $usuarios->datos_user_personal($trabajo[0]['id_coach']);
	//print_r($coach);
	//print_r($trabajo);
	//print_r($personal_coach);
	$horas_compradas = $trabajo[0]['horas_contratadas'];
	$horas_restantes = $trabajo[0]['horas_restantes'];
	if($horas_restantes == '0')
	{
		$porcentaje = '100';
	}
	elseif($horas_restantes == $horas_compradas)
	{
		$porcentaje = '0';
	}
	else
	{
		$porcentaje = ($horas_restantes*100)/$horas_compradas;
		$x = $porcentaje;
		$porcentaje = 100 - $x;
	}
	$html = str_replace('{porcentaje_progress}', $porcentaje, $html);
	$html = str_replace('{horas_compradas}', $horas_compradas, $html);
	$html = str_replace('{horas_restantes}', $horas_restantes, $html);

	$html = str_replace('{precio_total}', $trabajo[0]['total'], $html);
	$html = str_replace('{user_coach}', $coach[0]['usuario'], $html);
	$html = str_replace('{img_coach}', $personal_coach[0]['img_perfil'], $html);
	$html = str_replace('{tipo}', $trabajo[0]['tipo'], $html);
	$html = str_replace('{id_trabajo}', $trabajo[0]['id_trabajo_coach'], $html);

	/////////////////////// CHAT //////////////////////////
	$id_creador = $trabajo[0]['id_usuario'];
	$id_user_responde = $trabajo[0]['id_coach'];
	$chat = $mensajes->conversacion($id_creador, $id_user_responde);
	$html = str_replace('{id_conver}', $chat[0]['id_conversacion'], $html);
	$html = str_replace('{chat}', '', $html);
	///////////////////////////////////////////////////////

	////////////////// CALIFICAR //////////////////////////
	$calificacion = $trabajos->calificacion_trabajo($trabajo[0]['id_trabajo_coach']);
	if($calificacion == false)
	{
		$html = str_replace('{calificar}', '
			<div>
				<div class="ratingBig">
	                <div class="star-vacio" id="1"></div>
	                <div class="star-vacio" id="2"></div>
	                <div class="star-vacio" id="3"></div>
	                <div class="star-vacio" id="4"></div>
	                <div class="star-vacio" id="5"></div>
	            </div>
	            <div id="puntuacion" style="color:#555;font-size:14px;font-family:Helvetica, sans-serif;">
	                <center>Tu Puntuacion <span id="i">0</span> / <span>5</span></center>
	            </div>
			</div>
			<textarea id="calificacionText" placeholder="Califca al coach escribiendo un texto." required></textarea>
			<div id="calificar" class="btn_cal" align="center">Calificar coach</div>
			<div id="califacion_r"></div>
		', $html);
	}
	else
	{
		$html = str_replace('{calificar}', '
			<div>
				<div class="ratingBig" style="margin-bottom:10px;">
					<img src="'.RUTA_INDEX.'images/rating-stars.png" class="rat'.$calificacion[0]['calificacion'].'" align="middle">
				</div>
				<div id="puntuacion" style="color:#555;font-size:14px;font-family:Helvetica, sans-serif;">
	                <center>Tu Puntuacion fue '.$calificacion[0]['calificacion'].' / <span>5</span></center>
				</div>
			</div>
		', $html);
	}
	///////////////////////////////////////////////////////

	$html = str_replace('{id_usuario}', $trabajo[0]['id_usuario'], $html);
	$html = str_replace('{id_coach}', $trabajo[0]['id_coach'], $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>
