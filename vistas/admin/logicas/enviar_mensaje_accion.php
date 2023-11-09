<?php
	if(isset($_POST['receptor']))
	{
		$receptor = $_POST['receptor'];
		if(isset($_POST['asunto']))
		{
			$asunto = $_POST['asunto'];
			if(isset($_POST['contenido']))
			{
				$contenido = $_POST['contenido'];
				$id_remitente = $_SESSION['id_usuario'];
				$id_receptor = $usuarios->id_usuario($receptor);
				$id_receptor = $id_receptor[0]['id_usuario'];
				$resultado = $mensajes->enviar_mensaje($id_remitente, $id_receptor, $asunto, $contenido);
				echo $resultado;
			}
		}
	}
?>