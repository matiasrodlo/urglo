<?php
if(isset($_POST['leaguecurrent']))
{
	$id_level_inicio = $_POST['leaguecurrent'];
	if(isset($_POST['divisioncurrent']))
	{
		$id_division_inicio = $_POST['divisioncurrent'];
		if(isset($_POST['points']))
		{
			$points = $_POST['points'];
			if(isset($_POST['lpgain']))
			{
				$lpgain = $_POST['lpgain'];
				if(isset($_POST['leaguedesired']))
				{
					$id_level_llegada = $_POST['leaguedesired'];
					if(isset($_POST['divisiondesired']))
					{
						$id_division_llegada = $_POST['divisiondesired'];
						if(isset($_POST['price']))
						{
							$precio = $_POST['price'];
							if(isset($_POST['lolserver']))
							{
								$id_server_lol = $_POST['lolserver'];
								if(isset($_POST['lolnick']))
								{
									$nick_lol = $_POST['lolnick'];
									if(isset($_POST['loluser']))
									{
										$loluser = $_POST['loluser'];
										if(isset($_POST['lolpass']))
										{
											$pass_lol = $_POST['lolpass'];
											if(isset($_POST['rp']))
											{
												$rp = $_POST['rp'];
												if(isset($_POST['ip']))
												{
													$ip = $_POST['ip'];
													$nombre = 'Impulso Liga / División';
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
													if($id_level_llegada == '6')
													{
														$id_level_llegada = '5';
													}
													elseif($id_level_llegada == '5')
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
													elseif($id_level_llegada == '7')
													{
														$id_level_llegada = '6';
													}

													if($id_division_inicio == '6' or $id_division_inicio == '22' or $id_division_inicio == '17' or $id_division_inicio == '12')
													{
														$id_division_inicio = '1';
													}
													elseif($id_division_inicio == '7' or $id_division_inicio == '23' or $id_division_inicio == '18' or $id_division_inicio == '13')
													{
														$id_division_inicio = '2';
													}
													elseif($id_division_inicio == '8' or $id_division_inicio == '24' or $id_division_inicio == '19' or $id_division_inicio == '14')
													{
														$id_division_inicio = '3';
													}
													elseif($id_division_inicio == '9' or $id_division_inicio == '25' or $id_division_inicio == '20' or $id_division_inicio == '15')
													{
														$id_division_inicio = '4';
													}
													elseif($id_division_inicio == '10' or $id_division_inicio == '26' or $id_division_inicio == '21' or $id_division_inicio == '16')
													{
														$id_division_inicio = '5';
													}
													
													if($id_division_llegada == '10' or $id_division_llegada == '16' or $id_division_llegada == '21' or $id_division_llegada == '26')
													{
														$id_division_llegada = '5';
													}
													elseif($id_division_llegada == '9' or $id_division_llegada == '25' or $id_division_llegada == '20' or $id_division_llegada == '15')
													{
														$id_division_llegada = '4';
													}
													elseif($id_division_llegada == '8' or $id_division_llegada == '19' or $id_division_llegada == '14' or $id_division_llegada == '24')
													{
														$id_division_llegada = '3';
													}
													elseif($id_division_llegada == '7' or $id_division_llegada == '23' or $id_division_llegada == '18' or $id_division_llegada == '13')
													{
														$id_division_llegada = '2';
													}
													elseif($id_division_llegada == '6' or $id_division_llegada == '22' or $id_division_llegada == '17' or $id_division_llegada == '12')
													{
														$id_division_llegada = '1';
													}
													elseif($id_division_llegada == '30')
													{
														$id_division_llegada = '';
													}
													$id_usuario = $_SESSION['id_usuario'];
													$resultado = $pedidos->agregar_gl_purchase($nombre, $loluser, $nick_lol, $pass_lol, $id_server_lol, $rp, $ip, $id_level_inicio, $id_division_inicio, $points, $lpgain, $id_level_llegada, $id_division_llegada, $precio, $id_usuario);
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
		}
	}			
}
?>