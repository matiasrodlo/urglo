<?php
	if(isset($_POST['leaguecurrent']))
	{
		$id_level = $_POST['leaguecurrent'];
		if(isset($_POST['divisioncurrent']))
		{
			$id_division = $_POST['divisioncurrent'];
			if(isset($_POST['number_games']))
			{
				$games = $_POST['number_games'];
				if(isset($_POST['precio']))
				{
					$precio = $_POST['precio'];
					$nombre = 'Duo Queue coaching';
					if(isset($_POST['lolnick']))
					{
						$nick_lol = $_POST['lolnick'];
						if(isset($_POST['lolserver']))
						{
							$id_server_lol = $_POST['lolserver'];
							if($id_level == '1')
							{
								$id_level = '7';
							}
							elseif($id_level == '6')
							{
								$id_level = '5';
							}
							elseif($id_level == '5')
							{
								$id_level = '4';
							}
							elseif($id_level == '4')
							{
								$id_level = '3';
							}
							elseif($id_level == '3')
							{
								$id_level = '2';
							}
							elseif($id_level == '2')
							{
								$id_level = '1';
							}

							if($id_division == '10')
							{
								$id_division = '5';
							}
							elseif($id_division == '9')
							{
								$id_division = '4';
							}
							elseif($id_division == '8')
							{
								$id_division = '3';
							}
							elseif($id_division == '7')
							{
								$id_division = '2';
							}
							elseif($id_division == '6')
							{
								$id_division = '1';
							}
							
							elseif($id_division == '29')
							{
								$id_division = '0';
							}
							elseif($id_division == '26')
							{
								$id_division = '5';
							}
							elseif($id_division == '25')
							{
								$id_division = '4';
							}
							elseif($id_division == '24')
							{
								$id_division = '3';
							}
							elseif($id_division == '23')
							{
								$id_division = '2';
							}
							elseif($id_division == '22')
							{
								$id_division = '1';
							}

							elseif($id_division == '21')
							{
								$id_division = '5';
							}
							elseif($id_division == '20')
							{
								$id_division = '4';
							}
							elseif($id_division == '19')
							{
								$id_division = '3';
							}
							elseif($id_division == '18')
							{
								$id_division = '2';
							}
							elseif($id_division == '17')
							{
								$id_division = '1';
							}

							elseif($id_division == '16')
							{
								$id_division = '5';
							}
							elseif($id_division == '15')
							{
								$id_division = '4';
							}
							elseif($id_division == '14')
							{
								$id_division = '3';
							}
							elseif($id_division == '13')
							{
								$id_division = '2';
							}
							elseif($id_division == '12')
							{
								$id_division = '1';
							}
							$id_usuario = $_SESSION['id_usuario'];
							$resultado = $pedidos->agregar_dqb_purchase($nombre, $nick_lol, $id_server_lol, $id_level, $id_division, $games, $precio, $id_usuario);
							echo $resultado;
						}
					}
				}
			}
		}
	}
?>