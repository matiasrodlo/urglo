<?php
	$html = file_get_contents(__DIR__ . '/../index.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_coach/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_coach/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');
	require_once(__DIR__ . '/menu.php');
	
	$id_coach = $_SESSION['id_usuario'];
	$ultimos_trabajos = $trabajos->mis_ultimos_trabajos($id_coach);
	
	if ($ultimos_trabajos === false) {
		$ultimos_trabajos = array();
	}
	
	$lista_ultimos_trabajos = '';
	if(count($ultimos_trabajos) == 0)
	{
		$html = str_replace('{lista_ultimas_ordenes}', '<tr class="empty-state"><td colspan="7" style="border:0px;text-align:center;padding:40px;color:#999;">No hay órdenes de trabajo.</td></tr>', $html);
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
			}
			elseif($ultimos_trabajos[$i]['estado'] == '2')
			{
				$estado = "Orden en Proceso";
			}
			elseif($ultimos_trabajos[$i]['estado'] == '3')
			{
				$estado = "Orden Cancelada";
			}
			elseif($ultimos_trabajos[$i]['estado'] == '4')
			{
				$estado = "Orden Terminada";
			}

			$ganancia_coach = ($ultimos_trabajos[$i]['total']*30)/100;
			$ganancia_coach = $ultimos_trabajos[$i]['total'] - $ganancia_coach;
			$lista_ultimos_trabajos.='
				<tr>
					<td>
		            	<h5 style="font-size:14px;font-weight: normal;line-height: normal;margin:0 0 8px 0;">'.$ultimos_trabajos[$i]['tipo'].'</h5>
						<p class="price-ord" style="margin:0 0 8px 0;">
							<span class="subtitle">Precio:</span> '.$ganancia_coach.' <span class="subtitle">USD</span>
						</p>
						<p class="subtitle" style="margin:0;">Creado el '.$ultimos_trabajos[$i]['fecha'].'</p>
		            </td>
		            <td class="center">
		                <p class="subtitle" style="margin:0 0 4px 0;">Contratadas</p>
		                <h5 style="font-size:16px;font-weight: normal;line-height: normal;margin:0;">'.$horas_compradas.'</h5>
						<p class="subtitle" style="margin-top:4px;">Horas</p>
		            </td>
		            <td class="center">
		                <p class="subtitle" style="margin:0 0 4px 0;">Restantes</p>
		                <h5 style="font-size:16px;font-weight: normal;line-height: normal;margin:0;">'.$horas_restantes.'</h5>
						<p class="subtitle" style="margin-top:4px;">Horas</p>
		            </td>
		            <td class="center">
		                <p class="subtitle" style="margin:0 0 4px 0;">Usuario</p>
		                <h5 style="font-size:14px;font-weight: normal;line-height: normal;margin:0;">'.$user[0]['usuario'].'</h5>
		            </td>
		            <td class="center">
		                <div class="progress progress-danger progress-striped active" style="margin-bottom:5px">
		                	<div style="width: '.$porcentaje.'%" class="bar"></div>
		                </div>
		                <small class="subtitle" style="margin:0px">'.$porcentaje.'%</small>
		            </td>
		            <td class="center">
		                <span style="font-size:13px;color:#666;">'.$estado.'</span>
		            </td>
		            <td class="center">
		                <a href="'.RUTA_INDEX.'trabajos/'.$ultimos_trabajos[$i]['id_trabajo_coach'].'">
		                    <div class="btn_details">Detalles</div>
		                </a>
		            </td>
		        </tr>
			';
		}
		$html = str_replace('{lista_ultimas_ordenes}', $lista_ultimos_trabajos, $html);
	}

	/////////////////////////// MIS ULTIMAS CALIFICACIONES /////////////////////////////
	$mis_ultimas_calificaciones = $trabajos->mis_ultimas_calificaciones_coach($id_coach);
	
	if ($mis_ultimas_calificaciones === false) {
		$mis_ultimas_calificaciones = array();
	}
	
	$lista_ultimas_calificaciones = '';
	if(count($mis_ultimas_calificaciones) == 0)
	{
		$html = str_replace('{lista_ultimas_calificaciones}', '<li class="empty-state">No hay calificaciones realizadas.</li>', $html);
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
				<a href="'.RUTA_INDEX.'trabajos/'.$mis_ultimas_calificaciones[$i]['id_trabajo'].'" style="text-decoration:none;display:flex;align-items:center;gap:16px;">
				   	<img src="'.RUTA_INDEX.'images/user/'.$user_personal[0]['img_perfil'].'" style="width:48px;height:48px;border-radius:4px;object-fit:cover;flex-shrink:0;">
				    <div class="uinfo" style="flex:1;min-width:0;">
				        <h5 style="margin:0 0 4px 0;font-size:14px;font-weight:500;">'.$trabajo[$i]['tipo'].' con <b style="color:#71B8EE;">'.$user[0]['usuario'].'</b></h5>
				        <span class="pos" style="display:block;font-size:12px;color:#666;margin-bottom:2px;">
				            Compradas: '.$trabajo[0]['horas_contratadas'].'hs; Restantes: '.$trabajo[0]['horas_restantes'].'h
				        </span>
				        <span style="display:block;font-size:12px;color:#999;">
				            Creado el '.$trabajo[0]['fecha'].'
				        </span>
				    </div>
				    <div class="uinfo" style="flex-shrink:0;">
				        <div class="ratingBig">
							<img class="rat'.$mis_ultimas_calificaciones[$i]['calificacion'].'" src="'.RUTA_INDEX.'images/rating-stars.png">
						</div>
				    </div>
				    <div class="uinfo" style="flex:1;min-width:0;">
				        <p style="margin:0;color:#666;font-size:13px;font-style:normal;line-height:1.5;">'.$texto_cal.'</p>
				    </div>
				</a>
			</li>
			';
		}
		$html = str_replace('{lista_ultimas_calificaciones}', $lista_ultimas_calificaciones, $html);
	}

	//////////////////////////// MIS ULTIMAS GANANCIAS ////////////////////////
	$mis_ultimas_ganancias = $trabajos->mis_ultimos_trabajos_terminados($id_coach);
	
	if ($mis_ultimas_ganancias === false) {
		$mis_ultimas_ganancias = array();
	}
	
	$lista_ganancias = '';
	if(count($mis_ultimas_ganancias) == 0)
	{
		$html = str_replace('{lista_ultimas_ganancias}', '<li class="empty-state">No hay ganancias registradas.</li>', $html);
	}
	else
	{
		for($i=0;$i<count($mis_ultimas_ganancias);$i++)
		{
			$user_personal = $usuarios->datos_user_personal($mis_ultimas_ganancias[$i]['id_usuario']);
			$user = $usuarios->datos_usuario($mis_ultimas_ganancias[$i]['id_usuario']);
			$ganancia_coach = ($mis_ultimas_ganancias[$i]['total']*30)/100;
			$ganancia_coach = $mis_ultimas_ganancias[$i]['total'] - $ganancia_coach;
			$lista_ultimas_ganancias.='
			<li>
				<a href="'.RUTA_INDEX.'trabajos/'.$mis_ultimas_ganancias[$i]['id_trabajo_coach'].'" style="text-decoration:none;display:flex;align-items:center;gap:16px;">
					<img src="'.RUTA_INDEX.'images/user/'.$user_personal[0]['img_perfil'].'" style="width:48px;height:48px;border-radius:4px;object-fit:cover;flex-shrink:0;">
					<div class="uinfo" style="flex:1;min-width:0;">
						<h5 style="margin:0 0 4px 0;font-size:14px;font-weight:500;">'.$mis_ultimas_ganancias[$i]['tipo'].' con <b style="color:#71B8EE;">'.$user[0]['usuario'].'</b></h5>
						<span class="pos" style="display:block;font-size:12px;color:#666;margin-bottom:2px;">
						    Ganancia: '.$ganancia_coach.' USD
						</span>
						<span style="display:block;font-size:12px;color:#999;">
						    Creado el '.$mis_ultimas_ganancias[$i]['fecha'].'
						</span>
					</div>
				</a>
			</li>
			';
		}
		$html = str_replace('{lista_ultimas_ganancias}', $lista_ultimas_ganancias, $html);
	}

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>
