<?php
	$html = file_get_contents('vistas/user/orden_coaching_1_activa.html');
	$header_desconectado = file_get_contents('vistas/user/plantilla_user/header.html');
	$footer_desconectado = file_get_contents('vistas/user/plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$html = str_replace('{id_trabajo}', $orden[0]['id_pedido'], $html);
	$html = str_replace('{id_usuario}', $orden[0]['id_usuario'], $html);
	$html = str_replace('{tipo}', $orden[0]['nombre'], $html);
	$html = str_replace('{precio}', $orden[0]['precio'], $html);
	$html = str_replace('{estado_user}', $orden[0]['estado_user'], $html);
	$html = str_replace('{estado_elo}', $orden[0]['estado_elo'], $html);

	$started = level($orden[0]['id_level_inicio'], $orden[0]['id_division_inicio']);
	$html = str_replace('{img_started}', $started['imagen'], $html);
	$html = str_replace('{level_started}', $started['nombre'], $html);

	$current = level($orden[0]['id_level_current'], $orden[0]['id_division_current']);
	$html = str_replace('{img_current}', $current['imagen'], $html);
	$html = str_replace('{level_current}', $current['nombre'], $html);
	
	$desired = level($orden[0]['id_level_llegada'], $orden[0]['id_division_llegada']);
	$html = str_replace('{img_desired}', $desired['imagen'], $html);
	$html = str_replace('{level_desired}', $desired['nombre'], $html);

	$level_current = $orden[0]['id_level_current'];
	$division_currrent = $orden[0]['id_division_current'];
	$nom_current = $current['nom'];
	$div_current = $current['div'];

	$html = str_replace('{lvl_current}', $level_current, $html);
	$html = str_replace('{div_current}', $division_currrent, $html);
	$html = str_replace('{nom_current}', $nom_current, $html);
	$html = str_replace('{divs_current}', $div_current, $html);

	$progress = '';
	if($orden[0]['id_level_llegada'] == '5')
	{
		$level_llegada = '1';
	}
	elseif($orden[0]['id_level_llegada'] == '4')
	{
		$level_llegada = '2';
	}
	elseif($orden[0]['id_level_llegada'] == '3')
	{
		$level_llegada = '3';
	}
	elseif($orden[0]['id_level_llegada'] == '2')
	{
		$level_llegada = '4';
	}
	elseif($orden[0]['id_level_llegada'] == '1')
	{
		$level_llegada = '5';
	}
	elseif($orden[0]['id_level_llegada'] == '6')
	{
		$level_llegada = '6';
	}
	if($orden[0]['id_level_inicio'] == '5')
	{
		$level_inicio = '1';
	}
	elseif($orden[0]['id_level_inicio'] == '4')
	{
		$level_inicio = '2';
	}
	elseif($orden[0]['id_level_inicio'] == '3')
	{
		$level_inicio = '3';
	}
	elseif($orden[0]['id_level_inicio'] == '2')
	{
		$level_inicio = '4';
	}
	elseif($orden[0]['id_level_inicio'] == '1')
	{
		$level_inicio = '5';
	}
	elseif($orden[0]['id_level_inicio'] == '6')
	{
		$level_inicio = '6';
	}
	if($orden[0]['id_level_current'] == '5')
	{
		$level_actual = '1';
	}
	elseif($orden[0]['id_level_current'] == '4')
	{
		$level_actual = '2';
	}
	elseif($orden[0]['id_level_current'] == '3')
	{
		$level_actual = '3';
	}
	elseif($orden[0]['id_level_current'] == '2')
	{
		$level_actual = '4';
	}
	elseif($orden[0]['id_level_current'] == '1')
	{
		$level_actual = '5';
	}
	elseif($orden[0]['id_level_current'] == '6')
	{
		$level_actual = '6';
	}
	for($i=$level_inicio;$i<$level_llegada;$i++){$dist[$i] = $i;}
	$total_distancia = $i;
	$nivel_progress = (1*100)/$total_distancia;
	$division_progress = $nivel_progress/5;
	if($level_actual <> $level_llegada)
	{
		if($level_actual == $level_inicio)
		{
			if($division_currrent == $orden[0]['id_division_inicio'])
			{
				$progress = '0';
			}
			else
			{
				for($e=$level_actual;$e<$level_llegada;$e++){$r=$r+1;}
				$actual_distancia = $r;
				$distancia_act = $total_distancia - $actual_distancia;
				$progress = $distancia_act*$nivel_progress;
				if($division_currrent == '1')
				{
					$progressd = $division_progress;
				}
				elseif($division_currrent == '2')
				{
					$progressd = $division_progress*2;
				}
				elseif($division_currrent == '3')
				{
					$progressd = $division_progress*3;
				}
				elseif($division_currrent == '4')
				{
					$progressd = $division_progress*4;
				}
				elseif($division_currrent == '5')
				{
					$progressd = $division_progress*5;
				}
				$progress = $progress + $progressd;
			}
		}
		else
		{
			for($e=$level_actual;$e<$level_llegada;$e++){$r=$r+1;}
			$actual_distancia = $r;
			$distancia_act = $total_distancia - $actual_distancia;
			$progress = $distancia_act*$nivel_progress;
			if($division_currrent == '1')
			{
				$progressd = $division_progress;
			}
			elseif($division_currrent == '2')
			{
				$progressd = $division_progress*2;
			}
			elseif($division_currrent == '3')
			{
				$progressd = $division_progress*3;
			}
			elseif($division_currrent == '4')
			{
				$progressd = $division_progress*4;
			}
			elseif($division_currrent == '5')
			{
				$progressd = $division_progress*5;
			}
			$progress = $progress + $progressd;
		}
	}
	else
	{
		$progress = '100';
	}
	$html = str_replace('{porcentaje_progress}', $progress, $html);

	//////////// CHAT //////////////
	$html = str_replace('{chat}', '', $html);

	/////////// coacher /////////
	$elo = $usuarios->datos_usuario($orden[0]['id_coacher']);
	$html = str_replace('{user_coacher}', $elo[0]['usuario'], $html);
	$html = str_replace('{id_elo}', $orden[0]['id_coacher'], $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>