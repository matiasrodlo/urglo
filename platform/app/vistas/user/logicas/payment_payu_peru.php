<?php
// Llenamos los parametros
$subject = ''.$_REQUEST['tipo'].'';
$amount = $_REQUEST['total']*1;
$idusuario = $_SESSION['id_usuario']*1;
$verificacion= rand ( 1, 9999999999);
$verificacion=$verificacion.'-'.$idusuario;

$llave= md5("L2GR6wyO2EjnTg01iXpp13Q6h3~571429~$verificacion~$amount~PEN")
?>

	<body>
  <div style="margin:5% 0%; text-align:   center; ">
<form method="post" action="https://gateway.payulatam.com/ppp-web-gateway" accept-charset="UTF-8">
&emsp; <input type="image" border="0" alt="" src="http://www.payulatam.com/img-secure-2015/boton_pagar_mediano.png" onclick="this.form.urlOrigen.value = window.location.href;">
&emsp; <input name="buttonId" type="hidden" value="Eg+2SMdIUsDSZ3RWXRmYJBoZp02QClsGEJ91sqs9MzilC1tG5zAWNQ==">
&emsp; <input name="ApiKey" type="hidden" value="L2GR6wyO2EjnTg01iXpp13Q6h3">
&emsp; <input name="merchantId" type="hidden" value="571429">
&emsp; <input name="accountId" type="hidden" value="575066">
&emsp; <input name="description" type="hidden" value="coaching">
&emsp; <input name="referenceCode" type="hidden" value="<?php echo $verificacion; ?>">
&emsp; <input name="amount" type="hidden" value="<?php echo $amount; ?>">
&emsp; <input name="tax" type="hidden" value="0.00">
&emsp; <input name="taxReturnBase" type="hidden" value="0">
&emsp; <input name="shipmentValue" value="0.00" type="hidden">
&emsp; <input name="currency" type="hidden" value="PEN">
&emsp; <input name="lng" type="hidden" value="es">
&emsp; <input name="sourceUrl" id="urlOrigen" value="" type="hidden">
&emsp; <input name="buttonType" value="SIMPLE" type="hidden">
&emsp; <input name="signature" value="<?php echo $llave; ?>" type="hidden">
</form>
</div>
	</body>