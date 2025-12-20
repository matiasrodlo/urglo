<?php
	$id_trabajo = $url[2];
	$html = file_get_contents(__DIR__ . '/../orden_coach_libre.html');
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

	/////////////////////// CHAT //////////////////////////
	$id_creador = $trabajo[0]['id_usuario'];
	$id_user_responde = $trabajo[0]['id_coach'];
	$chat = $mensajes->conversacion($id_creador, $id_user_responde);
	$html = str_replace('{id_conver}', $chat[0]['id_conversacion'], $html);
	$html = str_replace('{chat}', '', $html);
	///////////////////////////////////////////////////////

	$html = str_replace('{id_usuario}', $trabajo[0]['id_usuario'], $html);
	$html = str_replace('{id_coach}', $trabajo[0]['id_coach'], $html);
	$html = str_replace('{id_orden}', $trabajo[0]['id_trabajo_coach'], $html);
	
	if($pais_usuario == 'Chile')
	{
		$precio = $trabajo[0]['total'];

		$kiphu_ch = '<div id="paykiph"><a id="pay-kiphu">
        				<div class="btn-info padding10" align="center" style="width:90%;display:inline-block;color:#fff;margin: 10px 0px;">
        					Pagar esta Orden con <b>Kiphu</b>.
        					<input type="hidden" id="total" value="'.$precio.'" />
        					<input type="hidden" id="tipo" value="'.$trabajo[0]['tipo'].'" />
        				</div>
        			</a>
        			</div>';
        $kiphu_not = '<div class="topicpanel" style="margin:0 10px;">
        		<div clas="topic-content" align="center">
        			<form action="'.RUTA_INDEX.'pedido.php" method="POST">
        				<input type="hidden" value="'.$id_trabajo.'" name="billing" />
        				<input type="hidden" value="'.$trabajo[0]['tipo'].'" name="tbilling" />
        				<input type="hidden" value="'.$trabajo[0]['total'].'" name="pbilling" />
        				<input type="submit" value="Notifica tu pago." class="btn-info padding10" align="center" style="width:90%;display:inline-block;color:#fff;margin: 10px 0px;cursor:pointer;"/>
        			</form>
        			<div>* Todos los pedidos luego de pagados, se tienen que notificar.</div>
        		</div>
        	</div>';
	}
	else
	{
		$kiphu_ch = '';
		$kiphu_not = '<div class="topicpanel" style="margin:0 10px;">
        		<div clas="topic-content" align="center">
        			<form action="'.RUTA_INDEX.'pedido.php" method="POST">
        				<input type="hidden" value="'.$id_trabajo.'" name="billing" />
        				<input type="hidden" value="'.$trabajo[0]['tipo'].'" name="tbilling" />
        				<input type="hidden" value="'.$trabajo[0]['total'].'" name="pbilling" />
        				<input type="submit" value="Notifica tu pago." class="btn-info padding10" align="center" style="width:90%;display:inline-block;color:#fff;margin: 10px 0px;cursor:pointer;"/>
        			</form>
        			<div>* Todos los pedidos luego de pagados, se tienen que notificar.</div>
        		</div>
        	</div>';
	}
	$html = str_replace('{kiphu_ch}', $kiphu_ch, $html);
	$html = str_replace('{kiphu_not}', $kiphu_not, $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>
