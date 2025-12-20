<?php
$usuario = $url[1];
$html = file_get_contents(__DIR__ . '/../perfil_usuario.html');
$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/header.html');
$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/footer.html');
	
$html = str_replace('{footer}', $footer_desconectado, $html);
$html = str_replace('{header}', $header_desconectado, $html);

require_once(__DIR__ . '/../../datos_usuario.php');

$resultado = $usuarios->id_usuario($usuario);
$id_usuario = $resultado[0]['id_usuario'];

$datos_cuenta_usuario = $usuarios->datos_usuario($id_usuario);
$datos_usuario = $usuarios->datos_user_personal($id_usuario);

$html = str_replace('{username}', isset($datos_cuenta_usuario[0]['usuario']) ? $datos_cuenta_usuario[0]['usuario'] : '', $html);
$html = str_replace('{password}', isset($datos_cuenta_usuario[0]['pass']) ? $datos_cuenta_usuario[0]['pass'] : '', $html);
$html = str_replace('{tipo}', isset($datos_cuenta_usuario[0]['tipo']) ? $datos_cuenta_usuario[0]['tipo'] : '', $html);
$html = str_replace('{nombre}', isset($datos_usuario[0]['nombre']) ? $datos_usuario[0]['nombre'] : '', $html);
$html = str_replace('{apellido}', isset($datos_usuario[0]['apellido']) ? $datos_usuario[0]['apellido'] : '', $html);
$html = str_replace('{correo}', isset($datos_usuario[0]['correo']) ? $datos_usuario[0]['correo'] : '', $html);
$html = str_replace('{pp_email}', isset($datos_usuario[0]['pp_correo']) ? $datos_usuario[0]['pp_correo'] : '', $html);
$html = str_replace('{telefono}', isset($datos_usuario[0]['telefono']) ? $datos_usuario[0]['telefono'] : '', $html);
$html = str_replace('{pais}', isset($datos_usuario[0]['pais']) ? $datos_usuario[0]['pais'] : '', $html);

$html = str_replace('{nombre_usuario}', $usuario, $html);
$html = str_replace('{id_usuario}', $datos_usuario[0]['id_usuario'], $html);

$html = str_replace('{ruta}', RUTA, $html);
$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
echo $html;
?>