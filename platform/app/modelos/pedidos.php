<?php
class Pedidos extends Conexion {
	public function comprobar_pedido($id_pedido, $estado)
	{
		$this->codigosql = "SELECT * FROM pedidos_coaching WHERE id_pedido='$id_pedido'";
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			$this->codigosql = "SELECT * FROM pedidos_coach WHERE id_pedido='$id_pedido' and estado='$estado'";
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
		else
		{
			return false;
		}
	}
	public function activar_pedido($id_pedido, $precio_coach)
	{
		$this->comprobar_pedido($id_pedido, '1');
		if($this->resultado == '')
		{
			echo 'Este pedido no puede ser activado.';
		}
		else
		{
			$id_usuario = $this->resultado[0]['id_usuario'];
			$this->codigosql = "UPDATE pedidos_coach SET estado='5', precio_coach='$precio_coach' WHERE id_pedido='$id_pedido'";
			$this->consulta_simple();
			$this->conectar_db();
						$hora = date("H:i:s");
						$fecha = date("Y-m-d");

					$contenido = 'Hemos procesado de manera correcta tu pedido, este se ha integrado a nuestra cola de pedidos libres en la cual a la brevedad te será asignado un coach. 

El tiempo de espera de este proceso es relativo y dependerá del número de pedidos que actualmente tengamos en nuestra cola de espera. De todas formas, no te preocupes, antes de 24 horas comenzaremos tu entrenamiento.';

					$this->codigosql = "INSERT INTO mensajes VALUES (null, 'El Pedido ha sido validado - En breve comenzamos', '$contenido', '$id_usuario', '1', '$fecha', '$hora', '0')";

					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
			
			if($this->consulta)
			{
				echo 'El pedido fue activado, y sumado a la lista de Pedidos Desocupados.';
			}
			else
			{
				echo 'No se pudo activar el pedido. Intenta nuevamente.';
			}
		}
	}
	public function tomar_pedido($id_pedido, $id_coach)
	{
		$this->comprobar_pedido($id_pedido, '5');
		if($this->resultado == '')
		{
			echo 'No se pudo tomar el pedido. Intenta nuevamente.';
		}
		else
		{
			$id_usuario = $this->resultado[0]['id_usuario'];
			$this->conectar_db();
			$this->codigosql = "START TRANSACTION";
 			$this->consulta = mysqli_query($this->conexion, $this->codigosql);
			if($this->consulta)
			{
				$this->codigosql = "UPDATE pedidos_coaching SET id_coach='$id_coach' WHERE id_pedido='$id_pedido'";
				$consult = mysqli_query($this->conexion, $this->codigosql);
				if($consult)
				{
					$this->codigosql = "UPDATE pedidos_coach SET estado='2', id_coach='$id_coach' WHERE id_pedido='$id_pedido'";
					$consult = mysqli_query($this->conexion, $this->codigosql);;
					
					if($consult)
					{

					$this->codigosql = "SELECT usuario, tipo, pass FROM usuarios WHERE id_usuario='$id_usuario'";
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					while ($this->resultado[] = mysqli_fetch_array($this->consulta, MYSQLI_ASSOC));
 					$this->num_resultados = mysqli_num_rows($this->consulta);
					$cliente = $this->resultado[2]['usuario'];
						// SE MANDA UN MENSAJE COMPRUEBA SI FUE MANDADO Y SI ESTA TODO BIEN GO COMMIT SINO ROLLBACK
						$asunto = 'Hemos asignado uno de nuestros coaches';
						$contenido = 'Hola @'.$cliente.', UrgloBot por aquí.</br></br>
Hemos asignado a tu pedido uno de nuestros coaches el cual comenzará tu entrenamiento a la brevedad, a partir de ahora puedes comunicarte con él desde el perfil de tu pedido. Tu coach te ayudará a mejorar tus habilidades y estrategias de juego.</br></br>
Aprovecha al máximo las sesiones de entrenamiento y no dudes en hacer todas las preguntas que necesites. Tu coach está aquí para ayudarte a alcanzar tus objetivos.</br></br>
Cabe comentar que está prohibido solicitar a nuestro coach cualquier tipo de información de contacto externa. En el caso de sorprender comunicación sospechosa esto significará la cancelación del pedido. 
';
						// El que recibe el mensaje es el cliente, el que lo envia el coach
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
							echo 'Pedido tomado correctamente';
						}
						else
						{
							$this->codigosql = 'rollback;';
							$this->consulta = mysqli_query($this->conexion, $this->codigosql);
							$this->desconectar_db();
							echo 'No se pudo tomar el pedido. Intenta nuevamente.';
						}
					}
					else
					{
						$this->codigosql = 'rollback;';
						$this->consulta = mysqli_query($this->conexion, $this->codigosql);
						$this->desconectar_db();
						echo 'No se pudo tomar el pedido. Intenta nuevamente.';
					}
				}
				else
				{
					$this->codigosql = 'rollback;';
					$this->consulta = mysqli_query($this->conexion, $this->codigosql);
					$this->desconectar_db();
					echo 'No se pudo tomar el pedido. Intenta nuevamente.';
				}
			}
			else
			{
				$this->codigosql = 'rollback;';
				$this->consulta = mysqli_query($this->conexion, $this->codigosql);
				$this->desconectar_db();
				echo 'No se pudo tomar el pedido. Intenta nuevamente.';
			}
		}
	}
	public function actualizar_pedido($id_pedido, $precio_coach)
	{
		$this->comprobar_pedido($id_pedido, '5');
		if($this->resultado == '')
		{
			echo 'No se pudo actualizar el pedido. Intenta nuevamente.';
		}
		else
		{
			$this->codigosql = "UPDATE pedidos_coach SET precio_coach='$precio_coach' WHERE id_pedido='$id_pedido'";
			$this->consulta_simple();
			
			if($this->consulta)
			{
				echo 'Pedido actualizado correctamente';
			}
			else
			{
				echo 'No se pudo actualizar el pedido. Intenta nuevamente.';
			}
		}
	}
	public function terminar_pedido($id_pedido, $id_coach)
	{
		$this->comprobar_pedido($id_pedido, '2');
		if($this->resultado == '')
		{
			echo 'No se pudo terminar el pedido. Intenta nuevamente.';
		}
		else
		{
			$this->codigosql = "UPDATE pedidos_coach SET estado='4' WHERE id_pedido='$id_pedido' and id_coach='$id_coach'";
			$this->consulta_simple();
			
			if($this->consulta)
			{
				echo 'Pedido terminado correctamente';
			}
			else
			{
				echo 'No se pudo terminar el pedido. Intenta nuevamente.';
			}
		}
	}
	public function cancelar_pedido($id_pedido, $id_usuario)
	{
		$this->comprobar_pedido($id_pedido, '2');
		if($this->resultado == '')
		{
			echo 'No se pudo cancelar el pedido. Intenta nuevamente.';
		}
		else
		{
			$this->codigosql = "UPDATE pedidos_coach SET estado='3' WHERE id_pedido='$id_pedido' and id_usuario='$id_usuario'";
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
	public function user_actualiza_pedido($id_pedido, $estado)
	{
		$this->comprobar_pedido($id_pedido, '2');
		if($this->resultado == '')
		{
			echo 'No se pudo actualizar el pedido. Intenta nuevamente.';
		}
		else
		{
			$this->codigosql = "UPDATE pedidos_coach SET estado_user='$estado' WHERE id_pedido='$id_pedido'";
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
	public function agregar_coach_purchase($nombre, $usuario_lol, $nick_lol, $pass_lol, $id_server_lol, $rp, $ip, $id_level_inicio, $id_division_inicio, $points, $lpgain, $id_level_llegada, $id_division_llegada, $precio, $id_usuario)
	{
		return false;
	}
	public function ordenes()
	{
		$this->codigosql = "SELECT * FROM pedidos_coaching order by id_pedido DESC";
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
	public function mis_ultimas_ordenes_coach($id_coach)
	{
		$this->codigosql = "SELECT * FROM pedidos_coaching WHERE id_coach='$id_coach' order by id_pedido DESC LIMIT 5";
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
		$this->codigosql = "SELECT * FROM pedidos_coach WHERE id_pedido='$id_pedido' and estado='$estado'";
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
	public function orden_tipo($tipo_pedido, $id_pedido)
	{
		$this->codigosql = "SELECT * FROM pedidos_coach WHERE id_pedido='$id_pedido'";
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
	public function pedidos_coach($id_pedido)
	{
		$this->codigosql = "SELECT * FROM pedidos_coach WHERE id_pedido='$id_pedido'";
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
