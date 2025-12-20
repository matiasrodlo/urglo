<?php
require_once(__DIR__ . '/../funciones/funciones.php');
require_once(__DIR__ . '/../modelos/bd.php');
require_once(__DIR__ . '/../modelos/usuarios.php');
require_once(__DIR__ . '/../modelos/pedidos.php');
require_once(__DIR__ . '/../modelos/mensajes.php');

$usuarios = new Usuarios();
$pedidos = new Pedidos();
$mensajes = new Mensajes();

if (isset($_SESSION['usuario'])) 
{
	if($_SESSION['tipo'] == 'user')
	{
		switch ($url[0]) 
		{
			case 'coaching':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once(__DIR__ . '/../vistas/user/logicas/coaching.php');
						break;

						case 'mis_ordenes':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once(__DIR__ . '/../vistas/user/logicas/mis_ordenes_coaching.php');
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
											require_once(__DIR__ . '/../vistas/user/logicas/orden_coaching.php');	
										}
									break;	
								}
							}
							else
							{
								require_once(__DIR__ . '/../vistas/user/logicas/mis_ordenes_coaching.php');
							}
						break;
					}		
				}
				else
				{
					require_once(__DIR__ . '/../vistas/user/logicas/coaching.php');
				}
			break;
			
			case 'mis_ordenes':
				require_once(__DIR__ . '/../vistas/user/logicas/mis_ordenes.php');
			break;

			case 'coach_purchase':
				require_once(__DIR__ . '/../vistas/user/logicas/purchase_coach_accion.php');
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'coach')
	{
		header('Location: '.RUTA_INDEX);	
	}
	elseif($_SESSION['tipo'] == 'coach')
	{
		if(isset($url[1]))
		{
			switch ($url[1]) 
			{
				case '':
					require_once(__DIR__ . '/../vistas/coach/logicas/lista_pedidos_libres.php');
				break;

				case ''.$url[1].'':
					$resultado = $pedidos->comprobar_pedido($url[1]);
					if($resultado == '')
					{
						header('Location: '.RUTA_INDEX.'pedidos');
					}
					else
					{
						require_once(__DIR__ . '/../vistas/coach/logicas/ver_pedido.php');
					}
				break;
			}
		}
		else
		{
			require_once(__DIR__ . '/../vistas/coach/logicas/lista_pedidos_libres.php');
		}
	}
	elseif($_SESSION['tipo'] == 'admin')
	{
		header('Location: '.RUTA_INDEX);
	}
}
else
{
	switch ($url[0]) 
	{
		case 'coaching':
			require_once(__DIR__ . '/../vistas/desconectado/logicas/coaching.php');
		break;
	}
}
?>