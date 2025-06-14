<?php
	$html = file_get_contents('vistas/user/index.html');
	$header_desconectado = file_get_contents('vistas/user/plantilla_user/header.html');
	$footer_desconectado = file_get_contents('vistas/user/plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	/////////////////////// MIS ULTIMAS ORDENES coachingS /////////////////////////////
	$mis_ordenes = $pedidos->mis_ultimas_ordenes($id_usuario);
	if($mis_ordenes == false)
	{
		$html = str_replace('{lista_ultimas_coaching}', '
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
                        	<p style="color:#a00; margin:0px;">No Asignado</p>';
			}
			else
			{
				$elo = $usuarios->datos_usuario($orden[0]['id_coacher']);
				$coaching= '<p class="subtitle" style="margin:0px">coacher</p>
                        	<p style="color:#71B8EE; margin:0px;">'.$elo[0]['usuario'].'</p>';
			}
			if($orden[0]['estado'] == '1')
			{
				$estado = '<h5 style="font-size:14px;font-weight: normal;line-height: normal;">Orden</h5>
                        <p class="subtitle" style="margin:0px;color:#a00">Orden no paga</p>';
			}
			elseif($orden[0]['estado'] == '2')
			{
				$estado = '<h5 style="font-size:14px;font-weight: normal;line-height: normal;">Orden</h5>
                        <p class="subtitle" style="margin:0px;color:#aaab40">Orden en Proceso</p>';
			}
			elseif($orden[0]['estado'] == '3')
			{
				$estado = '<h5 style="font-size:14px;font-weight: normal;line-height: normal;">Orden</h5>
                        <p class="subtitle" style="margin:0px;color:#a00">Orden cancelada</p>';
			}
			elseif($orden[0]['estado'] == '4')
			{
				$estado = '<h5 style="font-size:14px;font-weight: normal;line-height: normal;">Orden</h5>
                        <p class="subtitle" style="margin:0px;color:#3E941C">Orden Terminada</p>';
			}
			elseif($orden[0]['estado'] == '5')
			{
				$estado = '<h5 style="font-size:14px;font-weight: normal;line-height: normal;">Orden</h5>
                        <p class="subtitle" style="margin:0px;color:#3E941C">Orden Confirmada</p>';
			}
			if($tipo == '1')
			{
			

				$level_current = level($orden[0]['id_level_current'], $orden[0]['id_division_current']);
				$level_llegada = level($orden[0]['id_level_llegada'], $orden[0]['id_division_llegada']);
				$lista_orden = '
				<tr>
					<td class="center" style="vertical-align: middle;">
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['nombre'].'</h5>
						<p class="price-ord" style="margin-top:15px;">
							<span class="subtitle">Precio : </span> '.$orden[0]['precio'].' <span class="subtitle">USD</span>
						</p>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
                   	</td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">Actualmente</p>
                        <img src="http://urglo.com/miembros/images/Game/'.$level_current['imagen'].'" style="width:40px;">
                        <p class="subtitle" style="margin:0px">'.$level_current['nombre'].'</p>
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">Deseado</p>
                        <img src="http://urglo.com/miembros/images/Game/'.$level_llegada['imagen'].'" style="width:40px;">                        
                        <p class="subtitle" style="margin:0px">'.$level_llegada['nombre'].'</p>
                    </td>
                    <td class="center" style="vertical-align:middle">
                    	'.$coaching.'
                    </td>
                    <td class="center" style="vertical-align:middle">
                        <div class="progress progress-danger progress-striped active" style="margin-bottom:5px">
                            <div style="width: 0%" class="bar"></div>
                        </div>
                        <small class="subtitle" style="margin:0px">0%</small>
                    </td>
                    <td class="center" style="vertical-align:middle">
                        '.$estado.'
                    </td>
                    <td class="center" style="vertical-align:middle;width:4%;">
                        <a href="http://urglo.com/miembros/coaching/mis_ordenes/'.$orden[0]['id_pedido'].'">
                           <div class="btn_details">Detalles</div>
                        </a>
                    </td>
                </tr>';
			}
			elseif($tipo == '2')
			{
				$games_comprados = $orden[0]['games'];
				$games_current = $orden[0]['games_current'];
				if($games_current == '0')
				{
					$porcentaje = '0';
				}
				elseif($games_current == $games_comprados)
				{
					$porcentaje = '100';
				}
				else
				{
					$porcentaje = ($games_current*100)/$games_comprados;
					$porcentaje = substr($porcentaje, 0, 2);
				}

				$lista_orden = '
				<tr>
					<td class="center" style="vertical-align: middle;">
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['nombre'].'</h5>
						<p class="price-ord" style="margin-top:15px;">
							<span class="subtitle">Precio : </span> '.$orden[0]['precio'].' <span class="subtitle">USD</span>
						</p>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
                   	</td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">Actualmente</p>
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['games_current'].'</h5>
						<p class="subtitle">GAMES</p>
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">Deseado</p>
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['games'].'</h5>
						<p class="subtitle">GAMES</p>
                    </td>
                    <td class="center" style="vertical-align:middle">
                    	'.$coaching.'
                    </td>
                    <td class="center" style="vertical-align:middle">
                        <div class="progress progress-danger progress-striped active" style="margin-bottom:5px">
                            <div style="width: '.$porcentaje.'%" class="bar"></div>
                        </div>
                        <small class="subtitle" style="margin:0px">'.$porcentaje.'%</small>
                    </td>
                    <td class="center" style="vertical-align:middle">
                        '.$estado.'
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <a href="http://urglo.com/miembros/coaching/mis_ordenes/'.$orden[0]['id_pedido'].'">
                           <div class="btn_details">Detalles</div>
                        </a>
                    </td>
                </tr>';
			}
			elseif($tipo == '3')
			{
				$wins_compradas = $orden[0]['number_wins'];
				$wins_realizadas = $orden[0]['number_wins_current'];
				if($wins_realizadas == '0')
				{
					$porcentaje = '0';
				}
				elseif($wins_realizadas == $wins_compradas)
				{
					$porcentaje = '100';
				}
				else
				{
					$porcentaje = ($wins_realizadas*100)/$wins_compradas;
					$porcentaje = substr($porcentaje, 0, 2);
				}

				$lista_orden = '
				<tr>
					<td class="center" style="vertical-align: middle;">
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['nombre'].'</h5>
						<p class="price-ord" style="margin-top:15px;">
							<span class="subtitle">Precio : </span> '.$orden[0]['precio'].' <span class="subtitle">USD</span>
						</p>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
                   	</td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">Actualmente</p>
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['number_wins_current'].'</h5>
						<p class="subtitle">WINS</p>
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">Deseado</p>
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['number_wins'].'</h5>
						<p class="subtitle">WINS</p>
                    </td>
                    <td class="center" style="vertical-align:middle">
                    	'.$coaching.'
                    </td>
                    <td class="center" style="vertical-align:middle">
                        <div class="progress progress-danger progress-striped active" style="margin-bottom:5px">
                            <div style="width: '.$porcentaje.'%" class="bar"></div>
                        </div>
                        <small class="subtitle" style="margin:0px">'.$porcentaje.'%</small>
                    </td>
                    <td class="center" style="vertical-align:middle">
                        '.$estado.'
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <a href="http://urglo.com/miembros/coaching/mis_ordenes/'.$orden[0]['id_pedido'].'">
                           <div class="btn_details">Detalles</div>
                        </a>
                    </td>
                </tr>';
			}
			elseif($tipo == '4')
			{
				$level_current = level($orden[0]['id_level_current'], '0');
				$level_llegada = level($orden[0]['id_level_llegada'], $orden[0]['id_division_llegada']);
				$lista_orden = '
				<tr>
					<td class="center" style="vertical-align: middle;">
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['nombre'].'</h5>
						<p class="price-ord" style="margin-top:15px;">
							<span class="subtitle">Precio : </span> '.$orden[0]['precio'].' <span class="subtitle">USD</span>
						</p>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
                   	</td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">Actualmente</p>
                        <img src="http://urglo.com/miembros/images/Game/'.$level_current['imagen'].'" style="width:60px;">
						<p class="subtitle" style="margin-top:10px;">'.$level_current['nombre'].'</p>
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">Deseado</p>
                        <img src="http://urglo.com/miembros/images/Game/'.$level_llegada['imagen'].'" style="width:60px;">
						<p class="subtitle" style="margin-top:10px;">'.$level_llegada['nombre'].'</p>
                    </td>
                    <td class="center" style="vertical-align:middle">
                    	'.$coaching.'
                    </td>
                    <td class="center" style="vertical-align:middle">
                        <div class="progress progress-danger progress-striped active" style="margin-bottom:5px">
                            <div style="width: 0%" class="bar"></div>
                        </div>
                        <small class="subtitle" style="margin:0px">0%</small>
                    </td>
                    <td class="center" style="vertical-align:middle">
                        '.$estado.'
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <a href="http://urglo.com/miembros/coaching/mis_ordenes/'.$orden[0]['id_pedido'].'">
                           <div class="btn_details">Detalles</div>
                        </a>
                    </td>
                </tr>';
			}
			elseif($tipo == '5')
			{
				$wins_compradas = $orden[0]['wins'];
				$wins_realizadas = $orden[0]['wins_current'];
				if($wins_realizadas == '0')
				{
					$porcentaje = '0';
				}
				elseif($wins_realizadas == $wins_compradas)
				{
					$porcentaje = '100';
				}
				else
				{
					$porcentaje = ($wins_realizadas*100)/$wins_compradas;
					$porcentaje = substr($porcentaje, 0, 2);
				}
	
				$lista_orden = '
				<tr>
					<td class="center" style="vertical-align: middle;">
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['nombre'].'</h5>
						<p class="price-ord" style="margin-top:15px;">
							<span class="subtitle">Precio : </span> '.$orden[0]['precio'].' <span class="subtitle">USD</span>
						</p>
						<p class="subtitle" style="margin-top:10px;">Creado el '.$orden[0]['fecha'].'</p>
                   	</td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">Actualmente</p>
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['wins_current'].'</h5>
						<p class="subtitle">WINS</p>
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">Deseado</p>
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['wins'].'</h5>
					    <p class="subtitle">WINS</p>
                    </td>
                    <td class="center" style="vertical-align:middle">
                    	'.$coaching.'
                    </td>
                    <td class="center" style="vertical-align:middle">
                        <div class="progress progress-danger progress-striped active" style="margin-bottom:5px">
                            <div style="width: '.$porcentaje.'%" class="bar"></div>
                        </div>
                        <small class="subtitle" style="margin:0px">'.$porcentaje.'%</small>
                    </td>
                    <td class="center" style="vertical-align:middle">
                        '.$estado.'
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <a href="http://urglo.com/miembros/coaching/mis_ordenes/'.$orden[0]['id_pedido'].'">
                           <div class="btn_details">Detalles</div>
                        </a>
                    </td>
                </tr>';
			}

			$lista_ordenes_coaching.=''.$lista_orden.'';
		}
		$html = str_replace('{lista_ultimas_coaching}', $lista_ordenes_coaching, $html);
	}


	//////////////////////////// MI ULTIMAS ORDENES COACHS //////////////////////
	$mis_ordenes = $trabajos->mis_ultimas_ordenes_coachs($id_usuario);
	$lista_mis_ordenes = '';
	for($i=0;$i<count($mis_ordenes);$i++)
	{
		if($mis_ordenes[$i]['estado'] == '1' or $mis_ordenes[$i]['estado'] == '2' or $mis_ordenes[$i]['estado'] == '4')
		{
			$datos_coach = $usuarios->datos_usuario($mis_ordenes[$i]['id_coach']);
			$coach = $usuarios->datos_coach($mis_ordenes[$i]['id_coach']);
			$coach_personal = $usuarios->datos_user_personal($mis_ordenes[$i]['id_coach']);
			//print_r($coach);
			$level = level($coach[0]['id_level'], $coach[0]['id_division']);
		
			if($mis_ordenes[$i]['estado'] == '1')
			{
				$estado = "Orden No Paga";
			}
			elseif($mis_ordenes[$i]['estado'] == '2')
			{
				$estado = "Orden en Proceso";
			}
			elseif($mis_ordenes[$i]['estado'] == '3')
			{
				$estado = "Orden Cancelada";
			}
			elseif($mis_ordenes[$i]['estado'] == '4')
			{
				$estado = "Orden Terminada";
			}
			elseif($mis_ordenes[$i]['estado'] == '5')
			{
				$estado = "Orden Confirmada";
			}

			$lista_mis_ordenes.='
			<li>
                <a href="http://urglo.com/miembros/coachs/mis_ordenes/'.$mis_ordenes[$i]['id_trabajo_coach'].'" style="text-decoration:none">
                    <img src="http://urglo.com/miembros/images/user/'.$coach_personal[0]['img_perfil'].'">
                    <div class="uinfo">
                        <h5>'.$mis_ordenes[$i]['tipo'].' con '.$datos_coach[0]['usuario'].' </h5>
                        <span class="pos">
                            compradas : '.$mis_ordenes[$i]['horas_contratadas'].'h; realizo : '.$mis_ordenes[$i]['horas_restantes'].'h
                        </span>
                        <span>
                            Creado el : '.$mis_ordenes[$i]['fecha'].'
                        </span>
                    </div>
                </a>
            </li>';
		}
		else
		{

		}
	}
	if($mis_ordenes == false)
	{
		$html = str_replace('{lista_ultimas_coachs}', '<li style="text-align:center">No tenes ningun orden contratada</li>', $html);
	}
	else
	{
		$html = str_replace('{lista_ultimas_coachs}', $lista_mis_ordenes, $html);
	}

	/////////////////////// ULTIMAS CALIFICACIONES ////////////////////////////////
	$ultimas_calificaciones = $trabajos->mis_ultimas_calificaciones($id_usuario);
	$lista_ultimas_calificaciones = '';
	if($ultimas_calificaciones == false)
	{
		$html = str_replace('{lista_ultimas_calificaciones}', '<li style="text-align:center">No hay ninguna calificacion realizada.</li>', $html);
	}
	else
	{
		for($i=0;$i<count($ultimas_calificaciones);$i++)
		{
			$coach = $usuarios->datos_usuario($ultimas_calificaciones[$i]['id_coach']);
			$coach_personal = $usuarios->datos_user_personal($ultimas_calificaciones[$i]['id_coach']);
			$lista_ultimas_calificaciones.='
			<li>
                <a href="http://urglo.com/miembros/coachs/mis_ordenes/'.$ultimas_calificaciones[$i]['id_trabajo'].'" style="text-decoration:none">
                    <img src="http://urglo.com/miembros/images/user/'.$coach_personal[0]['img_perfil'].'">
                    <div class="uinfo">
                        <h5>Calificacion al coach <b>'.$coach[0]['usuario'].'</b></h5>
                        <span>Calificacion:</span>
			            <div class="ratingSmall" style="margin:-2px 0;">
							<img src="http://urglo.com/miembros/images/rating-stars-small.png" align="middle" class="rat'.$ultimas_calificaciones[$i]['calificacion'].'" style="width:98px;height:120px;">
						</div>
                    </div>
                </a>
            </li>
			';
		}
		$html = str_replace('{lista_ultimas_calificaciones}', $lista_ultimas_calificaciones, $html);
	}

	////////////////////// ULTIMOS COMENTARIOS ///////////////////////////////////
	$ultimos_comentarios = $trabajos->mis_ultimas_calificaciones($id_usuario);
	$lista_ultimos_comentarios = '';
	if($ultimos_comentarios == false)
	{
		$html = str_replace('{lista_ultimos_comentarios}', '<li style="text-align:center">No hay ningun comentario realizado.</li>', $html);
	}
	else
	{

	}

	/////////////////////TOP 3 COACH
	$top3 = $usuarios->top3_coach();
	$lista_top = '';
	if($top3 == false)
	{
		$html = str_replace('{top3_coach}', 'No hay coachs calificados.', $html);
	}
	else
	{
		for($i=0;$i<count($top3);$i++)
		{
			$id_coach = $top3[$i]['id_coach'];
			$datos_usuario = $usuarios->datos_usuario($id_coach);
			$datos_user_per = $usuarios->datos_user_personal($id_coach);
			$datos_perfil = $usuarios->datos_coach($id_coach);
			$calificaciones = $trabajos->calificaciones_coach($id_coach);
			$total = '';
			$cantidad_calificaciones = count($calificaciones);
			for($x=0;$x<$cantidad_calificaciones;$x++)
			{
				$total = $total + $calificaciones[$x]['calificacion']; 
			}

			$rating = $total/$cantidad_calificaciones;
			$rating = substr($rating, 0, 1);
			$level = level($datos_perfil[0]['id_level'], $datos_perfil[0]['id_division']);
		
			$lista_top.='<li>
		                <a href="http://urglo.com/miembros/coachs/'.$datos_usuario[0]['usuario'].'" style="text-decoration:none">
		                    <img src="http://urglo.com/miembros/images/user/'.$datos_user_per[0]['img_perfil'].'">
		                    <div class="uinfo">
		                        <h5><b>'.$datos_usuario[0]['usuario'].'</b></h5>
					            <div class="ratingSmall" style="margin:-2px 0;">
								<img src="http://urglo.com/miembros/images/rating-stars-small.png" align="middle" class="rat'.$rating.'" style="width:98px;height:120px;">
								</div>
								<span>'.$level['nombre'].'</span>
		                    </div>
		                </a>
		            </li>';
		}
		$html = str_replace('{top3_coach}', $lista_top, $html);
	}

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>