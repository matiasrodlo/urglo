<?php
	$id_coaching = $url[2];
	$orden = $pedidos->pedidos_coaching($id_coaching);
	if($orden[0]['tipo_pedido'] == 1)
	{
		require_once('vistas/admin/logicas/pedido_gl.php');
	}
	elseif($orden[0]['tipo_pedido'] == 2)
	{
		require_once('vistas/admin/logicas/pedido_dqb.php');
	}
	elseif($orden[0]['tipo_pedido'] == 3)
	{
		require_once('vistas/admin/logicas/pedido_pg.php');
	}
	elseif($orden[0]['tipo_pedido'] == 4)
	{
		require_once('vistas/admin/logicas/pedido_ul.php');
	}
	elseif($orden[0]['tipo_pedido'] == 5)
	{
		require_once('vistas/admin/logicas/pedido_win.php');
	}
?>