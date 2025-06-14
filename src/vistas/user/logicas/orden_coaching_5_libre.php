<?php
	$html = file_get_contents('vistas/user/orden_coaching_5_libre.html');
	$header_desconectado = file_get_contents('vistas/user/plantilla_user/header.html');
	$footer_desconectado = file_get_contents('vistas/user/plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$tipo_d = $orden[0]['nombre'];
	$tipo_d = str_replace(' ', '+', $tipo_d);
	$html = str_replace('{tipo_d}', $tipo_d, $html);
	$html = str_replace('{tipo}', $orden[0]['nombre'], $html);
	$html = str_replace('{precio}', $orden[0]['precio'], $html);
	$html = str_replace('{id_pedido}', $orden[0]['id_pedido'], $html);
	
	$html = str_replace('{wins}', $orden[0]['wins'], $html);
	$html = str_replace('{wins_current}', $orden[0]['wins_current'], $html);

	$league = level($orden[0]['id_level_inicio'], $orden[0]['id_division_inicio']);
	$html = str_replace('{img_league}', $league['imagen'], $html);
	$html = str_replace('{level}', $league['nombre'], $html);

	if($pais_usuario == 'Chile')
	{
		$precio = $orden[0]['precio'];
		$kiphu_ch = '<div id="paykiph"><a id="pay-kiphu">
        				<div class="btn-info padding10" align="center" style="width:90%;display:inline-block;color:#fff;margin: 10px 0px;">
        					Pagar esta Orden con <b>Kiphu</b>.
        					<input type="hidden" id="total" value="'.$precio.'" />
        					<input type="hidden" id="tipo" value="'.$orden[0]['nombre'].'" />
        				</div>
        			</a>
        			
        			</div>';
        $kiphu_not = '<div class="topicpanel" style="margin:0 10px;">
        		<div clas="topic-content" align="center">
        			<form action="http://urglo.com/miembros/pedido.php" method="POST">
        				<input type="hidden" name="billing" value="'.$orden[0]['id_pedido'].'" />
        				<input type="hidden" name="tbilling" value="'.$orden[0]['nombre'].'" />
        				<input type="hidden" value="'.$orden[0]['precio'].'" name="pbilling" />
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
        			<form action="http://urglo.com/miembros/pedido.php" method="POST">
        				<input type="hidden" name="billing" value="'.$orden[0]['id_pedido'].'" />
        				<input type="hidden" name="tbilling" value="'.$orden[0]['nombre'].'" />
        				<input type="hidden" value="'.$orden[0]['precio'].'" name="pbilling" />
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