<?php
if(isset($_POST['server']))
{	
	$servidor = $_POST['server'];
	if(isset($_POST['level']))
	{
		$level = $_POST['level'];
		if(isset($_POST['division']))
		{
			$division = $_POST['division'];
			if(isset($_POST['champion1']))
			{
				$champion1 = $_POST['champion1'];
				if(isset($_POST['champion2']))
				{
					$champion2 = $_POST['champion2'];
					if(isset($_POST['champion3']))
					{
						$champion3 = $_POST['champion3'];
						if(isset($_POST['champion4']))
						{
							$champion4 = $_POST['champion4'];
							if(isset($_POST['precio_personal']))
							{
								$precio_personal = $_POST['precio_personal'];
								if(isset($_POST['precio_team']))
								{
									$precio_team = $_POST['precio_team'];
									if(isset($_POST['roles']))
									{
										$roles = $_POST['roles'];
										if(isset($_POST['idiomas']))
										{
											$idiomas = $_POST['idiomas'];
											$id_usuario = $_SESSION['id_usuario'];
											$contenido = $_POST['contenido'];
											$contenido = str_replace("'", '"', $contenido);
											if($level == '6')
											{
												$divison = '0';
											}
											$resultado = $usuarios->miperfil_coach($id_usuario, $servidor, $contenido, $level, $division, $champion1, $champion2, $champion3, $champion4, $roles, $idiomas, $precio_personal, $precio_team);
											echo $resultado;
										}
										else
										{
											echo 'Todos los campos deben estar completos';
										}
									}
									else
									{
										echo 'Todos los campos deben estar completos';
									}
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