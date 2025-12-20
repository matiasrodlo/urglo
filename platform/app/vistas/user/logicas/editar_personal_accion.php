<?php
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
							$id_usuario = $_SESSION['id_usuario'];
							$resultado = $usuarios->editar_personal($id_usuario, $nombre, $apellido, $correo, $paypal, $telefono);
							echo $resultado;
						}
					}
				}
			}
		}
	}
?>