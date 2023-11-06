<?php
$html = file_get_contents('vistas/elobooster/lista_pedidos_desocupados.html');
$header_desconectado = file_get_contents('vistas/elobooster/plantilla_elo/header.html');
$footer_desconectado = file_get_contents('vistas/elobooster/plantilla_elo/footer.html');
	
$html = str_replace('{footer}', $footer_desconectado, $html);
$html = str_replace('{header}', $header_desconectado, $html);

require_once('vistas/datos_usuario.php');
$mis_ordenes = $pedidos->ordenes();

if($mis_ordenes == false)
{
	$html = str_replace('{lista_ordenes_boosting}', '
		<tr style="background-color:#fff;color:#000;">
			<td colspan="6" style="border:0px;">No hay ningún pedido desocupado.</td>
		</tr>', $html);
}
else
{
	$lista_ordenes_boosting = '';
	for($i=0;$i<count($mis_ordenes);$i++)
	{
		$tipo = $mis_ordenes[$i]['tipo_pedido'];
		$id_pedido = $mis_ordenes[$i]['id_pedido'];
		$orden = $pedidos->orden_tipo_estado($tipo, $id_pedido, '5');
		if($orden == '')
		{
			$lista_orden = '';
		}
		else
		{
			if($orden[0]['estado'] == '5')
			{
				$estado = "Orden Desocupada";
			}
			if($tipo == '1')
			{
				$level_current = level($orden[0]['id_level_current'], $orden[0]['id_division_current']);
				$level_llegada = level($orden[0]['id_level_llegada'], $orden[0]['id_division_llegada']);
				$lista_orden = '
				<tr style="background-color:#fff;color:#000;">
					<td width="120px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['nombre'].'</h4>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<img src="http://urglo.com/eloboost/miembros/images/Game/'.$level_current['imagen'].'" style="width:60px;">
						<p class="subtitle" style="margin-top:10px;">'.$level_current['nombre'].'</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<img src="http://urglo.com/eloboost/miembros/images/Game/'.$level_llegada['imagen'].'" style="width:60px;">
						<p class="subtitle" style="margin-top:10px;">'.$level_llegada['nombre'].'</p>
					</td>
					<td width="100px" style="border:1px solid #dddddd;">
						<p class="price-ord">
							<span class="subtitle">Ganancia:</span> '.$orden[0]['precio_elo'].' <span class="subtitle">USD</span>
						</p>
					</td>
					<td width="42px" style="border:1px solid #dddddd;text-transform:uppercase">'.$estado.'</td>
					<td width="67px" style="border:1px solid #dddddd;">
						<a href="http://urglo.com/eloboost/miembros/pedidos_desocupados/'.$orden[0]['id_pedido'].'">
							<div class="btn_details">Ver Detalles</div>
						</a>
					</td>
				</tr>';
			}
			elseif($tipo == '2')
			{
				$lista_orden = '
				<tr style="background-color:#fff;color:#000;">
					<td width="120px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['nombre'].'</h4>
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
					<td width="100px" style="border:1px solid #dddddd;">
						<p class="price-ord">
							<span class="subtitle">Ganancia:</span> '.$orden[0]['precio_elo'].' <span class="subtitle">USD</span>
						</p>
					</td>
					<td width="42px" style="border:1px solid #dddddd;text-transform:uppercase">'.$estado.'</td>
					<td width="67px" style="border:1px solid #dddddd;">
						<a href="http://urglo.com/eloboost/miembros/pedidos_desocupados/'.$orden[0]['id_pedido'].'">
							<div class="btn_details">Ver Detalles</div>
						</a>
					</td>
				</tr>';
			}
			elseif($tipo == '3')
			{
				$lista_orden = '
				<tr style="background-color:#fff;color:#000;">
					<td width="120px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['nombre'].'</h4>
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
					<td width="100px" style="border:1px solid #dddddd;">
						<p class="price-ord">
							<span class="subtitle">Ganancia:</span> '.$orden[0]['precio_elo'].' <span class="subtitle">USD</span>
						</p>
					</td>
					<td width="42px" style="border:1px solid #dddddd;text-transform:uppercase">'.$estado.'</td>
					<td width="67px" style="border:1px solid #dddddd;">
						<a href="http://urglo.com/eloboost/miembros/pedidos_desocupados/'.$orden[0]['id_pedido'].'">
							<div class="btn_details">Ver Detalles</div>
						</a>
					</td>
				</tr>';
			}
			elseif($tipo == '4')
			{
				$level_current = level($orden[0]['id_level_current'], '0');
				$level_llegada = level($orden[0]['id_level_llegada'], $orden[0]['id_division_llegada']);
				$lista_orden = '
				<tr style="background-color:#fff;color:#000;">
					<td width="120px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['nombre'].'</h4>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<img src="http://urglo.com/eloboost/miembros/images/Game/'.$level_current['imagen'].'" style="width:60px;">
						<p class="subtitle" style="margin-top:10px;">'.$level_current['nombre'].'</p>
					</td>
					<td width="50px" style="border:1px solid #dddddd;">
						<img src="http://urglo.com/eloboost/miembros/images/Game/'.$level_llegada['imagen'].'" style="width:60px;">
						<p class="subtitle" style="margin-top:10px;">'.$level_llegada['nombre'].'</p>
					</td>
					<td width="100px" style="border:1px solid #dddddd;">
						<p class="price-ord">
							<span class="subtitle">Ganancia:</span> '.$orden[0]['precio_elo'].' <span class="subtitle">USD</span>
						</p>
					</td>
					<td width="42px" style="border:1px solid #dddddd;text-transform:uppercase">'.$estado.'</td>
					<td width="67px" style="border:1px solid #dddddd;">
						<a href="http://urglo.com/eloboost/miembros/pedidos_desocupados/'.$orden[0]['id_pedido'].'">
							<div class="btn_details">Ver Detalles</div>
						</a>
					</td>
				</tr>';
			}
			elseif($tipo == '5')
			{
				$lista_orden = '
				<tr style="background-color:#fff;color:#000;">
					<td width="120px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['nombre'].'</h4>
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
					<td width="100px" style="border:1px solid #dddddd;">
						<p class="price-ord">
							<span class="subtitle">Ganancia:</span> '.$orden[0]['precio_elo'].' <span class="subtitle">USD</span>
						</p>
					</td>
					<td width="42px" style="border:1px solid #dddddd;text-transform:uppercase">'.$estado.'</td>
					<td width="67px" style="border:1px solid #dddddd;">
						<a href="http://urglo.com/eloboost/miembros/pedidos_desocupados/'.$orden[0]['id_pedido'].'">
							<div class="btn_details">Ver Detalles</div>
						</a>
					</td>
				</tr>';
			}
			$lista_ordenes_boosting.=''.$lista_orden.'';
		}
	}
	if($lista_ordenes_boosting == '')
	{
		$html = str_replace('{lista_ordenes_boosting}', '
		<tr style="background-color:#fff;color:#000;">
			<td colspan="6" style="border:0px;">No hay ningún pedido desocupado.</td>
		</tr>', $html);
	}
	else
	{
		$html = str_replace('{lista_ordenes_boosting}', $lista_ordenes_boosting, $html);
	}
}

$html = str_replace('{ruta}', RUTA, $html);
$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
echo $html;
?>
