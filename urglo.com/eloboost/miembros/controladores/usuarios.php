<?php
require_once('funciones/funciones.php');
require_once('modelos/bd.php');
require_once('modelos/usuarios.php');
require_once('modelos/pedidos.php');
require_once('modelos/mensajes.php');
require_once('modelos/trabajos.php');

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
				require_once('vistas/user/logicas/index.php');
			break;
			
			case 'perfil':
				require_once('vistas/user/logicas/editar_perfil.php');
			break;

			case 'editar_personal_accion':
				require_once('vistas/user/logicas/editar_personal_accion.php');
			break;

			case 'editar_password_accion':
				require_once('vistas/user/logicas/editar_pw_accion.php');
			break;

			case 'kiphu':
				require_once('vistas/user/logicas/payment_kiphu.php');
			break;

			case 'mercadopago':
				require_once('vistas/user/logicas/payment_mercadopago.php');
			break;

			case 'mercadopagochile':
				require_once('vistas/user/logicas/payment_mercadopago_chile.php');
			break;

			case 'payuperu':
				require_once('vistas/user/logicas/payment_payu_peru.php');
			break;

			case 'payuchile':
				require_once('vistas/user/logicas/payment_payu_chile.php');
			break;

			case 'payucolombia':
				require_once('vistas/user/logicas/payment_payu_colombia.php');
			break;

			case 'payumexico':
				require_once('vistas/user/logicas/payment_payu_mexico.php');
			break;

			case 'pago_efectivo':
				require_once('vistas/user/logicas/instrucciones_pago_efectivo.php');
			break;

			case 'terminosycondiciones':
				require_once('vistas/user/logicas/terminoscondiciones.php');
			break;

			case 'img_perfil':
				$id_usuario = $_SESSION['id_usuario'];
				$resultado = $usuarios->subir_imagen($id_usuario);
				echo $resultado;
			break;

			case 'cerrar_sesion':
				require_once('vistas/cerrar_sesion_accion.php');
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'coach')
	{
		switch ($url[0]) 
		{
			case '':
				require_once('vistas/coach/logicas/index.php');
			break;
			
			case 'miperfil':
				$id_usuario = $_SESSION['id_usuario'];
				$resultado = $usuarios->comprobar_datos_coach($id_usuario);
				if($resultado == '')
				{
					require_once('vistas/coach/logicas/mi_perfil.php');
				}
				else
				{
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');
				}
			break;

			case 'editar_miperfil':
				$id_usuario = $_SESSION['id_usuario'];
				$resultado = $usuarios->comprobar_datos_coach($id_usuario);
				if($resultado == '')
				{
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');
				}
				else
				{
					require_once('vistas/coach/logicas/editar_miperfil.php');
				}
			break;

			case 'perfil':
				require_once('vistas/coach/logicas/editar_perfil.php');
			break;

			case 'miperfil_coach_accion':
				require_once('vistas/coach/logicas/miperfil_coach_accion.php');
			break;

			case 'editarmiperfil_coach_accion':
				require_once('vistas/coach/logicas/editarmiperfil_coach_accion.php');
			break;

			case 'editar_personal_accion':
				require_once('vistas/coach/logicas/editar_personal_accion.php');
			break;

			case 'editar_password_accion':
				require_once('vistas/coach/logicas/editar_pw_accion.php');
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
									header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/coachs');
								}
								else
								{
									require_once('vistas/coach/logicas/perfil_coach.php');
								}
							}
							else
							{
								header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/coachs');
							}
						break;	
					}
				}
				else
				{
					require_once('vistas/coach/logicas/coachs.php');
				}
			break;

			case 'cerrar_sesion':
				require_once('vistas/cerrar_sesion_accion.php');
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'elobooster')
	{
		switch ($url[0]) 
		{
			case '':
				require_once('vistas/elobooster/logicas/index.php');
			break;

			case 'perfil':
				require_once('vistas/elobooster/logicas/editar_perfil.php');
			break;

			case 'editar_personal_accion':
				require_once('vistas/elobooster/logicas/editar_personal_accion.php');
			break;

			case 'editar_password_accion':
				require_once('vistas/elobooster/logicas/editar_pw_accion.php');
			break;

			case 'img_perfil':
				$id_usuario = $_SESSION['id_usuario'];
				$resultado = $usuarios->subir_imagen($id_usuario);
				echo $resultado;
			break;

			case 'pedidos_desocupados':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once('vistas/elobooster/logicas/lista_pedidos_desocupados.php');
						break;
						
						case 'realizar_pedido':
							$id_pedido = $_POST['pedido'];
							$id_elo = $_SESSION['id_usuario'];
							$resultado = $pedidos->tomar_pedido($id_pedido, $id_elo);
							echo $resultado;
						break;

						case ''.$url[1].'':
							$resultado = $pedidos->comprobar_pedido($url[1], '5');
							if($resultado == '')
							{
								header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/pedidos_desocupados');
							}
							else
							{
								require_once('vistas/elobooster/logicas/pedidos.php');
							}
						break;
					}
				}
				else
				{
					require_once('vistas/elobooster/logicas/lista_pedidos_desocupados.php');
				}
			break;

			case 'pedidos_activos':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once('vistas/elobooster/logicas/lista_pedidos_activos.php');
						break;
						
						case 'actualizar_pedido':
							$id_pedido = $_POST['pedido'];
							$current = $_POST['current'];
							$id_elo = $_SESSION['id_usuario'];
							$resultado = $pedidos->actualizar_pedido_elo($id_pedido, $id_elo, $current);
							echo $resultado;
						break;
						
						case 'actualizar_pedido_ac':
							$id_pedido = $_POST['pedido'];
							$leaguecurrent = $_POST['leaguecurrent'];
							$divisioncurrent = $_POST['divisioncurrent'];
							$id_elo = $_SESSION['id_usuario'];
							$resultado = $pedidos->actualiz_pedido_elo($id_pedido, $id_elo, $leaguecurrent, $divisioncurrent);
							echo $resultado;
						break;

						case 'actualizar_servicio':
							$id_pedido = $_POST['trabajo'];
							$estado = $_POST['el'];
							if($estado == '0')
							{
								$estado = '1';
							}
							elseif($estado == '1')
							{
								$estado = '0';
							}
							$resultado = $pedidos->elo_actualiza_pedido($id_pedido, $estado);
							echo $resultado;
						break;

						case 'terminar_pedido':
							$id_pedido = $_POST['pedido'];
							$id_elo = $_SESSION['id_usuario'];
							$resultado = $pedidos->terminar_pedido($id_pedido, $id_elo);
							echo $resultado;
						break;

						case ''.$url[1].'':
							$resultado = $pedidos->comprobar_pedido($url[1], '2');
							if($resultado[0]['id_elobooster'] == $_SESSION['id_usuario'])
							{
								if($resultado == '')
								{
									header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/pedidos_activos');
								}
								else
								{
									require_once('vistas/elobooster/logicas/pedidos.php');
								}
							}
							else
							{
								header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/pedidos_activos');
							}
						break;
					}
				}
				else
				{
					require_once('vistas/elobooster/logicas/lista_pedidos_activos.php');
				}
			break;	

			case 'pedidos_terminados':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once('vistas/elobooster/logicas/lista_pedidos_terminados.php');
						break;

						case ''.$url[1].'':
							$resultado = $pedidos->comprobar_pedido($url[1], '4');
							if($resultado[0]['id_elobooster'] == $_SESSION['id_usuario'])
							{
								if($resultado == '')
								{
									header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/pedidos_terminados');
								}
								else
								{
									require_once('vistas/elobooster/logicas/pedidos.php');
								}
							}
							else
							{
								header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/pedidos_terminados');
							}
						break;
					}
				}
				else
				{
					require_once('vistas/elobooster/logicas/lista_pedidos_terminados.php');
				}
			break;

			case 'cerrar_sesion':
				require_once('vistas/cerrar_sesion_accion.php');
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'admin')
	{
		switch ($url[0]) 
		{
			case '':
				require_once('vistas/admin/logicas/index.php');
			break;

			case 'mandaremaileloboosters':
				$resultado = $mensajes->mandar_email_eloboosters();
				if($resultado != '')
				{
					for($i=0;$i<count($resultado);$i++)
					{
						$email = $resultado[$i]['correo'];
						mail ( $email , 'Nuevo pedido libre - Urglo.com' , "Buenas Elobooster,\nTe mandamos este mensaje porque hay un nuevo pedido libre del cual puedes encargarte.\n\nSaludos\nUrglo.com - Administracion", 'From: contacto@urglo.com' . "\r\n" .
    'Reply-To: contacto@urglo.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion());
					}

				}
			break;

			case 'perfil':
				require_once('vistas/admin/logicas/editar_perfil.php');
			break;

			case 'editar_personal_accion':
				require_once('vistas/admin/logicas/editar_personal_accion.php');
			break;

			case 'editar_password_accion':
				require_once('vistas/admin/logicas/editar_pw_accion.php');
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
							header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');
						break;

						case 'lista':
							require_once('vistas/admin/logicas/lista_usuarios.php');
						break;

						case 'editar_perfil_accion':
							require_once('vistas/admin/logicas/editar_perfil_accion.php');
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
												<td><a class="btn_ag" href="http://localhost:8080/miembros/usuarios/'.$user[0]['usuario'].'">Ver</a></td>
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
								header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');
							}
							else
							{
								require_once('vistas/admin/logicas/perfil_usuario.php');
							}
						break;
					}
				}
				else
				{
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');
				}
			break;

			case 'coachs':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once('vistas/admin/logicas/lista_coachs.php');
						break;

						case 'lista':
							require_once('vistas/admin/logicas/lista_coachs.php');
						break;
						
						case 'trabajos_libres':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once('vistas/admin/logicas/lista_trabajos_coachs_libres.php');
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
											require_once('vistas/admin/logicas/trabajo_libre.php');
										}
										else
										{
											require_once('vistas/admin/logicas/lista_trabajos_coachs_libres.php');
										}
									break;
								}
							}	
							else
							{
								require_once('vistas/admin/logicas/lista_trabajos_coachs_libres.php');
							}
						break;

						case 'trabajos_activos':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once('vistas/admin/logicas/lista_trabajos_coachs_activos.php');
									break;

									case ''.$url[2].'':
										$resultado = $trabajos->comprobar_trabajo($url[2]);
										if($resultado[0]['estado'] == '2')
										{
											require_once('vistas/admin/logicas/trabajo_activo.php');
										}
										else
										{
											require_once('vistas/admin/logicas/lista_trabajos_coachs_activos.php');
										}
									break;
								}
							}
							else
							{
								require_once('vistas/admin/logicas/lista_trabajos_coachs_activos.php');
							}
						break;

						case 'trabajos_cancelados':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once('vistas/admin/logicas/lista_trabajos_coachs_cancelados.php');
									break;
									
									case ''.$url[2].'':
										$resultado = $trabajos->comprobar_trabajo($url[2]);
										if($resultado[0]['estado'] == '3')
										{
											require_once('vistas/admin/logicas/trabajo_cancelado.php');
										}
										else
										{
											require_once('vistas/admin/logicas/lista_trabajos_coachs_cancelados.php');
										}
									break;
								}
							}	
							else
							{
								require_once('vistas/admin/logicas/lista_trabajos_coachs_cancelados.php');
							}
						break;

						case 'trabajos_terminados':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once('vistas/admin/logicas/lista_trabajos_coachs_terminados.php');
									break;

									case ''.$url[2].'':
										$resultado = $trabajos->comprobar_trabajo($url[2]);
										if($resultado[0]['estado'] == '4')
										{
											require_once('vistas/admin/logicas/trabajo_terminado.php');
										}
										else
										{
											require_once('vistas/admin/logicas/lista_trabajos_coachs_terminados.php');
										}
									break;
								}
							}
							else
							{
								require_once('vistas/admin/logicas/lista_trabajos_coachs_terminados.php');
							}
						break;

						case ''.$url[1].'':
							$usuario = $url[1];
							$resultado = $usuarios->id_usuario($usuario);
							if($resultado[0]['id_usuario'] == '')
							{
								header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');
							}
							else
							{
								if($resultado[0]['tipo'] == 'coach')
								{
									$resultado = $usuarios->comprobar_datos_coach($resultado[0]['id_usuario']);
									if($resultado == '')
									{
										header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');
									}
									else
									{
										require_once('vistas/admin/logicas/perfil_usuario.php');
									}
								}
								else
								{
									header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');
								}
							}
						break;
					}
				}
				else
				{
					require_once('vistas/admin/logicas/lista_coachs.php');
				}
			break;

			case 'elobooster':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once('vistas/admin/logicas/lista_eloboosters.php');
						break;

						case 'lista':
							require_once('vistas/admin/logicas/lista_eloboosters.php');
						break;

						case 'pedidos_libres':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once('vistas/admin/logicas/lista_pedidos_libres.php');
									break;
										
									case 'activar_pedido':
										$id_pedido = $_POST['pedido'];
										$precio_elo = $_POST['precio_elo'];
										$activar = $pedidos->activar_pedido($id_pedido, $precio_elo);
										echo $activar;
									break;

									case ''.$url[2].'':
										$resultado = $pedidos->comprobar_pedido($url[2], '1');
										if($resultado == '')
										{
											header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/elobooster/pedidos_libres/');
										}
										else
										{
											require_once('vistas/admin/logicas/pedidos.php');
										}
									break;
								}
							}
							else
							{
								require_once('vistas/admin/logicas/lista_pedidos_libres.php');
							}
						break;

						case 'pedidos_desocupados':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once('vistas/admin/logicas/lista_pedidos_desocupados.php');
									break;

									case 'actualizar_pedido':
										$id_pedido = $_POST['pedido'];
										$precio_elo = $_POST['precio_elo'];
										$actualizar = $pedidos->actualizar_pedido($id_pedido, $precio_elo);
										echo $actualizar;
									break;

									case ''.$url[2].'':
										$resultado = $pedidos->comprobar_pedido($url[2], '5');
										if($resultado == '')
										{
											header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/elobooster/pedidos_desocupados/');
										}
										else
										{
											require_once('vistas/admin/logicas/pedidos.php');
										}
									break;
								}
							}
							else
							{
								require_once('vistas/admin/logicas/lista_pedidos_desocupados.php');
							}
						break;

						case 'pedidos_activos':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once('vistas/admin/logicas/lista_pedidos_activos.php');
									break;

									case ''.$url[2].'':
										$resultado = $pedidos->comprobar_pedido($url[2], '2');
										if($resultado == '')
										{
											header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/elobooster/pedidos_activos/');
										}
										else
										{
											require_once('vistas/admin/logicas/pedidos.php');
										}
									break;
								}
							}
							else
							{
								require_once('vistas/admin/logicas/lista_pedidos_activos.php');
							}
						break;

						case 'pedidos_cancelados':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once('vistas/admin/logicas/lista_pedidos_cancelados.php');
									break;

									case ''.$url[2].'':
										$resultado = $pedidos->comprobar_pedido($url[2], '3');
										if($resultado == '')
										{
											header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/elobooster/pedidos_cancelados/');
										}
										else
										{
											require_once('vistas/admin/logicas/pedidos.php');
										}
									break;
								}
							}
							else
							{
								require_once('vistas/admin/logicas/lista_pedidos_cancelados.php');
							}
						break;

						case 'pedidos_terminados':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once('vistas/admin/logicas/lista_pedidos_activos.php');
									break;
									
									case ''.$url[2].'':
										$resultado = $pedidos->comprobar_pedido($url[2], '4');
										if($resultado == '')
										{
											header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/elobooster/pedidos_terminados/');
										}
										else
										{
											require_once('vistas/admin/logicas/pedidos.php');
										}
									break;
								}
							}
							else
							{
								require_once('vistas/admin/logicas/lista_pedidos_terminados.php');
							}
						break;

						case ''.$url[1].'':
							$usuario = $url[1];
							$resultado = $usuarios->id_usuario($usuario);
							if($resultado[0]['id_usuario'] == '')
							{
								header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');
							}
							else
							{
								if($resultado[0]['tipo'] == 'admin')
								{
									require_once('vistas/admin/logicas/perfil_usuario.php');	
								}
								else
								{
									header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');
								}
							}
						break;
					}
				}
				else
				{
					require_once('vistas/admin/logicas/lista_eloobosters.php');
				}
			break;

			case 'cerrar_sesion':
				require_once('vistas/cerrar_sesion_accion.php');
			break;
		}
	}
}
else
{
	switch ($url[0]) 
	{
		case '':
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');
		break;
				
		case 'registro':
			require_once('vistas/desconectado/logicas/registrar_usuario.php');
		break;

		case 'agregar_usuario':
			require_once('vistas/desconectado/logicas/agregar_usuario_accion.php');
		break;

		case 'login':
			require_once('vistas/desconectado/logicas/conectar_usuario.php');
		break;

		case 'contacto':
			require_once('vistas/desconectado/logicas/contacto.php');
		break;

		case 'conectar_usuario':
			require_once('vistas/desconectado/logicas/conectar_usuario_accion.php');
		break;
	}
}
?>