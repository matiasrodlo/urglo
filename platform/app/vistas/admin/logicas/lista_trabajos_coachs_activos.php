<?php
	$html = file_get_contents(__DIR__ . '/../lista_trabajos_coachs_activos.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/footer.html');
		
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');

	$lista_pedidos = $pedidos->lista_trabajos_coach('2');
	
	if ($lista_pedidos === false) {
		$lista_pedidos = array();
	}
	
	$lista_pedidos_libres = '';
	for($i=0;$i<count($lista_pedidos);$i++)
	{
		$coach = $usuarios->datos_usuario($lista_pedidos[$i]['id_coach']);
		$lista_pedidos_libres .= '
		<tr style="background-color: #f2f2f2; color: #000;border-bottom: 1px solid #ddd;">
			<td width="200px">'.$lista_pedidos[$i]['tipo'].'</td>
			<td width="100px">'.$lista_pedidos[$i]['nick_lol'].'</td>
			<td width="100px">'.$coach[0]['usuario'].'</td>
			<td width="100px">'.$lista_pedidos[$i]['horas_contratadas'].' HS</td>
			<td width="100px">$ '.$lista_pedidos[$i]['total'].'</td>
			<td width="100px">Activo</td>
			<td width="100px"><a class="btn_ag" href="'.RUTA_INDEX.'coachs/trabajos_activos/'.$lista_pedidos[$i]['id_trabajo_coach'].'">VER</a></td>
		</tr>';
	}
	
	if($lista_pedidos_libres == '' || count($lista_pedidos) == 0)
	{
		$html = str_replace('{lista_pedidos}', '<tr style="background-color: #f2f2f2; color: #000;border-bottom: 1px solid #ddd;"><td colspan="7" style="text-align:center;padding:20px;">No hay pedidos activos.</td></tr>', $html);
	}
	else
	{
		$html = str_replace('{lista_pedidos}', $lista_pedidos_libres, $html);
	}

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>
