<?php
	$html = file_get_contents('vistas/admin/lista_trabajos_coachs_libre.html');
	$header_desconectado = file_get_contents('vistas/admin/plantilla_admin/header.html');
	$footer_desconectado = file_get_contents('vistas/admin/plantilla_admin/footer.html');
		
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$lista_pedidos = $pedidos->lista_trabajos_coach('1');
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
			<td width="100px">Libre</td>
			<td width="100px"><a class="btn_ag" href="http://urglo.com/miembros/coachs/trabajos_libres/'.$lista_pedidos[$i]['id_trabajo_coach'].'">VER</a></td>
		</tr>';
	}
	if($lista_pedidos == false)
	{
		$html = str_replace('{lista_pedidos}', '<tr style="background-color: #f2f2f2; color: #000;border-bottom: 1px solid #ddd;"><td></td><td></td><td>No hay pedidos libres.</td><td></td><td></td><td></td><td></td></tr>', $html);
	}
	else
	{
		$html = str_replace('{lista_pedidos}', $lista_pedidos_libres, $html);
	}

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>