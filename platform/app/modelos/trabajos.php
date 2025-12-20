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
			echo 'No se pudo tomar el trabajo. Intenta nuevamente.';
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
					echo 'Trabajo tomado correctamente';
				}
				else
				{
					echo 'No se pudo tomar el trabajo. Intenta nuevamente.';
				}
			}
			else
			{
				echo 'Este trabajo no está disponible.';
			}	
		}
	}
	public function actualizar_trabajo($id_trabajo, $horas_restantes)
	{
		if($id_trabajo == '')
		{
			echo 'No se pudo actualizar el trabajo. Intenta nuevamente.';
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
					echo 'Trabajo actualizado correctamente';
				}
				else
				{
					echo 'No se pudo actualizar el trabajo. Intenta nuevamente.';
				}
			}
			else
			{
				echo 'Este trabajo no se puede actualizar.';
			}
		}
	}
	public function terminar_trabajo($id_trabajo)
	{
		if($id_trabajo == '')
		{
			echo 'No se pudo terminar el trabajo. Intenta nuevamente.';
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
					echo 'Trabajo terminado correctamente';
				}
				else
				{
					echo 'No se pudo terminar el trabajo. Intenta nuevamente.';
				}
			}
			else
			{
				echo 'Este trabajo no se puede terminar.';
			}
		}
	}
	public function cancelar_trabajo($id_trabajo)
	{
		if($id_trabajo == '')
		{
			echo 'No se pudo cancelar el trabajo. Intenta nuevamente.';
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
					echo 'No se pudo cancelar el trabajo. Intenta nuevamente.';
				}
			}
			else
			{
				echo 'Este trabajo no se puede cancelar.';
			}
		}
	}
	public function calificar_trabajo($id_trabajo, $txt, $puntos, $id_coach, $id_usuario)
	{
		if($id_trabajo == '' || $txt == '' || $puntos == '' || $id_coach == '' || $id_usuario == '')
		{
			echo 'Completa todos los campos para realizar la calificación';
		}
		else
		{
			$hora = date("H:i:s");
			$fecha = date("Y-m-d");
			$this->codigosql = "INSERT INTO calificacion_coach VALUES (null, '$id_trabajo', '$txt', '$puntos', '$id_coach', '$id_usuario', '$fecha', '$hora')";
			$this->consulta_simple();
					
			if($this->consulta)
			{
				echo 'Calificación realizada correctamente';
			}
			else
			{
				echo 'No se pudo realizar la calificación. Intenta nuevamente.';
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
			echo 'Completa todos los campos';
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

										$contenido = ', espero que estés muy bien!</br>
Mi nombre es @UrgloBot y soy tu asistente virtual, simplemente uno más del equipo de especialistas dispuestos a atender cada una de tus dudas.</br>

Primero que todo, debo comentarte que luego que contratas uno de nuestros servicios, tendrás que esperar a que tu pago sea validado. Una vez este sea validado comenzaremos tu entrenamiento dentro de las primeras 24 horas posteriores a tu compra.</br>
Desde ahora estaré en todo momento notificándote por medio de nuevos mensajes el progreso de tu pedido y aprovechare de ir explicándote cada paso a seguir según corresponda. De todas formas, si tienes alguna consulta escríbenos a nuestro correo electrónico “s@urglo.com” .</br>
Esperamos que disfrutes del proceso, y por favor, no dudes en contáctanos en caso que tengas cualquier duda.</br></br>

* Recibirás este mensaje al realizar un pedido, incluso si este aún no ha sido pagado. La activación de su pedido puede tardar según el medio de pago elegido, puede comprobar el estado de su pago ingresando a su pedido.';
				$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden Entrenadores - coaching Latinoamerica', '$contenido', '$id_usuario', '1', '$fecha', '$hora', '0')";
				$this->consulta_simple();

				if($this->consulta)
				{
					$cliente = $this->datos_usuario($id_usuario);
					$contenido = '
					Tienes una nueva orden de @'.$cliente[0]['usuario'].', contáctate con el para coordinar el servicio. Recuerda ser cordial y satisfacer al cliente. Cualquier infracción a las normas será penalizada. 
					¡Que tengas un buen día entrenador! ';
					$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Tienes una nueva Orden Entrenadores - coaching Latinoamerica', '$contenido', '$coach', '2', '$fecha', '$hora', '0')";
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
			echo 'Completa todos los campos';
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

										$contenido = ', espero que estés muy bien!</br>
Mi nombre es @UrgloBot y soy tu asistente virtual, simplemente uno más del equipo de especialistas dispuestos a atender cada una de tus dudas.</br>

Primero que todo, debo comentarte que luego que contratas uno de nuestros servicios, tendrás que esperar a que tu pago sea validado. Una vez este sea validado comenzaremos tu entrenamiento dentro de las primeras 24 horas posteriores a tu compra.</br>
Desde ahora estaré en todo momento notificándote por medio de nuevos mensajes el progreso de tu pedido y aprovechare de ir explicándote cada paso a seguir según corresponda. De todas formas, si tienes alguna consulta escríbenos a nuestro correo electrónico “s@urglo.com” .</br>
Esperamos que disfrutes del proceso, y por favor, no dudes en contáctanos en caso que tengas cualquier duda.</br></br>

* Recibirás este mensaje al realizar un pedido, incluso si este aún no ha sido pagado. La activación de su pedido puede tardar según el medio de pago elegido, puede comprobar el estado de su pago ingresando a su pedido.';
				$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Nueva Orden Entrenadores - coaching Latinoamerica', '$contenido', '$id_usuario', '2', '$fecha', '$hora', '0')";
				$this->consulta_simple();

				if($this->consulta)
				{
					$cliente = $this->datos_usuario($id_usuario);
					$contenido = '
					Tienes una nueva orden de @'.$cliente[0]['usuario'].', contáctate con el para coordinar el servicio. Recuerda ser cordial y satisfacer al cliente. Cualquier infracción a las normas será penalizada. 
					¡Que tengas un buen día entrenador! ';
					$this->codigosql = "INSERT INTO mensajes VALUES (null, 'Tienes una nueva Orden Entrenadores - coaching Latinoamerica', '$contenido', '$coach', '1', '$fecha', '$hora', '0')";
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
				echo 'Pedido activado correctamente';
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
