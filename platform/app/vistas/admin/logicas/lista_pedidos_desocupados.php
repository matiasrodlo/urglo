<?php
$html = file_get_contents(__DIR__ . '/../lista_pedidos_desocupados.html');
$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/header.html');
$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/footer.html');
	
$html = str_replace('{footer}', $footer_desconectado, $html);
$html = str_replace('{header}', $header_desconectado, $html);

require_once(__DIR__ . '/../../datos_usuario.php');
$mis_ordenes = $pedidos->ordenes();

if($mis_ordenes == false)
{
	$html = str_replace('{lista_ordenes_coaching}', '
		<tr style="background-color:#fff;color:#000;">
			<td colspan="6" style="border:0px;">No hay ningún pedido desocupado.</td>
		</tr>', $html);
}
else
{
	$lista_ordenes_coaching = '';
	for($i=0;$i<count($mis_ordenes);$i++)
	{
		$tipo = $mis_ordenes[$i]['tipo_pedido'];
		$id_pedido = $mis_ordenes[$i]['id_pedido'];
		$orden = $pedidos->orden_tipo_estado($tipo, $id_pedido, '5');
		if($orden === false || empty($orden))
		{
			$lista_orden = '';
		}
		else
		{
			if($orden[0]['id_coach'] == '0' or $orden[0]['id_coach'] == null)
			{
				$coaching = '<h4 style="color:#a00;">NO ASIGNADO</h4>';
			}
			else
			{
				$coach_data = $usuarios->datos_usuario($orden[0]['id_coach']);
				$coaching = $coach_data[0]['usuario'];
			}
			if($orden[0]['estado'] == '5')
			{
				$estado = "Orden Desocupada";
			}
			if($tipo == '1')
			{
				$lista_orden = '
				<tr style="background-color:#fff;color:#000;">
					<td width="200px" style="border:1px solid #dddddd;">
						<h4>'.$orden[0]['nombre'].'</h4>
						<p class="price-ord"><span class="subtitle">Precio:</span> '.$orden[0]['precio'].' <span class="subtitle">USD</span></p>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
					</td>
					<td width="150px" style="border:1px solid #dddddd;">'.$coaching.'</td>
					<td width="100px" style="border:1px solid #dddddd;text-transform:uppercase">'.$estado.'</td>
					<td width="67px" style="border:1px solid #dddddd;">
						<a href="'.RUTA_INDEX.'coach/pedidos_desocupados/'.$orden[0]['id_pedido'].'">
							<div class="btn_details">Ver Detalles</div>
						</a>
					</td>
				</tr>';
			}
			$lista_ordenes_coaching.=''.$lista_orden.'';
		}
	}
	if($lista_ordenes_coaching == '')
	{
		$html = str_replace('{lista_ordenes_coaching}', '
		<tr style="background-color:#fff;color:#000;">
			<td colspan="6" style="border:0px;">No hay ningún pedido desocupado.</td>
		</tr>', $html);
	}
	else
	{
		$html = str_replace('{lista_ordenes_coaching}', $lista_ordenes_coaching, $html);
	}
}

$html = str_replace('{ruta}', RUTA, $html);
$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
echo $html;
?>
