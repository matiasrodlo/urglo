<?php
class Pedidos extends Conexion {
	public function comprobar_pedido($id_pedido, $estado)
	{
		$this->codigosql = "SELECT * FROM pedidos_boosting WHERE id_pedido='$id_pedido'";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			$tipo_pedido = $this->resultado[0]['tipo_pedido'];
			if($tipo_pedido == '1')
			{
				$this->codigosql = "SELECT * FROM pedidos_gl WHERE id_pedido='$id_pedido' and estado='$estado'";
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
			elseif($tipo_pedido == '2')
			{
				$this->codigosql = "SELECT * FROM pedidos_dqb WHERE id_pedido='$id_pedido' and estado='$estado'";
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
			elseif($tipo_pedido == '3')
			{
				$this->codigosql = "SELECT * FROM pedidos_pg WHERE id_pedido='$id_pedido' and estado='$estado'";
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
			elseif($tipo_pedido == '4')
			{
				$this->codigosql = "SELECT * FROM pedidos_ul WHERE id_pedido='$id_pedido' and estado='$estado'";
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
			elseif($tipo_pedido == '5')
			{
				$this->codigosql = "SELECT * FROM pedidos_win WHERE id_pedido='$id_pedido' and estado='$estado'";
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
		else
		{
			return false;
		}
	}
	public function activar_pedido($id_pedido, $precio_elo)
	{
		$this->comprobar_pedido($id_pedido, '1');
		if($this->resultado == '')
		{
			echo 'Este pedido no puede ser activado. Porque no existe, o porque ya fue activado anteriormente.';
		}
		else
		{
			$id_usuario = $this->resultado[0]['id_usuario'];
			$tipo_pedido = $this->resultado[0]['tipo_pedido'];
			if($tipo_pedido == '1')
			{
				$this->codigosql = "UPDATE pedidos_gl SET estado='5', precio_elo='$precio_elo' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				$this->conectar_db();
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");

						$contenido = 'Hemos procesado de manera correcta tu pedido, este se ha integrado a nuestra cola de pedidos libres en la cual a la brevedad te será asignado un jugador. 

El tiempo de espera de este proceso es relativo y dependerá del número de pedidos que actualmente tengamos en nuestra cola de espera. De todas formas, no te preocupes, antes de 24 horas estaremos trabajando en tu cuenta..';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'El Pedido ha sido validado - En breve comenzamos', '$contenido', '$id_usuario', '1', '$fecha', '$hora', '0')";

						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				
				if($this->consulta)
				{
					echo 'El pedido fue activado, y sumado a la lista de Pedidos Desocupados.';
				}
				else
				{
					echo 'Hubo un error en activar el pedido, por favor intentelo nuevamente.2';
				}
			}
			elseif($tipo_pedido == '2')
			{
				$this->codigosql = "UPDATE pedidos_dqb SET estado='5', precio_elo='$precio_elo' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				$this->conectar_db();
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");

						$contenido = 'Hemos procesado de manera correcta tu pedido, este se ha integrado a nuestra cola de pedidos libres en la cual a la brevedad te será asignado un jugador. 

El tiempo de espera de este proceso es relativo y dependerá del número de pedidos que actualmente tengamos en nuestra cola de espera. De todas formas, no te preocupes, antes de 24 horas estaremos trabajando en tu cuenta..';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'El Pedido ha sido validado - En breve comenzamos', '$contenido', '$id_usuario', '1', '$fecha', '$hora', '0')";

						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				
				if($this->consulta)
				{
					echo 'El pedido fue activado, y sumado a la lista de Pedidos Desocupados.';
				}
				else
				{
					echo 'Hubo un error en activar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '3')
			{
				$this->codigosql = "UPDATE pedidos_pg SET estado='5', precio_elo='$precio_elo' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				$this->conectar_db();
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");

						$contenido = 'Hemos procesado de manera correcta tu pedido, este se ha integrado a nuestra cola de pedidos libres en la cual a la brevedad te será asignado un jugador. 

El tiempo de espera de este proceso es relativo y dependerá del número de pedidos que actualmente tengamos en nuestra cola de espera. De todas formas, no te preocupes, antes de 24 horas estaremos trabajando en tu cuenta..';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'El Pedido ha sido validado - En breve comenzamos', '$contenido', '$id_usuario', '1', '$fecha', '$hora', '0')";

						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				
				if($this->consulta)
				{
					echo 'El pedido fue activado, y sumado a la lista de Pedidos Desocupados.';
				}
				else
				{
					echo 'Hubo un error en activar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '4')
			{
				$this->codigosql = "UPDATE pedidos_ul SET estado='5', precio_elo='$precio_elo' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				$this->conectar_db();
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");

						$contenido = 'Hemos procesado de manera correcta tu pedido, este se ha integrado a nuestra cola de pedidos libres en la cual a la brevedad te será asignado un jugador. 

El tiempo de espera de este proceso es relativo y dependerá del número de pedidos que actualmente tengamos en nuestra cola de espera. De todas formas, no te preocupes, antes de 24 horas estaremos trabajando en tu cuenta..';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'El Pedido ha sido validado - En breve comenzamos', '$contenido', '$id_usuario', '1', '$fecha', '$hora', '0')";

						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				
				if($this->consulta)
				{
					echo 'El pedido fue activado, y sumado a la lista de Pedidos Desocupados.';
				}
				else
				{
					echo 'Hubo un error en activar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '5')
			{
				$this->codigosql = "UPDATE pedidos_win SET estado='5', precio_elo='$precio_elo' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				$this->conectar_db();
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");

						$contenido = 'Hemos procesado de manera correcta tu pedido, este se ha integrado a nuestra cola de pedidos libres en la cual a la brevedad te será asignado un jugador. 

El tiempo de espera de este proceso es relativo y dependerá del número de pedidos que actualmente tengamos en nuestra cola de espera. De todas formas, no te preocupes, antes de 24 horas estaremos trabajando en tu cuenta..';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'El Pedido ha sido validado - En breve comenzamos', '$contenido', '$id_usuario', '1', '$fecha', '$hora', '0')";

						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				
				if($this->consulta)
				{
					echo 'El pedido fue activado, y sumado a la lista de Pedidos Desocupados.';
				}
				else
				{
					echo 'Hubo un error en activar el pedido, por favor intentelo nuevamente.';
				}
			}
		}
	}
	public function tomar_pedido($id_pedido, $id_elobooster)
	{
		$this->comprobar_pedido($id_pedido, '5');
		if($this->resultado == '')
		{
			echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
		}
		else
		{
			$tipo_pedido = $this->resultado[0]['tipo_pedido'];
			$id_usuario = $this->resultado[0]['id_usuario'];
			if($tipo_pedido == '1')
			{
				$this->conectar_db();
				$this->codigosql = "START TRANSACTION";
	 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				if($this->consulta)
				{
					$this->codigosql = "UPDATE pedidos_boosting SET id_elobooster='$id_elobooster' WHERE id_pedido='$id_pedido'";
					$consult = mysqli_query($this->conexion, $this->codigosql);
					if($consult)
					{
						$this->codigosql = "UPDATE pedidos_gl SET estado='2', id_elobooster='$id_elobooster' WHERE id_pedido='$id_pedido'";
						$consult = mysqli_query($this->conexion, $this->codigosql);;
						
						if($consult)
						{

						$this->codigosql = "SELECT usuario, tipo, pass FROM usuarios WHERE id_usuario='$id_usuario'";
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						while ($this->resultado[] = mysqli_fetch_array($this->consulta, MYSQLI_ASSOC));
 						$this->num_resultados = mysqli_num_rows($this->consulta);
						$cliente = $this->resultado[2]['usuario'];
							// SE MANDA UN MENSAJE COMPRUEBA SI FUE MANDADO Y SI ESTA TODO BIEN GO COMMIT SINO ROLLBACK
							$asunto = 'Hemos asignado uno de nuestros jugadores';
							$contenido = 'Hola @'.$cliente.', UrgloBot por aquí.</br></br>
Hemos asignado a tu pedido uno de nuestros jugadores el cual comenzara a trabajar en tu cuenta a la brevedad, a partir de ahora puedes comunicarte con él desde el perfil de tu pedido. Ten presente que posiblemente el jugar partidas normales alteren nuestros tiempos de entrega. </br></br>
Si deseas jugar partidas normales, recuerda pausar el servicio desde el perfil de tu pedido y una vez termines de jugar reanudar el servicio, de modo que podamos seguir trabajando en tu cuenta.</br></br>
Cabe comentar que está prohibido solicitar a nuestro jugador cualquier tipo de información de contacto externa. En el caso de sorprender comunicación sospechosa esto significara la cancelación del pedido. 
';
							// El que recibe el mensaje es el cliente, el que lo envia el elobooster
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");
							$id_remitente = 1; // El mensaje lo envia el admin
							$this->codigosql = "INSERT INTO mensajes VALUES (null, '$asunto', '$contenido', '$id_usuario', '$id_remitente', '$fecha', '$hora', '0')";
							$consult = mysqli_query($this->conexion, $this->codigosql);;
							if($consult)
							{
								$this->codigosql = 'commit;';
								$this->consulta = mysqli_query($this->conexion, $this->codigosql);
								$this->desconectar_db();
								echo 'El pedido fue tomado correctamente. Ya puedes empezar a trabajar con el.';
							}
							else
							{
								$this->codigosql = 'rollback;';
								$this->consulta = mysqli_query($this->conexion, $this->codigosql);
								$this->desconectar_db();
								echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
							}
						}
						else
						{
							$this->codigosql = 'rollback;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
						}
					}
					else
					{
						$this->codigosql = 'rollback;';
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						$this->desconectar_db();
						echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '2')
			{
				$this->conectar_db();
				$this->codigosql = "START TRANSACTION";
	 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				if($this->consulta)
				{
					$this->codigosql = "UPDATE pedidos_boosting SET id_elobooster='$id_elobooster' WHERE id_pedido='$id_pedido'";
					$consult = mysqli_query($this->conexion, $this->codigosql);
					if($consult)
					{
						$this->codigosql = "UPDATE pedidos_dqb SET estado='2', id_elobooster='$id_elobooster' WHERE id_pedido='$id_pedido'";
						$consult = mysqli_query($this->conexion, $this->codigosql);
						if($consult)
						{
							// SE MANDA UN MENSAJE COMPRUEBA SI FUE MANDADO Y SI ESTA TODO BIEN GO COMMIT SINO ROLLBACK
							$asunto = 'El Pedido ha sido validado - En breve comenzamos';
							$contenido = 'Hemos procesado de manera correcta tu pedido, este se ha integrado a nuestra cola de pedidos libres en la cual en breve te asignaremos un jugador.
</br></br>
Según el número de pedidos que se encuentren en nuestra cola de espera dependerá el tiempo en que tarda tu cuenta en tener asignado un jugador. De todas formas, no te preocupes, antes de 24 horas estaremos trabajando en tu cuenta.';
							// El que recibe el mensaje es el cliente, el que lo envia el elobooster
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");
							$id_remitente = 1;
							$this->codigosql = "INSERT INTO mensajes VALUES (null, '$asunto', '$contenido', '$id_receptor', '$id_remitente', '$fecha', '$hora', '0')";
							$consult = mysqli_query($this->conexion, $this->codigosql);;
							if($consult)
							{
								$this->codigosql = 'commit;';
								$this->consulta = mysqli_query($this->conexion, $this->codigosql);
								$this->desconectar_db();
								echo 'El pedido fue tomado correctamente. Ya puedes empezar a trabajar con el.';
							}
							else
							{
								$this->codigosql = 'rollback;';
								$this->consulta = mysqli_query($this->conexion, $this->codigosql);
								$this->desconectar_db();
								echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
							}
						}
						else
						{
							$this->codigosql = 'rollback;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
						}
					}
					else
					{
						$this->codigosql = 'rollback;';
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						$this->desconectar_db();
						echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '3')
			{
				$this->conectar_db();
				$this->codigosql = "START TRANSACTION";
	 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				if($this->consulta)
				{
					$this->codigosql = "UPDATE pedidos_boosting SET id_elobooster='$id_elobooster' WHERE id_pedido='$id_pedido'";
					$consult = mysqli_query($this->conexion, $this->codigosql);
					if($consult)
					{
						$this->codigosql = "UPDATE pedidos_pg SET estado='2', id_elobooster='$id_elobooster' WHERE id_pedido='$id_pedido'";
						$consult = mysqli_query($this->conexion, $this->codigosql);
						
						if($consult)
						{
							// SE MANDA UN MENSAJE COMPRUEBA SI FUE MANDADO Y SI ESTA TODO BIEN GO COMMIT SINO ROLLBACK
							$asunto = 'El Pedido ha sido validado - En breve comenzamos';
							$contenido = 'Hemos procesado de manera correcta tu pedido, este se ha integrado a nuestra cola de pedidos libres en la cual en breve te asignaremos un jugador.
</br></br>
Según el número de pedidos que se encuentren en nuestra cola de espera dependerá el tiempo en que tarda tu cuenta en tener asignado un jugador. De todas formas, no te preocupes, antes de 24 horas estaremos trabajando en tu cuenta.';
							// El que recibe el mensaje es el cliente, el que lo envia el elobooster
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");
							$id_remitente = 1;
							$this->codigosql = "INSERT INTO mensajes VALUES (null, '$asunto', '$contenido', '$id_receptor', '$id_remitente', '$fecha', '$hora', '0')";
							$consult = mysqli_query($this->conexion, $this->codigosql);;
							if($consult)
							{
								$this->codigosql = 'commit;';
								$this->consulta = mysqli_query($this->conexion, $this->codigosql);
								$this->desconectar_db();
								echo 'El pedido fue tomado correctamente. Ya puedes empezar a trabajar con el.';
							}
							else
							{
								$this->codigosql = 'rollback;';
								$this->consulta = mysqli_query($this->conexion, $this->codigosql);
								$this->desconectar_db();
								echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
							}
						}
						else
						{
							$this->codigosql = 'rollback;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
						}
					}
					else
					{
						$this->codigosql = 'rollback;';
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						$this->desconectar_db();
						echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '4')
			{
				$this->conectar_db();
				$this->codigosql = "START TRANSACTION";
	 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				if($this->consulta)
				{
					$this->codigosql = "UPDATE pedidos_boosting SET id_elobooster='$id_elobooster' WHERE id_pedido='$id_pedido'";
					$consult = mysqli_query($this->conexion, $this->codigosql);
					if($consult)
					{
						$this->codigosql = "UPDATE pedidos_ul SET estado='2', id_elobooster='$id_elobooster' WHERE id_pedido='$id_pedido'";
						$consult = mysqli_query($this->conexion, $this->codigosql);
						
						if($consult)
						{
							// SE MANDA UN MENSAJE COMPRUEBA SI FUE MANDADO Y SI ESTA TODO BIEN GO COMMIT SINO ROLLBACK
							$asunto = 'El Pedido ha sido validado - En breve comenzamos';
							$contenido = 'Hemos procesado de manera correcta tu pedido, este se ha integrado a nuestra cola de pedidos libres en la cual en breve te asignaremos un jugador.
</br></br>
Según el número de pedidos que se encuentren en nuestra cola de espera dependerá el tiempo en que tarda tu cuenta en tener asignado un jugador. De todas formas, no te preocupes, antes de 24 horas estaremos trabajando en tu cuenta.';
							// El que recibe el mensaje es el cliente, el que lo envia el elobooster
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");
							$id_remitente = 1;
							$this->codigosql = "INSERT INTO mensajes VALUES (null, '$asunto', '$contenido', '$id_receptor', '$id_remitente', '$fecha', '$hora', '0')";
							$consult = mysqli_query($this->conexion, $this->codigosql);;
							if($consult)
							{
								$this->codigosql = 'commit;';
								$this->consulta = mysqli_query($this->conexion, $this->codigosql);
								$this->desconectar_db();
								echo 'El pedido fue tomado correctamente. Ya puedes empezar a trabajar con el.';
							}
							else
							{
								$this->codigosql = 'rollback;';
								$this->consulta = mysqli_query($this->conexion, $this->codigosql);
								$this->desconectar_db();
								echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
							}
						}
						else
						{
							$this->codigosql = 'rollback;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
						}
					}
					else
					{
						$this->codigosql = 'rollback;';
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						$this->desconectar_db();
						echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '5')
			{
				$this->conectar_db();
				$this->codigosql = "START TRANSACTION";
	 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				if($this->consulta)
				{
					$this->codigosql = "UPDATE pedidos_boosting SET id_elobooster='$id_elobooster' WHERE id_pedido='$id_pedido'";
					$consult = mysqli_query($this->conexion, $this->codigosql);
					if($consult)
					{
						$this->codigosql = "UPDATE pedidos_win SET estado='2', id_elobooster='$id_elobooster' WHERE id_pedido='$id_pedido'";
						$consult = mysqli_query($this->conexion, $this->codigosql);
						
						if($consult)
						{
							// SE MANDA UN MENSAJE COMPRUEBA SI FUE MANDADO Y SI ESTA TODO BIEN GO COMMIT SINO ROLLBACK
							$asunto = 'El Pedido ha sido validado - En breve comenzamos';
							$contenido = 'Hemos procesado de manera correcta tu pedido, este se ha integrado a nuestra cola de pedidos libres en la cual en breve te asignaremos un jugador.
</br></br>
Según el número de pedidos que se encuentren en nuestra cola de espera dependerá el tiempo en que tarda tu cuenta en tener asignado un jugador. De todas formas, no te preocupes, antes de 24 horas estaremos trabajando en tu cuenta.';
							// El que recibe el mensaje es el cliente, el que lo envia el elobooster
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");
							$id_remitente = 1;
							$this->codigosql = "INSERT INTO mensajes VALUES (null, '$asunto', '$contenido', '$id_receptor', '$id_remitente', '$fecha', '$hora', '0')";
							$consult = mysqli_query($this->conexion, $this->codigosql);;
							if($consult)
							{
								$this->codigosql = 'commit;';
								$this->consulta = mysqli_query($this->conexion, $this->codigosql);
								$this->desconectar_db();
								echo 'El pedido fue tomado correctamente. Ya puedes empezar a trabajar con el.';
							}
							else
							{
								$this->codigosql = 'rollback;';
								$this->consulta = mysqli_query($this->conexion, $this->codigosql);
								$this->desconectar_db();
								echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
							}
						}
						else
						{
							$this->codigosql = 'rollback;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
						}
					}
					else
					{
						$this->codigosql = 'rollback;';
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						$this->desconectar_db();
						echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
				}
			}
		}
	}
	public function actualiz_pedido_elo($id_pedido, $id_elo, $leaguecurrent, $divisioncurrent)
	{
		$this->comprobar_pedido($id_pedido, '2');
		if($this->resultado == '')
		{
			echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
		}
		else
		{
			$tipo_pedido = $this->resultado[0]['tipo_pedido'];
			if($tipo_pedido == '1')
			{
				$this->codigosql = "UPDATE pedidos_gl SET id_level_current='$leaguecurrent', id_division_current='$divisioncurrent' WHERE id_pedido='$id_pedido' and id_elobooster='$id_elo'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue actualizado correctamente.';
				}
				else
				{
					echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '2')
			{
				echo 'error con el tipo de pedido';
			}
			elseif($tipo_pedido == '3')
			{
				echo 'error con el tipo de pedido';
			}
			elseif($tipo_pedido == '4')
			{
				$this->codigosql = "UPDATE pedidos_ul SET id_level_current='$leaguecurrent', id_division_current='$divisioncurrent' WHERE id_pedido='$id_pedido' and id_elobooster='$id_elo'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue actualizado correctamente.';
				}
				else
				{
					echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '5')
			{
				echo 'error con el tipo de pedido';
			}
		}
	}
	public function actualizar_pedido_elo($id_pedido, $id_elo, $current)
	{
		$this->comprobar_pedido($id_pedido, '2');
		if($this->resultado == '')
		{
			echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
		}
		else
		{
			$tipo_pedido = $this->resultado[0]['tipo_pedido'];
			if($tipo_pedido == '1')
			{
				echo 'error con el tipo de pedido';
			}
			elseif($tipo_pedido == '2')
			{
				$this->codigosql = "UPDATE pedidos_dqb SET games_current='$current' WHERE id_pedido='$id_pedido' and id_elobooster='$id_elo'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue actualizado correctamente.';
				}
				else
				{
					echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '3')
			{
				$this->codigosql = "UPDATE pedidos_pg SET number_wins_current='$current' WHERE id_pedido='$id_pedido' and id_elobooster='$id_elo'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue actualizado correctamente.';
				}
				else
				{
					echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '4')
			{
				echo 'error con el tipo de pedido';
			}
			elseif($tipo_pedido == '5')
			{
				$this->codigosql = "UPDATE pedidos_win SET wins_current='$current' WHERE id_pedido='$id_pedido' and id_elobooster='$id_elo'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue actualizado correctamente.';
				}
				else
				{
					echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
				}
			}
		}
	}
	public function actualizar_pedido($id_pedido, $precio_elo)
	{
		$this->comprobar_pedido($id_pedido, '5');
		if($this->resultado == '')
		{
			echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
		}
		else
		{
			$tipo_pedido = $this->resultado[0]['tipo_pedido'];
			if($tipo_pedido == '1')
			{
				$this->codigosql = "UPDATE pedidos_gl SET precio_elo='$precio_elo' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue actualizado correctamente.';
				}
				else
				{
					echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '2')
			{
				$this->codigosql = "UPDATE pedidos_dqb SET precio_elo='$precio_elo' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue actualizado correctamente.';
				}
				else
				{
					echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '3')
			{
				$this->codigosql = "UPDATE pedidos_pg SET precio_elo='$precio_elo' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue actualizado correctamente.';
				}
				else
				{
					echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '4')
			{
				$this->codigosql = "UPDATE pedidos_ul SET precio_elo='$precio_elo' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue actualizado correctamente.';
				}
				else
				{
					echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '5')
			{
				$this->codigosql = "UPDATE pedidos_win SET precio_elo='$precio_elo' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue actualizado correctamente.';
				}
				else
				{
					echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
				}
			}
		}
	}
	public function terminar_pedido($id_pedido, $id_elobooster)
	{
		$this->comprobar_pedido($id_pedido, '2');
		if($this->resultado == '')
		{
			echo 'Hubo un error en terminar el pedido, por favor intentelo nuevamente.';
		}
		else
		{
			$tipo_pedido = $this->resultado[0]['tipo_pedido'];
			if($tipo_pedido == '1')
			{
				$this->codigosql = "UPDATE pedidos_gl SET estado='4' WHERE id_pedido='$id_pedido' and id_elobooster='$id_elobooster'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue terminado correctamente.';
				}
				else
				{
					echo 'Hubo un error en ternubar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '2')
			{
				$this->codigosql = "UPDATE pedidos_dqb SET estado='4' WHERE id_pedido='$id_pedido' and id_elobooster='$id_elobooster'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue terminado correctamente.';
				}
				else
				{
					echo 'Hubo un error en terminado el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '3')
			{
				$this->codigosql = "UPDATE pedidos_pg SET estado='4' WHERE id_pedido='$id_pedido' and id_elobooster='$id_elobooster'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue terminado correctamente.';
				}
				else
				{
					echo 'Hubo un error en terminado el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '4')
			{
				$this->codigosql = "UPDATE pedidos_ul SET estado='4' WHERE id_pedido='$id_pedido' and id_elobooster='$id_elobooster'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue terminado correctamente.';
				}
				else
				{
					echo 'Hubo un error en terminado el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '5')
			{
				$this->codigosql = "UPDATE pedidos_win SET estado='4' WHERE id_pedido='$id_pedido' and id_elobooster='$id_elobooster'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue terminado correctamente.';
				}
				else
				{
					echo 'Hubo un error en terminado el pedido, por favor intentelo nuevamente.';
				}
			}
		}
	}
	public function cancelar_pedido($id_pedido, $id_usuario)
	{
		$this->comprobar_pedido($id_pedido, '1');
		if($this->resultado == '')
		{
			echo 'Hubo un error al cancelar el pedido, por favor intentelo nuevamente.';
		}
		else
		{
			$tipo_pedido = $this->resultado[0]['tipo_pedido'];
			if($tipo_pedido == '1')
			{
				$this->codigosql = "UPDATE pedidos_gl SET estado='3' WHERE id_pedido='$id_pedido' and id_usuario='$id_usuario'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					echo 'Hubo un error al cancelar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '2')
			{
				$this->codigosql = "UPDATE pedidos_dqb SET estado='3' WHERE id_pedido='$id_pedido' and id_usuario='$id_usuario'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					echo 'Hubo un error al cancelar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '3')
			{
				$this->codigosql = "UPDATE pedidos_pg SET estado='3' WHERE id_pedido='$id_pedido' and id_usuario='$id_usuario'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					echo 'Hubo un error al cancelar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '4')
			{
				$this->codigosql = "UPDATE pedidos_ul SET estado='3' WHERE id_pedido='$id_pedido' and id_usuario='$id_usuario'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					echo 'Hubo un error al cancelar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '5')
			{
				$this->codigosql = "UPDATE pedidos_win SET estado='3' WHERE id_pedido='$id_pedido' and id_usuario='$id_usuario'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					echo 'Hubo un error al cancelar el pedido, por favor intentelo nuevamente.';
				}
			}
		}
	}
	public function lista_trabajos_coach($estado)
	{
		$this->codigosql = "SELECT * FROM trabajos_coachs WHERE estado='$estado'";
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
	public function agregar_gl_purchase($nombre, $usuario_lol, $nick_lol, $pass_lol, $id_server_lol, $rp, $ip, $id_level_inicio, $id_division_inicio, $points, $lpgain, $id_level_llegada, $id_division_llegada, $precio, $id_usuario)
	{
		if($nombre == '' || $usuario_lol == '' || $nick_lol == '' || $pass_lol == '' || $id_server_lol == '' || $rp == '' || $ip == '' || $id_level_inicio == '' || $id_division_inicio == '' || $points == '' || $lpgain == '' || $id_level_llegada == '' || $precio == '' || $id_usuario == '')
		{
			echo 'Todos los campos deben estar completos';
		}
		else
		{
			if($id_division_llegada == '')
			{
				$id_division_llegada = '0';
			}
			$hora = date("H:i:s");
			$fecha = date("Y-m-d");
			$this->conectar_db();
			$this->codigosql = "START TRANSACTION";
 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
			if($this->consulta)
			{
				$this->codigosql = "INSERT INTO pedidos_boosting VALUES (null, '1', '$id_usuario', '0')";
				$consult = mysqli_query($this->conexion, $this->codigosql);
				if($consult)
				{
					$id_pedido = mysqli_insert_id($this->conexion);
					$this->codigosql = "INSERT INTO pedidos_gl VALUES ('$id_pedido', '1', '$nombre', '$usuario_lol', '$nick_lol', '$pass_lol', '$id_server_lol', '$rp', '$ip', '$id_level_inicio', '$id_division_inicio', '$points', '$lpgain', '$id_level_llegada', '$id_division_llegada', '$id_level_inicio', '$id_division_inicio', '$precio', '0', '1', '$fecha', '$hora', '$id_usuario', '', '0', '0')";
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					if($this->consulta)
					{
						$this->codigosql = "SELECT usuario, tipo, pass FROM usuarios WHERE id_usuario='$id_usuario'";
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						while ($this->resultado[] = mysqli_fetch_array($this->consulta, MYSQLI_ASSOC));
 						$this->num_resultados = mysqli_num_rows($this->consulta);

						$cliente = $this->resultado[0]['usuario'];
						$contenido = '
						Hola @'.$cliente.', espero que estés muy bien!</br></br>
Mi nombre es @UrgloBot y soy tu asistente virtual, simplemente uno más del equipo de especialistas dispuestos a atender cada una de tus dudas.</br></br>

Primero que todo, debo comentarte que luego que contratas uno de nuestros servicios, tendrás que esperar a que tu pago sea validado. Una vez este sea validado comenzaremos a trabajar en tu cuenta dentro de las primeras 24 horas posteriores a tu compra.</br></br>
Desde ahora estaré en todo momento notificándote por medio de nuevos mensajes el progreso de tu pedido y aprovechare de ir explicándote cada paso a seguir según corresponda. De todas formas, si tienes alguna consulta escríbenos a nuestro correo electrónico “s@urglo.com” .</br></br></br>
Esperamos que disfrutes del proceso, y por favor, no dudes en contáctanos en caso que tengas cualquier duda.</br></br>

* Recibirás este mensaje al realizar un pedido, incluso si este aún no ha sido pagado. La activación de su pedido puede tardar según el medio de pago elegido, puede comprobar el estado de su pago ingresando a su pedido.';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden de Eloboost - ¡Bienvenido!', '$contenido', '$id_usuario', '1', '$fecha', '$hora', '0')";
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						if($this->consulta)
						{
							$this->codigosql = 'commit;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							return true;
						}
						else
						{	
							$this->codigosql = 'rollback;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
						}
					}
					else
					{
						$this->codigosql = 'rollback;';
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						$this->desconectar_db();
						echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
				}
			}
			else
			{
				$this->codigosql = 'rollback;';
				$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				$this->desconectar_db();
				echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
			}
		}
	}
	public function agregar_dqb_purchase($nombre, $nick_lol, $id_server_lol, $id_level, $id_division, $games, $precio, $id_usuario)
	{
		if($nombre == '' || $nick_lol == '' || $id_server_lol == '' || $games == '' || $precio == '' || $id_level == '' || $id_division == '' || $id_usuario == '')
		{
			echo 'Todos los campos deben estar completos';
		}
		else
		{
			$hora = date("H:i:s");
			$fecha = date("Y-m-d");
			$this->conectar_db();
			$this->codigosql = "START TRANSACTION";
 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
 			if($this->consulta)
 			{
 				$this->codigosql = "INSERT INTO pedidos_boosting VALUES (null, '2', '$id_usuario', '0')";
				$consult = mysqli_query($this->conexion, $this->codigosql);
				if($consult)
				{
					$id_pedido = mysqli_insert_id($this->conexion);
	 				$this->codigosql = "INSERT INTO pedidos_dqb VALUES ('$id_pedido', '2', '$nombre', '$nick_lol', '$id_server_lol', '$id_level', '$id_division', '$games', '0', '$precio', '0', '1', '$fecha', '$hora', '$id_usuario', '', '0', '0')";
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					if($this->consulta)
					{
						$this->codigosql = "SELECT usuario, tipo, pass FROM usuarios WHERE id_usuario='$id_usuario'";
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						while ($this->resultado[] = mysqli_fetch_array($this->consulta, MYSQLI_ASSOC));
 						$this->num_resultados = mysqli_num_rows($this->consulta);

						$cliente = $this->resultado[0]['usuario'];
						$contenido = 'Hola @'.$cliente.', espero que estés muy bien!</br>
Mi nombre es @UrgloBot y soy tu asistente virtual, simplemente uno más del equipo de especialistas dispuestos a atender cada una de tus dudas.</br></br>

Primero que todo, debo comentarte que luego que contratas uno de nuestros servicios, tendrás que esperar a que tu pago sea validado. Una vez este sea validado comenzaremos a trabajar en tu cuenta dentro de las primeras 24 horas posteriores a tu compra.</br></br>
Desde ahora estaré en todo momento notificándote por medio de nuevos mensajes el progreso de tu pedido y aprovechare de ir explicándote cada paso a seguir según corresponda. De todas formas, si tienes alguna consulta escríbenos a nuestro correo electrónico “s@urglo.com” .</br></br>
Esperamos que disfrutes del proceso, y por favor, no dudes en contáctanos en caso que tengas cualquier duda.</br></br></br>

* Recibirás este mensaje al realizar un pedido, incluso si este aún no ha sido pagado. La activación de su pedido puede tardar según el medio de pago elegido, puede comprobar el estado de su pago ingresando a su pedido.';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden de Eloboost - ¡Bienvenido!', '$contenido', '$id_usuario', '1', '$fecha', '$hora', '0')";
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						if($this->consulta)
						{
							$this->codigosql = 'commit;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							return true;
						}
						else
						{	
							$this->codigosql = 'rollback;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
						}
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
				}
 			}
			else
			{
				$this->codigosql = 'rollback;';
				$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				$this->desconectar_db();
				echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
			}	
		}
	}
	public function agregar_pg_purchase($nombre, $user_lol, $nick_lol, $pass_lol, $id_server_lol, $rp, $ip, $id_level, $number_wins, $precio, $id_usuario)
	{
		if($nombre == '' || $user_lol == '' || $nick_lol == '' || $pass_lol == '' || $id_server_lol == '' || $rp == '' || $ip == '' || $id_level == '' || $number_wins == '' || $precio == '' || $id_usuario == '')
		{
			echo 'Todos los campos deben estar completos';
		}
		else
		{
			$hora = date("H:i:s");
			$fecha = date("Y-m-d");
			$this->conectar_db();
			$this->codigosql = "START TRANSACTION";
 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
 			if($this->consulta)
 			{
 				$this->codigosql = "INSERT INTO pedidos_boosting VALUES (null, '3', '$id_usuario', '0')";
				$consult = mysqli_query($this->conexion, $this->codigosql);
				if($consult)
				{
					$id_pedido = mysqli_insert_id($this->conexion);
					$this->codigosql = "INSERT INTO pedidos_pg VALUES ('$id_pedido', '3', '$nombre', '$user_lol', '$nick_lol', '$pass_lol', '$id_server_lol', '$rp', '$ip', '$id_level', '$number_wins', '0', '$precio', '0', '1', '$fecha', '$hora', '$id_usuario', '', '0', '0')";
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					if($this->consulta)
					{
						$this->codigosql = "SELECT usuario, tipo, pass FROM usuarios WHERE id_usuario='$id_usuario'";
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						while ($this->resultado[] = mysqli_fetch_array($this->consulta, MYSQLI_ASSOC));
 						$this->num_resultados = mysqli_num_rows($this->consulta);

						$cliente = $this->resultado[0]['usuario'];
												$contenido = 'Hola @'.$cliente.', espero que estés muy bien!</br></br>
Mi nombre es @UrgloBot y soy tu asistente virtual, simplemente uno más del equipo de especialistas dispuestos a atender cada una de tus dudas.</br></br>

Primero que todo, debo comentarte que luego que contratas uno de nuestros servicios, tendrás que esperar a que tu pago sea validado. Una vez este sea validado comenzaremos a trabajar en tu cuenta dentro de las primeras 24 horas posteriores a tu compra.</br></br>
Desde ahora estaré en todo momento notificándote por medio de nuevos mensajes el progreso de tu pedido y aprovechare de ir explicándote cada paso a seguir según corresponda. De todas formas, si tienes alguna consulta escríbenos a nuestro correo electrónico “s@urglo.com” .</br></br>
Esperamos que disfrutes del proceso, y por favor, no dudes en contáctanos en caso que tengas cualquier duda.</br></br>

* Recibirás este mensaje al realizar un pedido, incluso si este aún no ha sido pagado. La activación de su pedido puede tardar según el medio de pago elegido, puede comprobar el estado de su pago ingresando a su pedido.';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden de Eloboost - ¡Bienvenido!', '$contenido', '$id_usuario', '1', '$fecha', '$hora', '0')";
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						if($this->consulta)
						{
							$this->codigosql = 'commit;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							return true;
						}
						else
						{	
							$this->codigosql = 'rollback;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
						}
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
				}
			}
			else
			{
				$this->codigosql = 'rollback;';
				$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				$this->desconectar_db();
				echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
			}
		}
	}
	public function agregar_ul_purchase($nombre, $user_lol, $nick_lol, $pass_lol, $id_server_lol, $rp, $ip, $precio, $id_level_pasado, $id_level_llegada, $id_division_llegada, $id_usuario)
	{
		if($nombre == '' || $user_lol == '' || $nick_lol == '' || $pass_lol == '' || $id_server_lol == '' || $rp == '' || $ip == '' || $precio == '' || $id_level_llegada == '' || $id_division_llegada == '' || $id_usuario == '')
		{
			echo 'Todos los campos deben estar completos';
		}
		else
		{
			$hora = date("H:i:s");
			$fecha = date("Y-m-d");
			$this->conectar_db();
			$this->codigosql = "START TRANSACTION";
 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
 			if($this->consulta)
 			{
 				$this->codigosql = "INSERT INTO pedidos_boosting VALUES (null, '4', '$id_usuario', '0')";
				$consult = mysqli_query($this->conexion, $this->codigosql);
				if($consult)
				{
					$id_pedido = mysqli_insert_id($this->conexion);
					$this->codigosql = "INSERT INTO pedidos_ul VALUES ('$id_pedido', '4', '$nombre', '$user_lol', '$nick_lol', '$pass_lol', '$id_server_lol', '$rp', '$ip', '$precio', '0', '$id_level_pasado', '$id_level_llegada', '$id_division_llegada', '$id_level_pasado', '0', '1', '$fecha', '$hora', '$id_usuario', '', '0', '0')";
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					if($this->consulta)
					{
						$this->codigosql = "SELECT usuario, tipo, pass FROM usuarios WHERE id_usuario='$id_usuario'";
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						while ($this->resultado[] = mysqli_fetch_array($this->consulta, MYSQLI_ASSOC));
 						$this->num_resultados = mysqli_num_rows($this->consulta);

						$cliente = $this->resultado[0]['usuario'];
												$contenido = 'Hola @'.$cliente.', espero que estés muy bien!</br></br>
Mi nombre es @UrgloBot y soy tu asistente virtual, simplemente uno más del equipo de especialistas dispuestos a atender cada una de tus dudas.</br></br>

Primero que todo, debo comentarte que luego que contratas uno de nuestros servicios, tendrás que esperar a que tu pago sea validado. Una vez este sea validado comenzaremos a trabajar en tu cuenta dentro de las primeras 24 horas posteriores a tu compra.</br></br>
Desde ahora estaré en todo momento notificándote por medio de nuevos mensajes el progreso de tu pedido y aprovechare de ir explicándote cada paso a seguir según corresponda. De todas formas, si tienes alguna consulta escríbenos a nuestro correo electrónico “s@urglo.com” .</br></br>
Esperamos que disfrutes del proceso, y por favor, no dudes en contáctanos en caso que tengas cualquier duda.</br></br>

* Recibirás este mensaje al realizar un pedido, incluso si este aún no ha sido pagado. La activación de su pedido puede tardar según el medio de pago elegido, puede comprobar el estado de su pago ingresando a su pedido.';
						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden de Eloboost - ¡Bienvenido!', '$contenido', '$id_usuario', '1', '$fecha', '$hora', '0')";
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						if($this->consulta)
						{
							$this->codigosql = 'commit;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							return true;
						}
						else
						{	
							$this->codigosql = 'rollback;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
						}
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
				}
			}
			else
			{
				$this->codigosql = 'rollback;';
				$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				$this->desconectar_db();
				echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
			}
		}
	}
	public function agregar_win_purchase($nombre, $user_lol, $nick_lol, $pass_lol, $id_server_lol, $rp, $ip, $precio, $id_level_inicio, $id_division_inicio, $wins, $id_usuario)
	{
		if($nombre == '' || $user_lol == '' || $nick_lol == '' || $pass_lol == '' || $id_server_lol == '' || $rp == '' || $ip == '' || $precio == '' || $id_level_inicio == '' || $id_division_inicio == '' || $wins == '' || $id_usuario == '')
		{
			echo 'Todos los campos deben estar completos';
		}
		else
		{
			$hora = date("H:i:s");
			$fecha = date("Y-m-d");
			$this->conectar_db();
			$this->codigosql = "START TRANSACTION";
 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
 			if($this->consulta)
 			{
 				$this->codigosql = "INSERT INTO pedidos_boosting VALUES (null, '5', '$id_usuario', '0')";
				$consult = mysqli_query($this->conexion, $this->codigosql);
				if($consult)
				{
					$id_pedido = mysqli_insert_id($this->conexion);
					$this->codigosql = "INSERT INTO pedidos_win VALUES ('$id_pedido', '5', '$nombre', '$user_lol', '$nick_lol', '$pass_lol', '$id_server_lol', '$rp', '$ip', '$precio', '0', '$id_level_inicio', '$id_division_inicio', '$wins', '0', '1', '$fecha', '$hora', '$id_usuario', '', '0', '0')";
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					if($this->consulta)
					{
						$this->codigosql = "SELECT usuario, tipo, pass FROM usuarios WHERE id_usuario='$id_usuario'";
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						while ($this->resultado[] = mysqli_fetch_array($this->consulta, MYSQLI_ASSOC));
 						$this->num_resultados = mysqli_num_rows($this->consulta);

						$cliente = $this->resultado[0]['usuario'];
												$contenido = 'Hola @'.$cliente.', espero que estés muy bien!</br></br>
Mi nombre es @UrgloBot y soy tu asistente virtual, simplemente uno más del equipo de especialistas dispuestos a atender cada una de tus dudas.</br></br>

Primero que todo, debo comentarte que luego que contratas uno de nuestros servicios, tendrás que esperar a que tu pago sea validado. Una vez este sea validado comenzaremos a trabajar en tu cuenta dentro de las primeras 24 horas posteriores a tu compra.</br></br>
Desde ahora estaré en todo momento notificándote por medio de nuevos mensajes el progreso de tu pedido y aprovechare de ir explicándote cada paso a seguir según corresponda. De todas formas, si tienes alguna consulta escríbenos a nuestro correo electrónico “s@urglo.com” .</br></br>
Esperamos que disfrutes del proceso, y por favor, no dudes en contáctanos en caso que tengas cualquier duda.</br></br>

* Recibirás este mensaje al realizar un pedido, incluso si este aún no ha sido pagado. La activación de su pedido puede tardar según el medio de pago elegido, puede comprobar el estado de su pago ingresando a su pedido.';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden de Eloboost - ¡Bienvenido!', '$contenido', '$id_usuario', '1', '$fecha', '$hora', '0')";
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						if($this->consulta)
						{
							$this->codigosql = 'commit;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							return true;
						}
						else
						{	
							$this->codigosql = 'rollback;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
						}
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
				}
			}
			else
			{
				$this->codigosql = 'rollback;';
				$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				$this->desconectar_db();
				echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
			}
		}
	}
	public function user_actualiza_pedido($id_pedido, $estado)
	{
		$this->comprobar_pedido($id_pedido, '2');
		if($this->resultado == '')
		{
			echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
		}
		else
		{
			$tipo_pedido = $this->resultado[0]['tipo_pedido'];
			if($tipo_pedido == '1')
			{
				$this->codigosql = "UPDATE pedidos_gl SET estado_user='$estado' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			elseif($tipo_pedido == '2')
			{
				$this->codigosql = "UPDATE pedidos_dqb SET estado_user='$estado' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			elseif($tipo_pedido == '3')
			{
				$this->codigosql = "UPDATE pedidos_pg SET estado_user='$estado' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			elseif($tipo_pedido == '4')
			{
				$this->codigosql = "UPDATE pedidos_ul SET estado_user='$estado' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			elseif($tipo_pedido == '5')
			{
				$this->codigosql = "UPDATE pedidos_win SET estado_user='$estado' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}
	public function elo_actualiza_pedido($id_pedido, $estado)
	{
		$this->comprobar_pedido($id_pedido, '2');
		if($this->resultado == '')
		{
			echo 'Hubo un error en actualizar el pedido, por favor intentelo nuevamente.';
		}
		else
		{
			$tipo_pedido = $this->resultado[0]['tipo_pedido'];
			if($tipo_pedido == '1')
			{
				$this->codigosql = "UPDATE pedidos_gl SET estado_elo='$estado' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			elseif($tipo_pedido == '2')
			{
				$this->codigosql = "UPDATE pedidos_dqb SET estado_elo='$estado' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			elseif($tipo_pedido == '3')
			{
				$this->codigosql = "UPDATE pedidos_pg SET estado_elo='$estado' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			elseif($tipo_pedido == '4')
			{
				$this->codigosql = "UPDATE pedidos_ul SET estado_elo='$estado' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			elseif($tipo_pedido == '5')
			{
				$this->codigosql = "UPDATE pedidos_win SET estado_elo='$estado' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}
	public function ordenes()
	{
		$this->codigosql = "SELECT * FROM pedidos_boosting order by id_pedido DESC";
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
	public function ultimos_pedidos()
	{
		$this->codigosql = "SELECT * FROM pedidos_boosting order by id_pedido DESC LIMIT 5";
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
	public function mis_ordenes($id_usuario)
	{
		$this->codigosql = "SELECT * FROM pedidos_boosting WHERE id_usuario='$id_usuario' order by id_pedido DESC";
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
	public function mis_ultimas_ordenes_boost($id_booster)
	{
		$this->codigosql = "SELECT * FROM pedidos_boosting WHERE id_elobooster='$id_booster' order by id_pedido DESC LIMIT 5";
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
	public function mis_ultimas_ordenes($id_usuario)
	{
		$this->codigosql = "SELECT * FROM pedidos_boosting WHERE id_usuario='$id_usuario' order by id_pedido DESC LIMIT 5";
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
	public function orden_tipo_estado($tipo_pedido, $id_pedido, $estado)
	{
		if($tipo_pedido == '1')
		{
			$this->codigosql = "SELECT * FROM pedidos_gl WHERE id_pedido='$id_pedido' and estado='$estado'";
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
		elseif($tipo_pedido == '2')
		{
			$this->codigosql = "SELECT * FROM pedidos_dqb WHERE id_pedido='$id_pedido' and estado='$estado'";
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
		elseif($tipo_pedido == '3')
		{
			$this->codigosql = "SELECT * FROM pedidos_pg WHERE id_pedido='$id_pedido' and estado='$estado'";
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
		elseif($tipo_pedido == '4')
		{
			$this->codigosql = "SELECT * FROM pedidos_ul WHERE id_pedido='$id_pedido' and estado='$estado'";
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
		elseif($tipo_pedido == '5')
		{
			$this->codigosql = "SELECT * FROM pedidos_win WHERE id_pedido='$id_pedido' and estado='$estado'";
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
	public function orden_tipo($tipo_pedido, $id_pedido)
	{
		if($tipo_pedido == '1')
		{
			$this->codigosql = "SELECT * FROM pedidos_gl WHERE id_pedido='$id_pedido'";
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
		elseif($tipo_pedido == '2')
		{
			$this->codigosql = "SELECT * FROM pedidos_dqb WHERE id_pedido='$id_pedido'";
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
		elseif($tipo_pedido == '3')
		{
			$this->codigosql = "SELECT * FROM pedidos_pg WHERE id_pedido='$id_pedido'";
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
		elseif($tipo_pedido == '4')
		{
			$this->codigosql = "SELECT * FROM pedidos_ul WHERE id_pedido='$id_pedido'";
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
		elseif($tipo_pedido == '5')
		{
			$this->codigosql = "SELECT * FROM pedidos_win WHERE id_pedido='$id_pedido'";
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
	public function pedidos_boosting($id_pedido)
	{
		$this->codigosql = "SELECT * FROM pedidos_boosting WHERE id_pedido='$id_pedido'";
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
	public function pedidos_gl($id_pedido)
	{
		$this->codigosql = "SELECT * FROM pedidos_gl WHERE id_pedido='$id_pedido'";
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
	public function pedidos_dqb($id_pedido)
	{
		$this->codigosql = "SELECT * FROM pedidos_dqb WHERE id_pedido='$id_pedido'";
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
	public function pedidos_pg($id_pedido)
	{
		$this->codigosql = "SELECT * FROM pedidos_pg WHERE id_pedido='$id_pedido'";
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
	public function pedidos_ul($id_pedido)
	{
		$this->codigosql = "SELECT * FROM pedidos_ul WHERE id_pedido='$id_pedido'";
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
	public function pedidos_win($id_pedido)
	{
		$this->codigosql = "SELECT * FROM pedidos_win WHERE id_pedido='$id_pedido'";
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
