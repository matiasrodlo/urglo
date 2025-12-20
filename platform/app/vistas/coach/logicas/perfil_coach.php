<?php
	$html = file_get_contents(__DIR__ . '/../perfil_coach.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_coach/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_coach/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');
	require_once(__DIR__ . '/menu.php');

	$datos_coach = $usuarios->datos_coach($id_coach[0]['id_usuario']);
	$champions = $usuarios->champions_coach($id_coach[0]['id_usuario']);
	$idiomas = $usuarios->languages_coach($id_coach[0]['id_usuario']);
	$roles = $usuarios->roles_coach($id_coach[0]['id_usuario']);
	$datos_usuario_coach = $usuarios->datos_usuario($id_coach[0]['id_usuario']);
	$datos_personal_coach = $usuarios->datos_user_personal($id_coach[0]['id_usuario']);
	//print_r($datos_coach);
	//print_r($champions);
	//print_r($roles);
	//print_r($idiomas);
	//print_r($datos_personal_coach);
	$id_level = $datos_coach[0]['id_level'];
	$id_division = $datos_coach[0]['id_division'];
	if($id_level == '5' and $id_division == '5')
	{
		$img = '54462111-6c03-47d1-b42d-01be036c2712.png';
		$html = str_replace('{level_coach}', 'Bronce V', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '5' and $id_division == '4')
	{
		$img = '34c46afd-0042-44b7-9363-b52373b0d7b6.png';
		$html = str_replace('{level_coach}', 'Bronce IV', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '5' and $id_division == '3')
	{
		$img = '1cd507e9-1426-454b-906d-ca2901b6c006.png';
		$html = str_replace('{level_coach}', 'Bronce III', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '5' and $id_division == '2')
	{
		$img = 'bcea731d-3e32-4d77-9fa5-f767f8bfd491.png';
		$html = str_replace('{level_coach}', 'Bronce II', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '5' and $id_division == '1')
	{
		$img = '30852b39-89e9-4bad-9cf0-a637b6917fc1.png';
		$html = str_replace('{level_coach}', 'Bronce I', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '4' and $id_division == '5')
	{
		$img = '62003196-fcc1-4b45-9e3a-3e84fa95db9d.png';
		$html = str_replace('{level_coach}', 'Plata V', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '4' and $id_division == '4')
	{
		$img = 'bf91db2a-2b72-4d07-9e18-440720ed1ae9.png';
		$html = str_replace('{level_coach}', 'Plata IV', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '4' and $id_division == '3')
	{
		$img = '87e396f5-d22a-40fa-987b-91c32526e9ae.png';
		$html = str_replace('{level_coach}', 'Plata III', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '4' and $id_division == '2')
	{
		$img = '92e80b91-b388-4d61-b173-d04739e43fb8';
		$html = str_replace('{level_coach}', 'Plata II', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '4' and $id_division == '1')
	{
		$img = '52570517-9566-4459-911a-dde96be9e2b1';
		$html = str_replace('{level_coach}', 'Plata I', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '3' and $id_division == '5')
	{
		$img = 'b3c8b95a-82cf-4d86-8cba-f6ceffd45d65';
		$html = str_replace('{level_coach}', 'Oro V', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '3' and $id_division == '4')
	{
		$img = 'ddb3ecbe-3f37-4f3b-877b-01ee03f1f0a1';
		$html = str_replace('{level_coach}', 'Oro IV', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '3' and $id_division == '3')
	{
		$img = '8eb10d7f-3ffd-4ae2-a584-dbe443615695';
		$html = str_replace('{level_coach}', 'Oro III', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '3' and $id_division == '2')
	{
		$img = '3dc8fb37-5653-4c05-8ee8-7dbdcc3f2bf4';
		$html = str_replace('{level_coach}', 'Oro II', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '3' and $id_division == '1')
	{
		$img = 'dbed347e-55e1-4b8e-a01e-712594dcb8a2';
		$html = str_replace('{level_coach}', 'Oro I', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '2' and $id_division == '5')
	{
		$img = '4932644a-65a6-4475-9a4e-80be930bd8d6';
		$html = str_replace('{level_coach}', 'Platino V', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '2' and $id_division == '4')
	{
		$img = '33d258b1-e222-45ea-8518-4da73b2a0578';
		$html = str_replace('{level_coach}', 'Platino IV', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '2' and $id_division == '3')
	{
		$img = 'b98cb628-7cd3-4e3e-98d3-54e636505a31';
		$html = str_replace('{level_coach}', 'Platino III', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '2' and $id_division == '2')
	{
		$img = '69654f19-c11d-409b-b296-0227a60e9f3d';
		$html = str_replace('{level_coach}', 'Platino II', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '2' and $id_division == '1')
	{
		$img = 'f18ef92a-ec97-4642-a37a-f031306b8640';
		$html = str_replace('{level_coach}', 'Platino I', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '1' and $id_division == '5')
	{
		$img = '210f3b0b-1faa-4e20-aa78-7ef1ee0c2139';
		$html = str_replace('{level_coach}', 'Diamante V', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '1' and $id_division == '4')
	{
		$img = '266848b9-8b95-490e-9041-b9d95cfcc31a';
		$html = str_replace('{level_coach}', 'Diamante Iv', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '1' and $id_division == '3')
	{
		$img = '0c757285-76ad-455a-a8d6-884d3c9bb821';
		$html = str_replace('{level_coach}', 'Diamante III', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '1' and $id_division == '2')
	{
		$img = '6d2eb145-76cc-4a5c-925b-eefb5307ee77';
		$html = str_replace('{level_coach}', 'Diamante II', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '1' and $id_division == '1')
	{
		$img = '4eba264c-9bf4-4d71-b16b-81a8949b984f';
		$html = str_replace('{level_coach}', 'Diamante I', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '6' and $id_division == '0')
	{
		$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
		$html = str_replace('{level_coach}', 'Retador', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '6' and $id_division == '5')
	{
		$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
		$html = str_replace('{level_coach}', 'Retador', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '6' and $id_division == '4')
	{
		$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
		$html = str_replace('{level_coach}', 'Retador', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '6' and $id_division == '3')
	{
		$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
		$html = str_replace('{level_coach}', 'Retador', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '6' and $id_division == '2')
	{
		$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
		$html = str_replace('{level_coach}', 'Retador', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	elseif($id_level == '6' and $id_division == '1')
	{
		$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
		$html = str_replace('{level_coach}', 'Retador', $html);
		$html = str_replace('{img_level_coach}', $img, $html);
	}
	$html = str_replace('{user_coach}', $datos_usuario_coach[0]['usuario'], $html);
	$html = str_replace('{img_perfil_coach}', $datos_personal_coach[0]['img_perfil'], $html);
	$html = str_replace('{precio_personal}', $datos_coach[0]['precio'], $html);
	$html = str_replace('{precio_team}', $datos_coach[0]['precio_team'], $html);

	$champion1 = $usuarios->champion($champions[0]['id_champion']);
	$html = str_replace('{champion_nombre1}', $champion1[0]['nombre'] ,$html);
	$html = str_replace('{champion_img1}', $champion1[0]['img'], $html);
	$champion2 = $usuarios->champion($champions[1]['id_champion']);
	$html = str_replace('{champion_nombre2}', $champion2[0]['nombre'], $html);
	$html = str_replace('{champion_img2}', $champion2[0]['img'], $html);
	$champion3 = $usuarios->champion($champions[2]['id_champion']);
	$html = str_replace('{champion_nombre3}', $champion2[0]['nombre'], $html);
	$html = str_replace('{champion_img3}', $champion3[0]['img'], $html);
	$champion4 = $usuarios->champion($champions[3]['id_champion']);
	$html = str_replace('{champion_nombre4}', $champion4[0]['nombre'], $html);
	$html = str_replace('{champion_img4}', $champion4[0]['img'], $html);

	$roles_coach = '';
	for($i=0;$i<count($roles);$i++)
	{
		$id_rol = $roles[$i]['id_rol'];
		$rol = $usuarios->rol($id_rol);
		$roles_coach.='<img src="'.RUTA_INDEX.'images/Roles/'.$rol[0]['img'].'" width="30" align="center" title="'.$rol[0]['nombre'].'">';
	}
	if($roles == false)
	{
		$html = str_replace('{roles_coach}', 'No tiene position/roles.', $html);
	}
	else
	{
		$html = str_replace('{roles_coach}', $roles_coach, $html);
	}

	$idiomas_coach = '';
	for($i=0;$i<count($idiomas);$i++)
	{
		$id_idioma = $idiomas[$i]['id_language'];
		$idioma = $usuarios->idioma($id_idioma);
		$idiomas_coach.='<img src="'.RUTA_INDEX.'images/Languages/'.$idioma[0]['bandera'].'" width="30" align="center" title="'.$idioma[0]['idioma'].'">'; 
	}
	if($idioma == false)
	{
		$html = str_replace('{idiomas_coach}', 'No tiene idiomas.', $html);
	}
	else
	{
		$html = str_replace('{idiomas_coach}', $idiomas_coach, $html);
	}
	
	// 4 OPINIONES DE USUARIOS
	$opiniones = $trabajos->mis_ultimas_calificaciones_coach($id_coach[0]['id_usuario']);
	$lista_opiniones = '';
	if($opiniones == false)
	{
		$html = str_replace('{opiniones_usuarios}', 'El coach no tiene ninguna opinión.', $html);
	}
	else
	{
		for($i=0;$i<count($opiniones);$i++)
		{
			$calificador = $usuarios->datos_user_personal($opiniones[$i]['id_usuario']);

			$lista_opiniones.= '
			<div class="pad10" style="background:#eee; margin-top:10px;">
                <div class="ratingSmall">
                    <img class="rat'.$opiniones[$i]['calificacion'].'" src="'.RUTA_INDEX.'images/rating-stars-small.png" align="middle">
                </div>
                <p class="alignLeft" style="padding-top:0px;">
                    '.$opiniones[$i]['txt_calificacion'].'<br><br>
                	<small style="font-size:12px;">Por <b>'.$calificador[0]['nombre'].' '.$calificador[0]['apellido'].'</b></small>
                </p>
            </div>';
		}
		$html = str_replace('{opiniones_usuarios}', $lista_opiniones, $html);
	}

	$calificaciones = $trabajos->calificaciones_coach($id_coach[0]['id_usuario']);
	$total = '';
	$cantidad_calificaciones = count($calificaciones);
	for($x=0;$x<$cantidad_calificaciones;$x++)
	{
		$total = $total + $calificaciones[$x]['calificacion']; 
	}

	$rating = $total/$cantidad_calificaciones;
	$rating = substr($rating, 0, 1);
	$html = str_replace('{rating}', $rating, $html);

	$html = str_replace('{content_coach}', $datos_coach[0]['content'], $html);
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>
