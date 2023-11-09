<?php
	$html = file_get_contents('vistas/coach/lista_trabajos_activos.html');
	$header_desconectado = file_get_contents('vistas/coach/plantilla_coach/header.html');
	$footer_desconectado = file_get_contents('vistas/coach/plantilla_coach/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');
	require_once('vistas/coach/logicas/menu.php');

	$lista_pedidos = $trabajos->lista_trabajos('2', $id_usuario);
	$lista_pedidos_libres = '';
	//print_r($lista_pedidos);
	if($lista_pedidos == false)
	{
		$html = str_replace('{lista_ordenes_libres}', '
			<tr style="background-color:#fff;color:#000;">
				<td colspan="5" style="border:0px;">No hay ningun orden activa.</td>
			</tr>', $html);
	}
	else
	{
		for($i=0;$i<count($lista_pedidos);$i++)
		{
			$datos_coach = $usuarios->datos_usuario($lista_pedidos[$i]['id_coach']);
			$coach = $usuarios->datos_coach($lista_pedidos[$i]['id_coach']);
			$cliente = $usuarios->datos_usuario($lista_pedidos[$i]['id_usuario']);
			//print_r($coach);
			if($coach[0]['id_level'] == '5' and $coach[0]['id_division'] == '5')
			{
				$img = '54462111-6c03-47d1-b42d-01be036c2712.png';
				$level = 'Bronze V';
			}
			elseif($coach[0]['id_level'] == '5' and $coach[0]['id_division'] == '4')
			{
				$img = '34c46afd-0042-44b7-9363-b52373b0d7b6.png';
				$level = 'Bronze IV';
			}
			elseif($coach[0]['id_level'] == '5' and $coach[0]['id_division'] == '3')
			{
				$img = '1cd507e9-1426-454b-906d-ca2901b6c006.png';
				$level = 'Bronze III';
			}
			elseif($coach[0]['id_level'] == '5' and $coach[0]['id_division'] == '2')
			{
				$img = 'bcea731d-3e32-4d77-9fa5-f767f8bfd491.png';
				$level = 'Bronze II';
			}
			elseif($coach[0]['id_level'] == '5' and $coach[0]['id_division'] == '1')
			{
				$img = '30852b39-89e9-4bad-9cf0-a637b6917fc1.png';
				$level = 'Bronze I';
			}
			elseif($coach[0]['id_level'] == '4' and $coach[0]['id_division'] == '5')
			{
				$img = '62003196-fcc1-4b45-9e3a-3e84fa95db9d.png';
				$level = 'Silver V';
			}
			elseif($coach[0]['id_level'] == '4' and $coach[0]['id_division'] == '4')
			{
				$img = 'bf91db2a-2b72-4d07-9e18-440720ed1ae9.png';
				$level = 'Silver IV';
			}
			elseif($coach[0]['id_level'] == '4' and $coach[0]['id_division'] == '3')
			{
				$img = '87e396f5-d22a-40fa-987b-91c32526e9ae.png';
				$level = 'Silver III';
			}
			elseif($coach[0]['id_level'] == '4' and $coach[0]['id_division'] == '2')
			{
				$img = '92e80b91-b388-4d61-b173-d04739e43fb8';
				$level = 'Silver II';
			}
			elseif($coach[0]['id_level'] == '4' and $coach[0]['id_division'] == '1')
			{
				$img = '52570517-9566-4459-911a-dde96be9e2b1';
				$level = 'Silver I';
			}
			elseif($coach[0]['id_level'] == '3' and $coach[0]['id_division'] == '5')
			{
				$img = 'b3c8b95a-82cf-4d86-8cba-f6ceffd45d65';
				$level = 'Gold V';
			}
			elseif($coach[0]['id_level'] == '3' and $coach[0]['id_division'] == '4')
			{
				$img = 'ddb3ecbe-3f37-4f3b-877b-01ee03f1f0a1';
				$level = 'Gold IV';
			}
			elseif($coach[0]['id_level'] == '3' and $coach[0]['id_division'] == '3')
			{
				$img = '8eb10d7f-3ffd-4ae2-a584-dbe443615695';
				$level = 'Gold III';
			}
			elseif($coach[0]['id_level'] == '3' and $coach[0]['id_division'] == '2')
			{
				$img = '3dc8fb37-5653-4c05-8ee8-7dbdcc3f2bf4';
				$level = 'Gold II';
			}
			elseif($coach[0]['id_level'] == '3' and $coach[0]['id_division'] == '1')
			{
				$img = 'dbed347e-55e1-4b8e-a01e-712594dcb8a2';
				$level = 'Gold I';
			}
			elseif($coach[0]['id_level'] == '2' and $coach[0]['id_division'] == '5')
			{
				$img = '4932644a-65a6-4475-9a4e-80be930bd8d6';
				$level = 'Platinum V';
			}
			elseif($coach[0]['id_level'] == '2' and $coach[0]['id_division'] == '4')
			{
				$img = '33d258b1-e222-45ea-8518-4da73b2a0578';
				$level = 'Platinum IV';
			}
			elseif($coach[0]['id_level'] == '2' and $coach[0]['id_division'] == '3')
			{
				$img = 'b98cb628-7cd3-4e3e-98d3-54e636505a31';
				$level = 'Platinum III';
			}
			elseif($coach[0]['id_level'] == '2' and $coach[0]['id_division'] == '2')
			{
				$img = '69654f19-c11d-409b-b296-0227a60e9f3d';
				$level = 'Platinum II';
			}
			elseif($coach[0]['id_level'] == '2' and $coach[0]['id_division'] == '1')
			{
				$img = 'f18ef92a-ec97-4642-a37a-f031306b8640';
				$level = 'Platinum I';
			}
			elseif($coach[0]['id_level'] == '1' and $coach[0]['id_division'] == '5')
			{
				$img = '210f3b0b-1faa-4e20-aa78-7ef1ee0c2139';
				$level = 'Diamond V';
			}
			elseif($coach[0]['id_level'] == '1' and $coach[0]['id_division'] == '4')
			{
				$img = '266848b9-8b95-490e-9041-b9d95cfcc31a';
				$level = 'Diamond IV';
			}
			elseif($coach[0]['id_level'] == '1' and $coach[0]['id_division'] == '3')
			{
				$img = '0c757285-76ad-455a-a8d6-884d3c9bb821';
				$level = 'Diamond III';
			}
			elseif($coach[0]['id_level'] == '1' and $coach[0]['id_division'] == '2')
			{
				$img = '6d2eb145-76cc-4a5c-925b-eefb5307ee77';
				$level = 'Diamond II';
			}
			elseif($coach[0]['id_level'] == '1' and $coach[0]['id_division'] == '1')
			{
				$img = '4eba264c-9bf4-4d71-b16b-81a8949b984f';
				$level = 'Diamond I';
			}
			elseif($coach[0]['id_level'] == '6' and $coach[0]['id_division'] == '0')
			{
				$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
				$level = 'Challenger';
			}
			elseif($coach[0]['id_level'] == '6' and $coach[0]['id_division'] == '5')
			{
				$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
				$level = 'Challenger';
			}
			elseif($coach[0]['id_level'] == '6' and $coach[0]['id_division'] == '4')
			{
				$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
				$level = 'Challenger';
			}
			elseif($coach[0]['id_level'] == '6' and $coach[0]['id_division'] == '3')
			{
				$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
				$level = 'Challenger';
			}
			elseif($coach[0]['id_level'] == '6' and $coach[0]['id_division'] == '2')
			{
				$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
				$level = 'Challenger';
			}
			elseif($coach[0]['id_level'] == '6' and $coach[0]['id_division'] == '1')
			{
				$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
				$level = 'Challenger';
			}
			if($lista_pedidos[$i]['estado'] == '1')
			{
				$estado = "Orden No Paga";
			}
			elseif($lista_pedidos[$i]['estado'] == '2')
			{
				$estado = "Orden en Proceso";
			}
			elseif($lista_pedidos[$i]['estado'] == '3')
			{
				$estado = "Orden Cancelada";
			}
			elseif($lista_pedidos[$i]['estado'] == '4')
			{
				$estado = "Orden Terminada";
			}
			$intereses = $lista_pedidos[$i]['intereses'];
			$ganancia_coach = ($lista_pedidos[$i]['total']*30)/100;
			$ganancia_coach = $lista_pedidos[$i]['total'] - $ganancia_coach;
			$lista_pedidos_libres .= '
			<tr style="background-color:#fff;color:#000;">
				<td style="border:1px solid #dddddd;">
					<h4>'.$lista_pedidos[$i]['tipo'].'</h4>
					<p class="price-ord"><span class="subtitle">Precio:</span> '.$ganancia_coach.' <span class="subtitle">USD</span></p>
					<p class="subtitle" style="margin-top:10px;">Creado el '.$lista_pedidos[$i]['fecha'].'</p>
				</td>
				<td style="border:1px solid #dddddd;">
					<h4 style="color:#3b6c8e;font-size:24px;letter-spacing:-1px;">'.$cliente[0]['usuario'].'</h4>
					
				</td>
				<td style="border:1px solid #dddddd;">
					<h4 style="font-size:19px;">'.$lista_pedidos[$i]['horas_contratadas'].'</h4>
					<small style="font-size:8px;letter-spacing:0px;color:#666;">horas</small>
				</td>
				<td style="border:1px solid #dddddd;text-transform:uppercase">'.$estado.'</td>
				<td style="border:1px solid #dddddd;"><a href="http://urglo.com/miembros/trabajos/'.$lista_pedidos[$i]['id_trabajo_coach'].'"><div class="btn_details">Ver Detalles</div></a></td>
			</tr>';
		}
		$html = str_replace('{lista_ordenes_libres}', $lista_pedidos_libres, $html);
	}

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>