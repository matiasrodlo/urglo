<?php
// Llenamos los parametros
$subject = ''.$_REQUEST['tipo'].'';
$amount = $_REQUEST['total']*1;

require_once ('mercadopago.php');

$mp = new MP('6255551242009178', 'I7UTTMCpSHam8gPQxHineQg8xOJVAU1R');

$preference_data = array(
	"items" => array(
		array(
			"title" => $subject,
			"quantity" => 1,
			"currency_id" => "CLP", 
			"unit_price" => $amount
		)
	)
);

$preference = $mp->create_preference($preference_data);
?>

  <div style="margin:5% 0%; text-align:   center; ">
	<body>
		<a href="<?php echo $preference['response']['init_point']; ?>" style="  background: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  padding: 10px 20px 10px 20px;
  text-decoration: none;">Pagar por Mercado Pago</a>
	</body>
  </div>