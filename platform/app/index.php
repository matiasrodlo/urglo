<?php
session_start();
header('Content-type: text/html; charset=utf-8');
define('BASE_PATH', '/app/');
define('RUTA_INDEX', 'http://' . $_SERVER['HTTP_HOST'] . BASE_PATH);
define('RUTA', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '/');
require_once(__DIR__ . '/funciones/funciones.php');
require_once(__DIR__ . '/modelos/bd.php');
require_once(__DIR__ . '/modelos/usuarios.php');
require_once(__DIR__ . '/modelos/pedidos.php');
require_once(__DIR__ . '/modelos/mensajes.php');

$usuarios = new Usuarios();
$pedidos = new Pedidos();
$mensajes = new Mensajes();

if(isset($_GET['url']))
{
	$url = explode("/", $_GET['url']);
}
else
{
	$url[0] = '';	
}
if(isset($_SESSION['usuario']))
	{
		switch ($url[0])
	{
		/* MODULO REGISTRO */
		case 'registro':
			header('Location: '.RUTA_INDEX);
		break;

		case 'agregar_usuario':
			header('Location: '.RUTA_INDEX);
		break;
		/* FIN REGISTRO */
		
		case 'login':
			header('Location: '.RUTA_INDEX);
		break;
		
		case 'contacto':
			header('Location: '.RUTA_INDEX);
		break;

		case 'conectar_usuario':
			header('Location: '.RUTA_INDEX);
		break;
	}

	if($_SESSION['tipo'] == 'user')
	{
		switch ($url[0]) 
		{
			case '':
				require_once('controladores/usuarios.php');
			break;

			case 'perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'kiphu':
				require_once('controladores/usuarios.php');
			break;

			case 'mercadopago':
				require_once('controladores/usuarios.php');
			break;

			case 'mercadopagochile':
				require_once('controladores/usuarios.php');
			break;

			case 'payuperu':
				require_once('controladores/usuarios.php');
			break;

			case 'payuchile':
				require_once('controladores/usuarios.php');
			break;

			case 'payucolombia':
				require_once('controladores/usuarios.php');
			break;

			case 'payumexico':
				require_once('controladores/usuarios.php');
			break;

			case 'mensajes':
				require_once('controladores/mensajes.php');
			break;

			case 'editar_personal_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'editar_password_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'img_perfil':
				require_once('controladores/usuarios.php');
			break;


			case 'coach_purchase':
				require_once('controladores/pedidos.php');						
			break;

			case 'coachs':
				require_once('controladores/trabajos.php');
			break;

			case 'conversacion':
				require_once('controladores/mensajes.php');
			break;

			case 'sendMessage':
				require_once('controladores/mensajes.php');
			break;

			case 'calificar_coach':
				require_once('controladores/trabajos.php');
			break;

			case 'pago_efectivo':
				require_once('controladores/usuarios.php');
			break;

			case 'cerrar_sesion':
				require_once('controladores/usuarios.php');
			break;

			case 'coaching':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once(__DIR__ . '/vistas/user/logicas/coaching.php');
						break;

						case 'mis_ordenes':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once(__DIR__ . '/vistas/user/logicas/mis_ordenes_coaching.php');
									break;
									
									case 'actualizar_servicio':
										$id_pedido = $_POST['trabajo'];
										$estado = $_POST['us'];
										if($estado == '0')
										{
											$estado = '1';
										}
										elseif($estado == '1')
										{
											$estado = '0';
										}
										$resultado = $pedidos->user_actualiza_pedido($id_pedido, $estado);
										echo $resultado;
									break;

									case ''.$url[2].'':
										if(isset($url[3]))
										{
											if($url[3] == 'cancelar')
											{
												if(isset($_POST))
												{
													$id_pedido = $_POST['trabajo'];
													$id_usuario = $_SESSION['id_usuario'];
													$resultado = $pedidos->cancelar_pedido($id_pedido, $id_usuario);
													echo $resultado;
												}
												else
												{
													header('Location: ../');
												}
											}
											else
											{
												header('Location: ../');
											}
										}
										else
										{
											require_once(__DIR__ . '/vistas/user/logicas/orden_coaching.php');	
										}
									break;	
								}
							}
							else
							{
								require_once(__DIR__ . '/vistas/user/logicas/mis_ordenes_coaching.php');
							}
						break;
					}		
				}
				else
				{
					require_once(__DIR__ . '/vistas/user/logicas/coaching.php');
				}
			break;

			case ''.$url[0].'':
				//url con id codificada con sha 1
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'coach')
	{
		switch ($url[0]) 
		{
			case '':
				require_once('controladores/usuarios.php');
			break;

			case 'perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'miperfil':
				require_once('controladores/usuarios.php');
			break;

			case 'editar_miperfil':
				require_once('controladores/usuarios.php');
			break;	

			case 'editarmiperfil_coach_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'miperfil_coach_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'editarmiperfil_coach_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'trabajos':
				require_once('controladores/trabajos.php');
			break;

			case 'realizar_trabajo_accion':
				require_once('controladores/trabajos.php');
			break;

			case 'editar_personal_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'editar_password_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'mensajes':
				require_once('controladores/mensajes.php');
			break;

			case 'coachs':
				require_once('controladores/usuarios.php');
			break;

			case 'conversacion':
				require_once('controladores/mensajes.php');
			break;

			case 'sendMessage':
				require_once('controladores/mensajes.php');
			break;

			case 'img_perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'cerrar_sesion':
				require_once('controladores/usuarios.php');
			break;

			case 'coach':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case 'pedidos_libres':
							if(isset($url[2]))
							{
								require_once(__DIR__ . '/vistas/coach/logicas/ver_pedido.php');
							}
							else
							{
								require_once(__DIR__ . '/vistas/coach/logicas/lista_pedidos_libres.php');
							}
						break;

						case 'pedidos_desocupados':
							if(isset($url[2]))
							{
								require_once(__DIR__ . '/vistas/coach/logicas/ver_pedido.php');
							}
							else
							{
								require_once(__DIR__ . '/vistas/coach/logicas/lista_pedidos_desocupados.php');
							}
						break;

						case 'pedidos_activos':
							if(isset($url[2]))
							{
								require_once(__DIR__ . '/vistas/coach/logicas/ver_pedido.php');
							}
							else
							{
								require_once(__DIR__ . '/vistas/coach/logicas/lista_pedidos_activos.php');
							}
						break;

						case 'pedidos_terminados':
							if(isset($url[2]))
							{
								require_once(__DIR__ . '/vistas/coach/logicas/ver_pedido.php');
							}
							else
							{
								require_once(__DIR__ . '/vistas/coach/logicas/lista_pedidos_terminados.php');
							}
						break;

						case 'pedidos_cancelados':
							if(isset($url[2]))
							{
								require_once(__DIR__ . '/vistas/coach/logicas/ver_pedido.php');
							}
							else
							{
								require_once(__DIR__ . '/vistas/coach/logicas/lista_pedidos_cancelados.php');
							}
						break;
					}
				}
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
				require_once('controladores/usuarios.php');
			break;

			case 'perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'mensajes':
				require_once('controladores/mensajes.php');
			break;
			
			case 'editar_personal_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'editar_password_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'img_perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'usuarios':
				require_once('controladores/usuarios.php');
			break;

			case 'coachs':
				require_once('controladores/usuarios.php');
			break;

			case 'trabajos':
				require_once('controladores/trabajos.php');
			break;

			case 'enviar_email_coaches':
				require_once('controladores/usuarios.php');
			break;

			case 'cerrar_sesion':
				require_once('controladores/usuarios.php');
			break;

			case 'activar_pedido':
				$id_pedido = $_POST['pedido'];
				$precio_coach = $_POST['precio_coach'];
				$resultado = $pedidos->activar_pedido($id_pedido, $precio_coach);
				echo $resultado;
			break;

			case 'actualizar_pedido':
				$id_pedido = $_POST['pedido'];
				$precio_coach = $_POST['precio_coach'];
				$resultado = $pedidos->actualizar_pedido($id_pedido, $precio_coach);
				echo $resultado;
			break;

		case 'coach':
			if(isset($url[1]))
			{
				switch ($url[1]) 
				{
					case 'pedidos_libres':
						if(isset($url[2]))
						{
							require_once(__DIR__ . '/vistas/coach/logicas/ver_pedido.php');
						}
						else
						{
							require_once(__DIR__ . '/vistas/coach/logicas/lista_pedidos_libres.php');
						}
					break;

					case 'pedidos_desocupados':
						if(isset($url[2]))
						{
							require_once(__DIR__ . '/vistas/coach/logicas/ver_pedido.php');
						}
						else
						{
							require_once(__DIR__ . '/vistas/coach/logicas/lista_pedidos_desocupados.php');
						}
					break;

					case 'pedidos_activos':
						if(isset($url[2]))
						{
							require_once(__DIR__ . '/vistas/coach/logicas/ver_pedido.php');
						}
						else
						{
							require_once(__DIR__ . '/vistas/coach/logicas/lista_pedidos_activos.php');
						}
					break;

					case 'pedidos_terminados':
						if(isset($url[2]))
						{
							require_once(__DIR__ . '/vistas/coach/logicas/ver_pedido.php');
						}
						else
						{
							require_once(__DIR__ . '/vistas/coach/logicas/lista_pedidos_terminados.php');
						}
					break;

					case 'pedidos_cancelados':
						if(isset($url[2]))
						{
							require_once(__DIR__ . '/vistas/coach/logicas/ver_pedido.php');
						}
						else
						{
							require_once(__DIR__ . '/vistas/coach/logicas/lista_pedidos_cancelados.php');
						}
					break;
				}
			}
		break;
		}
	}
}
else
{
	switch ($url[0]) 
	{
		case '':
			header('Location: '.RUTA_INDEX.'login');
		break;
		
		case 'cerrar_sesion':
			header('Location: /');
			exit;
		break;
		
		/* MODULO REGISTRO */
		case 'registro':
			require_once('controladores/usuarios.php');
		break;

		case 'agregar_usuario':
			require_once('controladores/usuarios.php');
		break;
		/* FIN REGISTRO */
		
		case 'login':
			require_once('controladores/usuarios.php');
		break;
		
		case 'contacto':
			require_once('controladores/usuarios.php');
		break;


		case 'coachs':
			require_once('controladores/trabajos.php');
		break;

		case 'conectar_usuario':
			require_once('controladores/usuarios.php');
		break;
	}
}
?>