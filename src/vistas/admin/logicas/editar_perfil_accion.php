<?php
if(isset($_POST['username']))
{
	$username = $_POST['username'];
	if(isset($_POST['password']))
	{
		$password = $_POST['password'];
		if(isset($_POST['tipo_cuenta']))
		{
			$tipo_cuenta = $_POST['tipo_cuenta'];
			if(isset($_POST['nombre']))
			{
				$nombre = $_POST['nombre'];
				if(isset($_POST['apellido']))
				{
					$apellido = $_POST['apellido'];
					if(isset($_POST['correo']))
					{
						$correo = $_POST['correo'];
						if(isset($_POST['paypal']))
						{
							$paypal = $_POST['paypal'];
							if(isset($_POST['telefono']))
							{
								$telefono = $_POST['telefono'];
								if(isset($_POST['pais']))
								{
									$pais = $_POST['pais'];
									$id_usuario = $_POST['id_usuario'];
									$resultado = $usuarios->editar_perfil($id_usuario, $username, $password, $tipo_cuenta, $nombre, $apellido, $correo, $paypal, $telefono, $pais);
									echo $resultado;
								}
							}
						}
					}
				}
			}
		}
	}
}
?>