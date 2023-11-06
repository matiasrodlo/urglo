<?php
if(isset($_POST['old_contraseña']))
{
	$old = $_POST['old_contraseña'];
	if(isset($_POST['contraseña']))
	{
		$nueva = $_POST['contraseña'];
		if(isset($_POST['re_contraseña']))
		{
			$rep = $_POST['re_contraseña'];
			$id_usuario = $_SESSION['id_usuario'];
			$resultado = $usuarios->cambiar_contra($id_usuario, $old, $nueva, $rep);
			echo $resultado;
		}
	}	
}
?>