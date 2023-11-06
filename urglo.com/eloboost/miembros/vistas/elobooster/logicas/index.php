<?php
	$html = file_get_contents('vistas/elobooster/index.html');
	$header_desconectado = file_get_contents('vistas/elobooster/plantilla_elo/header.html');
	$footer_desconectado = file_get_contents('vistas/elobooster/plantilla_elo/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	///////////////////////// MIS ULTIMOS TRABAJOS BOOSTINGS //////////////////////////////
	$id_booster = $_SESSION['id_usuario'];
	$mis_ordenes = $pedidos->mis_ultimas_ordenes_boost($id_booster);
	$lista_ordenes_boosting = '';
	if($mis_ordenes == false)
	{
		$html = str_replace('{lista_ultimas_boosting}', '<tr style="background-color:#fff;color:#000;">
				<td colspan="6" style="border:0px;">No hay ningún orden contratada.</td>
			</tr>', $html);
	}
	else
	{
		$lista_ordenes_boosting = '';
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
			}
			elseif($orden[0]['estado'] == '2')
			{
				$estado = '<h5 style="font-size:14px;font-weight: normal;line-height: normal;">Orden</h5>
                        <p class="subtitle" style="margin:0px;color:#3E941C">Orden en Proceso</p>';
				$url = 'http://urglo.com/eloboost/miembros/pedidos_activos/'.$orden[0]['id_pedido'].'';
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
                $url = 'http://urglo.com/eloboost/miembros/pedidos_terminados/'.$orden[0]['id_pedido'].'';
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
                        <p class="subtitle" style="margin:0px">actual</p>
                        <img src="http://urglo.com/eloboost/miembros/images/Game/'.$level_current['imagen'].'" style="width:40px;">
                        <p class="subtitle" style="margin:0px">'.$level_current['nombre'].'</p>
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">deseado</p>
                        <img src="http://urglo.com/eloboost/miembros/images/Game/'.$level_llegada['imagen'].'" style="width:40px;">                        
                        <p class="subtitle" style="margin:0px">'.$level_llegada['nombre'].'</p>
                    </td>
                    <td class="center" style="vertical-align:middle">
                    	<p class="subtitle" style="margin:0px">usuario</p>
                    	'.$usuario.'
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
                        <a href="'.$url.'">
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
                        <p class="subtitle" style="margin:0px">actual</p>
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['games_current'].'</h5>
						<p class="subtitle">GAMES</p>
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">deseado</p>
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['games'].'</h5>
						<p class="subtitle">GAMES</p>
                    </td>
                    <td class="center" style="vertical-align:middle">
                    	<p class="subtitle" style="margin:0px">usuario</p>
                    	'.$usuario.'
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
                        <a href="'.$url.'">
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
                        <p class="subtitle" style="margin:0px">actual</p>
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['number_wins_current'].'</h5>
						<p class="subtitle">VICTORIAS</p>
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">deseado</p>
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['number_wins'].'</h5>
						<p class="subtitle">VICTORIAS</p>
                    </td>
                    <td class="center" style="vertical-align:middle">
                    	<p class="subtitle" style="margin:0px">usuario</p>
                    	'.$usuario.'
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
                        <a href="'.$url.'">
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
                        <p class="subtitle" style="margin:0px">actual</p>
                        <img src="http://urglo.com/eloboost/miembros/images/Game/'.$level_current['imagen'].'" style="width:60px;">
						<p class="subtitle" style="margin-top:10px;">'.$level_current['nombre'].'</p>
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">deseado</p>
                        <img src="http://urglo.com/eloboost/miembros/images/Game/'.$level_llegada['imagen'].'" style="width:60px;">
						<p class="subtitle" style="margin-top:10px;">'.$level_llegada['nombre'].'</p>
                    </td>
                    <td class="center" style="vertical-align:middle">
                    	<p class="subtitle" style="margin:0px">usuario</p>
                    	'.$usuario.'
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
                        <a href="'.$url.'">
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
                        <p class="subtitle" style="margin:0px">actual</p>
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['wins_current'].'</h5>
						<p class="subtitle">VICTORIAS</p>
                    </td>
                    <td class="center" style="vertical-align:middle;">
                        <p class="subtitle" style="margin:0px">deseado</p>
                        <h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$orden[0]['wins'].'</h5>
					    <p class="subtitle">VICTORIAS</p>
                    </td>
                    <td class="center" style="vertical-align:middle">
                    	<p class="subtitle" style="margin:0px">usuario</p>
                    	'.$usuario.'
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
                        <a href="'.$url.'">
                           <div class="btn_details">Detalles</div>
                        </a>
                    </td>
                </tr>';
			}

			$lista_ordenes_boosting.=''.$lista_orden.'';
		}
		$html = str_replace('{lista_ultimas_boosting}', $lista_ordenes_boosting, $html);
	}	
	//////////////////////// MIS ULTIMAS GANANCIAS ////////////////////////////////////////
	$mis_ultimas_ordenes = $pedidos->mis_ultimas_ordenes_boost($id_booster);
	$lista_ultimas_ganancias = '';
	if($mis_ultimas_ordenes == false)
	{
		$html = str_replace('{lista_ultimas_ganancias}', '<li style="text-align:center">Todavia no tienes ninguna ganancia.</li>', $html);
	}
	else
	{
		for($i=0;$i<count($mis_ultimas_ordenes);$i++)
		{
			$id_orden = $mis_ultimas_ordenes[$i]['id_pedido'];
			$tipo_pedido = $mis_ultimas_ordenes[$i]['tipo_pedido'];
			//echo 'id orden: '.$id_orden.' tipo: '.$tipo_pedido.'<br/>';
			$orden = $pedidos->orden_tipo_estado($tipo_pedido, $id_orden, '4');
			if($orden == false)
			{
				$lista_ultimas_ganancias.='';
			}
			else
			{	
				$lista_ultimas_ganancias.='
					<li style="margin-left:0px;">
						<a href="http://urglo.com/eloboost/miembros/pedidos_terminados/'.$orden[0]['id_pedido'].'" style="text-decoration:none">
							<div class="uinfo" style="margin-left:0px;">
								<h5>'.$orden[0]['nombre'].'</h5>
								<span class="pos">
		                           Ganancia : '.$orden[0]['precio_elo'].'
		                        </span>
		                        <span>
									Creado el : '.$orden[0]['fecha'].'
								</span>
							</div>
						</a>
					</li>
				';
			}
		}
		if($lista_ultimas_ganancias == '')
		{
			$html = str_replace('{lista_ultimas_ganancias}', '<li style="text-align:center">Todavia no tienes ninguna ganancia.</li>', $html);
		}
		else
		{
			$html = str_replace('{lista_ultimas_ganancias}', $lista_ultimas_ganancias, $html);
		}
	}

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>
