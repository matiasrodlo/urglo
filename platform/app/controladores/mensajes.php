<?php
require_once(__DIR__ . '/../funciones/funciones.php');
require_once(__DIR__ . '/../modelos/bd.php');
require_once(__DIR__ . '/../modelos/usuarios.php');
require_once(__DIR__ . '/../modelos/mensajes.php');

$usuarios = new Usuarios();
$mensajes = new Mensajes();

if (isset($_SESSION['usuario'])) 
{
	if($_SESSION['tipo'] == 'user')
	{
		switch ($url[0]) 
		{
			case 'mensajes':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once(__DIR__ . '/../vistas/user/logicas/mensajes.php');
						break;

						case 'bandeja_entrada':
							require_once(__DIR__ . '/../vistas/user/logicas/mensajes.php');
						break;

						case 'bandeja_salida':
							require_once(__DIR__ . '/../vistas/user/logicas/mensajes_bandeja_salida.php');
						break;

						case 'enviar':
							require_once(__DIR__ . '/../vistas/user/logicas/enviar_mensaje.php');
						break;

						case 'enviar_mensaje_accion':
							require_once(__DIR__ . '/../vistas/user/logicas/enviar_mensaje_accion.php');
						break;

						case 'responder_mensaje_accion':
							require_once(__DIR__ . '/../vistas/user/logicas/responder_mensaje_accion.php');
						break;

						case 'conversacion':
							$id_usuario = $_POST['id_user'];
							$id_receptor = $_POST['receptor'];
							$id_trabajo = $_POST['trabajo'];
							$coach = $usuarios->datos_usuario($id_receptor);
							$chat = $mensajes->conversacion($id_trabajo);
							if($chat == false)
							{
								echo '<center>No hay ningún mensaje con '.$coach[0]['usuario'].'</center>';
							}
							else
							{ 
								$mensajes_chat = $mensajes->mensajes_chat($chat[0]['id_conversacion']);
								$lista_mensajes = '';
								if($mensajes_chat == true)
								{
									echo '<input type="hidden" id="chatboxconv" value="'.$mensajes_chat[0]['id_conversacion'].'"/>';
									for($i=0;$i<count($mensajes_chat);$i++)
									{	
										//print_r($mensajes_chat);
										$datos_usuario_envia = $usuarios->datos_usuario($mensajes_chat[$i]['id_user_envia']);
										$datos_personal_envia = $usuarios->datos_user_personal($mensajes_chat[$i]['id_user_envia']);
										//print_r($datos_usuario_envia);
										//print_r($mensajes_chat);
										$lista_mensajes.='
											<div class="message-user">
								            	<img src="'.RUTA_INDEX.'images/user/'.$datos_personal_envia[0]['img_perfil'].'" width="32px" height="32px">
								            	<div class="chatMessage">
								            		<div class="user">'.$datos_usuario_envia[0]['usuario'].'</div>
								            		<div class="text">
								            			<p>'.$mensajes_chat[$i]['mensaje'].'</p>
								            		</div>
								            	</div>
								            	<div class="hora">'.substr($mensajes_chat[$i]['hora_envio'], 0, -3).'</div>
								            </div>
										';
									}
									echo $lista_mensajes;	
								}
								else
								{
									echo '<center>No hay ningún mensaje con '.$coach[0]['usuario'].'</center>';
								}
							}	
						break;

						case 'sendMessage':
							$mensaje = $_POST['message'];
							$id_conversacion = $_POST['id_conver'];
							$id_trabajo = $_POST['trabajo'];
							$id_receptor = $_POST['receptor'];
							$id_envia = $_SESSION['id_usuario'];
							$resultado = $mensajes->enviar_msj_chat($id_conversacion, $id_trabajo, $mensaje, $id_envia, $id_receptor);
							echo $resultado;
						break;

						case 'conversacion_coaching':
							$id_usuario = $_POST['id_user'];
							$id_receptor = $_POST['receptor'];
							$id_trabajo = $_POST['trabajo'];
							$coach_data = $usuarios->datos_usuario($id_receptor);
							$chat = $mensajes->conversacion_coaching($id_trabajo);
							if($chat == false)
							{
								echo '<center>No hay ningún mensaje con '.$coach_data[0]['usuario'].'</center>';
							}
							else
							{ 
								$mensajes_chat = $mensajes->mensajes_chat_coaching($chat[0]['id_conversacion']);
								$lista_mensajes = '';
								if($mensajes_chat == true)
								{
									echo '<input type="hidden" id="chatboxconv" value="'.$mensajes_chat[0]['id_conversacion'].'"/>';
									for($i=0;$i<count($mensajes_chat);$i++)
									{	
										$datos_usuario_envia = $usuarios->datos_usuario($mensajes_chat[$i]['id_user_envia']);
										$datos_personal_envia = $usuarios->datos_user_personal($mensajes_chat[$i]['id_user_envia']);

										$lista_mensajes.='
											<div class="message-user">
								            	<img src="'.RUTA_INDEX.'images/user/'.$datos_personal_envia[0]['img_perfil'].'" width="32px" height="32px">
								            	<div class="chatMessage">
								            		<div class="user">'.$datos_usuario_envia[0]['usuario'].'</div>
								            		<div class="text">
								            			<p>'.$mensajes_chat[$i]['mensaje'].'</p>
								            		</div>
								            	</div>
								            	<div class="hora">'.substr($mensajes_chat[$i]['hora_envio'], 0, -3).'</div>
								            </div>
										';
									}
									echo $lista_mensajes;	
								}
								else
								{
									echo '<center>No hay ningún mensaje con '.$coach_data[0]['usuario'].'</center>';
								}
							}	
						break;

						case 'sendMessage_coaching':
							$mensaje = $_POST['message'];
							$id_conversacion = $_POST['id_conver'];
							$id_trabajo = $_POST['trabajo'];
							$id_receptor = $_POST['receptor'];
							$id_envia = $_SESSION['id_usuario'];
							$resultado = $mensajes->enviar_msj_chat_coaching($id_conversacion, $id_trabajo, $mensaje, $id_envia, $id_receptor);
							echo $resultado;
						break;

						case ''.$url[1].'':
							$id_mensaje = $url[1];
							$id_receptor = $_SESSION['id_usuario'];
							$resultado = $mensajes->ver_mensaje($id_mensaje, $id_receptor);
							if($resultado == false)
							{
								$resultado = $mensajes->ver_mensaje_rem($id_mensaje, $id_receptor);
								if($resultado == false)
								{
									header('Location: '.RUTA_INDEX.'mensajes');
								}
								else
								{
									require_once(__DIR__ . '/../vistas/user/logicas/ver_mensaje.php');
								}
							}
							else
							{
								require_once(__DIR__ . '/../vistas/user/logicas/ver_mensaje.php');
							}
						break;
					}
				}
				else
				{
					require_once(__DIR__ . '/../vistas/user/logicas/mensajes.php');
				}
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'coach')
	{	
		switch ($url[0]) 
		{
			case 'mensajes':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once(__DIR__ . '/../vistas/coach/logicas/mensajes.php');
						break;

						case 'bandeja_entrada':
							require_once(__DIR__ . '/../vistas/coach/logicas/mensajes.php');
						break;

						case 'bandeja_salida':
							require_once(__DIR__ . '/../vistas/coach/logicas/mensajes_bandeja_salida.php');
						break;

						case 'enviar':
							require_once(__DIR__ . '/../vistas/coach/logicas/enviar_mensaje.php');
						break;

						case 'enviar_mensaje_accion':
							require_once(__DIR__ . '/../vistas/coach/logicas/enviar_mensaje_accion.php');
						break;

						case 'responder_mensaje_accion':
							require_once(__DIR__ . '/../vistas/coach/logicas/responder_mensaje_accion.php');
						break;

						case 'conversacion':
							$id_usuario = $_POST['id_user'];
							$id_coach = $_POST['id_coach'];
							$id_trabajo = $_POST['trabajo'];

							$cliente = $usuarios->datos_usuario($id_usuario);
							$chat = $mensajes->conversacion($id_trabajo);
							if($chat == false)
							{
								echo '<center>No hay ningún mensaje con '.$cliente[0]['usuario'].'</center>';
							}
							else
							{
								$mensajes_chat = $mensajes->mensajes_chat($chat[0]['id_conversacion']);
								$lista_mensajes = '';
								if($mensajes_chat == true)
								{
									echo '<input type="hidden" id="chatboxconv" value="'.$mensajes_chat[0]['id_conversacion'].'"/>';
									for($i=0;$i<count($mensajes_chat);$i++)
									{	
										$datos_usuario_envia = $usuarios->datos_usuario($mensajes_chat[$i]['id_user_envia']);
										$datos_personal_envia = $usuarios->datos_user_personal($mensajes_chat[$i]['id_user_envia']);
										$lista_mensajes.='
											<div class="message-user">
								            	<img src="'.RUTA_INDEX.'images/user/'.$datos_personal_envia[0]['img_perfil'].'" width="32px" height="32px">
								            	<div class="chatMessage">
								            		<div class="user">'.$datos_usuario_envia[0]['usuario'].'</div>
								            		<div class="text">
								            			<p>'.$mensajes_chat[$i]['mensaje'].'</p>
								            		</div>
								            	</div>
								            	<div class="hora">'.substr($mensajes_chat[$i]['hora_envio'], 0, -3).'</div>
								            </div>
										';
									}
									echo $lista_mensajes;	
								}
								else
								{
									echo '<center>No hay ningún mensaje con '.$cliente[0]['usuario'].'</center>';
								}
							}	
						break;

						case 'sendMessage':
							$mensaje = $_POST['message'];
							$id_conversacion = $_POST['id_conver'];
							$id_trabajo = $_POST['trabajo'];
							$id_cliente = $_POST['id_user'];
							$id_envia = $_SESSION['id_usuario'];
							$resultado = $mensajes->enviar_msj_chat($id_conversacion, $id_trabajo, $mensaje, $id_envia, $id_cliente);
							echo $resultado;
						break;

						case ''.$url[1].'':
							$id_mensaje = $url[1];
							$id_receptor = $_SESSION['id_usuario'];
							$resultado = $mensajes->ver_mensaje($id_mensaje, $id_receptor);
							if($resultado == false)
							{
								$resultado = $mensajes->ver_mensaje_rem($id_mensaje, $id_receptor);
								if($resultado == false)
								{
									header('Location: '.RUTA_INDEX.'mensajes');
								}
								else
								{
									require_once(__DIR__ . '/../vistas/coach/logicas/ver_mensaje.php');
								}
							}
							else
							{
								require_once(__DIR__ . '/../vistas/coach/logicas/ver_mensaje.php');
							}
						break;
					}
				}
				else
				{
					require_once(__DIR__ . '/../vistas/coach/logicas/mensajes.php');
				}	
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'coach')
	{
		switch ($url[0]) 
		{
			case 'mensajes':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once(__DIR__ . '/../vistas/coach/logicas/mensajes.php');
						break;

						case 'bandeja_entrada':
							require_once(__DIR__ . '/../vistas/coach/logicas/mensajes.php');
						break;

						case 'bandeja_salida':
							require_once(__DIR__ . '/../vistas/coach/logicas/mensajes_bandeja_salida.php');
						break;

						case 'enviar':
							require_once(__DIR__ . '/../vistas/coach/logicas/enviar_mensaje.php');
						break;

						case 'enviar_mensaje_accion':
							require_once(__DIR__ . '/../vistas/coach/logicas/enviar_mensaje_accion.php');
						break;

						case 'responder_mensaje_accion':
							require_once(__DIR__ . '/../vistas/coach/logicas/responder_mensaje_accion.php');
						break;

						case 'conversacion':
							$id_usuario = $_POST['id_user'];
							$id_receptor = $_POST['receptor'];
							$id_trabajo = $_POST['trabajo'];
							$user = $usuarios->datos_usuario($id_receptor);
							$chat = $mensajes->conversacion_coaching($id_trabajo);
							if($chat == false)
							{
								echo '<center>No hay ningún mensaje con '.$user[0]['usuario'].'</center>';
							}
							else
							{ 
								$mensajes_chat = $mensajes->mensajes_chat_coaching($chat[0]['id_conversacion']);
								$lista_mensajes = '';
								if($mensajes_chat == true)
								{
									echo '<input type="hidden" id="chatboxconv" value="'.$mensajes_chat[0]['id_conversacion'].'"/>';
									for($i=0;$i<count($mensajes_chat);$i++)
									{	
										$datos_usuario_envia = $usuarios->datos_usuario($mensajes_chat[$i]['id_user_envia']);
										$datos_personal_envia = $usuarios->datos_user_personal($mensajes_chat[$i]['id_user_envia']);

										$lista_mensajes.='
											<div class="message-user">
								            	<img src="'.RUTA_INDEX.'images/user/'.$datos_personal_envia[0]['img_perfil'].'" width="32px" height="32px">
								            	<div class="chatMessage">
								            		<div class="user">'.$datos_usuario_envia[0]['usuario'].'</div>
								            		<div class="text">
								            			<p>'.$mensajes_chat[$i]['mensaje'].'</p>
								            		</div>
								            	</div>
								            	<div class="hora">'.substr($mensajes_chat[$i]['hora_envio'], 0, -3).'</div>
								            </div>
										';
									}
									echo $lista_mensajes;	
								}
								else
								{
									echo '<center>No hay ningún mensaje con '.$user[0]['usuario'].'</center>';
								}
							}	
						break;

						case 'sendMessage':
							$mensaje = $_POST['message'];
							$id_conversacion = $_POST['id_conver'];
							$id_trabajo = $_POST['trabajo'];
							$id_receptor = $_POST['receptor'];
							$id_envia = $_SESSION['id_usuario'];
							$resultado = $mensajes->enviar_msj_chat_coaching($id_conversacion, $id_trabajo, $mensaje, $id_envia, $id_receptor);
							echo $resultado;
						break;
						
						case ''.$url[1].'':
							$id_mensaje = $url[1];
							$id_receptor = $_SESSION['id_usuario'];
								
							$resultado = $mensajes->ver_mensaje($id_mensaje, $id_receptor);
							if($resultado == false)
							{
								$resultado = $mensajes->ver_mensaje_rem($id_mensaje, $id_receptor);
								if($resultado == false)
								{
									header('Location: '.RUTA_INDEX.'mensajes');
								}
								else
								{
									require_once(__DIR__ . '/../vistas/coach/logicas/ver_mensaje.php');
								}
							}
							else
							{
								require_once(__DIR__ . '/../vistas/coach/logicas/ver_mensaje.php');
							}
						break;
					}
				}
				else
				{
					require_once(__DIR__ . '/../vistas/coach/logicas/mensajes.php');
				}	
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'admin')
	{
		switch ($url[0]) 
		{
			case 'mensajes':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once(__DIR__ . '/../vistas/admin/logicas/mensajes.php');
						break;

						case 'bandeja_entrada':
							require_once(__DIR__ . '/../vistas/admin/logicas/mensajes.php');
						break;

						case 'bandeja_salida':
							require_once(__DIR__ . '/../vistas/admin/logicas/mensajes_bandeja_salida.php');
						break;

						case 'enviar':
							require_once(__DIR__ . '/../vistas/admin/logicas/enviar_mensaje.php');
						break;

						case 'enviar_mensaje_accion':
							require_once(__DIR__ . '/../vistas/admin/logicas/enviar_mensaje_accion.php');
						break;

						case 'responder_mensaje_accion':
							require_once(__DIR__ . '/../vistas/admin/logicas/responder_mensaje_accion.php');
						break;

						case 'conversacion':
							$id_usuario = $_POST['id_user'];
							$id_coach = $_POST['id_coach'];
							$id_trabajo = $_POST['trabajo'];

							$cliente = $usuarios->datos_usuario($id_usuario);
							$coach = $usuarios->datos_usuario($id_coach);
							$chat = $mensajes->conversacion($id_trabajo);
							if($chat == false)
							{
								echo '<center>No hay ningún mensaje entre el usuario '.$cliente[0]['usuario'].' y el coach '.$coach[0]['usuario'].'</center>';
							}
							else
							{
								$mensajes_chat = $mensajes->mensajes_chat($chat[0]['id_conversacion']);
								$lista_mensajes = '';
								if($mensajes_chat == true)
								{
									echo '<input type="hidden" id="chatboxconv" value="'.$mensajes_chat[0]['id_conversacion'].'"/>';
									for($i=0;$i<count($mensajes_chat);$i++)
									{	
										$datos_usuario_envia = $usuarios->datos_usuario($mensajes_chat[$i]['id_user_envia']);
										$datos_personal_envia = $usuarios->datos_user_personal($mensajes_chat[$i]['id_user_envia']);

										$lista_mensajes.='
											<div class="message-user">
								            	<img src="'.RUTA_INDEX.'images/user/'.$datos_personal_envia[0]['img_perfil'].'" width="32px" height="32px">
								            	<div class="chatMessage">
								            		<div class="user">'.$datos_usuario_envia[0]['usuario'].'</div>
								            		<div class="text">
								            			<p>'.$mensajes_chat[$i]['mensaje'].'</p>
								            		</div>
								            	</div>
								            	<div class="hora">'.substr($mensajes_chat[$i]['hora_envio'], 0, -3).'</div>
								            </div>
										';
									}
									echo $lista_mensajes;	
								}
								else
								{
									echo '<center>No hay ningún mensaje entre el usuario '.$cliente[0]['usuario'].' y el coach '.$coach[0]['usuario'].'</center>';
								}
							}	
						break;

						case 'sendMessage':
							$mensaje = $_POST['message'];
							$id_conversacion = $_POST['id_conver'];
							$id_trabajo = $_POST['trabajo'];
							$id_coach = $_POST['id_coach'];
							$id_envia = $_SESSION['id_usuario'];
							$resultado = $mensajes->enviar_msj_chat($id_conversacion, $id_trabajo, $mensaje, $id_envia, $id_coach);
							echo $resultado;
						break;

						case 'conversacion_coaching':
							$id_usuario = $_POST['id_user'];
							$id_receptor = $_POST['receptor'];
							$id_trabajo = $_POST['trabajo'];

							$user = $usuarios->datos_usuario($id_usuario);

							$coach_data = $usuarios->datos_usuario($id_receptor);
							$chat = $mensajes->conversacion_coaching($id_trabajo);
							if($chat == false)
							{
								echo '<center>No hay ningún mensaje entre el usuario '.$user[0]['usuario'].' y el coach '.$coach_data[0]['usuario'].'</center>';
							}
							else
							{ 
								$mensajes_chat = $mensajes->mensajes_chat_coaching($chat[0]['id_conversacion']);
								$lista_mensajes = '';
								if($mensajes_chat == true)
								{
									echo '<input type="hidden" id="chatboxconv" value="'.$mensajes_chat[0]['id_conversacion'].'"/>';
									for($i=0;$i<count($mensajes_chat);$i++)
									{	
										$datos_usuario_envia = $usuarios->datos_usuario($mensajes_chat[$i]['id_user_envia']);
										$datos_personal_envia = $usuarios->datos_user_personal($mensajes_chat[$i]['id_user_envia']);

										$lista_mensajes.='
											<div class="message-user">
								            	<img src="'.RUTA_INDEX.'images/user/'.$datos_personal_envia[0]['img_perfil'].'" width="32px" height="32px">
								            	<div class="chatMessage">
								            		<div class="user">'.$datos_usuario_envia[0]['usuario'].'</div>
								            		<div class="text">
								            			<p>'.$mensajes_chat[$i]['mensaje'].'</p>
								            		</div>
								            	</div>
								            	<div class="hora">'.substr($mensajes_chat[$i]['hora_envio'], 0, -3).'</div>
								            </div>
										';
									}
									echo $lista_mensajes;	
								}
								else
								{
									echo '<center>No hay ningún mensaje entre el usuario '.$user[0]['usuario'].' y el coach '.$coach_data[0]['usuario'].'</center>';
								}
							}	
						break;

						case 'sendMessage_coaching':
							$mensaje = $_POST['message'];
							$id_conversacion = $_POST['id_conver'];
							$id_trabajo = $_POST['trabajo'];
							$id_receptor = $_POST['receptor'];
							$id_envia = $_SESSION['id_usuario'];
							$resultado = $mensajes->enviar_msj_chat_coaching($id_conversacion, $id_trabajo, $mensaje, $id_envia, $id_receptor);
							echo $resultado;
						break;

						case ''.$url[1].'':
							$id_mensaje = $url[1];
							$id_receptor = $_SESSION['id_usuario'];
							$resultado = $mensajes->ver_mensaje($id_mensaje, $id_receptor);
							if($resultado == false)
							{
								$resultado = $mensajes->ver_mensaje_rem($id_mensaje, $id_receptor);
								if($resultado == false)
								{
									header('Location: '.RUTA_INDEX.'mensajes');
								}
								else
								{
									require_once(__DIR__ . '/../vistas/admin/logicas/ver_mensaje.php');
								}
							}
							else
							{
								require_once(__DIR__ . '/../vistas/admin/logicas/ver_mensaje.php');
							}
						break;
					}
				}
				else
				{
					require_once(__DIR__ . '/../vistas/admin/logicas/mensajes.php');
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
			header('Location: '.RUTA_INDEX);
		break;
	}
}
?>
