<?php
	$html = file_get_contents('vistas/user/mis_ordenes_coaching.html');
	$header_desconectado = file_get_contents('vistas/user/plantilla_user/header.html');
	$footer_desconectado = file_get_contents('vistas/user/plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$mis_ordenes = $pedidos->mis_ordenes($id_usuario);
	if($mis_ordenes == false)
	{
		$html = str_replace('{lista_ordenes_coaching}', '
			<tr style="background-color:#fff;color:#000;">
				<td colspan="6" style="border:0">No hay ningún orden contratada.</td>
			</tr>', $html);
	}
	else
	{
		$lista_ordenes_coaching = '';
		for($i=0;$i<count($mis_ordenes);$i++)
		{
			$tipo = $mis_ordenes[$i]['tipo_pedido'];
			$id_pedido = $mis_ordenes[$i]['id_pedido'];
			$orden = $pedidos->orden_tipo($tipo, $id_pedido);
			if($orden[0]['id_coacher'] == '0')
			{
				$coaching= '<p class="subtitle" style="margin:0px">coacher</p>
                        	<p style="color:#a00; margin:0px;">NO ASIGNADO</p>';
			}
			else
			{
				
				$elo = $usuarios->datos_usuario($orden[0]['id_coacher']);
				$coaching= '<p class="subtitle" style="margin:0px">coacher</p>
                        	<p style="color:#a00; margin:0px;">'.$elo[0]['usuario'].'</p>';
			}
			if($orden[0]['estado'] == '1')
			{
				$estado = "Orden No Paga";
			}
			elseif($orden[0]['estado'] == '2')
			{
				$estado = "Orden en Proceso";
			}
			elseif($orden[0]['estado'] == '3')
			{
				$estado = "Orden Cancelada";
			}
			elseif($orden[0]['estado'] == '4')
			{
				$estado = "Orden Terminada";
			}
			elseif($orden[0]['estado'] == '5')
			{
				$estado = "Orden Confirmada";
			}
			if($tipo == '1')
			{
			

				$level_current = level($orden[0]['id_level_current'], $orden[0]['id_division_current']);
				$level_llegada = level($orden[0]['id_level_llegada'], $orden[0]['id_division_llegada']);
				$lista_orden = '
				<tr style="background-color:#fff;color:#000;">
					<td width="120px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['nombre'].'</h4>
						<p class="price-ord"><span class="subtitle">Precio:</span> '.$orden[0]['precio'].' <span class="subtitle">USD</span></p>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<img src="http://urglo.com/miembros/images/Game/'.$level_current['imagen'].'" style="width:60px;">
						<p class="subtitle" style="margin-top:10px;">'.$level_current['nombre'].'</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<img src="http://urglo.com/miembros/images/Game/'.$level_llegada['imagen'].'" style="width:60px;">
						<p class="subtitle" style="margin-top:10px;">'.$level_llegada['nombre'].'</p>
					</td>
					<td width="100px" style="border:1px solid #dddddd;">'.$coaching.'</td>
					<td width="42px" style="border:1px solid #dddddd;text-transform:uppercase">'.$estado.'</td>
					<td width="67px" style="border:1px solid #dddddd;">
						<a href="http://urglo.com/miembros/coaching/mis_ordenes/'.$orden[0]['id_pedido'].'">
							<div class="btn_details">Ver Detalles</div>
						</a>
					</td>
				</tr>
				';
			}
			elseif($tipo == '2')
			{
				$lista_orden = '
				<tr style="background-color:#fff;color:#000;">
					<td width="120px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['nombre'].'</h4>
						<p class="price-ord"><span class="subtitle">Precio:</span> '.$orden[0]['precio'].' <span class="subtitle">USD</span></p>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['games_current'].'</h4>
						<p class="subtitle">GAMES</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['games'].'</h4>
						<p class="subtitle">GAMES</p>
					</td>
					<td width="100px" style="border:1px solid #dddddd;">'.$coaching.'</td>
					<td width="42px" style="border:1px solid #dddddd;text-transform:uppercase">'.$estado.'</td>
					<td width="67px" style="border:1px solid #dddddd;">
						<a href="http://urglo.com/miembros/coaching/mis_ordenes/'.$orden[0]['id_pedido'].'">
							<div class="btn_details">Ver Detalles</div>
						</a>
					</td>
				</tr>
				';
			}
			elseif($tipo == '3')
			{
				$lista_orden = '
				<tr style="background-color:#fff;color:#000;">
					<td width="120px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['nombre'].'</h4>
						<p class="price-ord"><span class="subtitle">Precio:</span> '.$orden[0]['precio'].' <span class="subtitle">USD</span></p>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['number_wins_current'].'</h4>
						<p class="subtitle">WINS</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['number_wins'].'</h4>
						<p class="subtitle">WINS</p>
					</td>
					<td width="100px" style="border:1px solid #dddddd;">'.$coaching.'</td>
					<td width="42px" style="border:1px solid #dddddd;text-transform:uppercase">'.$estado.'</td>
					<td width="67px" style="border:1px solid #dddddd;">
						<a href="http://urglo.com/miembros/coaching/mis_ordenes/'.$orden[0]['id_pedido'].'">
							<div class="btn_details">Ver Detalles</div>
						</a>
					</td>
				</tr>
				';
			}
			elseif($tipo == '4')
			{
				$level_current = level($orden[0]['id_level_current'], '0');
				$level_llegada = level($orden[0]['id_level_llegada'], $orden[0]['id_division_llegada']);
				$lista_orden = '
				<tr style="background-color:#fff;color:#000;">
					<td width="120px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['nombre'].'</h4>
						<p class="price-ord"><span class="subtitle">Precio:</span> '.$orden[0]['precio'].' <span class="subtitle">USD</span></p>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<img src="http://urglo.com/miembros/images/Game/'.$level_current['imagen'].'" style="width:60px;">
						<p class="subtitle" style="margin-top:10px;">'.$level_current['nombre'].'</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<img src="http://urglo.com/miembros/images/Game/'.$level_llegada['imagen'].'" style="width:60px;">
						<p class="subtitle" style="margin-top:10px;">'.$level_llegada['nombre'].'</p>
					</td>
					<td width="100px" style="border:1px solid #dddddd;">'.$coaching.'</td>
					<td width="42px" style="border:1px solid #dddddd;text-transform:uppercase">'.$estado.'</td>
					<td width="67px" style="border:1px solid #dddddd;">
						<a href="http://urglo.com/miembros/coaching/mis_ordenes/'.$orden[0]['id_pedido'].'">
							<div class="btn_details">Ver Detalles</div>
						</a>
					</td>
				</tr>
				';
			}
			elseif($tipo == '5')
			{
				$lista_orden = '
				<tr style="background-color:#fff;color:#000;">
					<td width="120px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['nombre'].'</h4>
						<p class="price-ord"><span class="subtitle">Precio:</span> '.$orden[0]['precio'].' <span class="subtitle">USD</span></p>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['wins_current'].'</h4>
						<p class="subtitle">WINS</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['wins'].'</h4>
						<p class="subtitle">WINS</p>
					</td>
					<td width="100px" style="border:1px solid #dddddd;">'.$coaching.'</td>
					<td width="42px" style="border:1px solid #dddddd;text-transform:uppercase">'.$estado.'</td>
					<td width="67px" style="border:1px solid #dddddd;">
						<a href="http://urglo.com/miembros/coaching/mis_ordenes/'.$orden[0]['id_pedido'].'">
							<div class="btn_details">Ver Detalles</div>
						</a>
					</td>
				</tr>
				';
			}

			$lista_ordenes_coaching.=''.$lista_orden.'';
		}
		$html = str_replace('{lista_ordenes_coaching}', $lista_ordenes_coaching, $html);
	}
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>