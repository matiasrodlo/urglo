<?php
$usuario = $url[1];
$html = file_get_contents('vistas/admin/perfil_usuario.html');
$header_desconectado = file_get_contents('vistas/admin/plantilla_admin/header.html');
$footer_desconectado = file_get_contents('vistas/admin/plantilla_admin/footer.html');
	
$html = str_replace('{footer}', $footer_desconectado, $html);
$html = str_replace('{header}', $header_desconectado, $html);

require_once('vistas/datos_usuario.php');

$resultado = $usuarios->id_usuario($usuario);
$id_usuario = $resultado[0]['id_usuario'];

$datos_cuenta_usuario = $usuarios->datos_usuario($id_usuario);
$datos_usuario = $usuarios->datos_user_personal($id_usuario);

$html = str_replace('{username}', $datos_cuenta_usuario[0]['usuario'], $html);
$html = str_replace('{password}', $datos_cuenta_usuario[0]['pass'], $html);
$html = str_replace('{tipo}', $datos_cuenta_usuario[0]['tipo'], $html);
$html = str_replace('{nombre}', $datos_usuario[0]['nombre'], $html);
$html = str_replace('{apellido}', $datos_usuario[0]['apellido'], $html);
$html = str_replace('{correo}', $datos_usuario[0]['correo'], $html);
$html = str_replace('{pp_email}', $datos_usuario[0]['pp_correo'], $html);
$html = str_replace('{telefono}', $datos_usuario[0]['telefono'], $html);
$html = str_replace('{pais}', $datos_usuario[0]['pais'], $html);

$html = str_replace('{nombre_usuario}', $usuario, $html);
$html = str_replace('{id_usuario}', $datos_usuario[0]['id_usuario'], $html);

$html = str_replace('{ruta}', RUTA, $html);
$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
echo $html;
?>