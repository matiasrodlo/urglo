<?php
// Llenamos los parametros
$subject = ''.$_REQUEST['tipo'].'';
$amount = $_REQUEST['total']*1;

require_once ('mercadopago.php');

$mp = new MP('1556611174130737', '8NaQ8rXEMppjPXYZz5uNL0DhsL6rzhcq');

//$mp->sandboxMode(true);

$preference_data = array(
	"items" => array(
		array(
			"title" => $subject,
			"quantity" => 1,
			"currency_id" => "ARS", 
			"unit_price" => $amount,
            "email" => $_SESSION['id_usuario']
		)
	)
);

$preference = $mp->create_preference($preference_data);

?>

	<body>
  <div style="margin:5% 0%; text-align:   center; ">
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
  text-decoration: none;margin-top:10px;margin-bottom:10px;">Pagar por Mercado Pago</a>
	</body>
  </div>