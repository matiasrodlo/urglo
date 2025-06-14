<?php
	$html = file_get_contents('vistas/coach/index.html');
	$header_desconectado = file_get_contents('vistas/coach/plantilla_coach/header.html');
	$footer_desconectado = file_get_contents('vistas/coach/plantilla_coach/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');
	require_once('vistas/coach/logicas/menu.php');
	
	$id_coach = $_SESSION['id_usuario'];
	$ultimos_trabajos = $trabajos->mis_ultimos_trabajos($id_coach);
	$lista_ultimos_trabajos = '';
	if($ultimos_trabajos == false)
	{
		$html = str_replace('{lista_ultimas_ordenes}', '<tr><td colspan="7" style="border:0px;">No tenes ninguna orden.</td></tr>', $html);
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
					<td class="center" style="vertical-align: middle;width:250px;">
		            	<h5 style="font-size:14px;font-weight: normal;line-height: normal;">'.$ultimos_trabajos[$i]['tipo'].'</h5>
						<p class="price-ord" style="margin-top:15px;">
							<span class="subtitle">Precio : </span> '.$ganancia_coach.' <span class="subtitle">USD</span>
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
		                <a href="http://urglo.com/miembros/trabajos/'.$ultimos_trabajos[$i]['id_trabajo_coach'].'">
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
	$lista_ultimas_calificaciones = '';
	if($mis_ultimas_calificaciones == false)
	{
		$html = str_replace('{lista_ultimas_calificaciones}', '<li style="text-align:center">No hay ninguna calificacion realizada.</li>', $html);
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
				<a href="http://urglo.com/miembros/trabajos/'.$mis_ultimas_calificaciones[$i]['id_trabajo'].'" style="text-decoration:none">
				   	<img src="http://urglo.com/miembros/images/user/'.$user_personal[0]['img_perfil'].'">
				    <div class="uinfo" style="display:inline-block;margin-left:10px;vertical-align:middle;">
				        <h5>'.$trabajo[$i]['tipo'].' con <b>'.$user[0]['usuario'].'</b></h5>
				        <span class="pos">
				            compradas : '.$trabajo[0]['horas_contratadas'].'hs; restantes : '.$trabajo[0]['horas_restantes'].'h
				        </span>
				        <span>
				            Creado el : '.$trabajo[0]['fecha'].'
				        </span>
				    </div>
				    <div class="uinfo" style="display:inline-block;margin-left:10px;vertical-align:middle;">
				        <div class="ratingBig">
							<img class="rat'.$mis_ultimas_calificaciones[$i]['calificacion'].'" style="width:100%;height:240px;float:none;"src="http://urglo.com/miembros/images/rating-stars.png" align="middle">
						</div>
				    </div>
				    <div class="uinfo" style="display:inline-block;margin-left:10px;vertical-align:middle;">
				        <i style="width:190px;color:#999;display:block;">'.$texto_cal.'</i>
				    </div>
				</a>
			</li>
			';
		}
		$html = str_replace('{lista_ultimas_calificaciones}', $lista_ultimas_calificaciones, $html);
	}

	//////////////////////////// MIS ULTIMAS GANANCIAS ////////////////////////
	$mis_ultimas_ganancias = $trabajos->mis_ultimos_trabajos_terminados($id_coach);
	$lista_ganancias = '';
	if($mis_ultimas_ganancias == false)
	{
		$html = str_replace('{lista_ultimas_ganancias}', '<li style="text-align:center">Todavia no hay ninguna ganancia.</li>', $html);
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
				<a href="http://urglo.com/miembros/trabajos/'.$mis_ultimas_ganancias[$i]['id_trabajo_coach'].'" style="text-decoration:none">
					<img src="http://urglo.com/miembros/images/user/'.$user_personal[0]['img_perfil'].'">
					<div class="uinfo" style="display:inline-block;margin-left:10px;vertical-align:middle;">
						<h5>'.$mis_ultimas_ganancias[$i]['tipo'].' con <b>'.$user[0]['usuario'].'</b></h5>
						<span class="pos">
						    Ganancia: '.$ganancia_coach.' USD
						</span>
						<span>
						    Creado el : '.$mis_ultimas_ganancias[$i]['fecha'].'
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