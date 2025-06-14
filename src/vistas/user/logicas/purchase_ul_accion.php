<?php
	if(isset($_POST['leaguepasado']))
	{
		$id_level_pasado = $_POST['leaguepasado'];
		if(isset($_POST['leaguedesired']))
		{
			$id_level_llegada = $_POST['leaguedesired'];
			if(isset($_POST['divisiondesired']))
			{
				$id_division_llegada = $_POST['divisiondesired'];
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
											$nombre = "Impulso Sin clasificar Liga / División";
											if($id_level_pasado == '1')
											{
												$id_level_pasado = '7';
											}
											elseif($id_level_pasado == '6')
											{
												$id_level_pasado = '5';
											}
											elseif($id_level_pasado == '5')
											{
												$id_level_pasado = '4';
											}
											elseif($id_level_pasado == '4')
											{
												$id_level_pasado = '3';
											}
											elseif($id_level_pasado == '3')
											{
												$id_level_pasado = '2';
											}
											elseif($id_level_pasado == '2')
											{
												$id_level_pasado = '1';
											}
											if($id_level_llegada == '5')
											{
												$id_level_llegada = '4';
											}
											elseif($id_level_llegada == '4')
											{
												$id_level_llegada = '3';
											}
											elseif($id_level_llegada == '3')
											{
												$id_level_llegada = '2';
											}
											elseif($id_level_llegada == '2')
											{
												$id_level_llegada = '1';
											}
											if($id_division_llegada == '10')
											{
												$id_division_llegada = '5';
											}
											elseif($id_division_llegada == '26')
											{
												$id_division_llegada = '5';
											}
											elseif($id_division_llegada == '21')
											{
												$id_division_llegada = '5';
											}
											elseif($id_division_llegada == '16')
											{
												$id_division_llegada = '5';
											}
											$id_usuario = $_SESSION['id_usuario'];
											$resultado = $pedidos->agregar_ul_purchase($nombre, $user_lol, $nick_lol, $pass_lol, $id_server_lol, $rp, $ip, $precio, $id_level_pasado, $id_level_llegada, $id_division_llegada, $id_usuario);
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
	}
?>