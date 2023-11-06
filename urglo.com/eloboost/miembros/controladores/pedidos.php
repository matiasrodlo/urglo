<?php
require_once('funciones/funciones.php');
require_once('modelos/bd.php');
require_once('modelos/usuarios.php');
require_once('modelos/pedidos.php');
require_once('modelos/mensajes.php');

$usuarios = new Usuarios();
$pedidos = new Pedidos();
$mensajes = new Mensajes();

if (isset($_SESSION['usuario'])) 
{
	if($_SESSION['tipo'] == 'user')
	{
		switch ($url[0]) 
		{
			case 'boosting':
				if(isset($url[1]))
				{
					switch ($url[1]) 
					{
						case '':
							require_once('vistas/user/logicas/boosting.php');
						break;

						case 'mis_ordenes':
							if(isset($url[2]))
							{
								switch ($url[2]) 
								{
									case '':
										require_once('vistas/user/logicas/mis_ordenes_boosting.php');
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
											require_once('vistas/user/logicas/orden_boosting.php');	
										}
									break;	
								}
							}
							else
							{
								require_once('vistas/user/logicas/mis_ordenes_boosting.php');
							}
						break;
					}		
				}
				else
				{
					require_once('vistas/user/logicas/boosting.php');
				}
			break;
			
			case 'mis_ordenes':
				require_once('vistas/user/logicas/mis_ordenes.php');
			break;

			case 'gl_purchase':
				require_once('vistas/user/logicas/purchase_gl_accion.php');
			break;

			case 'dqb_purchase':
				require_once('vistas/user/logicas/purchase_dqb_accion.php');
			break;
						
			case 'pg_purchase':
				require_once('vistas/user/logicas/purchase_pg_accion.php');
			break;

			case 'ul_purchase':
				require_once('vistas/user/logicas/purchase_ul_accion.php');
			break;

			case 'win_purchase':
				require_once('vistas/user/logicas/purchase_win_accion.php');
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'coach')
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');	
	}
	elseif($_SESSION['tipo'] == 'elobooster')
	{
		if(isset($url[1]))
		{
			switch ($url[1]) 
			{
				case '':
					require_once('vistas/elobooster/logicas/lista_pedidos_libres.php');
				break;

				case ''.$url[1].'':
					$resultado = $pedidos->comprobar_pedido($url[1]);
					if($resultado == '')
					{
						header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/pedidos');
					}
					else
					{
						require_once('vistas/elobooster/logicas/ver_pedido.php');
					}
				break;
			}
		}
		else
		{
			require_once('vistas/elobooster/logicas/lista_pedidos_libres.php');
		}
	}
	elseif($_SESSION['tipo'] == 'admin')
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/eloboost/miembros/');
	}
}
else
{
	switch ($url[0]) 
	{
		case 'boosting':
			require_once('vistas/desconectado/logicas/boosting.php');
		break;
	}
}
?>