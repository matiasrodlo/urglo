<?php
$html = file_get_contents('vistas/admin/lista_usuarios.html');
$header_desconectado = file_get_contents('vistas/admin/plantilla_admin/header.html');
$footer_desconectado = file_get_contents('vistas/admin/plantilla_admin/footer.html');
	
$html = str_replace('{footer}', $footer_desconectado, $html);
$html = str_replace('{header}', $header_desconectado, $html);

require_once('vistas/datos_usuario.php');

$list_usuarios = $usuarios->lista_usuarios();
$lista_usuarios = '';
for($i=0;$i<count($list_usuarios);$i++)
{
	$id_usuario = $list_usuarios[$i]['id_usuario'];
	$datos_cuenta = $usuarios->datos_usuario($id_usuario);
	$datos_personal = $usuarios->datos_user_personal($id_usuario);

	$lista_usuarios.='
	<tr style="background-color: #f2f2f2; color: #000;border-bottom: 1px solid #ddd;">
		<td>'.$datos_cuenta[0]['usuario'].'</td>
		<td>'.$datos_cuenta[0]['tipo'].'</td>
		<td>'.$datos_personal[0]['nombre'].'</td>
		<td>'.$datos_personal[0]['apellido'].'</td>
		<td>'.$datos_personal[0]['correo'].'</td>
		<td>'.$datos_personal[0]['pais'].'</td>
		<td><a class="btn_ag" href="http://urglo.com/miembros/usuarios/'.$datos_cuenta[0]['usuario'].'">Ver</a></td>
	</tr>';
}
if($list_usuarios == false)
{
	$html = str_replace('{lista_usuarios}', '<tr style="background-color:#fff;color:#000;">
			<td colspan="7" style="border:0px">No hay ningún usuario.</td>
		</tr>', $html);
}
else
{
	$html = str_replace('{lista_usuarios}', $lista_usuarios, $html);
}
$html = str_replace('{clase_usuarios}', 'Usuarios', $html);
$html = str_replace('{ruta}', RUTA, $html);
$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
echo $html;
?>