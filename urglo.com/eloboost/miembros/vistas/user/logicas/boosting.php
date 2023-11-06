<?php
	$html = file_get_contents('vistas/user/boosting.html');
	$header_desconectado = file_get_contents('vistas/user/plantilla_user/header.html');
	$footer_desconectado = file_get_contents('vistas/user/plantilla_user/footer.html');
	
	$html = str_replace('{footer}', $footer_desconectado, $html);
	$html = str_replace('{header}', $header_desconectado, $html);

	require_once('vistas/datos_usuario.php');

	$servers = $usuarios->lista_server_lol();
	$lista_servers = '';
	for($i=0;$i<count($servers);$i++)
	{
		$lista_servers.='<option value="'.$servers[$i]['id_server'].'">'.$servers[$i]['nombre'].'</option>';
	}
	$html = str_replace('{lista_servers}', $lista_servers, $html);
	
	// Kiphu para usuarios de chile
	if($pais_usuario == 'Chile')
	{
		$chi = '
		<label>
            <span>Moneda</span>
            <select id="cphBody_ucDivisionBoosting1_ddlDesiredCurrency" onchange="updateLeagueBoostingPrice();">
                <option value="USD;$US;1.00">US Dollar</option>
                <option value="CLP;$;639.61">Peso Chileno</option>
            </select>
        </label>';
		$chi_1 = '
		<label>
			<span style="width:130px;text-align:right">Paga con kiphu</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/kiphu.png" width="90px" align="middle"/>
			    <input type="radio" value="kiphu" name="pay" style="box-shadow: none;"/>
			</i>
		</label>
		<label>
			<span style="width:130px;text-align:right">Paga en efectivo</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/efectivo.png" width="90px" align="middle"/>
			    <input type="radio" value="efectivo" name="pay" style="box-shadow: none;"/>
			</i>
		</label>
		<label>
			<span style="width:130px;text-align:right">Paga en Mercado Pago</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/mercadopago.png" width="90px" align="middle"/>
			    <input type="radio" value="mercadopagochile" name="pay" style="box-shadow: none;"/>
			</i>
		</label>
		';
		$chi_dqb = '
		<label>
			<span style="width:130px;text-align:right">Paga con kiphu</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/kiphu.png" width="90px" align="middle"/>
			    <input type="radio" value="kiphu" name="paydqb" style="box-shadow: none;"/>
			</i>
		</label>
		<label>
			<span style="width:130px;text-align:right">Paga en efectivo</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/efectivo.png" width="90px" align="middle"/>
			    <input type="radio" value="efectivo" name="paydqb" style="box-shadow: none;"/>
			</i>
		</label>
		<label>
			<span style="width:130px;text-align:right">Paga en Mercado Pago</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/mercadopago.png" width="90px" align="middle"/>
			    <input type="radio" value="mercadopagochile" name="pay" style="box-shadow: none;"/>
			</i>
		</label>
		<label>';
		$chi_unrankedwin = '
		<label>
			<span style="width:130px;text-align:right">Paga con kiphu</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/kiphu.png" width="90px" align="middle"/>
			    <input type="radio" value="kiphu" name="payunrankedwin" style="box-shadow: none;"/>
			</i>
		</label>
		<label>
			<span style="width:130px;text-align:right">Paga en efectivo</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/efectivo.png" width="90px" align="middle"/>
			    <input type="radio" value="efectivo" name="payunrankedwin" style="box-shadow: none;"/>
			</i>
		</label>
		<label>
			<span style="width:130px;text-align:right">Paga en Mercado Pago</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/mercadopago.png" width="90px" align="middle"/>
			    <input type="radio" value="mercadopagochile" name="pay" style="box-shadow: none;"/>
			</i>
		</label>';
		$chi_ul = '
		<label>
			<span style="width:130px;text-align:right">Paga con kiphu</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/kiphu.png" width="90px" align="middle"/>
			    <input type="radio" value="kiphu" name="payul" style="box-shadow: none;"/>
			</i>
		</label>
		<label>
			<span style="width:130px;text-align:right">Paga en efectivo</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/efectivo.png" width="90px" align="middle"/>
			    <input type="radio" value="efectivo" name="payul" style="box-shadow: none;"/>
			</i>
		</label>
		<label>
			<span style="width:130px;text-align:right">Paga en Mercado Pago</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/mercadopago.png" width="90px" align="middle"/>
			    <input type="radio" value="mercadopagochile" name="pay" style="box-shadow: none;"/>
			</i>
		</label>
		';
		$chi_win = '
		<label>
			<span style="width:130px;text-align:right">Paga con kiphu</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/kiphu.png" width="90px" align="middle"/>
			    <input type="radio" value="kiphu" name="paywin" style="box-shadow: none;"/>
			</i>
		</label>
		<label>
			<span style="width:130px;text-align:right">Paga en efectivo</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/efectivo.png" width="90px" align="middle"/>
			    <input type="radio" value="efectivo" name="paywin" style="box-shadow: none;"/>
			</i>
		</label>
		<label>
			<span style="width:130px;text-align:right">Paga en Mercado Pago</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/mercadopago.png" width="90px" align="middle"/>
			    <input type="radio" value="mercadopagochile" name="pay" style="box-shadow: none;"/>
			</i>
		</label>
		';
	}
	else if($pais_usuario == 'Argentina')
	{
		$chi = '
		<label>
            <span>Moneda</span>
            <select id="cphBody_ucDivisionBoosting1_ddlDesiredCurrency" onchange="updateLeagueBoostingPrice();">
                <option value="USD;$US;1.00">US Dollar</option>
                <option value="CLP;$;16.00">Peso Argentino</option>
            </select>
        </label>';
		$chi_1 = '
		<label>
			<span style="width:130px;text-align:right">Paga con MeradoPago</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/mercadopago.png" width="90px" align="middle"/>
			    <input type="radio" value="mercadopago" name="pay" style="box-shadow: none;"/>
			</i>
		</label>
		';
		$chi_dqb = '
		<label>
			<span style="width:130px;text-align:right">Paga con MeradoPago</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/mercadopago.png" width="90px" align="middle"/>
			    <input type="radio" value="mercadopago" name="pay" style="box-shadow: none;"/>
			</i>
		</label>';
		$chi_unrankedwin = '
		<label>
			<span style="width:130px;text-align:right">Paga con MeradoPago</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/mercadopago.png" width="90px" align="middle"/>
			    <input type="radio" value="mercadopago" name="pay" style="box-shadow: none;"/>
			</i>
		</label>';
		$chi_ul = '
		<label>
			<span style="width:130px;text-align:right">Paga con MeradoPago</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/mercadopago.png" width="90px" align="middle"/>
			    <input type="radio" value="mercadopago" name="pay" style="box-shadow: none;"/>
			</i>
		</label>';
		$chi_win = '
		<label>
			<span style="width:130px;text-align:right">Paga con MeradoPago</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/mercadopago.png" width="90px" align="middle"/>
			    <input type="radio" value="mercadopago" name="pay" style="box-shadow: none;"/>
			</i>
		</label>';
	}
	else if($pais_usuario == 'Peru')
	{
		$chi = '
		<label>
            <span>Moneda</span>
            <select id="cphBody_ucDivisionBoosting1_ddlDesiredCurrency" onchange="updateLeagueBoostingPrice();">
                <option value="USD;$US;1.00">US Dollar</option>
                <option value="CLP;$;3.27">Sol Peruano</option>
            </select>
        </label>';
		$chi_1 = '
		<label>
			<span style="width:130px;text-align:right">Paga con Payu</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/payu.png" width="90px" align="middle"/>
			    <input type="radio" value="payuperu" name="pay" style="box-shadow: none;"/>
			</i>
		</label>
		';
		$chi_dqb = '
		<label>
			<span style="width:130px;text-align:right">Paga con Payu</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/payu.png" width="90px" align="middle"/>
			    <input type="radio" value="payuperu" name="pay" style="box-shadow: none;"/>
			</i>
		</label>';
		$chi_unrankedwin = '
		<label>
			<span style="width:130px;text-align:right">Paga con Payu</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/payu.png" width="90px" align="middle"/>
			    <input type="radio" value="payuperu" name="pay" style="box-shadow: none;"/>
			</i>
		</label>';
		$chi_ul = '
		<label>
			<span style="width:130px;text-align:right">Paga con Payu</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/payu.png" width="90px" align="middle"/>
			    <input type="radio" value="payuperu" name="pay" style="box-shadow: none;"/>
			</i>
		</label>';
		$chi_win = '
		<label>
			<span style="width:130px;text-align:right">Paga con Payu</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/payu.png" width="90px" align="middle"/>
			    <input type="radio" value="payuperu" name="pay" style="box-shadow: none;"/>
			</i>
		</label>';
	}
	else if($pais_usuario == 'Mexico')
	{
		$chi = '
		<label>
            <span>Moneda</span>
            <select id="cphBody_ucDi21visionBoosting1_ddlDesiredCurrency" onchange="updateLeagueBoostingPrice();">
                <option value="USD;$US;1.00">US Dollar</option>
                <option value="CLP;$;21">Peso Mexicano</option>
            </select>
        </label>';
		$chi_1 = '
		<label>
			<span style="width:130px;text-align:right">Paga con Payu</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/payumexico.jpg" width="90px" align="middle"/>
			    <input type="radio" value="payumexico" name="pay" style="box-shadow: none;"/>
			</i>
		</label>
		';
		$chi_dqb = $chi_1;
		$chi_unrankedwin = $chi_1;
		$chi_ul = $chi_1;
		$chi_win = $chi_1;
	}
	else if($pais_usuario == 'Colombia')
	{
		$chi = '
		<label>
            <span>Moneda</span>
            <select id="cphBody_ucDivisionBoosting1_ddlDesiredCurrency" onchange="updateLeagueBoostingPrice();">
                <option value="USD;$US;1.00">US Dollar</option>
                <option value="CLP;$;2906">Peso Colombiano</option>
            </select>
        </label>';
		$chi_1 = '
		<label>
			<span style="width:130px;text-align:right">Paga con Payu</span>
			<i>
			    <img src="http://urglo.com/eloboost/miembros/images/payucolombia.jpg" width="90px" align="middle"/>
			    <input type="radio" value="payucolombia" name="pay" style="box-shadow: none;"/>
			</i>
		</label>
		';
		$chi_dqb = $chi_1;
		$chi_unrankedwin = $chi_1;
		$chi_ul = $chi_1;
		$chi_win = $chi_1;
	}
	else
	{
		$chi = '<select style="display:none" id="cphBody_ucDivisionBoosting1_ddlDesiredCurrency" onchange="updateLeagueBoostingPrice();">
                <option value="USD;$US;1.00">US Dollar</option>
            </select>';
		$chi_1 = '
                            <label>
                                <span style="width:130px;text-align:right;">Paga con PayPal</span>
                                    <i>
                                        <img src="{ruta_index}images/paypal.png" width="90px" align="middle"/>
                                        <input type="radio" value="paypal" name="pay" style="box-shadow: none;" checked/>
                                    </i>
                            </label>';
        $chi_dqb = '
                            <label>
                                <span style="width:130px;text-align:right;">Paga con PayPal</span>
                                    <i>
                                        <img src="{ruta_index}images/paypal.png" width="90px" align="middle"/>
                                        <input type="radio" value="paypal" name="pay" style="box-shadow: none;" checked/>
                                    </i>
                            </label>';
        $chi_unrankedwin = '
                            <label>
                                <span style="width:130px;text-align:right;">Paga con PayPal</span>
                                    <i>
                                        <img src="{ruta_index}images/paypal.png" width="90px" align="middle"/>
                                        <input type="radio" value="paypal" name="pay" style="box-shadow: none;" checked/>
                                    </i>
                            </label>';
        $chi_ul = '
                            <label>
                                <span style="width:130px;text-align:right;">Paga con PayPal</span>
                                    <i>
                                        <img src="{ruta_index}images/paypal.png" width="90px" align="middle"/>
                                        <input type="radio" value="paypal" name="pay" style="box-shadow: none;" checked/>
                                    </i>
                            </label>';
        $chi_win = '		<label>
                                <span style="width:130px;text-align:right;">Paga con PayPal</span>
                                    <i>
                                        <img src="{ruta_index}images/paypal.png" width="90px" align="middle"/>
                                        <input type="radio" value="paypal" name="pay" style="box-shadow: none;" checked/>
                                    </i>
                            </label>';
	}
	$html = str_replace('{chi}', $chi, $html);
	$html = str_replace('{chi_1}', $chi_1, $html);
	$html = str_replace('{chi_dqb}', $chi_dqb, $html);
	$html = str_replace('{chi_unrankedwin}', $chi_unrankedwin, $html);
	$html = str_replace('{chi_ul}', $chi_ul, $html);
	$html = str_replace('{chi_win}', $chi_win, $html);

	$html = str_replace('{ruta}', RUTA, $html);
	$html = str_replace('{ruta_index}', RUTA_INDEX, $html);
	echo $html;
?>
