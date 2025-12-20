<?php
	require_once(__DIR__ . '/../../../funciones/funciones.php');
	require_once(__DIR__ . '/../../../modelos/bd.php');
	require_once(__DIR__ . '/../../../modelos/usuarios.php');
	require_once(__DIR__ . '/../../../modelos/pedidos.php');
	require_once(__DIR__ . '/../../../modelos/mensajes.php');
	
	$usuarios = new Usuarios();
	$pedidos = new Pedidos();
	$mensajes = new Mensajes();
	
	$id_usuario = $_SESSION['id_usuario'];
	$id_pedido = $url[2];
	$orden = $pedidos->pedidos_coaching($id_pedido);
	
	if($orden == false || count($orden) == 0)
	{
		header('Location: ' . RUTA_INDEX . 'coaching/mis_ordenes');
		exit;
	}
	
	if($orden[0]['id_usuario'] != $id_usuario)
	{
		header('Location: ' . RUTA_INDEX . 'coaching/mis_ordenes');
		exit;
	}
	
	$tipo_pedido = $orden[0]['tipo_pedido'];
	
	$html = file_get_contents(__DIR__ . '/../plantilla_user/header.html');
	$footer = file_get_contents(__DIR__ . '/../plantilla_user/footer.html');
	
	require_once(__DIR__ . '/../../datos_usuario.php');
	
	if($tipo_pedido == '1')
	{
		$tipo_nombre = 'Coaching';
	}
	else
	{
		$tipo_nombre = 'Servicio #' . $tipo_pedido;
	}
	
	$estado = $orden[0]['estado'];
	if($estado == '0')
	{
		$estado_nombre = 'Pendiente';
		$estado_class = 'pendiente';
	}
	elseif($estado == '1')
	{
		$estado_nombre = 'No Pagado';
		$estado_class = 'no-pagado';
	}
	elseif($estado == '2')
	{
		$estado_nombre = 'En Proceso';
		$estado_class = 'en-proceso';
	}
	elseif($estado == '3')
	{
		$estado_nombre = 'Cancelado';
		$estado_class = 'cancelado';
	}
	elseif($estado == '4')
	{
		$estado_nombre = 'Terminado';
		$estado_class = 'terminado';
	}
	else
	{
		$estado_nombre = 'Desconocido';
		$estado_class = 'desconocido';
	}
	
	$coach_info = '';
	if($orden[0]['id_coach'] != null && $orden[0]['id_coach'] != '0')
	{
		$datos_coach = $usuarios->datos_usuario($orden[0]['id_coach']);
		if($datos_coach != false && count($datos_coach) > 0)
		{
			$coach_info = '<p><strong>Coach asignado:</strong> <a href="' . RUTA_INDEX . 'coachs/' . $datos_coach[0]['usuario'] . '">' . $datos_coach[0]['usuario'] . '</a></p>';
		}
	}
	else
	{
		$coach_info = '<p><strong>Coach asignado:</strong> <span style="color:#999;">Sin asignar</span></p>';
	}
	
	$content = '
	<ul class="breadcrumbs">
		<div class="wrapper-whilox">
			<li><a href="' . RUTA_INDEX . '">Home</a></li>
			<span class="separator"></span>
			<li><a href="' . RUTA_INDEX . 'coaching">Coaching</a></li>
			<span class="separator"></span>
			<li><a href="' . RUTA_INDEX . 'coaching/mis_ordenes">Mis Órdenes</a></li>
			<span class="separator"></span>
			<li>Orden #' . $id_pedido . '</li>
		</div>
	</ul>
	<section class="wrapper-whilox" style="padding:30px 0;">
		<div style="background:#fff;border:1px solid #e8e8e8;border-radius:5px;padding:30px;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
			<h2 style="margin:0 0 20px 0;font-size:24px;font-weight:300;">Orden de Coaching #' . $id_pedido . '</h2>
			<div style="margin-bottom:20px;">
				<p><strong>Tipo de servicio:</strong> ' . $tipo_nombre . '</p>
				' . $coach_info . '
				<p><strong>Estado:</strong> <span class="' . $estado_class . '">' . $estado_nombre . '</span></p>
			</div>
			<div style="margin-top:30px;">
				<a href="' . RUTA_INDEX . 'coaching/mis_ordenes" style="display:inline-block;padding:10px 20px;background:#71B8EE;color:#fff;text-decoration:none;border-radius:3px;">Volver a Mis Órdenes</a>
			</div>
		</div>
	</section>';
	
	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	$html = str_replace('{time}', time(), $html);
	
	echo $html;
	echo $content;
	echo $footer;
?>

