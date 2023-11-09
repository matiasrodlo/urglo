<?php
session_start();
header('Content-type: text/html; charset=utf-8');
define('RUTA_INDEX', 'http://'.$_SERVER['HTTP_HOST'].'/miembros/');
define('RUTA', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']).'/';
if(isset($_GET['url']))
{
	$url = explode("/", $_GET['url']);
}
else
{
	$url[0] = '';	
}
if(isset($_SESSION['usuario']))
{
	switch ($url[0]) 
	{
		/* MODULO REGISTRO */
		case 'registrarse':
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros');
		break;

		case 'agregar_usuario':
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros');
		break;
		/* FIN REGISTRO */
		
		case 'conectarse':
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros');
		break;

		case 'conectar_usuario':
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/miembros');
		break;
	}

	if($_SESSION['tipo'] == 'user')
	{
		switch ($url[0]) 
		{
			case '':
				require_once('controladores/usuarios.php');
			break;

			case 'perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'kiphu':
				require_once('controladores/usuarios.php');
			break;

			case 'mensajes':
				require_once('controladores/mensajes.php');
			break;

			case 'editar_personal_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'editar_password_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'img_perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'coaching':
				require_once('controladores/pedidos.php');
			break;

			case 'gl_purchase':
				require_once('controladores/pedidos.php');						
			break;

			case 'dqb_purchase':
				require_once('controladores/pedidos.php');						
			break;

			case 'pg_purchase':
				require_once('controladores/pedidos.php');						
			break;

			case 'ul_purchase':
				require_once('controladores/pedidos.php');						
			break;

			case 'win_purchase':
				require_once('controladores/pedidos.php');						
			break;

			case 'coachs':
				require_once('controladores/trabajos.php');
			break;

			case 'conversacion':
				require_once('controladores/mensajes.php');
			break;

			case 'sendMessage':
				require_once('controladores/mensajes.php');
			break;

			case 'calificar_coach':
				require_once('controladores/trabajos.php');
			break;

			case 'pago_efectivo':
				require_once('controladores/usuarios.php');
			break;

			case 'cerrar_sesion':
				require_once('controladores/usuarios.php');
			break;

			case ''.$url[0].'':
				//url con id codificada con sha 1
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'coach')
	{
		switch ($url[0]) 
		{
			case '':
				require_once('controladores/usuarios.php');
			break;

			case 'perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'miperfil':
				require_once('controladores/usuarios.php');
			break;

			case 'editar_miperfil':
				require_once('controladores/usuarios.php');
			break;	

			case 'editarmiperfil_coach_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'miperfil_coach_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'editarmiperfil_coach_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'trabajos':
				require_once('controladores/trabajos.php');
			break;

			case 'realizar_trabajo_accion':
				require_once('controladores/trabajos.php');
			break;

			case 'editar_personal_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'editar_password_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'mensajes':
				require_once('controladores/mensajes.php');
			break;

			case 'coachs':
				require_once('controladores/usuarios.php');
			break;

			case 'conversacion':
				require_once('controladores/mensajes.php');
			break;

			case 'sendMessage':
				require_once('controladores/mensajes.php');
			break;

			case 'img_perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'cerrar_sesion':
				require_once('controladores/usuarios.php');
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'coacher')
	{
		switch ($url[0]) 
		{
			case '':
				require_once('controladores/usuarios.php');
			break;

			case 'perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'editar_personal_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'editar_password_accion':
				require_once('controladores/usuarios.php');
			break;
			
			case 'img_perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'pedidos':
				require_once('controladores/pedidos.php');
			break;

			case 'pedidos_desocupados':
				require_once('controladores/usuarios.php');
			break;

			case 'pedidos_activos':
				require_once('controladores/usuarios.php');
			break;

			case 'pedidos_terminados':
				require_once('controladores/usuarios.php');
			break;

			case 'mensajes':
				require_once('controladores/mensajes.php');
			break;

			case 'conversacion':
				require_once('controladores/mensajes.php');
			break;

			case 'sendMessage':
				require_once('controladores/mensajes.php');
			break;
				
			case 'cerrar_sesion':
				require_once('controladores/usuarios.php');
			break;
		}
	}
	elseif($_SESSION['tipo'] == 'admin')
	{
		switch ($url[0]) 
		{
			case '':
				require_once('controladores/usuarios.php');
			break;

			case 'perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'mensajes':
				require_once('controladores/mensajes.php');
			break;
			
			case 'editar_personal_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'editar_password_accion':
				require_once('controladores/usuarios.php');
			break;

			case 'img_perfil':
				require_once('controladores/usuarios.php');
			break;

			case 'usuarios':
				require_once('controladores/usuarios.php');
			break;

			case 'coachs':
				require_once('controladores/usuarios.php');
			break;

			case 'coacher':
				require_once('controladores/usuarios.php');
			break;

			case 'cerrar_sesion':
				require_once('controladores/usuarios.php');
			break;
		}
	}
}
else
{
	switch ($url[0]) 
	{
		case '':
			require_once('vistas/desconectado/logicas/index_desconectado.php');
		break;
		
		/* MODULO REGISTRO */
		case 'registrarse':
			require_once('controladores/usuarios.php');
		break;

		case 'agregar_usuario':
			require_once('controladores/usuarios.php');
		break;
		/* FIN REGISTRO */
		
		case 'conectarse':
			require_once('controladores/usuarios.php');
		break;

		case 'coaching':
			require_once('controladores/pedidos.php');
		break;

		case 'coachs':
			require_once('controladores/trabajos.php');
		break;

		case 'conectar_usuario':
			require_once('controladores/usuarios.php');
		break;
	}
}
?>