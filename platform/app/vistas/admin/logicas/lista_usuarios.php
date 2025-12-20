<?php
$html = file_get_contents(__DIR__ . '/../lista_usuarios.html');
$header_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/header.html');
$footer_desconectado = file_get_contents(__DIR__ . '/../plantilla_admin/footer.html');
	
$html = str_replace('{footer}', $footer_desconectado, $html);
$html = str_replace('{header}', $header_desconectado, $html);

require_once(__DIR__ . '/../../datos_usuario.php');

$list_usuarios = $usuarios->lista_usuarios();

$lista_usuarios = '';
if($list_usuarios == false || count($list_usuarios) == 0)
{
	$html = str_replace('{lista_usuarios}', '<tr class="empty-state">
			<td colspan="7" style="border:0px;text-align:center;padding:32px;color:#999;">No hay usuarios registrados.</td>
		</tr>', $html);
}
else
{
	for($i=0;$i<count($list_usuarios);$i++)
	{
		$id_usuario = $list_usuarios[$i]['id_usuario'];
		$datos_cuenta = $usuarios->datos_usuario($id_usuario);
		$datos_personal = $usuarios->datos_user_personal($id_usuario);

		$lista_usuarios.='
		<tr>
			<td>'.$datos_cuenta[0]['usuario'].'</td>
			<td>'.$datos_cuenta[0]['tipo'].'</td>
		<td>'.(isset($datos_personal[0]['nombre']) ? $datos_personal[0]['nombre'] : '').'</td>
		<td>'.(isset($datos_personal[0]['apellido']) ? $datos_personal[0]['apellido'] : '').'</td>
		<td>'.(isset($datos_personal[0]['correo']) ? $datos_personal[0]['correo'] : '').'</td>
		<td>'.(isset($datos_personal[0]['pais']) ? $datos_personal[0]['pais'] : '').'</td>
			<td><a class="btn_ag" href="'.RUTA_INDEX.'usuarios/'.$datos_cuenta[0]['usuario'].'">Ver</a></td>
		</tr>';
	}
	$html = str_replace('{lista_usuarios}', $lista_usuarios, $html);
}
$html = str_replace('{clase_usuarios}', 'Usuarios', $html);
$html = str_replace('{ruta}', RUTA, $html);
$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
echo $html;
?>
