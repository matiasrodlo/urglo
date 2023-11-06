<?php
	if(isset($_POST['leaguecurrent'])) 
	{
		$id_level = $_POST['leaguecurrent'];
		if(isset($_POST['number_wins']))
		{
			$number_wins = $_POST['number_wins'];
			if(isset($_POST['precio']))
			{
				$precio = $_POST['precio'];
				if(isset($_POST['lolserver']))
				{
					$id_server_lol = $_POST['lolserver'];
					if(isset($_POST['lolnick']))
					{
						$nick_lol = $_POST['lolnick'];
						if(isset($_POST['loluser']))
						{
							$user_lol = $_POST['loluser'];
							if(isset($_POST['lolpass']))
							{
								$pass_lol = $_POST['lolpass'];
								if(isset($_POST['rp']))
								{
									$rp = $_POST['rp'];
									if(isset($_POST['ip']))
									{
										$ip = $_POST['ip'];
										if($id_level == '1')
										{
											$id_level = '7';
										}
										$nombre = "Victorias Unranked";
										$id_usuario = $_SESSION['id_usuario'];
										$resultado = $pedidos->agregar_pg_purchase($nombre, $user_lol, $nick_lol, $pass_lol, $id_server_lol, $rp, $ip, $id_level, $number_wins, $precio, $id_usuario);
										echo $resultado;
									}
								}
							}
						}
					}
				}
			}
		}
	}
?>