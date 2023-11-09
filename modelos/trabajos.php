<?php
class Trabajos extends Conexion {
	public function comprobar_trabajo($id_trabajo_coach)
	{
		$this->codigosql = "SELECT nick_lol, estado, id_coach, id_usuario FROM trabajos_coachs WHERE id_trabajo_coach='$id_trabajo_coach'";
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
	public function datos_trabajo($id_trabajo)
	{
		$this->codigosql = "SELECT * FROM trabajos_coachs WHERE id_trabajo_coach='$id_trabajo'";
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
	public function realizar_trabajo($id_trabajo, $id_coach)
	{
		if($id_trabajo == '' || $id_coach == '')
		{
			echo 'Hubo un error en tomar el trabajo, por favor intentelo nuevamente.';
		}
		else
		{
			$this->datos_trabajo($id_trabajo);
			if($this->resultado[0]['estado'] == '1')
			{
				$this->codigosql = "UPDATE trabajos_coachs SET id_coach='$id_coach', estado='2' WHERE id_trabajo_coach='$id_trabajo'";
				$this->consulta_simple();
				
				if($this->consulta)
				{
					echo 'Ya puedes empezar a comunicarte con el usuario y realizar el trabajo.';
				}
				else
				{
					echo 'Hubo un error en tomar el trabajo, por favor intentelo nuevamente.';
				}
			}
			else
			{
				echo 'Este trabajo no esta disponible.';
			}	
		}
	}
	public function actualizar_trabajo($id_trabajo, $horas_restantes)
	{
		if($id_trabajo == '')
		{
			echo 'Hubo un error en actualzar el trabajo, por favor intentelo nuevamente.';
		}
		else
		{
			$this->datos_trabajo($id_trabajo);
			if($this->resultado[0]['estado'] == '2')
			{
				$this->codigosql = "UPDATE trabajos_coachs SET horas_restantes='$horas_restantes' WHERE id_trabajo_coach='$id_trabajo'";
				$this->consulta_simple();
					
				if($this->consulta)
				{
					echo 'El trabajo a sido actualizado correctamente.';
				}
				else
				{
					echo 'Hubo un error en actualzar el trabajo, por favor intentelo nuevamente.';
				}
			}
			else
			{
				echo 'El trabajo no se puede actualizar.';
			}
		}
	}
	public function terminar_trabajo($id_trabajo)
	{
		if($id_trabajo == '')
		{
			echo 'Hubo un error en terminar el trabajo, por favor intentelo nuevamente.';
		}
		else
		{
			$this->datos_trabajo($id_trabajo);
			if($this->resultado[0]['estado'] == '2')
			{
				$this->codigosql = "UPDATE trabajos_coachs SET estado='4' WHERE id_trabajo_coach='$id_trabajo'";
				$this->consulta_simple();
					
				if($this->consulta)
				{
					echo 'El trabajo a sido terminado correctamente.';
				}
				else
				{
					echo 'Hubo un error en terminar el trabajo, por favor intentelo nuevamente.';
				}
			}
			else
			{
				echo 'El trabajo no se puede terminar.';
			}
		}
	}
	public function cancelar_trabajo($id_trabajo)
	{
		if($id_trabajo == '')
		{
			echo 'Hubo un error en cancelar el trabajo, por favor intentelo nuevamente.';
		}
		else
		{
			$this->datos_trabajo($id_trabajo);
			if($this->resultado[0]['estado'] == '1')
			{
				$this->codigosql = "UPDATE trabajos_coachs SET estado='3' WHERE id_trabajo_coach='$id_trabajo'";
				$this->consulta_simple();
					
				if($this->consulta)
				{
					return true;
				}
				else
				{
					echo 'Hubo un error en cancelar el trabajo, por favor intentelo nuevamente.';
				}
			}
			else
			{
				echo 'El trabajo no se puede cancelar.';
			}
		}
	}
	public function calificar_trabajo($id_trabajo, $txt, $puntos, $id_coach, $id_usuario)
	{
		if($id_trabajo == '' || $txt == '' || $puntos == '' || $id_coach == '' || $id_usuario == '')
		{
			echo 'Todos los campos tienen que estar completos, para realizar la calificacion';
		}
		else
		{
			$hora = date("H:i:s");
			$fecha = date("Y-m-d");
			$this->codigosql = "INSERT INTO calificacion_coach VALUES (null, '$id_trabajo', '$txt', '$puntos', '$id_coach', '$id_usuario', '$fecha', '$hora')";
			$this->consulta_simple();
					
			if($this->consulta)
			{
				echo 'La calificacion fue realizada correctamente.';
			}
			else
			{
				echo 'Hubo un error en realizar la calificacion, por favor intentalo nuevamente.';
			}
		}
	}
	public function calificaciones_coach($id_coach)
	{
		$this->codigosql = "SELECT * FROM calificacion_coach WHERE id_coach='$id_coach'";
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
	public function mis_ultimas_calificaciones($id_usuario)
	{
		$this->codigosql = "SELECT * FROM calificacion_coach WHERE id_usuario='$id_usuario' order by id_calificacion DESC LIMIT 3";
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
	public function ultimas_calificaciones()
	{
		$this->codigosql = "SELECT * FROM calificacion_coach order by id_calificacion DESC LIMIT 3";
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
	public function mis_ultimas_calificaciones_coach($id_coach)
	{
		$this->codigosql = "SELECT * FROM calificacion_coach WHERE id_coach='$id_coach' order by id_calificacion DESC LIMIT 4";
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
	public function calificacion_trabajo($id_trabajo)
	{
		$this->codigosql = "SELECT * FROM calificacion_coach WHERE id_trabajo='$id_trabajo'";
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
	public function lista_coachs()
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
	public function lista_trabajos($estado, $id_coach)
	{
		$this->codigosql = "SELECT * FROM trabajos_coachs WHERE estado='$estado' and id_coach='$id_coach'";
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
	public function mis_ultimos_trabajos_terminados($id_coach)
	{
		$this->codigosql = "SELECT * FROM trabajos_coachs WHERE estado='4' and id_coach='$id_coach' order by id_trabajo_coach LIMIT 5";
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
	public function coach_personal($total, $horas, $intereses, $lolserver, $nicklol, $id_coach, $id_usuario)
	{
		if($total == '' || $horas == '' || $intereses == '' || $lolserver == '' || $nicklol == '' || $id_coach == '' || $id_usuario == '')
		{
			echo 'Todos los campos deben estar completos';
		}
		else
		{
			$hora = date("H:i:s");
			$fecha = date("Y-m-d");
			$this->codigosql = "INSERT INTO trabajos_coachs VALUES (null, '$lolserver', '$nicklol', '$total', '$horas', '$horas', 'Personal Coaching', 'Tenes que dar coaching personal', '$intereses', '$id_usuario', '1', '$fecha', '$hora', '$id_coach')";
			$this->consulta_simple();
				
			if($this->consulta)
			{
				$cliente = $this->datos_usuario($id_usuario);

				$contenido = '
				Gracias @'.$cliente[0]['usuario'].' por comprar en coachingLA.<br/>
				(Usted recibirá este mensaje al realizar un pedido, incluso si este no ha sido pagado todavía. Compruebe en nuestro panel el estado de su pago. La activación de su pedido puede tardar según el medio de pago elegido)

				En este Mensaje encontrara <b>información sobre su compra y como recibir un cupón equivalente a servicios Gratis.</b> Sugerimos que lea este Mensaje ya que puede responder a muchas de tus preguntas.<br/>
				<h3 style="text-decoration:underline;margin-top:10px;">Acabo de Contratar coaching:</h3><br/>
				Una vez que usted contrata un servicio coaching, tendrá que esperar a que su pago sea comprobado. Cuando su pago es comprobado, solo tiene que esperar a que empecemos a trabajar en su cuenta.<br/>
				
				<h3 style="text-decoration:underline;margin-top:10px;">Me gustaría conseguir un impulso coachingo una lección con un Entrenador GRATIS:</h3><br/>
				Hay varias maneras de conseguir un impulso o un entrenamiento gratis. Presta mucha atención puedes ser tú uno de los beneficiados.<br/>
				-	Si un Impulsador (coacher) / Entrenador (coach) insinúa u ofrece servicios que se desvinculan de urglo.com (si él te invita a contratar los servicios en otro lugar y no en nuestro sitio o bien si te proporciona algún dato)<br/>
				-	Si usted contrata 10 clases a un entrenador de una vez, usted ganara 2 clases completamente gratis<br/>
				-	Si usted le da Me Gusta y comparte nuestra Página de Facebook, usted podrá concursar por ganar un impulso coaching, Entrenamientos, Skins, Riotpoints y otras cosas interesantes.<br/>
				
				<h3 style="text-decoration:underline">Necesito contactarme con el Área de Soporte:</h3><br/>
				Usted puede contactarse con nosotros escribiéndonos a nuestro correo electrónico Soporte@urglo.com Usted recibirá una respuesta dentro de las primeras 24 horas.<br/>
				Por favor, no dude en ponerse en contacto si tiene alguna pregunta o preocupación.<br/>
				<br/>
				Esperamos que usted disfrute del proceso, y por favor no dude en contactar con nosotros en cualquier momento para cualquier pregunta o duda.';
				$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden Entrenadores - coachingLatinoamerica', '$contenido', '$id_usuario', '2', '$fecha', '$hora', '0')";
				$this->consulta_simple();

				if($this->consulta)
				{
					$cliente = $this->datos_usuario($id_usuario);
					$contenido = '
					Tienes una nueva orden de @'.$cliente[0]['usuario'].', contáctate con el para coordinar el servicio. Recuerda ser cordial y satisfacer al cliente. Cualquier infracción a las normas será penalizada. 
					¡Que tengas un buen día entrenador! ';
					$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Tienes una nueva Orden Entrenadores - coachingLatinoamerica', '$contenido', '$coach', '2', '$fecha', '$hora', '0')";
					$this->consulta_simple();

					if($this->consulta)
					{
						return true;	
					}
					else
					{
						echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
					}
				}
				else
				{
					echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
				}
			}
			else
			{
				echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
			}
		}
	}
	public function coach_team($total, $horas, $intereses, $lolserver, $nicklol, $id_coach, $id_usuario)
	{
		if($total == '' || $horas == '' || $intereses == '' || $lolserver == '' || $nicklol == '' || $id_coach == '' || $id_usuario == '')
		{
			echo 'Todos los campos deben estar completos';
		}
		else
		{
			$hora = date("H:i:s");
			$fecha = date("Y-m-d");
			$this->codigosql = "INSERT INTO trabajos_coachs VALUES (null, '$lolserver', '$nicklol', '$total', '$horas', '$horas', 'Team Coaching', 'Tenes que entrenar un team', '$intereses', '$id_usuario', '1', '$fecha', '$hora', '$id_coach')";
			$this->consulta_simple();
			
			if($this->consulta)
			{
				$cliente = $this->datos_usuario($id_usuario);

				$contenido = '
				Gracias @'.$cliente[0]['usuario'].' por comprar en coachingLA.<br/>
				(Usted recibirá este mensaje al realizar un pedido, incluso si este no ha sido pagado todavía. Compruebe en nuestro panel el estado de su pago. La activación de su pedido puede tardar según el medio de pago elegido)

				En este Mensaje encontrara <b>información sobre su compra y como recibir un cupón equivalente a servicios Gratis.</b> Sugerimos que lea este Mensaje ya que puede responder a muchas de tus preguntas.<br/>
				<h3 style="text-decoration:underline;margin-top:10px;">Acabo de Contratar coaching:</h3><br/>
				Una vez que usted contrata un servicio coaching, tendrá que esperar a que su pago sea comprobado. Cuando su pago es comprobado, solo tiene que esperar a que empecemos a trabajar en su cuenta.<br/>
				
				<h3 style="text-decoration:underline;margin-top:10px;">Me gustaría conseguir un impulso coachingo una lección con un Entrenador GRATIS:</h3><br/>
				Hay varias maneras de conseguir un impulso o un entrenamiento gratis. Presta mucha atención puedes ser tú uno de los beneficiados.<br/>
				-	Si un Impulsador (coacher) / Entrenador (coach) insinúa u ofrece servicios que se desvinculan de urglo.com (si él te invita a contratar los servicios en otro lugar y no en nuestro sitio o bien si te proporciona algún dato)<br/>
				-	Si usted contrata 10 clases a un entrenador de una vez, usted ganara 2 clases completamente gratis<br/>
				-	Si usted le da Me Gusta y comparte nuestra Página de Facebook, usted podrá concursar por ganar un impulso coaching, Entrenamientos, Skins, Riotpoints y otras cosas interesantes.<br/>
				
				<h3 style="text-decoration:underline">Necesito contactarme con el Área de Soporte:</h3><br/>
				Usted puede contactarse con nosotros escribiéndonos a nuestro correo electrónico Soporte@urglo.com Usted recibirá una respuesta dentro de las primeras 24 horas.<br/>
				Por favor, no dude en ponerse en contacto si tiene alguna pregunta o preocupación.<br/>
				<br/>
				Esperamos que usted disfrute del proceso, y por favor no dude en contactar con nosotros en cualquier momento para cualquier pregunta o duda.';
				$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden Entrenadores - coachingLatinoamerica', '$contenido', '$id_usuario', '2', '$fecha', '$hora', '0')";
				$this->consulta_simple();

				if($this->consulta)
				{
					$cliente = $this->datos_usuario($id_usuario);
					$contenido = '
					Tienes una nueva orden de @'.$cliente[0]['usuario'].', contáctate con el para coordinar el servicio. Recuerda ser cordial y satisfacer al cliente. Cualquier infracción a las normas será penalizada. 
					¡Que tengas un buen día entrenador! ';
					$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Tienes una nueva Orden Entrenadores - coachingLatinoamerica', '$contenido', '$coach', '2', '$fecha', '$hora', '0')";
					$this->consulta_simple();

					if($this->consulta)
					{
						return true;	
					}
					else
					{
						echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
					}
				}
				else
				{
					echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
				}
			}
			else
			{
				echo 'Hubo un error en agregar su pedido, por favor intentelo denuevo.';
			}
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
	public function activar_pedido($id_pedido, $mensaje)
	{
		if($id_pedido == '')
		{
			echo 'Hubo un error en activar el pedido, por favor intentelo nuevamente.';
		}
		else
		{	
			$this->codigosql = "UPDATE trabajos_coachs SET estado='2', mensaje='$mensaje' WHERE id_trabajo_coach='$id_pedido'";
			$this->consulta_simple();
				
			if($this->consulta)
			{
				echo 'El pedido fue activado correctamente, el mensaje al coach fue enviado.';
			}
			else
			{
				echo 'Hubo un error en activar el pedido, por favor intentelo nuevamente.';
			}
		}
	}
	public function lista_mis_trabajos($id_coach)
	{
		$this->codigosql = "SELECT * FROM trabajos_coachs WHERE id_coach='$id_coach'";
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
		$this->codigosql = "SELECT * FROM trabajos_coachs WHERE id_usuario='$id_usuario'";
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
	public function mis_ultimas_ordenes_coachs($id_usuario)
	{
		$this->codigosql = "SELECT * FROM trabajos_coachs WHERE id_usuario='$id_usuario' order by id_trabajo_coach DESC LIMIT 3";
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
	public function mis_ultimos_trabajos($id_coach)
	{
		$this->codigosql = "SELECT * FROM trabajos_coachs WHERE id_coach='$id_coach' order by id_trabajo_coach DESC LIMIT 5";
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
	public function ultimos_trabajos_terminados()
	{
		$this->codigosql = "SELECT * FROM trabajos_coachs WHERE estado='4' order by id_trabajo_coach DESC LIMIT 5";
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
	public function ultimos_trabajos()
	{
		$this->codigosql = "SELECT * FROM trabajos_coachs order by id_trabajo_coach DESC LIMIT 5";
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