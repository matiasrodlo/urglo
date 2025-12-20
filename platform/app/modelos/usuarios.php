<?php
class Usuarios extends Conexion {
	public function comprobar_correo($email)
	{
		$this->codigosql = "SELECT correo FROM usuario_personal WHERE correo='$email' LIMIT 1";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function comprobar_nick($usuario)
	{
		$this->codigosql = "SELECT id_usuario, usuario FROM usuarios WHERE usuario='$usuario' LIMIT 1";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function comprobar_pass($id_usuario, $pass)
	{
		$pass = md5($pass);
		$this->codigosql = "SELECT usuario, pass FROM usuarios WHERE id_usuario='$id_usuario' and pass='$pass'";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function buscar_usuario($busk)
	{
		$this->codigosql = "SELECT * FROM usuario_personal WHERE usuario_personal.nombre LIKE '%$busk%' or usuario_personal.apellido LIKE '%$busk%' or usuario_personal.correo LIKE '%$busk%' or usuario_personal.pp_correo LIKE '%$busk%' ORDER BY usuario_personal.id_usuario ASC";
		$this->obtener_resultados();

		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function conectar_usuario($nombre, $pass)
	{
		if ($nombre == '' || $pass== '') 
		{
			return 'Completa todos los campos';
		}
		else
		{
			$pass = md5($pass);
			$this->codigosql = "SELECT id_usuario, usuario, pass, tipo FROM usuarios WHERE usuario='$nombre' and pass='$pass' LIMIT 1";
			$this->obtener_resultados();

			if($this->num_resultados > 0)
			{
				$pass_sql = $this->resultado[0]['pass'];
				if($pass == $pass_sql)
				{
					$_SESSION['usuario'] = $this->resultado[0]['usuario'];
					$_SESSION['id_usuario'] = $this->resultado[0]['id_usuario'];
					$_SESSION['tipo'] = $this->resultado[0]['tipo'];
					return '1';
				}
				else
				{
					return 'Usuario o contraseña incorrectos.';
				}
			}
			else
			{
				return 'Usuario o contraseña incorrectos.';
			}
		}
	}

	public function registrar_usuario()
	{
		$user_platform = isset($_POST['user_platform']) ? $_POST['user_platform'] : '';
		$pass_platform = isset($_POST['pass_platform']) ? $_POST['pass_platform'] : '';
		$pass2_platform = isset($_POST['pass2_platform']) ? $_POST['pass2_platform'] : '';

		if($_POST['nombre'] == '' || $_POST['apellido'] == '' || $_POST['email'] == '' || $_POST['telefono'] == '' || $_POST['pais'] == '' || $user_platform == '' || $pass_platform == '' || $pass2_platform == '')
		{
			echo 'Completa todos los campos';
		}
		else
		{
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$email = $_POST['email'];
			$paypal = $_POST['paypal'];
			$telefono = $_POST['telefono'];
			$pais = $_POST['pais'];
			$user_platform = $user_platform;
			$pass_platform = $pass_platform;
			$pass2_platform = $pass2_platform;

			if(check_email($email))
			{
				if($this->comprobar_correo($email) == true)
				{
					echo 'Su email ya esta en uso.';
				}
				else
				{
					if($this->comprobar_nick($user_platform) == true)
					{
						echo 'El nombre de usuario ya esta en uso.';
					}
					else
					{
						if($pass_platform == $pass2_platform)
						{
							$this->conectar_db();
							$this->codigosql = "START TRANSACTION";
 							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
 							if($this->consulta)
 							{
 								$pass_login1 = $pass_platform;
 								$pass_platform = md5($pass_platform);
			 					$consulta2 = mysqli_query($this->conexion, "INSERT INTO usuarios VALUES (null, '$user_platform', '$pass_platform', 'user')");
								if($consulta2)
								{
									$id_usuario = mysqli_insert_id($this->conexion);
									$consulta1 = mysqli_query($this->conexion, "INSERT INTO usuario_personal VALUES ('$id_usuario', '$nombre', '$apellido', '$email', '$paypal', '$telefono', '$pais', 'user_perfil_defecto.jpg')");

									if($consulta1 && $consulta2)
									{
										$this->codigosql = 'commit;';
										$this->consulta = mysqli_query($this->conexion, $this->codigosql);
										$this->desconectar_db();
										$this->conectar_usuario($user_platform, $pass_login1);
										return true;
									}
									else
									{
										$this->codigosql = 'rollback;';
										$this->consulta = mysqli_query($this->conexion, $this->codigosql);
										$this->desconectar_db();
										echo 'No se pudo registrar el usuario. Intenta nuevamente.';
									}
								}
								else
								{
									$this->codigosql = 'rollback;';
									$this->consulta = mysqli_query($this->conexion, $this->codigosql);
									$this->desconectar_db();
									echo 'No se pudo registrar el usuario. Intenta nuevamente.';
								}
 							}
 							else
 							{
 								$this->codigosql = 'rollback;';
								$this->consulta = mysqli_query($this->conexion, $this->codigosql);
								$this->desconectar_db();
								echo 'Hubo un error en el registro de usuario, por favor intentalo denuevo.';
 							}
						}
						else
						{
							echo 'Las contraseñas no coinciden';
						}
					}
				}
			}
			else
			{
				echo 'Por favor, ingrese un correo valido.';
			}
		}
	}
	public function editar_perfil($id_usuario, $username, $password, $tipo_cuenta, $nombre, $apellido, $correo, $paypal, $telefono, $pais)
	{
		if($id_usuario == '' || $username == '' || $password == '' || $tipo_cuenta == '' || $nombre == '' || $apellido == '' || $correo == '' || $telefono == '' || $pais == '')
		{
			echo 'Completa todos los campos para realizar los cambios';
		}
		else
		{
			//$password = md5($password);
			$this->conectar_db();
			$this->codigosql = "START TRANSACTION";
 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
		 	if($this->consulta)
		 	{
		 		$consulta1 = mysqli_query($this->conexion, "UPDATE usuario_personal SET nombre='$nombre', apellido='$apellido', correo='$correo', pp_correo='$paypal', telefono='$telefono', pais='$pais' WHERE id_usuario='$id_usuario'");
				$consulta2 = mysqli_query($this->conexion, "UPDATE usuarios SET usuario='$username', pass='$password', tipo='$tipo_cuenta' WHERE id_usuario='$id_usuario'");

				if($consulta1)
				{
					if($consulta2)
					{
						$this->codigosql = 'commit;';
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						$this->desconectar_db();
						echo 'Los cambios se han realizados correctamente.';
					}
					else
					{
						$this->codigosql = 'rollback;';
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						$this->desconectar_db();
						echo 'No se pudieron guardar los cambios. Intenta nuevamente.';
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error en realizar los cambios del usuario, por favor intentelo nuevamente.';
				}
		 	}
		 	else
			{
				$this->codigosql = 'rollback;';
				$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				$this->desconectar_db();
				echo 'Hubo un error en realizar los cambios del usuario, por favor intentelo nuevamente.';
			}
		}
	}
	public function editar_personal($id_usuario, $nombre, $apellido, $correo, $paypal, $telefono)
	{
		if($id_usuario  == '' || $nombre == '' || $apellido == '' || $correo == '' || $paypal == '' || $telefono == '')
		{
			echo 'Completa todos los campos para realizar los cambios';
		}
		else
		{
			$this->codigosql = "UPDATE usuario_personal SET nombre='$nombre', apellido='$apellido', correo='$correo', pp_correo='$paypal', telefono='$telefono' WHERE id_usuario='$id_usuario'";
			$this->consulta_simple();

			if($this->consulta)
			{
				echo 'Los cambios fueron realizados correctamente.';
			}
			else
			{
				echo 'No se pudieron guardar los cambios. Intenta nuevamente.';
			}	
		}
	}
	public function subir_imagen($id_usuario)
	{
		if($_FILES == array())
		{
			echo 'No se pudo subir la imagen. Intenta nuevamente.';
		}
		else
		{
			$mime = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');
			$error = '';
			if(!in_array( $_FILES['imagen']['type'], $mime ))
			{
				echo 'Solo se permiten imagenes de formato JPG, GIF, PNG.';
			}
			else
			{
				if($_FILES['imagen']['type'] == '')
				{
					echo 'No subiste ninguna imagen.';
				}
				else
				{
					if($_FILES['imagen']['size'] > 6222915) 
					{
						echo 'El tamaño de la imagen debe ser menor a 5 MB.';
					}
					else
					{
						$args = array(
							'filename' => $_FILES['imagen']['name'],
							'tmp_name' => $_FILES['imagen']['tmp_name']
						);
						
						extract($args, EXTR_SKIP);
					    $filename = uniqid(microtime()) . $filename;
					    $expl = explode('.', $filename);
					    $ext = end($expl);
					    $filename = substr(md5($filename), 0, 10);
					    $filename = $filename . '.' . $ext;
					    $filepath = dirname(__FILE__) . '/../images/user/';
					    
					    $ruta = $filepath;$nombre = $filename;$alto = 314;$ancho = 314;$nombreN = 'perfil_'.$nombre;$extension = $ext;

					    $rutaImagenOriginal = $tmp_name;
					    if($extension == 'GIF' || $extension == 'gif')
					    {
					   		$img_original = imagecreatefromgif($rutaImagenOriginal);
					    }
					    if($extension == 'jpg' || $extension == 'JPG')
					    {
					   		$img_original = imagecreatefromjpeg($rutaImagenOriginal);
					    }
					    if($extension == 'png' || $extension == 'PNG')
					    {
					    	$img_original = imagecreatefrompng($rutaImagenOriginal);
					    }
					    
					    $max_ancho = $ancho;
					    $max_alto = $alto;
					    list($ancho,$alto)=getimagesize($rutaImagenOriginal);
					    $x_ratio = $max_ancho / $ancho;
					    $y_ratio = $max_alto / $alto;
					    if( ($ancho <= $max_ancho) && ($alto <= $max_alto) )
					    {
					  		$ancho_final = $ancho;
							$alto_final = $alto;
						} 
						elseif (($x_ratio * $alto) < $max_alto)
						{
							$alto_final = ceil($x_ratio * $alto);
							$ancho_final = $max_ancho;
						} else
						{
							$ancho_final = ceil($y_ratio * $ancho);
							$alto_final = $max_alto;
						}

					    $tmp=imagecreatetruecolor($ancho_final,$alto_final);
					    imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
					    imagedestroy($img_original);
					    $calidad=70;
					    imagejpeg($tmp,$ruta.$nombreN,$calidad);
					    
					    $imagen_fin = $ruta.$nombreN;

						chmod($imagen_fin , 0644);

						$this->codigosql = "UPDATE usuario_personal SET img_perfil='$nombreN' WHERE id_usuario='$id_usuario'";
						$this->consulta_simple();
						if($this->consulta)
						{
						   	echo 'Tu imagen de perfil se subio correctamente.';	
						}
						else
						{
						    echo 'No se pudo subir la imagen de perfil. Intenta nuevamente.';
						}
					}
				}
			}
		}
	}
	public function imagen_perfil($id_usuario)
	{
		$this->codigosql = "SELECT img_perfil FROM usuario_personal WHERE id_usuario='$id_usuario'";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado[0]['img_perfil'];
		}
		else
		{
			return false;
		}
	}
	public function cambiar_contra($id_usuario, $old, $nueva, $rep)
	{
		if($id_usuario == '' || $old == '' || $nueva == '' || $rep == '')
		{
			echo 'Completa todos los campos para realizar los cambios';
		}
		else
		{
			if($this->comprobar_pass($id_usuario, $old) == true)
			{
				if($nueva == $rep)
				{
					$nueva = md5($nueva);
					$this->codigosql = "UPDATE usuarios SET pass='$nueva' WHERE id_usuario='$id_usuario'";
					$this->consulta_simple();

					if($this->consulta)
					{
						echo 'Contraseña cambiada correctamente';
					}
					else
					{
						echo 'No se pudo cambiar la contraseña. Intenta nuevamente.';
					}	
				}
				else
				{
					echo 'Las contraseñas no coinciden';
				}
			}
			else
			{
				echo 'Su antigua contraseña no coincide';
			}
		}
	}
	public function desconectar_usuario()
	{
		session_destroy();
	    $parametros_cookies = session_get_cookie_params(); 
	    setcookie(session_name(),0,1,$parametros_cookies["path"]);
		header('Location: /');
		exit;
	}
	public function datos_user_personal($id_usuario)
	{
		$this->codigosql = "SELECT * FROM usuario_personal WHERE id_usuario='$id_usuario'";
		$this->obtener_resultados();

		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function datos_usuario($id_usuario)
	{
		$this->codigosql = "SELECT usuario, tipo, pass FROM usuarios WHERE id_usuario='$id_usuario'";
		$this->obtener_resultados();
		
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function lista_usuarios()
	{
		$this->codigosql = "SELECT * FROM usuarios ORDER BY id_usuario DESC";
		$this->obtener_resultados();
		
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}

	public function lista_usuarios_coachs()
	{
		$this->codigosql = "SELECT * FROM usuarios WHERE tipo='coach'";
		$this->obtener_resultados();
		
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}


	public function id_usuario($usuario)
	{
		$this->codigosql = "SELECT id_usuario, tipo FROM usuarios WHERE usuario='$usuario' LIMIT 1";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}

	public function server_lol($id_server_lol)
	{
		$this->codigosql = "SELECT nombre FROM servers WHERE id_server='$id_server_lol'";
		$this->obtener_resultados();
		
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function lista_server_lol()
	{
		$this->codigosql= "SELECT * FROM servers";
		$this->obtener_resultados();

		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function lp($id_lp)
	{
		$this->codigosql = "SELECT valor FROM leaguepoints WHERE id_lp='$id_lp'";
		$this->obtener_resultados();

		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function lista_lp()
	{
		$this->codigosql= "SELECT * FROM leaguepoints";
		$this->obtener_resultados();

		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function level($id_level)
	{
		$this->codigosql = "SELECT valor FROM levels WHERE id_level='$id_level'";
		$this->obtener_resultados();

		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function lista_levels()
	{
		$this->codigosql= "SELECT * FROM levels";
		$this->obtener_resultados();

		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function division($id_division)
	{
		$this->codigosql = "SELECT division FROM division WHERE id_division='$id_division'";
		$this->obtener_resultados();

		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function lista_division()
	{
		$this->codigosql= "SELECT * FROM division";
		$this->obtener_resultados();

		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function comprobar_datos_coach($id_usuario)
	{
		$this->codigosql = "SELECT * FROM perfil_coach WHERE id_usuario='$id_usuario'";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function lista_champions()
	{
		$this->codigosql = "SELECT * FROM champions";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function lista_lang()
	{
		$this->codigosql = "SELECT * FROM idiomas";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function lista_roles()
	{
		$this->codigosql = "SELECT * FROM roles";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function miperfil_coach($id_usuario, $servidor, $contenido, $level, $division, $champion1, $champion2, $champion3, $champion4, $roles, $idiomas, $precio_personal, $precio_team)
	{
		if($id_usuario == '' || $servidor == '' || $level == '' || $champion1 == '' || $champion2 == '' || $champion3 == '' || $champion4 == '' || $roles == '' || $idiomas == '' || $precio_personal == '' || $precio_team == '')
		{
			echo 'Completa todos los campos';
		}
		else
		{
			$this->conectar_db();
			$this->codigosql = 'START TRANSACTION;';
			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
			if($this->consulta)
			{
			 	$consulta1 = mysqli_query($this->conexion, "INSERT INTO perfil_coach VALUES ('$id_usuario', '$servidor', '$level', '$division', '$contenido', '$precio_personal', '$precio_team')");
			 	$consulta2 = mysqli_query($this->conexion, "INSERT INTO champion_coach VALUES ('$id_usuario', '$champion1')"); 
			 	$consulta3 = mysqli_query($this->conexion, "INSERT INTO champion_coach VALUES ('$id_usuario', '$champion2')");
			 	$consulta4 = mysqli_query($this->conexion, "INSERT INTO champion_coach VALUES ('$id_usuario', '$champion3')");
			 	$consulta5 = mysqli_query($this->conexion, "INSERT INTO champion_coach VALUES ('$id_usuario', '$champion4')");
				
			 	if($consulta1 && $consulta2 && $consulta3 && $consulta4 && $consulta5)
				{		
					for($i=0;$i<count($roles);$i++)
					{
						$rol = $roles[$i];
						$consulta6 = mysqli_query($this->conexion, "INSERT INTO roles_coach VALUES ('$id_usuario', '$rol')");	
					}
					for($i=0;$i<count($idiomas);$i++)
					{
						$lang = $idiomas[$i];
						$consulta7 = mysqli_query($this->conexion, "INSERT INTO languages_coach VALUES ('$id_usuario', '$lang')");
					}
					if($consulta6 && $consulta7)
					{
						$this->codigosql = 'commit;';
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						$this->desconectar_db();
						$usuario = $this->datos_usuario($id_usuario);
						$usuario = $usuario[0]['usuario'];
						echo 'Felicitaciones ya esta todo listo. Asi quedo tu perfil <a href="'.RUTA_INDEX.'coachs/'.$usuario.'">Mi Perfil de Coach</a>';
					}
					else
					{
						$this->codigosql = 'rollback;';
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						$this->desconectar_db();
						echo 'No se pudo completar el perfil. Intenta nuevamente.';
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error al completar el perfil, por favor intentalo denuevo.';
				}				
			}
			else
			{
				echo 'Hubo un error al completar el perfil, por favor intentalo denuevo.';
			}
		}
	}
	public function editar_miperfil_coach($id_usuario, $servidor, $contenido, $level, $division, $champion1, $champion2, $champion3, $champion4, $roles, $idiomas, $precio_personal, $precio_team)
	{
		if($id_usuario == '' || $servidor == '' || $level == '' || $champion1 == '' || $champion2 == '' || $champion3 == '' || $champion4 == '' || $roles == '' || $idiomas == '' || $precio_personal == '' || $precio_team == '')
		{
			echo 'Completa todos los campos';
		}
		else
		{
			$this->conectar_db();
			$this->codigosql = 'START TRANSACTION;';
			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
			if($this->consulta)
			{
				$delet = mysqli_query($this->conexion, "DELETE FROM languages_coach WHERE id_usuario='$id_usuario'");
				if($delet)
				{
					$delet = mysqli_query($this->conexion, "DELETE FROM roles_coach WHERE id_usuario='$id_usuario'");
					if($delet)
					{
						$delet = mysqli_query($this->conexion, "DELETE FROM champion_coach WHERE id_usuario='$id_usuario'");
						if($delet)
						{
							$consulta1 = mysqli_query($this->conexion, "UPDATE perfil_coach SET id_level='$level', id_servidor='$servidor', id_division='$division', content='$contenido', precio='$precio_personal', precio_team='$precio_team' WHERE id_usuario='$id_usuario'");
						 	$consulta2 = mysqli_query($this->conexion, "INSERT INTO champion_coach VALUES ('$id_usuario', '$champion1')"); 
						 	$consulta3 = mysqli_query($this->conexion, "INSERT INTO champion_coach VALUES ('$id_usuario', '$champion2')");
						 	$consulta4 = mysqli_query($this->conexion, "INSERT INTO champion_coach VALUES ('$id_usuario', '$champion3')");
						 	$consulta5 = mysqli_query($this->conexion, "INSERT INTO champion_coach VALUES ('$id_usuario', '$champion4')");
							
						 	if($consulta1 && $consulta2 && $consulta3 && $consulta4 && $consulta5)
							{		
								for($i=0;$i<count($roles);$i++)
								{
									$rol = $roles[$i];
									$consulta6 = mysqli_query($this->conexion, "INSERT INTO roles_coach VALUES ('$id_usuario', '$rol')");	
								}
								for($i=0;$i<count($idiomas);$i++)
								{
									$lang = $idiomas[$i];
									$consulta7 = mysqli_query($this->conexion, "INSERT INTO languages_coach VALUES ('$id_usuario', '$lang')");
								}
								if($consulta6 && $consulta7)
								{
									$this->codigosql = 'commit;';
									$this->consulta = mysqli_query($this->conexion, $this->codigosql);
									$this->desconectar_db();
									$usuario = $this->datos_usuario($id_usuario);
									$usuario = $usuario[0]['usuario'];
									echo 'Felicitaciones ya esta todo listo. Asi quedo tu perfil <a href="'.RUTA_INDEX.'coachs/'.$usuario.'">Mi Perfil de Coach</a>';
								}
								else
								{
									$this->codigosql = 'rollback;';
									$this->consulta = mysqli_query($this->conexion, $this->codigosql);
									$this->desconectar_db();
									echo 'No se pudo modificar el perfil. Intenta nuevamente.';
								}
							}
							else
							{
								$this->codigosql = 'rollback;';
								$this->consulta = mysqli_query($this->conexion, $this->codigosql);
								$this->desconectar_db();
								echo 'Hubo un error al modificar el perfil, por favor intentalo denuevo.';
							}
						}
						else
						{
							$this->codigosql = 'rollback;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							echo 'Hubo un error al modificar el perfil, por favor intentalo denuevo.';
						}
					}
					else
					{
						$this->codigosql = 'rollback;';
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						$this->desconectar_db();
						echo 'Hubo un error al modificar el perfil, por favor intentalo denuevo.';
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error al modificar el perfil, por favor intentalo denuevo.';
				}			
			}
			else
			{
				echo 'Hubo un error al modificar el perfil, por favor intentalo denuevo.';
			}
		}
	}
	public function datos_coach($id_usuario)
	{
		$this->codigosql = "SELECT * FROM perfil_coach WHERE id_usuario='$id_usuario'";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function champions_coach($id_usuario)
	{
		$this->codigosql = "SELECT * FROM champion_coach WHERE id_usuario='$id_usuario'";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function top3_coach()
	{
		$this->codigosql = "SELECT id_coach, AVG(calificacion) as avg_rating, COUNT(*) as total_ratings 
			FROM calificacion_coach 
			GROUP BY id_coach 
			HAVING total_ratings > 0 
			ORDER BY avg_rating DESC, total_ratings DESC 
			LIMIT 3";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function languages_coach($id_usuario)
	{
		$this->codigosql = "SELECT * FROM languages_coach WHERE id_usuario='$id_usuario'";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function roles_coach($id_usuario)
	{
		$this->codigosql = "SELECT * FROM roles_coach WHERE id_usuario='$id_usuario'";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function champion($id_champion)
	{
		$this->codigosql = "SELECT * FROM champions WHERE id_champion='$id_champion'";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function rol($id_rol)
	{
		$this->codigosql = "SELECT * FROM roles WHERE id_rol='$id_rol'";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
	public function idioma($id_idioma)
	{
		$this->codigosql = "SELECT * FROM idiomas WHERE id_idioma='$id_idioma'";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}
}
?>
