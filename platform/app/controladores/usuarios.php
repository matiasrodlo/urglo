<?php
require_once(__DIR__ . '/../funciones/funciones.php');
require_once(__DIR__ . '/../modelos/bd.php');
require_once(__DIR__ . '/../modelos/usuarios.php');
require_once(__DIR__ . '/../modelos/pedidos.php');
require_once(__DIR__ . '/../modelos/mensajes.php');
require_once(__DIR__ . '/../modelos/trabajos.php');

$usuarios = new Usuarios();
$pedidos = new Pedidos();
$mensajes = new Mensajes();
$trabajos = new Trabajos();

if (isset($_SESSION['usuario'])) 
{
	if($_SESSION['tipo'] == 'user')
	{
		switch ($url[0]) 
		{
			case '':
				require_once(__DIR__ . '/../vistas/user/logicas/index.php');
			break;
			
			case 'perfil':
				require_once(__DIR__ . '/../vistas/user/logicas/editar_perfil.php');
			break;

			case 'editar_personal_accion':
				require_once(__DIR__ . '/../vistas/user/logicas/editar_personal_accion.php');
			break;

			case 'editar_password_accion':
				require_once(__DIR__ . '/../vistas/user/logicas/editar_pw_accion.php');
			break;

			case 'kiphu':
				require_once(__DIR__ . '/../vistas/user/logicas/payment_kiphu.php');
			break;

			case 'mercadopago':
				require_once(__DIR__ . '/../vistas/user/logicas/payment_mercadopago.php');
			break;

			case 'mercadopagochile':
				require_once(__DIR__ . '/../vistas/user/logicas/payment_mercadopago_chile.php');
			break;

			case 'payuperu':
				require_once(__DIR__ . '/../vistas/user/logicas/payment_payu_peru.php');
			break;

			case 'payuchile':
				require_once(__DIR__ . '/../vistas/user/logicas/payment_payu_chile.php');
			break;

			case 'payucolombia':
				require_once(__DIR__ . '/../vistas/user/logicas/payment_payu_colombia.php');
			break;

			case 'payumexico':
				require_once(__DIR__ . '/../vistas/user/logicas/payment_payu_mexico.php');
			break;

			case 'pago_efectivo':
				require_once(__DIR__ . '/../vistas/user/logicas/instrucciones_pago_efectivo.php');
			break;

			case 'terminosycondiciones':
				require_once(__DIR__ . '/../vistas/user/logicas/terminoscondiciones.php');
			break;

			case 'img_perfil':
				$id_usuario = $_SESSION['id_usuario'];
				$resultado = $usuarios->subir_imagen($id_usuario);
				echo $resultado;
			break;

			case 'cerrar_sesion':
				require_once(__DIR__ . '/../vistas/cerrar_sesion_accion.php');
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'coach')
	{
		switch ($url[0]) 
		{
			case '':
				require_once(__DIR__ . '/../vistas/coach/logicas/index.php');
			break;
			
			case 'miperfil':
				$id_usuario = $_SESSION['id_usuario'];
				$resultado = $usuarios->comprobar_datos_coach($id_usuario);
				if($resultado == '')
				{
					require_once(__DIR__ . '/../vistas/coach/logicas/mi_perfil.php');
				}
				else
				{
					header('Location: '.RUTA_INDEX);
				}
			break;

			case 'editar_miperfil':
				$id_usuario = $_SESSION['id_usuario'];
				$resultado = $usuarios->comprobar_datos_coach($id_usuario);
				if($resultado == '')
				{
					header('Location: '.RUTA_INDEX);
				}
				else
				{
					require_once(__DIR__ . '/../vistas/coach/logicas/editar_miperfil.php');
				}
			break;

			case 'perfil':
				require_once(__DIR__ . '/../vistas/coach/logicas/editar_perfil.php');
			break;

			case 'miperfil_coach_accion':
				require_once(__DIR__ . '/../vistas/coach/logicas/miperfil_coach_accion.php');
			break;

			case 'editarmiperfil_coach_accion':
				require_once(__DIR__ . '/../vistas/coach/logicas/editarmiperfil_coach_accion.php');
			break;

			case 'editar_personal_accion':
				require_once(__DIR__ . '/../vistas/coach/logicas/editar_personal_accion.php');
			break;

			case 'editar_password_accion':
				require_once(__DIR__ . '/../vistas/coach/logicas/editar_pw_accion.php');
			break;

			case 'img_perfil':
				$id_usuario = $_SESSION['id_usuario'];
				$resultado = $usuarios->subir_imagen($id_usuario);
				echo $resultado;
			break;

			case 'coachs':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case ''.$url[1].'':
							$coach_user = $url[1];
							$id_coach = $usuarios->id_usuario($coach_user);
							if($id_coach[0]['tipo'] == 'coach')
							{
								$resultado = $usuarios->comprobar_datos_coach($id_coach[0]['id_usuario']);
								if($resultado == '')
								{
									header('Location: '.RUTA_INDEX.'coachs');
								}
								else
								{
									require_once(__DIR__ . '/../vistas/coach/logicas/perfil_coach.php');
								}
							}
							else
							{
								header('Location: '.RUTA_INDEX.'coachs');
							}
						break;	
					}
				}
				else
				{
					require_once(__DIR__ . '/../vistas/coach/logicas/coachs.php');
				}
			break;

			case 'cerrar_sesion':
				require_once(__DIR__ . '/../vistas/cerrar_sesion_accion.php');
			break;
		}
	}
	elseif($_SESSION['tipo'] != 'user' && $_SESSION['tipo'] != 'coach' && $_SESSION['tipo'] != 'admin')
	{
		session_destroy();
		header('Location: '.RUTA_INDEX.'login');
		exit;
	}
	elseif($_SESSION['tipo'] == 'admin')
	{
		switch ($url[0]) 
		{
			case '':
				require_once(__DIR__ . '/../vistas/admin/logicas/index.php');
			break;

			case 'enviar_email_coaches':
				$resultado = $mensajes->mandar_email_coachs();
				if($resultado != '')
				{
					for($i=0;$i<count($resultado);$i++)
					{
						$email = $resultado[$i]['correo'];
						mail ( $email , 'Nuevo trabajo disponible - Urglo.com' , "Hola,\nTe avisamos porque hay un nuevo trabajo disponible en la plataforma.\n\nSaludos\nUrglo.com - Administración", 'From: contacto@urglo.com' . "\r\n" .
    'Reply-To: contacto@urglo.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion());
					}

				}
			break;

			case 'perfil':
				require_once(__DIR__ . '/../vistas/admin/logicas/editar_perfil.php');
			break;

			case 'editar_personal_accion':
				require_once(__DIR__ . '/../vistas/admin/logicas/editar_personal_accion.php');
			break;

			case 'editar_password_accion':
				require_once(__DIR__ . '/../vistas/admin/logicas/editar_pw_accion.php');
			break;

			case 'img_perfil':
				$id_usuario = $_SESSION['id_usuario'];
				$resultado = $usuarios->subir_imagen($id_usuario);
				echo $resultado;
			break;

			case 'usuarios':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							header('Location: '.RUTA_INDEX);
						break;

						case 'lista':
							require_once(__DIR__ . '/../vistas/admin/logicas/lista_usuarios.php');
						break;

						case 'editar_perfil_accion':
							require_once(__DIR__ . '/../vistas/admin/logicas/editar_perfil_accion.php');
						break;

						case 'buscar_usuario':
							$busk = $_POST['user'];
							$resultado = $usuarios->buscar_usuario($busk);
							if($resultado == '')
							{
								echo '<tr style="background-color:#fff;color:#000;">
										<td colspan="7" style="border:0px">No se encontro a ningún usuario en la base de datos.</td>
									</tr>';
							}
							else
							{
								echo '<table class="lista" style="margin-top:10px;" cellspacing="0">
										<tr>
											<td width="100px">Usuario</td>
											<td width="80px">Tipo de usuario</td>
											<td width="100px">Nombre</td>
											<td width="120px">Apellido</td>
											<td width="250px">Correo</td>
											<td width="100px">Pais</td>
											<td width="100px"></td>
										</tr>';
										for($i=0;$i<count($resultado);$i++)
										{
											$user = $usuarios->datos_usuario($resultado[$i]['id_usuario']);

											echo '
											<tr style="background-color: #f2f2f2; color: #000;border-bottom: 1px solid #ddd;">
												<td>'.$user[0]['usuario'].'</td>
												<td>'.$user[0]['tipo'].'</td>
												<td>'.$resultado[$i]['nombre'].'</td>
												<td>'.$resultado[$i]['apellido'].'</td>
												<td>'.$resultado[$i]['correo'].'</td>
												<td>'.$resultado[$i]['pais'].'</td>
												<td><a class="btn_ag" href="'.RUTA_INDEX.'usuarios/'.$user[0]['usuario'].'">Ver</a></td>
											</tr>';
										}
								echo '</table>';
							}
						break;

						case ''.$url[1].'':
							$usuario = $url[1];
							$resultado = $usuarios->id_usuario($usuario);
							if($resultado[0]['id_usuario'] == '')
							{
								header('Location: '.RUTA_INDEX);
							}
							else
							{
								require_once(__DIR__ . '/../vistas/admin/logicas/perfil_usuario.php');
							}
						break;
					}
				}
				else
				{
					header('Location: '.RUTA_INDEX);
				}
			break;

			case 'coachs':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once(__DIR__ . '/../vistas/admin/logicas/lista_coachs.php');
						break;

						case 'lista':
							require_once(__DIR__ . '/../vistas/admin/logicas/lista_coachs.php');
						break;
						
						case 'trabajos_libres':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once(__DIR__ . '/../vistas/admin/logicas/lista_trabajos_coachs_libres.php');
									break;
									
									case 'activar_pedido':
										$id_pedido = $_POST['pedido'];
										$mensaje = $_POST['mensaje'];
										$resultado = $trabajos->activar_pedido($id_pedido, $mensaje);
										echo $resultado;
									break;

									case ''.$url[2].'':
										$resultado = $trabajos->comprobar_trabajo($url[2]);
										if($resultado[0]['estado'] == '1')
										{
											require_once(__DIR__ . '/../vistas/admin/logicas/trabajo_libre.php');
										}
										else
										{
											require_once(__DIR__ . '/../vistas/admin/logicas/lista_trabajos_coachs_libres.php');
										}
									break;
								}
							}	
							else
							{
								require_once(__DIR__ . '/../vistas/admin/logicas/lista_trabajos_coachs_libres.php');
							}
						break;

						case 'trabajos_activos':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once(__DIR__ . '/../vistas/admin/logicas/lista_trabajos_coachs_activos.php');
									break;

									case ''.$url[2].'':
										$resultado = $trabajos->comprobar_trabajo($url[2]);
										if($resultado[0]['estado'] == '2')
										{
											require_once(__DIR__ . '/../vistas/admin/logicas/trabajo_activo.php');
										}
										else
										{
											require_once(__DIR__ . '/../vistas/admin/logicas/lista_trabajos_coachs_activos.php');
										}
									break;
								}
							}
							else
							{
								require_once(__DIR__ . '/../vistas/admin/logicas/lista_trabajos_coachs_activos.php');
							}
						break;

						case 'trabajos_cancelados':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once(__DIR__ . '/../vistas/admin/logicas/lista_trabajos_coachs_cancelados.php');
									break;
									
									case ''.$url[2].'':
										$resultado = $trabajos->comprobar_trabajo($url[2]);
										if($resultado[0]['estado'] == '3')
										{
											require_once(__DIR__ . '/../vistas/admin/logicas/trabajo_cancelado.php');
										}
										else
										{
											require_once(__DIR__ . '/../vistas/admin/logicas/lista_trabajos_coachs_cancelados.php');
										}
									break;
								}
							}	
							else
							{
								require_once(__DIR__ . '/../vistas/admin/logicas/lista_trabajos_coachs_cancelados.php');
							}
						break;

						case 'trabajos_terminados':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once(__DIR__ . '/../vistas/admin/logicas/lista_trabajos_coachs_terminados.php');
									break;

									case ''.$url[2].'':
										$resultado = $trabajos->comprobar_trabajo($url[2]);
										if($resultado[0]['estado'] == '4')
										{
											require_once(__DIR__ . '/../vistas/admin/logicas/trabajo_terminado.php');
										}
										else
										{
											require_once(__DIR__ . '/../vistas/admin/logicas/lista_trabajos_coachs_terminados.php');
										}
									break;
								}
							}
							else
							{
								require_once(__DIR__ . '/../vistas/admin/logicas/lista_trabajos_coachs_terminados.php');
							}
						break;

						case ''.$url[1].'':
							$usuario = $url[1];
							$resultado = $usuarios->id_usuario($usuario);
							if($resultado[0]['id_usuario'] == '')
							{
								header('Location: '.RUTA_INDEX);
							}
							else
							{
								if($resultado[0]['tipo'] == 'coach')
								{
									$resultado = $usuarios->comprobar_datos_coach($resultado[0]['id_usuario']);
									if($resultado == '')
									{
										header('Location: '.RUTA_INDEX);
									}
									else
									{
										require_once(__DIR__ . '/../vistas/admin/logicas/perfil_usuario.php');
									}
								}
								else
								{
									header('Location: '.RUTA_INDEX);
								}
							}
						break;
					}
				}
				else
				{
					require_once(__DIR__ . '/../vistas/admin/logicas/lista_coachs.php');
				}
			break;


			case 'cerrar_sesion':
				require_once(__DIR__ . '/../vistas/cerrar_sesion_accion.php');
			break;
		}
	}
}
else
{
	switch ($url[0]) 
	{
		case '':
			header('Location: '.RUTA_INDEX);
		break;
				
		case 'registro':
			require_once(__DIR__ . '/../vistas/desconectado/logicas/registrar_usuario.php');
		break;

		case 'agregar_usuario':
			require_once(__DIR__ . '/../vistas/desconectado/logicas/agregar_usuario_accion.php');
		break;

		case 'login':
			require_once(__DIR__ . '/../vistas/desconectado/logicas/conectar_usuario.php');
		break;

		case 'contacto':
			require_once(__DIR__ . '/../vistas/desconectado/logicas/contacto.php');
		break;

		case 'conectar_usuario':
			require_once(__DIR__ . '/../vistas/desconectado/logicas/conectar_usuario_accion.php');
		break;
	}
}
?>