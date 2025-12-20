<?php
	$html = file_get_contents(__DIR__ . '/../mi_perfil.html');
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

	$servers = $usuarios->lista_server_lol();
	$lista_servers = '';
	for($i=0;$i<count($servers);$i++)
	{
		$lista_servers.= '<option value='.$servers[$i]['id_server'].'>'.$servers[$i]['nombre'].'</option>';
	}

	$html = str_replace('{lista_servers}', $lista_servers, $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>