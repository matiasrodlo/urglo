<?php
class Pedidos extends Conexion {
	public function comprobar_pedido($id_pedido, $estado)
	{
		$this->codigosql = "SELECT * FROM pedidos_coaching WHERE id_pedido='$id_pedido'";
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
			$tipo_pedido = $this->resultado[0]['tipo_pedido'];
			if($tipo_pedido == '1')
			{
				$this->codigosql = "UPDATE pedidos_gl SET estado='5', precio_elo='$precio_elo' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'El pedido fue activado, y sumado a la lista de Pedidos Desocupados.';
				}
				else
				{
					echo 'Hubo un error en activar el pedido, por favor intentelo nuevamente.';
				}
			}
			elseif($tipo_pedido == '2')
			{
				$this->codigosql = "UPDATE pedidos_dqb SET estado='5', precio_elo='$precio_elo' WHERE id_pedido='$id_pedido'";
				$this->consulta_simple();
				
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
	public function tomar_pedido($id_pedido, $id_coacher)
	{
		$this->comprobar_pedido($id_pedido, '5');
		if($this->resultado == '')
		{
			echo 'Hubo un error en tomar el pedido, por favor intentelo nuevamente.';
		}
		else
		{
			$tipo_pedido = $this->resultado[0]['tipo_pedido'];
			$id_receptor = $this->resultado[0]['id_usuario'];
			if($tipo_pedido == '1')
			{
				$this->conectar_db();
				$this->codigosql = "START TRANSACTION";
	 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				if($this->consulta)
				{
					$this->codigosql = "UPDATE pedidos_coaching SET id_coacher='$id_coacher' WHERE id_pedido='$id_pedido'";
					$consult = mysqli_query($this->conexion, $this->codigosql);
					if($consult)
					{
						$this->codigosql = "UPDATE pedidos_gl SET estado='2', id_coacher='$id_coacher' WHERE id_pedido='$id_pedido'";
						$consult = mysqli_query($this->conexion, $this->codigosql);;
						
						if($consult)
						{
							// SE MANDA UN MENSAJE COMPRUEBA SI FUE MANDADO Y SI ESTA TODO BIEN GO COMMIT SINO ROLLBACK
							$asunto = 'Su pedido de coaching va a empezar a ser realizado';
							$contenido = 'Su pedido va a empezar a ser trabajado con el coacher.';
							// El que recibe el mensaje es el cliente, el que lo envia el coacher
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");
							$id_remitente = 2; // El mensaje lo envia el admin
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
			elseif($tipo_pedido == '2')
			{
				$this->conectar_db();
				$this->codigosql = "START TRANSACTION";
	 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				if($this->consulta)
				{
					$this->codigosql = "UPDATE pedidos_coaching SET id_coacher='$id_coacher' WHERE id_pedido='$id_pedido'";
					$consult = mysqli_query($this->conexion, $this->codigosql);
					if($consult)
					{
						$this->codigosql = "UPDATE pedidos_dqb SET estado='2', id_coacher='$id_coacher' WHERE id_pedido='$id_pedido'";
						$consult = mysqli_query($this->conexion, $this->codigosql);
						if($consult)
						{
							// SE MANDA UN MENSAJE COMPRUEBA SI FUE MANDADO Y SI ESTA TODO BIEN GO COMMIT SINO ROLLBACK
							$asunto = 'Su pedido de coaching va a empezar a ser realizado';
							$contenido = 'Su pedido va a empezar a ser trabajado con el coacher.';
							// El que recibe el mensaje es el cliente, el que lo envia el coacher
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");
							$id_remitente = 2;
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
					$this->codigosql = "UPDATE pedidos_coaching SET id_coacher='$id_coacher' WHERE id_pedido='$id_pedido'";
					$consult = mysqli_query($this->conexion, $this->codigosql);
					if($consult)
					{
						$this->codigosql = "UPDATE pedidos_pg SET estado='2', id_coacher='$id_coacher' WHERE id_pedido='$id_pedido'";
						$consult = mysqli_query($this->conexion, $this->codigosql);
						
						if($consult)
						{
							// SE MANDA UN MENSAJE COMPRUEBA SI FUE MANDADO Y SI ESTA TODO BIEN GO COMMIT SINO ROLLBACK
							$asunto = 'Su pedido de coaching va a empezar a ser realizado';
							$contenido = 'Su pedido va a empezar a ser trabajado con el coacher.';
							// El que recibe el mensaje es el cliente, el que lo envia el coacher
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");
							$id_remitente = 2;
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
					$this->codigosql = "UPDATE pedidos_coaching SET id_coacher='$id_coacher' WHERE id_pedido='$id_pedido'";
					$consult = mysqli_query($this->conexion, $this->codigosql);
					if($consult)
					{
						$this->codigosql = "UPDATE pedidos_ul SET estado='2', id_coacher='$id_coacher' WHERE id_pedido='$id_pedido'";
						$consult = mysqli_query($this->conexion, $this->codigosql);
						
						if($consult)
						{
							// SE MANDA UN MENSAJE COMPRUEBA SI FUE MANDADO Y SI ESTA TODO BIEN GO COMMIT SINO ROLLBACK
							$asunto = 'Su pedido de coaching va a empezar a ser realizado';
							$contenido = 'Su pedido va a empezar a ser trabajado con el coacher.';
							// El que recibe el mensaje es el cliente, el que lo envia el coacher
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");
							$id_remitente = 2;
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
					$this->codigosql = "UPDATE pedidos_coaching SET id_coacher='$id_coacher' WHERE id_pedido='$id_pedido'";
					$consult = mysqli_query($this->conexion, $this->codigosql);
					if($consult)
					{
						$this->codigosql = "UPDATE pedidos_win SET estado='2', id_coacher='$id_coacher' WHERE id_pedido='$id_pedido'";
						$consult = mysqli_query($this->conexion, $this->codigosql);
						
						if($consult)
						{
							// SE MANDA UN MENSAJE COMPRUEBA SI FUE MANDADO Y SI ESTA TODO BIEN GO COMMIT SINO ROLLBACK
							$asunto = 'Su pedido de coaching va a empezar a ser realizado';
							$contenido = 'Su pedido va a empezar a ser trabajado con el coacher.';
							// El que recibe el mensaje es el cliente, el que lo envia el coacher
							$hora = date("H:i:s");
							$fecha = date("Y-m-d");
							$id_remitente = 2;
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
				$this->codigosql = "UPDATE pedidos_gl SET id_level_current='$leaguecurrent', id_division_current='$divisioncurrent' WHERE id_pedido='$id_pedido' and id_coacher='$id_elo'";
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
				$this->codigosql = "UPDATE pedidos_ul SET id_level_current='$leaguecurrent', id_division_current='$divisioncurrent' WHERE id_pedido='$id_pedido' and id_coacher='$id_elo'";
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
				$this->codigosql = "UPDATE pedidos_dqb SET games_current='$current' WHERE id_pedido='$id_pedido' and id_coacher='$id_elo'";
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
				$this->codigosql = "UPDATE pedidos_pg SET number_wins_current='$current' WHERE id_pedido='$id_pedido' and id_coacher='$id_elo'";
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
				$this->codigosql = "UPDATE pedidos_win SET wins_current='$current' WHERE id_pedido='$id_pedido' and id_coacher='$id_elo'";
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
	public function terminar_pedido($id_pedido, $id_coacher)
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
				$this->codigosql = "UPDATE pedidos_gl SET estado='4' WHERE id_pedido='$id_pedido' and id_coacher='$id_coacher'";
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
				$this->codigosql = "UPDATE pedidos_dqb SET estado='4' WHERE id_pedido='$id_pedido' and id_coacher='$id_coacher'";
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
				$this->codigosql = "UPDATE pedidos_pg SET estado='4' WHERE id_pedido='$id_pedido' and id_coacher='$id_coacher'";
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
				$this->codigosql = "UPDATE pedidos_ul SET estado='4' WHERE id_pedido='$id_pedido' and id_coacher='$id_coacher'";
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
				$this->codigosql = "UPDATE pedidos_win SET estado='4' WHERE id_pedido='$id_pedido' and id_coacher='$id_coacher'";
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
				$this->codigosql = "INSERT INTO pedidos_coaching VALUES (null, '1', '$id_usuario', '0')";
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
						Gracias @'.$cliente.' por comprar en coachingLA.<br/>
						(Usted recibirá este mensaje al realizar un pedido, incluso si este no ha sido pagado todavía. Compruebe en nuestro panel el estado de su pago. La activación de su pedido puede tardar según el medio de pago elegido)
						<br/>
						En este Mensaje encontrara <b>información sobre su compra y como recibir un cupón equivalente a servicios Gratis.</b> Sugerimos que lea este Mensaje ya que puede responder a muchas de tus preguntas.
						<h3 style="text-decoration:underline;margin-top:10px;">Acabo de Contratar un impulso coaching:</h3>
						Una vez que usted contrata un servicio de impulso coaching, tendrá que esperar a que su pago sea comprobado. Cuando su pago es comprobado solo tiene que esperar a que empecemos a trabajar en su cuenta.
						<h3 style="text-decoration:underline;margin-top:10px;">Me gustaría jugar una partida Normal:</h3>
						No existe problema alguno con que juegues partidas normales, lo único que tienes que tener presente es que tienes que ingresar en tu pedido y <b><u>PAUSAR</u></b> mientras estes dentro de tu cuenta para que nuestro impulsador no ingrese a tu cuenta. El servicio puede ser reanudado sin ningún problema y puedes realizar este proceso tantas veces como quieras.
						RECUERDA: Mientras juegas quizás nuestro impulsador está afuera esperando poder terminar tu pedido lo antes posible, de modo que al tu jugar puedes interferir nuestros tiempos de entrega.
						<h3 style="text-decoration:underline;margin-top:10px;">Me gustaría conseguir un impulso coachingo una lección con un Entrenador GRATIS:</h3>
						Hay varias maneras de conseguir un impulso o un entrenamiento gratis. Presta mucha atención puedes ser tú uno de los beneficiados.
						-	Si un Impulsador (coacher) / Entrenador (coach) insinúa u ofrece servicios que se desvinculan de urglo.com (si él te invita a contratar los servicios en otro lugar y no en nuestro sitio o bien si te proporciona algún dato)
						-	Si usted contrata 10 clases a un entrenador de una vez, usted ganara 2 clases completamente gratis
						-	Si usted le da Me Gusta y comparte nuestra Página de Facebook, usted podrá concursar por ganar un impulso coaching, Entrenamientos, Skins, Riotpoints y otras cosas interesantes.
						<h3 style="text-decoration:underline;margin-top:10px;">Necesito contactarme con el Área de Soporte:</h3>
						Usted puede contactarse con nosotros escribiéndonos a nuestro correo electrónico Soporte@urglo.com Usted recibirá una respuesta dentro de las primeras 24 horas. 
						Por favor, no dude en ponerse en contacto si tiene alguna pregunta o preocupación.
						<br>
						Esperamos que usted disfrute del proceso, y por favor no dude en contactar con nosotros en cualquier momento para cualquier pregunta o duda.';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden de coaching- coachingLatinoamerica', '$contenido', '$id_usuario', '2', '$fecha', '$hora', '0')";
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
 				$this->codigosql = "INSERT INTO pedidos_coaching VALUES (null, '2', '$id_usuario', '0')";
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
						$contenido = '
						Gracias @'.$cliente.' por comprar en coachingLA.<br/>
						(Usted recibirá este mensaje al realizar un pedido, incluso si este no ha sido pagado todavía. Compruebe en nuestro panel el estado de su pago. La activación de su pedido puede tardar según el medio de pago elegido)
						<br/>
						En este Mensaje encontrara <b>información sobre su compra y como recibir un cupón equivalente a servicios Gratis.</b> Sugerimos que lea este Mensaje ya que puede responder a muchas de tus preguntas.
						<h3 style="text-decoration:underline;margin-top:10px;">Acabo de Contratar un impulso coaching:</h3>
						Una vez que usted contrata un servicio de impulso coaching, tendrá que esperar a que su pago sea comprobado. Cuando su pago es comprobado solo tiene que esperar a que empecemos a trabajar en su cuenta.
						<h3 style="text-decoration:underline;margin-top:10px;">Me gustaría jugar una partida Normal:</h3>
						No existe problema alguno con que juegues partidas normales, lo único que tienes que tener presente es que tienes que ingresar en tu pedido y <b><u>PAUSAR</u></b> mientras estes dentro de tu cuenta para que nuestro impulsador no ingrese a tu cuenta. El servicio puede ser reanudado sin ningún problema y puedes realizar este proceso tantas veces como quieras.
						RECUERDA: Mientras juegas quizás nuestro impulsador está afuera esperando poder terminar tu pedido lo antes posible, de modo que al tu jugar puedes interferir nuestros tiempos de entrega.
						<h3 style="text-decoration:underline;margin-top:10px;">Me gustaría conseguir un impulso coachingo una lección con un Entrenador GRATIS:</h3>
						Hay varias maneras de conseguir un impulso o un entrenamiento gratis. Presta mucha atención puedes ser tú uno de los beneficiados.
						-	Si un Impulsador (coacher) / Entrenador (coach) insinúa u ofrece servicios que se desvinculan de urglo.com (si él te invita a contratar los servicios en otro lugar y no en nuestro sitio o bien si te proporciona algún dato)
						-	Si usted contrata 10 clases a un entrenador de una vez, usted ganara 2 clases completamente gratis
						-	Si usted le da Me Gusta y comparte nuestra Página de Facebook, usted podrá concursar por ganar un impulso coaching, Entrenamientos, Skins, Riotpoints y otras cosas interesantes.
						<h3 style="text-decoration:underline;margin-top:10px;">Necesito contactarme con el Área de Soporte:</h3>
						Usted puede contactarse con nosotros escribiéndonos a nuestro correo electrónico Soporte@urglo.com Usted recibirá una respuesta dentro de las primeras 24 horas. 
						Por favor, no dude en ponerse en contacto si tiene alguna pregunta o preocupación.
						<br>
						Esperamos que usted disfrute del proceso, y por favor no dude en contactar con nosotros en cualquier momento para cualquier pregunta o duda.';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden de coaching- coachingLatinoamerica', '$contenido', '$id_usuario', '2', '$fecha', '$hora', '0')";
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
 				$this->codigosql = "INSERT INTO pedidos_coaching VALUES (null, '3', '$id_usuario', '0')";
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
						$contenido = '
						Gracias @'.$cliente.' por comprar en coachingLA.<br/>
						(Usted recibirá este mensaje al realizar un pedido, incluso si este no ha sido pagado todavía. Compruebe en nuestro panel el estado de su pago. La activación de su pedido puede tardar según el medio de pago elegido)
						<br/>
						En este Mensaje encontrara <b>información sobre su compra y como recibir un cupón equivalente a servicios Gratis.</b> Sugerimos que lea este Mensaje ya que puede responder a muchas de tus preguntas.
						<h3 style="text-decoration:underline;margin-top:10px;">Acabo de Contratar un impulso coaching:</h3>
						Una vez que usted contrata un servicio de impulso coaching, tendrá que esperar a que su pago sea comprobado. Cuando su pago es comprobado solo tiene que esperar a que empecemos a trabajar en su cuenta.
						<h3 style="text-decoration:underline;margin-top:10px;">Me gustaría jugar una partida Normal:</h3>
						No existe problema alguno con que juegues partidas normales, lo único que tienes que tener presente es que tienes que ingresar en tu pedido y <b><u>PAUSAR</u></b> mientras estes dentro de tu cuenta para que nuestro impulsador no ingrese a tu cuenta. El servicio puede ser reanudado sin ningún problema y puedes realizar este proceso tantas veces como quieras.
						RECUERDA: Mientras juegas quizás nuestro impulsador está afuera esperando poder terminar tu pedido lo antes posible, de modo que al tu jugar puedes interferir nuestros tiempos de entrega.
						<h3 style="text-decoration:underline;margin-top:10px;">Me gustaría conseguir un impulso coachingo una lección con un Entrenador GRATIS:</h3>
						Hay varias maneras de conseguir un impulso o un entrenamiento gratis. Presta mucha atención puedes ser tú uno de los beneficiados.
						-	Si un Impulsador (coacher) / Entrenador (coach) insinúa u ofrece servicios que se desvinculan de urglo.com (si él te invita a contratar los servicios en otro lugar y no en nuestro sitio o bien si te proporciona algún dato)
						-	Si usted contrata 10 clases a un entrenador de una vez, usted ganara 2 clases completamente gratis
						-	Si usted le da Me Gusta y comparte nuestra Página de Facebook, usted podrá concursar por ganar un impulso coaching, Entrenamientos, Skins, Riotpoints y otras cosas interesantes.
						<h3 style="text-decoration:underline;margin-top:10px;">Necesito contactarme con el Área de Soporte:</h3>
						Usted puede contactarse con nosotros escribiéndonos a nuestro correo electrónico Soporte@urglo.com Usted recibirá una respuesta dentro de las primeras 24 horas. 
						Por favor, no dude en ponerse en contacto si tiene alguna pregunta o preocupación.
						<br>
						Esperamos que usted disfrute del proceso, y por favor no dude en contactar con nosotros en cualquier momento para cualquier pregunta o duda.';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden de coaching- coachingLatinoamerica', '$contenido', '$id_usuario', '2', '$fecha', '$hora', '0')";
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
 				$this->codigosql = "INSERT INTO pedidos_coaching VALUES (null, '4', '$id_usuario', '0')";
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
						$contenido = '
						Gracias @'.$cliente.' por comprar en coachingLA.<br/>
						(Usted recibirá este mensaje al realizar un pedido, incluso si este no ha sido pagado todavía. Compruebe en nuestro panel el estado de su pago. La activación de su pedido puede tardar según el medio de pago elegido)
						<br/>
						En este Mensaje encontrara <b>información sobre su compra y como recibir un cupón equivalente a servicios Gratis.</b> Sugerimos que lea este Mensaje ya que puede responder a muchas de tus preguntas.
						<h3 style="text-decoration:underline;margin-top:10px;">Acabo de Contratar un impulso coaching:</h3>
						Una vez que usted contrata un servicio de impulso coaching, tendrá que esperar a que su pago sea comprobado. Cuando su pago es comprobado solo tiene que esperar a que empecemos a trabajar en su cuenta.
						<h3 style="text-decoration:underline;margin-top:10px;">Me gustaría jugar una partida Normal:</h3>
						No existe problema alguno con que juegues partidas normales, lo único que tienes que tener presente es que tienes que ingresar en tu pedido y <b><u>PAUSAR</u></b> mientras estes dentro de tu cuenta para que nuestro impulsador no ingrese a tu cuenta. El servicio puede ser reanudado sin ningún problema y puedes realizar este proceso tantas veces como quieras.
						RECUERDA: Mientras juegas quizás nuestro impulsador está afuera esperando poder terminar tu pedido lo antes posible, de modo que al tu jugar puedes interferir nuestros tiempos de entrega.
						<h3 style="text-decoration:underline;margin-top:10px;">Me gustaría conseguir un impulso coachingo una lección con un Entrenador GRATIS:</h3>
						Hay varias maneras de conseguir un impulso o un entrenamiento gratis. Presta mucha atención puedes ser tú uno de los beneficiados.
						-	Si un Impulsador (coacher) / Entrenador (coach) insinúa u ofrece servicios que se desvinculan de urglo.com (si él te invita a contratar los servicios en otro lugar y no en nuestro sitio o bien si te proporciona algún dato)
						-	Si usted contrata 10 clases a un entrenador de una vez, usted ganara 2 clases completamente gratis
						-	Si usted le da Me Gusta y comparte nuestra Página de Facebook, usted podrá concursar por ganar un impulso coaching, Entrenamientos, Skins, Riotpoints y otras cosas interesantes.
						<h3 style="text-decoration:underline;margin-top:10px;">Necesito contactarme con el Área de Soporte:</h3>
						Usted puede contactarse con nosotros escribiéndonos a nuestro correo electrónico Soporte@urglo.com Usted recibirá una respuesta dentro de las primeras 24 horas. 
						Por favor, no dude en ponerse en contacto si tiene alguna pregunta o preocupación.
						<br>
						Esperamos que usted disfrute del proceso, y por favor no dude en contactar con nosotros en cualquier momento para cualquier pregunta o duda.';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden de coaching- coachingLatinoamerica', '$contenido', '$id_usuario', '2', '$fecha', '$hora', '0')";
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
 				$this->codigosql = "INSERT INTO pedidos_coaching VALUES (null, '5', '$id_usuario', '0')";
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
						$contenido = '
						Gracias @'.$cliente.' por comprar en coachingLA.<br/>
						(Usted recibirá este mensaje al realizar un pedido, incluso si este no ha sido pagado todavía. Compruebe en nuestro panel el estado de su pago. La activación de su pedido puede tardar según el medio de pago elegido)
						<br/>
						En este Mensaje encontrara <b>información sobre su compra y como recibir un cupón equivalente a servicios Gratis.</b> Sugerimos que lea este Mensaje ya que puede responder a muchas de tus preguntas.
						<h3 style="text-decoration:underline;margin-top:10px;">Acabo de Contratar un impulso coaching:</h3>
						Una vez que usted contrata un servicio de impulso coaching, tendrá que esperar a que su pago sea comprobado. Cuando su pago es comprobado solo tiene que esperar a que empecemos a trabajar en su cuenta.
						<h3 style="text-decoration:underline;margin-top:10px;">Me gustaría jugar una partida Normal:</h3>
						No existe problema alguno con que juegues partidas normales, lo único que tienes que tener presente es que tienes que ingresar en tu pedido y <b><u>PAUSAR</u></b> mientras estes dentro de tu cuenta para que nuestro impulsador no ingrese a tu cuenta. El servicio puede ser reanudado sin ningún problema y puedes realizar este proceso tantas veces como quieras.
						RECUERDA: Mientras juegas quizás nuestro impulsador está afuera esperando poder terminar tu pedido lo antes posible, de modo que al tu jugar puedes interferir nuestros tiempos de entrega.
						<h3 style="text-decoration:underline;margin-top:10px;">Me gustaría conseguir un impulso coachingo una lección con un Entrenador GRATIS:</h3>
						Hay varias maneras de conseguir un impulso o un entrenamiento gratis. Presta mucha atención puedes ser tú uno de los beneficiados.
						-	Si un Impulsador (coacher) / Entrenador (coach) insinúa u ofrece servicios que se desvinculan de urglo.com (si él te invita a contratar los servicios en otro lugar y no en nuestro sitio o bien si te proporciona algún dato)
						-	Si usted contrata 10 clases a un entrenador de una vez, usted ganara 2 clases completamente gratis
						-	Si usted le da Me Gusta y comparte nuestra Página de Facebook, usted podrá concursar por ganar un impulso coaching, Entrenamientos, Skins, Riotpoints y otras cosas interesantes.
						<h3 style="text-decoration:underline;margin-top:10px;">Necesito contactarme con el Área de Soporte:</h3>
						Usted puede contactarse con nosotros escribiéndonos a nuestro correo electrónico Soporte@urglo.com Usted recibirá una respuesta dentro de las primeras 24 horas. 
						Por favor, no dude en ponerse en contacto si tiene alguna pregunta o preocupación.
						<br>
						Esperamos que usted disfrute del proceso, y por favor no dude en contactar con nosotros en cualquier momento para cualquier pregunta o duda.';

						$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden de coaching- coachingLatinoamerica', '$contenido', '$id_usuario', '2', '$fecha', '$hora', '0')";
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
		$this->codigosql = "SELECT * FROM pedidos_coaching order by id_pedido ASC";
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
		$this->codigosql = "SELECT * FROM pedidos_coaching order by id_pedido DESC LIMIT 5";
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
		$this->codigosql = "SELECT * FROM pedidos_coaching WHERE id_usuario='$id_usuario' order by id_pedido DESC";
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
	public function mis_ultimas_ordenes_coach($id_coacher)
	{
		$this->codigosql = "SELECT * FROM pedidos_coaching WHERE id_coacher='$id_coacher' order by id_pedido DESC LIMIT 5";
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
		$this->codigosql = "SELECT * FROM pedidos_coaching WHERE id_usuario='$id_usuario' order by id_pedido DESC LIMIT 5";
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
	public function pedidos_coaching($id_pedido)
	{
		$this->codigosql = "SELECT * FROM pedidos_coaching WHERE id_pedido='$id_pedido'";
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