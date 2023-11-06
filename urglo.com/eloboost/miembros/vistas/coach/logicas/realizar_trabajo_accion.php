<?php
if (isset($_POST['tr'])) 
{
	$id_trabajo = $_POST['tr'];
	$id_coach = $_SESSION['id_usuario'];
	$resultado = $trabajos->realizar_trabajo($id_trabajo, $id_coach);
	echo $resultado;
}
?>