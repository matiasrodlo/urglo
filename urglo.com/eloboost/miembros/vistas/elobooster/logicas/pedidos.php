<?php
	$id_boosting = $url[1];
	$orden = $pedidos->pedidos_boosting($id_boosting);
	if($orden[0]['tipo_pedido'] == 1)
	{
		require_once('vistas/elobooster/logicas/pedido_gl.php');
	}
	elseif($orden[0]['tipo_pedido'] == 2)
	{
		require_once('vistas/elobooster/logicas/pedido_dqb.php');
	}
	elseif($orden[0]['tipo_pedido'] == 3)
	{
		require_once('vistas/elobooster/logicas/pedido_pg.php');
	}
	elseif($orden[0]['tipo_pedido'] == 4)
	{
		require_once('vistas/elobooster/logicas/pedido_ul.php');
	}
	elseif($orden[0]['tipo_pedido'] == 5)
	{
		require_once('vistas/elobooster/logicas/pedido_win.php');
	}
?>