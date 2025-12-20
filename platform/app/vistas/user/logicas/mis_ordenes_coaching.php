<?php
	require_once(__DIR__ . '/../../../funciones/funciones.php');
	require_once(__DIR__ . '/../../../modelos/bd.php');
	require_once(__DIR__ . '/../../../modelos/usuarios.php');
	require_once(__DIR__ . '/../../../modelos/pedidos.php');
	require_once(__DIR__ . '/../../../modelos/mensajes.php');
	
	$usuarios = new Usuarios();
	$pedidos = new Pedidos();
	$mensajes = new Mensajes();
	
	$html = file_get_contents(__DIR__ . '/../mis_ordenes_coaching.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_user/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');

	$mis_ordenes = $pedidos->mis_ordenes($id_usuario);
	$lista_mis_ordenes = '';
	
	if($mis_ordenes != false)
	{
		for($i=0;$i<count($mis_ordenes);$i++)
		{
			$tipo_pedido = $mis_ordenes[$i]['tipo_pedido'];
			if($tipo_pedido == '1')
			{
				$tipo_nombre = 'Coaching';
			}
			else
			{
				$tipo_nombre = 'Servicio #' . $tipo_pedido;
			}

			$coach_nombre = 'Sin asignar';
			$coach_link = '';
			if($mis_ordenes[$i]['id_coach'] != null && $mis_ordenes[$i]['id_coach'] != '0')
			{
				$datos_coach = $usuarios->datos_usuario($mis_ordenes[$i]['id_coach']);
				if($datos_coach != false && count($datos_coach) > 0)
				{
					$coach_nombre = $datos_coach[0]['usuario'];
					$coach_link = RUTA_INDEX . 'coachs/' . $datos_coach[0]['usuario'];
				}
			}

			$estado = $mis_ordenes[$i]['estado'];
			if($estado == '0')
			{
				$estado_nombre = 'Pendiente';
			}
			elseif($estado == '1')
			{
				$estado_nombre = 'No Pagado';
			}
			elseif($estado == '2')
			{
				$estado_nombre = 'En Proceso';
			}
			elseif($estado == '3')
			{
				$estado_nombre = 'Cancelado';
			}
			elseif($estado == '4')
			{
				$estado_nombre = 'Terminado';
			}
			else
			{
				$estado_nombre = 'Desconocido';
			}

			$lista_mis_ordenes.='<tr>
				<td>
					<div style="font-size:13px;font-weight:500;color:#333;margin-bottom:2px;">'.$tipo_nombre.'</div>
					<small style="color:#999;font-size:11px;">ID: #'.$mis_ordenes[$i]['id_pedido'].'</small>
				</td>
				<td>';
			
			if($coach_link != '')
			{
				$lista_mis_ordenes.='<a href="'.$coach_link.'" style="color:#71B8EE;text-decoration:none;font-weight:400;transition:color 0.15s ease;font-size:13px;">'.$coach_nombre.'</a>';
			}
			else
			{
				$lista_mis_ordenes.='<span style="color:#999;font-size:13px;">'.$coach_nombre.'</span>';
			}
			
			$lista_mis_ordenes.='</td>
				<td><span style="display:inline-block;padding:3px 10px;background:#f5f5f5;color:#666;border-radius:3px;font-size:11px;font-weight:400;letter-spacing:0.1px;">'.$estado_nombre.'</span></td>
				<td style="text-align:center;"><a href="'.RUTA_INDEX.'coaching/mis_ordenes/'.$mis_ordenes[$i]['id_pedido'].'"><div class="btn_details">Ver</div></a></td>
			</tr>';
		}
	}
	
	if($mis_ordenes == false || $lista_mis_ordenes == '')
	{
		$html = str_replace('{lista_ordenes}', '
			<tr>
				<td colspan="4" style="padding:40px 16px;text-align:center;">
					<p style="font-size:13px;color:#999;margin:0;font-weight:300;">No hay órdenes contratadas</p>
				</td>
			</tr>', $html);
	}
	else
	{
		$html = str_replace('{lista_ordenes}', $lista_mis_ordenes, $html);
	}
	
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	$html = str_replace('{time}', time(), $html);
	echo $html;
?>

