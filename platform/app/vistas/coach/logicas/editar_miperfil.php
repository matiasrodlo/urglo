<?php
	$html = file_get_contents(__DIR__ . '/../editar_mi_perfil.html');
	$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_coach/header.html');
	$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_coach/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once(__DIR__ . '/../../datos_usuario.php');
	require_once(__DIR__ . '/menu.php');

	$levels = $usuarios->lista_levels();
	$lista_level = '';
	for($i=0;$i<count($levels);$i++)
	{
		$lista_level .= '<option value="'.$levels[$i]['id_level'].'">'.$levels[$i]['valor'].'</option>';
	}
	$html = str_replace('{lista_level}', $lista_level, $html);

	$division = $usuarios->lista_division();
	$lista_division = '';
	for($i=0;$i<count($division);$i++)
	{
		$lista_division .= '<option value="'.$division[$i]['id_division'].'">'.$division[$i]['division'].'</option>';
	}
	$html = str_replace('{lista_division}', $lista_division, $html);

	$champions = $usuarios->lista_champions();
	$lista_champions = '';
	for($i=0;$i<count($champions);$i++)
	{
		$lista_champions .= '<option value="'.$champions[$i]['id_champion'].'">'.$champions[$i]['nombre'].'</option>';
	}
	$html = str_replace('{lista_champions}', $lista_champions, $html);

	$roles = $usuarios->lista_roles();
	$lista_roles = '';
	for($i=0;$i<count($roles);$i++)
	{
		$lista_roles .= '';
	}

	$id_usuario = $_SESSION['id_usuario'];
	$datos_coach = $usuarios->datos_coach($id_usuario);
	$champions_coach = $usuarios->champions_coach($id_usuario);
	$idiomas_coach = $usuarios->languages_coach($id_usuario);
	$roles_coach = $usuarios->roles_coach($id_usuario);

	$lista_idiomas = '';
	for($i=0;$i<count($idiomas_coach);$i++)
	{
		if($idiomas_coach[$i]["id_language"] == "1"){$html = str_replace('{checked_id1}', 'checked', $html);}
		if($idiomas_coach[$i]["id_language"] == "2"){$html = str_replace('{checked_id2}', 'checked', $html);}
		if($idiomas_coach[$i]["id_language"] == "3"){$html = str_replace('{checked_id3}', 'checked', $html);}
	}

	for($i=0;$i<count($roles_coach);$i++)
	{
		if($roles_coach[$i]["id_rol"] == "1"){$html = str_replace('{checked1}', 'checked', $html);}
		if($roles_coach[$i]["id_rol"] == "2"){$html = str_replace('{checked2}', 'checked', $html);}
		if($roles_coach[$i]["id_rol"] == "3"){$html = str_replace('{checked3}', 'checked', $html);}
		if($roles_coach[$i]["id_rol"] == "4"){$html = str_replace('{checked4}', 'checked', $html);}
		if($roles_coach[$i]["id_rol"] == "5"){$html = str_replace('{checked5}', 'checked', $html);}
	}

	$html = str_replace('{champion1}', $champions_coach[0]['id_champion'], $html);
	$html = str_replace('{champion2}', $champions_coach[1]['id_champion'], $html);
	$html = str_replace('{champion3}', $champions_coach[2]['id_champion'], $html);
	$html = str_replace('{champion4}', $champions_coach[3]['id_champion'], $html);

	$html = str_replace('{roles}', $roles_coach, $html);
	$html = str_replace('{idiomas}', $idiomas_coach, $html);

	$servers = $usuarios->lista_server_lol();
	$lista_servers = '';
	for($i=0;$i<count($servers);$i++)
	{
		$lista_servers.= '<option value='.$servers[$i]['id_server'].'>'.$servers[$i]['nombre'].'</option>';
	}

	$html = str_replace('{lista_servers}', $lista_servers, $html);
	
	$html = str_replace('{id_server}', $datos_coach[0]['id_servidor'], $html);
	$html = str_replace('{level}', $datos_coach[0]['id_level'], $html);
	$html = str_replace('{division}', $datos_coach[0]['id_division'], $html);
	$html = str_replace('{precio_personal}', $datos_coach[0]['precio'], $html);
	$html = str_replace('{precio_team}', $datos_coach[0]['precio_team'], $html);
	$html = str_replace('{contenido}', $datos_coach[0]['content'], $html);
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>