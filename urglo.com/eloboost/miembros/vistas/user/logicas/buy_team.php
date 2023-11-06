<?php
	if(isset($_POST['total']))
	{
		$total = $_POST['total'];
		if(isset($_POST['horas']))
		{
			$horas = $_POST['horas'];
			if(isset($_POST['intereses']))
			{
				$intereses = $_POST['intereses'];
				if(isset($_POST['lolserver']))
				{
					$lolserver = $_POST['lolserver'];
					if(isset($_POST['nicklol']))
					{
						$nicklol = $_POST['nicklol'];
						if(isset($_POST['coach']))
						{
							$id_coach = $_POST['coach'];
							$id_usuario = $_SESSION['id_usuario'];
							$resultado = $trabajos->coach_team($total, $horas, $intereses, $lolserver, $nicklol, $id_coach, $id_usuario);
							echo $resultado;
						}		
					}
				}
			}
		}
	}
?>