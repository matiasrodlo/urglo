<?php
if(isset($_POST['asunto']))
{
	$asunto = $_POST['asunto'];
	if(isset($_POST['contenido']))
	{
		$contenido = $_POST['contenido'];
		if(isset($_POST['rp']))
		{
			$id_receptor = $_POST['rp'];
			$id_remitente = $_SESSION['id_usuario'];
			$resultado = $mensajes->enviar_mensaje($id_remitente, $id_receptor, $asunto, $contenido);
			echo $resultado;
		}
	}
}
?>