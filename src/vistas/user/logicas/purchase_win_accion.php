<?php
	if(isset($_POST['leaguecurrent']))
	{
		$id_level_inicio = $_POST['leaguecurrent'];
		if(isset($_POST['divisioncurrent']))
		{
			$id_division_inicio = $_POST['divisioncurrent'];
			if(isset($_POST['precio']))
			{
				$precio = $_POST['precio'];
				if(isset($_POST['wins']))
				{
					$wins = $_POST['wins'];
					if(isset($_POST['lolserver']))
					{
						$id_server_lol = $_POST['lolserver'];
						if(isset($_POST['loluser']))
						{
							$user_lol = $_POST['loluser'];
							if(isset($_POST['lolnick']))
							{
								$nick_lol = $_POST['lolnick'];
								if(isset($_POST['lolpass']))
								{
									$pass_lol = $_POST['lolpass'];
									if(isset($_POST['rp']))
									{
										$rp = $_POST['rp'];
										if(isset($_POST['ip']))
										{
											$ip = $_POST['ip'];
											$nombre = "Impulso Victorias";
											if($id_level_inicio == '6')
											{
												$id_level_inicio = '5';
											}
											elseif($id_level_inicio == '5')
											{
												$id_level_inicio = '4';
											}
											elseif($id_level_inicio == '4')
											{
												$id_level_inicio = '3';
											}
											elseif($id_level_inicio == '3')
											{
												$id_level_inicio = '2';
											}
											elseif($id_level_inicio == '2')
											{
												$id_level_inicio = '1';
											}
											elseif($id_level_inicio == '7')
											{
												$id_level_inicio = '6';
											}
											if($id_division_inicio == '10')
											{
												$id_division_inicio = '5';
											}
											elseif($id_division_inicio == '9')
											{
												$id_division_inicio = '4';
											}
											elseif($id_division_inicio == '8')
											{
												$id_division_inicio = '3';
											}
											elseif($id_division_inicio == '7')
											{
												$id_division_inicio = '2';
											}
											elseif($id_division_inicio == '6')
											{
												$id_division_inicio = '1';
											}

											elseif($id_division_inicio == '26')
											{
												$id_division_inicio = '5';
											}
											elseif($id_division_inicio == '25')
											{
												$id_division_inicio = '4';
											}
											elseif($id_division_inicio == '24')
											{
												$id_division_inicio = '3';
											}
											elseif($id_division_inicio == '23')
											{
												$id_division_inicio = '2';
											}
											elseif($id_division_inicio == '22')
											{
												$id_division_inicio = '1';
											}

											elseif($id_division_inicio == '21')
											{
												$id_division_inicio = '5';
											}
											elseif($id_division_inicio == '20')
											{
												$id_division_inicio = '4';
											}
											elseif($id_division_inicio == '19')
											{
												$id_division_inicio = '3';
											}
											elseif($id_division_inicio == '18')
											{
												$id_division_inicio = '2';
											}
											elseif($id_division_inicio == '17')
											{
												$id_division_inicio = '1';
											}

											elseif($id_division_inicio == '16')
											{
												$id_division_inicio = '5';
											}
											elseif($id_division_inicio == '15')
											{
												$id_division_inicio = '4';
											}
											elseif($id_division_inicio == '14')
											{
												$id_division_inicio = '3';
											}
											elseif($id_division_inicio == '13')
											{
												$id_division_inicio = '2';
											}
											elseif($id_division_inicio == '12')
											{
												$id_division_inicio = '1';
											}

											elseif($id_division_inicio == '30')
											{
												$id_division_inicio = '';
											}
											$id_usuario = $_SESSION['id_usuario'];
											$resultado = $pedidos->agregar_win_purchase($nombre, $user_lol, $nick_lol, $pass_lol, $id_server_lol, $rp, $ip, $precio, $id_level_inicio, $id_division_inicio, $wins, $id_usuario);
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