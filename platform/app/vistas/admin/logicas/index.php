<?php
$html = file_get_contents(__DIR__ . '/../index.html');
$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/header.html');
$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/footer.html');
	
$html = str_replace('{footer}', $footer_desconectado, $html);
$html = str_replace('{header}', $header_desconectado, $html);

require_once(__DIR__ . '/../../datos_usuario.php');

////////////////////// LISTA ULTIMOS PEDIDOS TERMINADOS COACHING //////////////////////
$mis_ordenes = $pedidos->ordenes();

if ($mis_ordenes === false) {
	$mis_ordenes = array();
}

if(count($mis_ordenes) == 0)
{
	$html = str_replace('{lista_ultimos_pedidos_terminados}', '
		<tr class="empty-state">
			<td colspan="6" style="border:0px;text-align:center;padding:20px;color:#999;">No hay pedidos de coaching terminados.</td>
		</tr>', $html);
}
else
{
	$lista_ordenes_coaching = '';
	for($i=0;$i<count($mis_ordenes);$i++)
	{
		$tipo = $mis_ordenes[$i]['tipo_pedido'];
		$id_pedido = $mis_ordenes[$i]['id_pedido'];
		$orden = $pedidos->orden_tipo_estado($tipo, $id_pedido, '4');
		if($orden === false || empty($orden))
		{
			$lista_orden = '';
		}
		else
		{
			if($orden[0]['id_coach'] == '0')
			{
				$coaching = '<p class="subtitle" style="margin:0 0 4px 0;font-size:12px;color:#666;">Coach</p>
	                       	<p style="color:#a00; margin:0;font-size:13px;">No asignado</p>';
			}
			else
			{
				$coach_data = $usuarios->datos_usuario($orden[0]['id_coach']);
				$coaching = '<p class="subtitle" style="margin:0 0 4px 0;font-size:12px;color:#666;">Coach</p>
	                        	<p style="color:#71B8EE; margin:0;font-size:13px;font-weight:500;">'.$coach_data[0]['usuario'].'</p>';
			}
			if($orden[0]['estado'] == '1')
			{
				$estado = '<span style="font-size:13px;color:#a00;">Orden no pagada</span>';
			}
			elseif($orden[0]['estado'] == '2')
			{
				$estado = '<span style="font-size:13px;color:#aaab40;">Orden en proceso</span>';
			}
			elseif($orden[0]['estado'] == '3')
			{
				$estado = '<span style="font-size:13px;color:#a00;">Orden cancelada</span>';
			}
			elseif($orden[0]['estado'] == '4')
			{
				$estado = '<span style="font-size:13px;color:#3E941C;">Orden terminada</span>';
			}
			if($tipo == '1')
			{
				$lista_orden = '
				<tr>
					<td>
	                    <h5 style="font-size:14px;font-weight: normal;line-height: normal;margin:0 0 8px 0;">'.$orden[0]['nombre'].'</h5>
						<p class="price-ord" style="margin:0 0 8px 0;">
							<span class="subtitle">Ganancia coach:</span> '.$orden[0]['precio_coach'].' <span class="subtitle">USD</span><br/>
							<span class="subtitle">Ganancia total:</span> '.$orden[0]['precio'].' <span class="subtitle">USD</span>
						</p>
						<p class="subtitle" style="margin:0;">Creado el '.$orden[0]['fecha'].'</p>
	               	</td>
	                <td class="center">
	                    '.$coaching.'
	                </td>
	                <td class="center">
	                    '.$estado.'
	                </td>
	                <td class="center">
	                    <a href="'.RUTA_INDEX.'coach/pedidos_terminados/'.$orden[0]['id_pedido'].'">
	                        <div class="btn_details">Detalles</div>
	                    </a>
	                </td>
	            </tr>';
			}
			$lista_ordenes_coaching.=''.$lista_orden.'';
		}
	}
	if($lista_ordenes_coaching == '')
	{
		$html = str_replace('{lista_ultimos_pedidos_terminados}', '
		<tr class="empty-state">
			<td colspan="6" style="border:0px;text-align:center;padding:20px;color:#999;">No hay pedidos de coaching terminados.</td>
		</tr>', $html);
	}
	else
	{
		$html = str_replace('{lista_ultimos_pedidos_terminados}', $lista_ordenes_coaching, $html);
	}
}
	
///////////////////////// LISTA ULTIMOS TRABAJOS COACHS //////////////////////////////////////
$ultimos_trabajos = $trabajos->ultimos_trabajos_terminados();

if ($ultimos_trabajos === false) {
	$ultimos_trabajos = array();
}

$lista_ultimos_trabajos = '';
if(count($ultimos_trabajos) == 0)
{
	$html = str_replace('{lista_ultimos_trabajos_terminados}', '<tr class="empty-state"><td colspan="7" style="border:0px;text-align:center;padding:20px;color:#999;">No hay trabajos de coach terminados.</td></tr>', $html);	
}
else
{
	for($i=0;$i<count($ultimos_trabajos);$i++)
	{
		$user = $usuarios->datos_usuario($ultimos_trabajos[$i]['id_usuario']);
		$horas_compradas = $ultimos_trabajos[$i]['horas_contratadas'];
		$horas_restantes = $ultimos_trabajos[$i]['horas_restantes'];
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
			$porcentaje = substr($porcentaje, 0, 2);
		}
	
		if($ultimos_trabajos[$i]['estado'] == '4')
		{
			$estado = "Orden Terminada";
		}

		$lista_ultimos_trabajos.='
			<tr>
				<td class="center" style="vertical-align: middle;width:250px;">
		           	<h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$ultimos_trabajos[$i]['tipo'].'</h5>
					<p class="price-ord" style="margin-top:15px;">
						<span class="subtitle">Precio : </span> '.$ultimos_trabajos[$i]['total'].' <span class="subtitle">USD</span>
					</p>
					<p class="subtitle" style="margin-top:10px;">Creado el '.$ultimos_trabajos[$i]['fecha'].'</p>
		        </td>
		        <td class="center" style="vertical-align:middle;width:100px;">
		            <p class="subtitle" style="margin:0px">Contratadas</p>
		            <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$horas_compradas.'</h5>
					<p class="subtitle">HS</p>
		        </td>
		        <td class="center" style="vertical-align:middle;width:100px;">
		            <p class="subtitle" style="margin:0px">Restantes</p>
		            <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$horas_restantes.'</h5>
					<p class="subtitle">HS</p>
		        </td>
		        <td class="center" style="vertical-align:top;width:80px;">
		            <p class="subtitle" style="margin:0px">Usuario</p>
		            <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$user[0]['usuario'].'</h5>
		        </td>
		        <td class="center" style="vertical-align:middle;width:80px">
		            <div class="progress progress-danger progress-striped active" style="margin-bottom:5px">
		                <div style="width: '.$porcentaje.'%" class="bar"></div>
		            </div>
		            <small class="subtitle" style="margin:0px">'.$porcentaje.'%</small>
		        </td>
		        <td class="center" style="vertical-align:middle;width:120px">
		            '.$estado.'
		        </td>
		        <td class="center" style="vertical-align:middle;">
		            <a href="'.RUTA_INDEX.'coachs/trabajos_terminados/'.$ultimos_trabajos[$i]['id_trabajo_coach'].'">
		                <div class="btn_details">Detalles</div>
		            </a>
		        </td>
		    </tr>
			';
	}
	$html = str_replace('{lista_ultimos_trabajos_terminados}', $lista_ultimos_trabajos, $html);
}

/////////////////////////// LISTA ULTIMOS PEDIDOS coach ////////////////////////////////
$mis_ordenes = $pedidos->ultimos_pedidos();

if ($mis_ordenes === false) {
	$mis_ordenes = array();
}

$lista_ordenes_coaching = '';
if(count($mis_ordenes) == 0)
{
	$html = str_replace('{lista_ultimos_pedidos}', '<tr class="empty-state">
			<td colspan="6" style="border:0px;text-align:center;padding:20px;color:#999;">No hay pedidos de coaching contratados.</td>
		</tr>', $html);
}
else
{
	$orden = '';
	$lista_ordenes_coaching = '';
	for($i=0;$i<count($mis_ordenes);$i++)
	{
		$tipo = $mis_ordenes[$i]['tipo_pedido'];
		$id_pedido = $mis_ordenes[$i]['id_pedido'];
		$orden = $pedidos->orden_tipo($tipo, $id_pedido);
		$usuario = $usuarios->datos_usuario($orden[0]['id_usuario']);
		$usuario = $usuario[0]['usuario'];
		if($orden[0]['estado'] == '1')
		{
			$estado = '<h5 style="font-size:14px;font-weight: normal;line-height: normal;">Orden</h5>
                       <p class="subtitle" style="margin:0px;color:#a00">Orden no paga</p>';
			$url = ''.RUTA_INDEX.'coach/pedidos_libres/'.$orden[0]['id_pedido'].'';
		}
		elseif($orden[0]['estado'] == '2')
		{
			$estado = '<h5 style="font-size:14px;font-weight: normal;line-height: normal;">Orden</h5>
                       <p class="subtitle" style="margin:0px;color:#aaab40">Orden en Proceso</p>';
			$url = ''.RUTA_INDEX.'coach/pedidos_activos/'.$orden[0]['id_pedido'].'';
		}
		elseif($orden[0]['estado'] == '3')
		{
			$estado = '<h5 style="font-size:14px;font-weight: normal;line-height: normal;">Orden</h5>
                       <p class="subtitle" style="margin:0px;color:#a00">Orden cancelada</p>';
			$url = ''.RUTA_INDEX.'coach/pedidos_cancelados/'.$orden[0]['id_pedido'].'';
		}
		elseif($orden[0]['estado'] == '4')
		{
			$estado = '<h5 style="font-size:14px;font-weight: normal;line-height: normal;">Orden</h5>
                       <p class="subtitle" style="margin:0px;color:#3E941C">Orden Terminada</p>';
			$url = ''.RUTA_INDEX.'coach/pedidos_terminados/'.$orden[0]['id_pedido'].'';
		}
		elseif($orden[0]['estado'] == '5')
		{
			$estado = '<h5 style="font-size:14px;font-weight: normal;line-height: normal;">Orden</h5>
                       <p class="subtitle" style="margin:0px;color:#3E941C">Orden Terminada</p>';
			$url = ''.RUTA_INDEX.'coach/pedidos_desocupados/'.$orden[0]['id_pedido'].'';
		}
		if($tipo == '1')
		{
			$lista_orden = '
			<tr>
                <td class="center" style="vertical-align: middle;">
                    <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['nombre'].'</h5>
					<p class="price-ord" style="margin-top:15px;">
						<span class="subtitle">Precio : </span> '.$orden[0]['precio'].' <span class="subtitle">USD</span>
					</p>
					<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
                </td>
                <td class="center" style="vertical-align:middle">
                    <p class="subtitle" style="margin:0px">usuario</p>
                    '.$usuario.'
                </td>
                <td class="center" style="vertical-align:middle">
                    '.$estado.'
                </td>
                <td class="center" style="vertical-align:middle;width:4%;">
                    <a href="'.$url.'">
                        <div class="btn_details">Detalles</div>
                    </a>
                </td>
            </tr>';
		}
		$lista_ordenes_coaching.=''.$lista_orden.'';
	}
	$html = str_replace('{lista_ultimos_pedidos}', $lista_ordenes_coaching, $html);
}	

//////////////////////// LISTA ULTIMOS TRABAJOS COACHS ///////////////////////////////////
$ultimos_trabajos = $trabajos->ultimos_trabajos();

if ($ultimos_trabajos === false) {
	$ultimos_trabajos = array();
}

$lista_ultimos_trabajos = '';
if(count($ultimos_trabajos) == 0)
{
	$html = str_replace('{lista_ultimas_trabajos}', '<tr class="empty-state"><td colspan="7" style="border:0px;text-align:center;padding:20px;color:#999;">No hay trabajos de coaches.</td></tr>', $html);
}
else
{
	for($i=0;$i<count($ultimos_trabajos);$i++)
	{
		$user = $usuarios->datos_usuario($ultimos_trabajos[$i]['id_usuario']);
		$horas_compradas = $ultimos_trabajos[$i]['horas_contratadas'];
		$horas_restantes = $ultimos_trabajos[$i]['horas_restantes'];
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
			$porcentaje = substr($porcentaje, 0, 2);
		}

		if($ultimos_trabajos[$i]['estado'] == '1')
		{
			$estado = "Orden No Paga";
			$url = ''.RUTA_INDEX.'coachs/trabajos_libres/'.$ultimos_trabajos[$i]['id_trabajo_coach'].'';
		}
		elseif($ultimos_trabajos[$i]['estado'] == '2')
		{
			$estado = "Orden en Proceso";
			$url = ''.RUTA_INDEX.'coachs/trabajos_activos/'.$ultimos_trabajos[$i]['id_trabajo_coach'].'';
		}
		elseif($ultimos_trabajos[$i]['estado'] == '3')
		{
			$estado = "Orden Cancelada";
			$url = ''.RUTA_INDEX.'coachs/trabajos_cancelados/'.$ultimos_trabajos[$i]['id_trabajo_coach'].'';
		}
		elseif($ultimos_trabajos[$i]['estado'] == '4')
		{
			$estado = "Orden Terminada";
			$url = ''.RUTA_INDEX.'coachs/trabajos_terminados/'.$ultimos_trabajos[$i]['id_trabajo_coach'].'';
		}

		$lista_ultimos_trabajos.='
			<tr>
				<td class="center" style="vertical-align: middle;width:250px;">
		          	<h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$ultimos_trabajos[$i]['tipo'].'</h5>
					<p class="price-ord" style="margin-top:15px;">
						<span class="subtitle">Precio : </span> '.$ultimos_trabajos[$i]['total'].' <span class="subtitle">USD</span>
					</p>
					<p class="subtitle" style="margin-top:10px;">Creado el '.$ultimos_trabajos[$i]['fecha'].'</p>
		        </td>
		        <td class="center" style="vertical-align:middle;width:100px;">
		            <p class="subtitle" style="margin:0px">Contratadas</p>
		            <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$horas_compradas.'</h5>
					<p class="subtitle">HS</p>
		        </td>
		        <td class="center" style="vertical-align:middle;width:100px;">
		            <p class="subtitle" style="margin:0px">Restantes</p>
		            <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$horas_restantes.'</h5>
					<p class="subtitle">HS</p>
		        </td>
		        <td class="center" style="vertical-align:top;width:80px;">
		            <p class="subtitle" style="margin:0px">Usuario</p>
		            <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$user[0]['usuario'].'</h5>
		        </td>
		        <td class="center" style="vertical-align:middle;width:80px">
		            <div class="progress progress-danger progress-striped active" style="margin-bottom:5px">
		              	<div style="width: '.$porcentaje.'%" class="bar"></div>
		            </div>
		            <small class="subtitle" style="margin:0px">'.$porcentaje.'%</small>
		        </td>
		        <td class="center" style="vertical-align:middle;width:120px">
		            '.$estado.'
		        </td>
		        <td class="center" style="vertical-align:middle;">
		            <a href="'.$url.'">
		                 <div class="btn_details">Detalles</div>
		            </a>
		        </td>
		    </tr>
			';
	}
	$html = str_replace('{lista_ultimas_trabajos}', $lista_ultimos_trabajos, $html);
}

///////////////////// lista_ultimas_clasificaciones /////////////////////////////////
$mis_ultimas_calificaciones = $trabajos->ultimas_calificaciones();

if ($mis_ultimas_calificaciones === false) {
	$mis_ultimas_calificaciones = array();
}

$lista_ultimas_calificaciones = '';
if(count($mis_ultimas_calificaciones) == 0)
{
	$html = str_replace('{lista_ultimas_calificaciones}', '<li class="empty-state" style="text-align:center;padding:20px;color:#999;">No hay calificaciones realizadas.</li>', $html);
}
else
{
	for($i=0;$i<count($mis_ultimas_calificaciones);$i++)
	{	
			
		$texto_cal = $mis_ultimas_calificaciones[$i]['txt_calificacion'];
		$texto_cal = substr($texto_cal, 0, 65);
		$user = $usuarios->datos_usuario($mis_ultimas_calificaciones[$i]['id_usuario']);
		$user_personal = $usuarios->datos_user_personal($mis_ultimas_calificaciones[$i]['id_usuario']);
		$trabajo = $trabajos->datos_trabajo($mis_ultimas_calificaciones[$i]['id_trabajo']);
		$lista_ultimas_calificaciones.='
		<li>
			<a href="'.RUTA_INDEX.'coachs/trabajos_terminados/'.$mis_ultimas_calificaciones[$i]['id_trabajo'].'" style="text-decoration:none">
			   	<img src="'.RUTA_INDEX.'images/user/'.$user_personal[0]['img_perfil'].'">
				<div class="uinfo" style="display:inline-block;margin-left:10px;vertical-align:middle;">
				    <h5>'.$mis_ultimas_calificaciones[$i]['tipo'].' con <b>'.$user[0]['usuario'].'</b></h5>
				    <span class="pos">
				        compradas : '.$trabajo[0]['horas_contratadas'].'hs; restantes : '.$trabajo[0]['horas_restantes'].'h
				    </span>
				  	<span>
				        Creado el : '.$trabajo[0]['fecha'].'
				    </span>
				</div>
				<div class="uinfo" style="display:inline-block;margin-left:10px;vertical-align:middle;">
				    <div class="ratingBig">
						<img class="rat'.$mis_ultimas_calificaciones[$i]['calificacion'].'" style="width:100%;height:240px;float:none;"src="'.RUTA_INDEX.'images/rating-stars.png" align="middle">
					</div>
				</div>
			    <div class="uinfo" style="display:inline-block;margin-left:10px;vertical-align:middle;">
				    <i style="width:190px;color:#999;display:block;">'.$texto_cal.'</i>
				</div>
			</a>
		</li>';
	}
	$html = str_replace('{lista_ultimas_calificaciones}', $lista_ultimas_calificaciones, $html);
}

$html = str_replace('{ruta}', RUTA, $html);
$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
echo $html;
?>
