<?php
	$id_usuario = $_SESSION['id_usuario'];
	$resultado = $usuarios->comprobar_datos_coach($id_usuario);
	if($resultado == '')
	{
		$html = str_replace('{menu_coach}', '
			<div class="completar-datos">
				<span class="msj-com">Para poder empezar a realizar trabajos debe completar todo su perfil</span>
				<a href="http://urglo.com/eloboost/miembros/miperfil" class="btn-blue"><b>Completar Perfil</b></a>
			</div>
			<a class="barmenu" style="margin-left:260px;"></a>', $html);
		$html = str_replace('{editar_miperfil}', '', $html);
	}
	else
	{
		$html = str_replace('{menu_coach}', '<a class="barmenu" style="margin-left:260px;"></a>', $html);
		$html = str_replace('{editar_miperfil}', '<li><a href="{ruta_index}editar_miperfil"><i class="fa fa-pencil-square-o"></i> Editar Mi Perfil</a></li>', $html);
	}
?>
