<?php
	$html = file_get_contents(__DIR__ . '/../coachs.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_coach/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_coach/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');
	require_once(__DIR__ . '/menu.php');

	$lista_coachs = $trabajos->lista_coachs();
	$lista_coachs_all = '';
	for($i=0;$i<count($lista_coachs);$i++)
	{
		$id_coach = $lista_coachs[$i]['id_usuario'];
		$datos_coach = $usuarios->datos_coach($id_coach);
		if($datos_coach == '')
		{
			$lista_coachs_all.='';
		}
		else
		{
			$coach_dats = $usuarios->datos_usuario($id_coach);
			$personal_coach = $usuarios->datos_user_personal($datos_coach[0]['id_usuario']);
			$id_level = $datos_coach[0]['id_level'];
			$id_division = $datos_coach[0]['id_division'];
			$nombre_usuario = $coach_dats[0]['usuario'];
			
			$img = '';
			$level = '';

			if($id_level == '5' and $id_division == '5')
			{
				$img = '54462111-6c03-47d1-b42d-01be036c2712.png';
				$level = 'Bronce V';
			}
			elseif($id_level == '5' and $id_division == '4')
			{
				$img = '34c46afd-0042-44b7-9363-b52373b0d7b6.png';
				$level = 'Bronce IV';
			}
			elseif($id_level == '5' and $id_division == '3')
			{
				$img = '1cd507e9-1426-454b-906d-ca2901b6c006.png';
				$level = 'Bronce III';
			}
			elseif($id_level == '5' and $id_division == '2')
			{
				$img = 'bcea731d-3e32-4d77-9fa5-f767f8bfd491.png';
				$level = 'Bronce II';
			}
			elseif($id_level == '5' and $id_division == '1')
			{
				$img = '30852b39-89e9-4bad-9cf0-a637b6917fc1.png';
				$level = 'Bronce I';
			}
			elseif($id_level == '4' and $id_division == '5')
			{
				$img = '62003196-fcc1-4b45-9e3a-3e84fa95db9d.png';
				$level = 'Plata V';
			}
			elseif($id_level == '4' and $id_division == '4')
			{
				$img = 'bf91db2a-2b72-4d07-9e18-440720ed1ae9.png';
				$level = 'Plata IV';
			}
			elseif($id_level == '4' and $id_division == '3')
			{
				$img = '87e396f5-d22a-40fa-987b-91c32526e9ae.png';
				$level = 'Plata III';
			}
			elseif($id_level == '4' and $id_division == '2')
			{
				$img = '92e80b91-b388-4d61-b173-d04739e43fb8';
				$level = 'Plata II';
			}
			elseif($id_level == '4' and $id_division == '1')
			{
				$img = '52570517-9566-4459-911a-dde96be9e2b1';
				$level = 'Plata I';
			}
			elseif($id_level == '3' and $id_division == '5')
			{
				$img = 'b3c8b95a-82cf-4d86-8cba-f6ceffd45d65';
				$level = 'Oro V';
			}
			elseif($id_level == '3' and $id_division == '4')
			{
				$img = 'ddb3ecbe-3f37-4f3b-877b-01ee03f1f0a1';
				$level = 'Oro IV';
			}
			elseif($id_level == '3' and $id_division == '3')
			{
				$img = '8eb10d7f-3ffd-4ae2-a584-dbe443615695';
				$level = 'Oro III';
			}
			elseif($id_level == '3' and $id_division == '2')
			{
				$img = '3dc8fb37-5653-4c05-8ee8-7dbdcc3f2bf4';
				$level = 'Oro II';
			}
			elseif($id_level == '3' and $id_division == '1')
			{
				$img = 'dbed347e-55e1-4b8e-a01e-712594dcb8a2';
				$level = 'Oro I';
			}
			elseif($id_level == '2' and $id_division == '5')
			{
				$img = '4932644a-65a6-4475-9a4e-80be930bd8d6';
				$level = 'Platino V';
			}
			elseif($id_level == '2' and $id_division == '4')
			{
				$img = '33d258b1-e222-45ea-8518-4da73b2a0578';
				$level = 'Platino IV';
			}
			elseif($id_level == '2' and $id_division == '3')
			{
				$img = 'b98cb628-7cd3-4e3e-98d3-54e636505a31';
				$level = 'Platino III';
			}
			elseif($id_level == '2' and $id_division == '2')
			{
				$img = '69654f19-c11d-409b-b296-0227a60e9f3d';
				$level = 'Platino II';
			}
			elseif($id_level == '2' and $id_division == '1')
			{
				$img = 'f18ef92a-ec97-4642-a37a-f031306b8640';
				$level = 'Platino I';
			}
			elseif($id_level == '1' and $id_division == '5')
			{
				$img = '210f3b0b-1faa-4e20-aa78-7ef1ee0c2139';
				$level = 'Diamante V';
			}
			elseif($id_level == '1' and $id_division == '4')
			{
				$img = '266848b9-8b95-490e-9041-b9d95cfcc31a';
				$level = 'Diamante Iv';
			}
			elseif($id_level == '1' and $id_division == '3')
			{
				$img = '0c757285-76ad-455a-a8d6-884d3c9bb821';
				$level = 'Diamante III';
			}
			elseif($id_level == '1' and $id_division == '2')
			{
				$img = '6d2eb145-76cc-4a5c-925b-eefb5307ee77';
				$level = 'Diamante II';
			}
			elseif($id_level == '1' and $id_division == '1')
			{
				$img = '4eba264c-9bf4-4d71-b16b-81a8949b984f';
				$level = 'Diamante I';
			}
			elseif($id_level == '6' and $id_division == '0')
			{
				$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
				$level = 'Retador';
			}
			elseif($id_level == '6' and $id_division == '5')
			{
				$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
				$level = 'Retador';
			}
			elseif($id_level == '6' and $id_division == '4')
			{
				$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
				$level = 'Retador';
			}
			elseif($id_level == '6' and $id_division == '3')
			{
				$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
				$level = 'Retador';
			}
			elseif($id_level == '6' and $id_division == '2')
			{
				$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
				$level = 'Retador';
			}
			elseif($id_level == '6' and $id_division == '1')
			{
				$img = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3';
				$level = 'Retador';
			}
			$calificaciones = $trabajos->calificaciones_coach($datos_coach[0]['id_usuario']);
			$total = '';
			$cantidad_calificaciones = count($calificaciones);
			for($x=0;$x<$cantidad_calificaciones;$x++)
			{
				$total = $total + $calificaciones[$x]['calificacion']; 
			}

			$rating = $total/$cantidad_calificaciones;
			$rating = substr($rating, 0, 1);

			$champions = $usuarios->champions_coach($datos_coach[0]['id_usuario']);
			$idiomas = $usuarios->languages_coach($datos_coach[0]['id_usuario']);
			$roles = $usuarios->roles_coach($datos_coach[0]['id_usuario']);

			$champion1 = $usuarios->champion($champions[0]['id_champion']);
			$champion_nombre1 = str_replace('{champion_nombre1}', $champion1[0]['nombre'] ,$html);
			$champion_img1 = str_replace('{champion_img1}', $champion1[0]['img'], $html);
			$champion2 = $usuarios->champion($champions[1]['id_champion']);
			$champion_nombre2 = str_replace('{champion_nombre2}', $champion2[0]['nombre'], $html);
			$champion_img2 = str_replace('{champion_img2}', $champion2[0]['img'], $html);
			$champion3 = $usuarios->champion($champions[2]['id_champion']);
			$champion_nombre3 = str_replace('{champion_nombre3}', $champion2[0]['nombre'], $html);
			$champion_img3 = str_replace('{champion_img3}', $champion3[0]['img'], $html);
			$champion4 = $usuarios->champion($champions[3]['id_champion']);
			$champion_nombre4 = str_replace('{champion_nombre4}', $champion4[0]['nombre'], $html);
			$champion_img4 = str_replace('{champion_img4}', $champion4[0]['img'], $html);

			$roles_coach = '';
			for($r=0;$r<count($roles);$r++)
			{
				$id_rol = $roles[$r]['id_rol'];
				$rol = $usuarios->rol($id_rol);
				$roles_coach.='<img src="'.RUTA_INDEX.'images/Roles/'.$rol[0]['img'].'" width="30" align="center" title="'.$rol[0]['nombre'].'">';
				$roles_r.=$id_rol.';';
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
			for($h=0;$h<count($idiomas);$h++)
			{
				$id_idioma = $idiomas[$h]['id_language'];
				$idioma = $usuarios->idioma($id_idioma);
				$idiomas_coach.='<img src="'.RUTA_INDEX.'images/Languages/'.$idioma[0]['bandera'].'" width="30" align="center" title="'.$idioma[0]['idioma'].'">'; 
				$idiomas_l.= $id_idioma.';';
			}
			if($idioma == false)
			{
				$html = str_replace('{idiomas_coach}', 'No tiene idiomas.', $html);
			}
			else
			{
				$html = str_replace('{idiomas_coach}', $idiomas_coach, $html);
			}

			$servidor_coach = $datos_coach[0]['id_servidor'];
			$lista_coachs_all.='
				<a id="cphBody_lvData_hlCoach_'.$i.'" class="coach-details" href="'.RUTA_INDEX.'coachs/'.$nombre_usuario.'">
					<div class="profile-img">
						<img src="'.RUTA_INDEX.'images/user/'.$personal_coach[0]['img_perfil'].'" style="width:240px;height:210px">
					</div>
					<div class="servers" style="display:none;">'.$servidor_coach.';a</div>
					<div class="languages" style="display:none;">a;'.$idiomas_l.'</div>
					<div class="roles" style="display:none;">a;'.$roles_r.'</div>
					<div class="champions" style="display:none;">a;'.$champions[0]['id_champion'].';'.$champions[1]['id_champion'].';'.$champions[2]['id_champion'].';'.$champions[3]['id_champion'].'</div>
					<div class="w-background"></div>
					<div class="w-league">
						<img id="cphBody_lvData_imgLeague_'.$i.'" src="'.RUTA_INDEX.'images/Game/'.$img.'.png" style="width:100%;">
					</div>
					<div class="w-title">
						<center>
							<h2>'.$nombre_usuario.'</h2>
							<h3>'.$level.'</h3>
							<div class="ratingSmall">
								<img id="cphBody_lvData_imgRating_'.$i.'" src="'.RUTA_INDEX.'images/rating-stars-small.png" align="middle" class="rat'.$rating.'">
							</div>
						</center>
					</div>
					<div class="w-infobox" style="display:none;">
						<p>Ver Perfil</p>
					</div>
					<div id="cphBody_lvData_divSkills_'.$i.'" class="w-skills">
						'.$roles_coach.'
					</div>
					<div id="cphBody_lvData_divLanguages_'.$i.'" class="w-lang">
						'.$idiomas_coach.'
					</div>
					<div class="w-price">
						<h2>$US '.$datos_coach[0]['precio'].'</h2>
					</div>
				</a>
			';
		}
	}
	if($lista_coachs == false)
	{
		$html = str_replace('{lista_coachs_all}', 'No hay coachs registrados.', $html);
	}
	else
	{
		$html = str_replace('{lista_coachs_all}', $lista_coachs_all, $html);
	}

	$servers = $usuarios->lista_server_lol();
	$lista_servers = '';
	for($i=0;$i<count($servers);$i++)
	{
		$lista_servers.= '<option value='.$servers[$i]['id_server'].'>'.$servers[$i]['nombre'].'</option>';
	}
	$html = str_replace('{lista_servers}', $lista_servers, $html);

	$champions_l = $usuarios->lista_champions();
	$lista_champions = '';
	for($i=0;$i<count($champions_l);$i++)
	{
		$lista_champions.='<option value='.$champions_l[$i]['id_champion'].'>'.$champions_l[$i]['nombre'].'</option>';
	}
	$html = str_replace('{lista_champions}', $lista_champions, $html);

	$languages_l = $usuarios->lista_lang();
	$lista_lang = '';
	for($i=0;$i<count($languages_l);$i++)
	{
		$lista_lang.='<option value='.$languages_l[$i]['id_idioma'].'>'.$languages_l[$i]['idioma'].'</option>';
	}
	$html = str_replace('{lista_lenguajes}', $lista_lang, $html);

	$roles_l = $usuarios->lista_roles();
	$lista_roles = '';
	for($i=0;$i<count($roles_l);$i++)
	{
		$lista_roles.='<option value='.$roles_l[$i]['id_rol'].'>'.$roles_l[$i]['nombre'].'</option>';
	}
	$html = str_replace('{lista_roles}', $lista_roles, $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>
