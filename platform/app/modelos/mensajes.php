<?php
class Mensajes extends Conexion {
	public function mensajes_visto($id_usuario, $estado)
	{
		$this->codigosql = "SELECT visto FROM mensajes WHERE id_receptor='$id_usuario' and visto='$estado'";
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
	public function modificar_estado($id_mensaje)
	{
		$this->codigosql = "UPDATE mensajes SET visto='1' WHERE id_mensaje='$id_mensaje'";
		$this->consulta_simple();
	}

	public function mandar_email_coachs()
	{
		$this->codigosql = "select * FROM usuarios,usuario_personal WHERE tipo='coach' and usuario_personal.id_usuario = usuarios.id_usuario";		
		$this->obtener_resultados();
		if($this->num_resultados > 0)
		{
			return $this->resultado;
		}
	}
	public function bandeja_entrada($id_usuario)
	{
		$this->codigosql = "SELECT * FROM mensajes WHERE id_receptor='$id_usuario' order by id_mensaje DESC LIMIT 0,5";
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
	public function bandeja_salida($id_usuario)
	{
		$this->codigosql = "SELECT * FROM mensajes WHERE id_remitente='$id_usuario' order by id_mensaje DESC LIMIT 0,5";
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
	public function ver_mensaje($id_mensaje, $id_receptor)
	{
		$this->codigosql = "SELECT * FROM mensajes WHERE id_mensaje='$id_mensaje' and id_receptor='$id_receptor' order by id_mensaje DESC LIMIT 0,5";
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
	public function ver_mensaje_rem($id_mensaje, $id_remitente)
	{
		$this->codigosql = "SELECT * FROM mensajes WHERE id_mensaje='$id_mensaje' and id_remitente='$id_remitente' order by id_mensaje DESC LIMIT 0,5";
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
	public function comprobar_mensaje($id_remitente, $contenido)
	{
		$this->codigosql = "SELECT id_mensaje FROM mensajes WHERE id_remitente='$id_remitente' and contenido='$contenido' LIMIT 1";
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
	public function enviar_mensaje($id_remitente, $id_receptor, $asunto, $contenido)
	{
		if($id_remitente == '' || $id_receptor == '' || $asunto == '' || $contenido == '')
		{
			echo 'Completa todos los campos para enviar el ticket';
		}
		else
		{
			if($this->datos_usuario($id_receptor) == false)
			{
				echo 'El usuario no existe';
			}
			else
			{
				if($this->comprobar_mensaje($id_remitente, $contenido) == true)
				{
					echo 'Este ticket ya fue enviado';
				}
				else
				{
					$hora = date("H:i:s");
					$fecha = date("Y-m-d");
					$this->codigosql = "INSERT INTO mensajes VALUES (null, '$asunto', '$contenido', '$id_receptor', '$id_remitente', '$fecha', '$hora', '0')";
					$this->consulta_simple();

					if($this->consulta)
					{
						echo 'El Ticket de soporte se envio correctamente.';
					}
					else
					{
						echo 'No se pudo enviar el ticket. Intenta nuevamente.';
					}
				}
			}	
		}
	}

	public function conversacion($id_trabajo)
	{
		$this->codigosql = "SELECT * FROM conversacion WHERE id_trabajo='$id_trabajo'";
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

	public function mensajes_chat($id_conversacion)
	{
		$this->codigosql = "SELECT * FROM chat WHERE id_conversacion='$id_conversacion' order by id_mensaje asc";
		$this->obtener_resultados();

		if ($this->num_resultados > 0) 
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}

	public function enviar_msj_chat($id_conversacion, $id_trabajo, $mensaje, $id_envia, $id_receptor)
	{
		//Con esto pregunto si traigo mensajes, si no trae es porque no hay mensajes, tampoco conversacion
		$this->codigosql = "SELECT id_mensaje FROM chat WHERE id_conversacion='$id_conversacion' order by id_mensaje desc LIMIT 1";
		$this->obtener_resultados();
		if($this->num_resultados > 0) 
		{
			//si ya existe la conver va sumando el id del mensaje por cada mensaje que envia
			$id_mensaje = $this->resultado[0]['id_mensaje'];
			$hora = date("H:i:s");
			$fecha = date("Y-m-d");
			$this->codigosql = "INSERT INTO chat (id_conversacion, id_mensaje, mensaje, id_user_envia, fecha_envio, hora_envio) VALUES ('$id_conversacion', '$id_mensaje'+1, '$mensaje', '$id_envia', '$fecha', '$hora')";
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
		else
		{
			// si no existe entra aca y busca el ultimo id conversacion
			$this->codigosql = "SELECT id_conversacion FROM chat order by id_conversacion desc LIMIT 1";
			$this->obtener_resultados();
			if($this->num_resultados > 0) 
			{
				//si entra aca es porque trajo el ultimo  id conversacion para sumarlo entonces crea nueva conver
				$id_conversacion = $this->resultado[0]['id_conversacion'];
				$hora = date("H:i:s");
				$fecha = date("Y-m-d");
				$this->codigosql = "INSERT INTO conversacion VALUES ('$id_conversacion'+1, '$id_trabajo', '$fecha', '$hora')";
				$this->consulta_simple();
				if($this->consulta)
				{
					$hora = date("H:i:s");
					$fecha = date("Y-m-d");
					$this->codigosql = "INSERT INTO chat (id_conversacion, id_mensaje, mensaje, id_user_envia, fecha_envio, hora_envio) VALUES ('$id_conversacion'+1, '1', '$mensaje', '$id_envia', '$fecha', '$hora')";
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
				else
				{
					return false;
				}
				
			}
			else
			{
				//si no hay id conversacion crea la primer conversacion
				$hora = date("H:i:s");
				$fecha = date("Y-m-d");
				$this->codigosql = "INSERT INTO conversacion VALUES ('1', '$id_trabajo', '$fecha', '$hora')";
				$this->consulta_simple();
				if($this->consulta)
				{
					$hora = date("H:i:s");
					$fecha = date("Y-m-d");
					$this->codigosql = "INSERT INTO chat (id_conversacion, id_mensaje, mensaje, id_user_envia, fecha_envio, hora_envio) VALUES ('1', '1', '$mensaje', '$id_envia', '$fecha', '$hora')";
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
				else
				{

				}
				
			}
		}
	}

	/////////////////////////////// CHAT coaching ////////////////////////////////////
	public function conversacion_coaching($id_trabajo)
	{
		$this->codigosql = "SELECT * FROM conversacion_coaching WHERE id_pedido='$id_trabajo'";
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

	public function mensajes_chat_coaching($id_conversacion)
	{
		$this->codigosql = "SELECT * FROM chat_coaching WHERE id_conversacion='$id_conversacion' order by id_mensaje asc";
		$this->obtener_resultados();

		if ($this->num_resultados > 0) 
		{
			return $this->resultado;
		}
		else
		{
			return false;
		}
	}

	public function enviar_msj_chat_coaching($id_conversacion, $id_trabajo, $mensaje, $id_envia, $id_receptor)
	{
		//Con esto pregunto si traigo mensajes, si no trae es porque no hay mensajes, tampoco conversacion
		$this->codigosql = "SELECT id_mensaje FROM chat_coaching WHERE id_conversacion='$id_conversacion' order by id_mensaje desc LIMIT 1";
		$this->obtener_resultados();
		if($this->num_resultados > 0) 
		{
			//si ya existe la conver va sumando el id del mensaje por cada mensaje que envia
			$id_mensaje = $this->resultado[0]['id_mensaje'];
			$hora = date("H:i:s");
			$fecha = date("Y-m-d");
			$this->codigosql = "INSERT INTO chat_coaching (id_conversacion, id_mensaje, mensaje, id_user_envia, fecha_envio, hora_envio) VALUES ('$id_conversacion', '$id_mensaje'+1, '$mensaje', '$id_envia', '$fecha', '$hora')";
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
		else
		{
			// si no existe entra aca y busca el ultimo id conversacion
			$this->codigosql = "SELECT id_conversacion FROM chat_coaching order by id_conversacion desc LIMIT 1";
			$this->obtener_resultados();
			if($this->num_resultados > 0) 
			{
				//si entra aca es porque trajo el ultimo  id conversacion para sumarlo entonces crea nueva conver
				$id_conversacion = $this->resultado[0]['id_conversacion'];
				$hora = date("H:i:s");
				$fecha = date("Y-m-d");
				$this->codigosql = "INSERT INTO conversacion_coaching VALUES ('$id_conversacion'+1, '$id_trabajo', '$fecha', '$hora')";
				$this->consulta_simple();
				if($this->consulta)
				{
					$hora = date("H:i:s");
					$fecha = date("Y-m-d");
					$this->codigosql = "INSERT INTO chat_coaching (id_conversacion, id_mensaje, mensaje, id_user_envia, fecha_envio, hora_envio) VALUES ('$id_conversacion'+1, '1', '$mensaje', '$id_envia', '$fecha', '$hora')";
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
				else
				{
					return false;
				}
				
			}
			else
			{
				//si no hay id conversacion crea la primer conversacion
				$hora = date("H:i:s");
				$fecha = date("Y-m-d");
				$this->codigosql = "INSERT INTO conversacion_coaching VALUES ('1', '$id_trabajo', '$fecha', '$hora')";
				$this->consulta_simple();
				if($this->consulta)
				{
					$hora = date("H:i:s");
					$fecha = date("Y-m-d");
					$this->codigosql = "INSERT INTO chat_coaching (id_conversacion, id_mensaje, mensaje, id_user_envia, fecha_envio, hora_envio) VALUES ('1', '1', '$mensaje', '$id_envia', '$fecha', '$hora')";
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
				else
				{

				}
				
			}
		}
	}
}
?>