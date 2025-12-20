<?php 
	session_start();
	require_once('modelos/bd.php');
	require_once('modelos/usuarios.php');
	require_once('modelos/mensajes.php');
	$usuarios = new Usuarios();
	$mensajes = new Mensajes();

	$html = file_get_contents('pedido.html');

	require_once('vistas/datos_usuario.php');
	$msj = '';
	if(isset($_GET['error']))
	{
        $msj = '<ul class="woocommerce-error">
               <li>'.strtoupper(htmlspecialchars(stripslashes($_GET['error']))).'</li>
            </ul>';
    }
    if(isset($_GET['success']))
    {
         $msj = '<div class="woocommerce-message" style="background:#009900!important;">
                   '.strtoupper(htmlspecialchars(stripslashes($_GET['success']))).'
           </div>';
    }

    $html = str_replace('{msj}', $msj, $html);
	$html = str_replace('{id_pedido}', $_POST['billing'], $html);
	$html = str_replace('{tipo_pedido}', $_POST['tbilling'], $html);
	$html = str_replace('{precio_pedido}', $_POST['pbilling'], $html);
    $html = str_replace('{ruta}', 'http://'.$_SERVER['HTTP_HOST'].'/coaching/', $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>
