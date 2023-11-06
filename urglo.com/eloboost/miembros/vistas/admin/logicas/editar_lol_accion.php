<?php
if(isset($_POST['username']))
{
	$username = $_POST['username'];
	if(isset($_POST['contraseña']))
	{
		$old = $_POST['contraseña'];
		if(isset($_POST['nueva_contraseña']))
		{
			$contra = $_POST['nueva_contraseña'];
			if(isset($_POST['re_contraseña']))
			{
				$re_contra = $_POST['re_contraseña'];
				$id_usuario = $_SESSION['id_usuario'];
				$resultado = $usuarios->editar_lol($id_usuario, $username, $old, $contra, $re_contra);
				echo $resultado;
			}
		}
	}
}
?>