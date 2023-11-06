<?php
	if(isset($_POST['asunto']))
	{
		$asunto = $_POST['asunto'];
		if(isset($_POST['contenido']))
		{
			$contenido = $_POST['contenido'];
			$id_remitente = $_SESSION['id_usuario'];
			$id_receptor = 1;
			$resultado = $mensajes->enviar_mensaje($id_remitente, $id_receptor, $asunto, $contenido);
			echo $resultado;
		}
	}
?>