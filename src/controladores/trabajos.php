<?php
require_once('funciones/funciones.php');
require_once('modelos/bd.php');
require_once('modelos/usuarios.php');
require_once('modelos/pedidos.php');
require_once('modelos/trabajos.php');
require_once('modelos/mensajes.php');

$usuarios = new Usuarios();
$pedidos = new Pedidos();
$trabajos = new Trabajos();
$mensajes = new Mensajes();

if (isset($_SESSION['usuario'])) 
{
	if($_SESSION['tipo'] == 'user')
	{
		switch ($url[0]) 
		{		
			case 'coachs':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once('vistas/user/logicas/coachs.php');	
						break;

						case 'mis_ordenes':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once('vistas/user/logicas/mis_ordenes_coachs.php');
									break;
									
									case 'calificar_coach':
										$trabajo = $trabajos->datos_trabajo($_POST['trabajo']);
										$id_cliente = $trabajo[0]['id_usuario'];
										$id_coach = $trabajo[0]['id_coach'];
										$id_trabajo = $trabajo[0]['id_trabajo_coach'];
										$txt = $_POST['calificacionText'];
										$puntos = $_POST['point'];
										$resultado = $trabajos->calificar_trabajo($id_trabajo, $txt, $puntos, $id_coach, $id_cliente);
										echo $resultado;
									break;

									case ''.$url[2].'':
										// tengo que verificar si el id del cliente es correspondiente a el id del trabajo
										$resultado = $trabajos->comprobar_trabajo($url[2]);
										if($resultado == false)
										{
											require_once('vistas/user/logicas/mis_ordenes_coachs.php');
										}
										else
										{
											if(isset($url[3]))
											{
												switch ($url[3]) 
												{
													case '':
														require_once('vistas/user/logicas/orden_coach.php');
													break;

													case 'cancelar':
														if(isset($_POST))
														{
															$id_orden = $_POST['trabajo'];
															$resultado = $trabajos->cancelar_trabajo($id_orden);
															echo $resultado;
														}
														else
														{
															header('Location: ../');
														}
													break;
												}
											}
											else
											{
												require_once('vistas/user/logicas/orden_coach.php');
											}
										}
									break;
								}
							}
							else
							{
								require_once('vistas/user/logicas/mis_ordenes_coachs.php');
							}
						break;
						
						case 'buy_personal':
							require_once('vistas/user/logicas/buy_personal.php');
						break;

						case 'buy_team':
							require_once('vistas/user/logicas/buy_team.php');
						break;

						case 'kiphu':
							require_once('vistas/user/logicas/payment_kiphu.php');
						break;

						case ''.$url[1].'':
							$coach_user = $url[1];
							$id_coach = $usuarios->id_usuario($coach_user);
							if($id_coach[0]['tipo'] == 'coach')
							{
								$resultado = $usuarios->comprobar_datos_coach($id_coach[0]['id_usuario']);
								if($resultado == '')
								{
									header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros/coachs');
								}
								else
								{
									require_once('vistas/user/logicas/perfil_coach.php');
								}
							}
							else
							{
								header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros/coachs');
							}
						break;
					}
				}
				else
				{
					require_once('vistas/user/logicas/coachs.php');	
				}
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'coach')
	{
		if(isset($url[1]))
		{
			switch ($url[1]) 
			{
				case '':
					require_once('vistas/coach/logicas/lista_trabajos.php');
				break;
				
				case 'act_t':
					$id_trabajo = $_POST['trabajo'];
					$horas_restantes = $_POST['restantes'];
					$resultado = $trabajos->actualizar_trabajo($id_trabajo, $horas_restantes);
					echo $resultado;
				break;

				case 'tm_t':
					$id_trabajo = $_POST['trabajo'];
					$resultado = $trabajos->terminar_trabajo($id_trabajo);
					echo $resultado;
				break;

				case 'activos':
					require_once('vistas/coach/logicas/lista_trabajos_activos.php');
				break;

				case 'terminados':
					require_once('vistas/coach/logicas/lista_trabajos_terminados.php');
				break;

				case 'cancelados':
					require_once('vistas/coach/logicas/lista_trabajos_cancelados.php');
				break;

				case 'realizar_trabajo_accion':
					require_once('vistas/coach/logicas/realizar_trabajo_accion.php');
				break;

				case ''.$url[1].'':
					$resultado = $trabajos->comprobar_trabajo($url[1]);
					if($resultado[0]['id_coach'] == $_SESSION['id_usuario'])
					{
						if($resultado == '')
						{
							header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros/trabajos');
						}
						else
						{
							require_once('vistas/coach/logicas/ver_trabajo.php');
						}
					}
					else
					{
						header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros/trabajos');
					}
				break;
			}
		}
		else
		{
			require_once('vistas/coach/logicas/lista_trabajos.php');
		}	
	}
	elseif($_SESSION['tipo'] == 'coacher')
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros');
	}
	elseif($_SESSION['tipo'] == 'admin')
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros');
	}
}
else
{
	switch ($url[0]) 
	{
		case 'coachs':
			if(isset($url[1]))
			{
				switch ($url[1]) 
				{
					case '':
						require_once('vistas/desconectado/logicas/coachs.php');
					break;

					case ''.$url[1].'':
						$coach_user = $url[1];
						$id_coach = $usuarios->id_usuario($coach_user);
						if($id_coach[0]['tipo'] == 'coach')
						{
							$resultado = $usuarios->comprobar_datos_coach($id_coach[0]['id_usuario']);
							if($resultado == '')
							{
								header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros/coachs');
							}
							else
							{
								require_once('vistas/desconectado/logicas/perfil_coach.php');
							}
						}
						else
						{
							header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros/coachs');
						}
					break;
				}
			}
			else
			{
				require_once('vistas/desconectado/logicas/coachs.php');
			}
		break;
	}
}
?>