<?php
	if(isset($_POST['user_login']))
	{
		$nombre = $_POST['user_login'];
		if(isset($_POST['pass_login']))
		{
			$pass = $_POST['pass_login'];
			$resultado = $usuarios->conectar_usuario($nombre, $pass);
			echo $resultado;
		}
		else
		{
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros/');
		}
	}
	else
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros/');
	}
?>