<?php
   session_start();
   require_once(__DIR__ . '/index.php');

   $id_pedido = $_POST['billing'];
   $tipo_pedido = $_POST['tbilling'];
   $precio_pedido = $_POST['pbilling'];
   $billing_email = $_POST['billing_email'];
   $billing_first_name = $_POST['billing_first_name'];
   if(!trim($_POST['billing_first_name'])){
	   header('Location: '.RUTA_INDEX.'pedido.php?error=El nombre es requerido');
	   die;
   }
   if(!filter_var($_POST['billing_email'], FILTER_VALIDATE_EMAIL)){
	   header('Location: '.RUTA_INDEX.'pedido.php?error=El correo no es valido');
	   die;
   }
   $imgfile = $_FILES['billing_file'];
   if(strpos($imgfile["type"], "image") !== FALSE) {
  
   } else {
	 header('Location: '.RUTA_INDEX.'pedido.php?error=El archivo que has subido no es una imagen valida');
   }
   $namefile = $imgfile['name'];
   if(strpos($imgfile['name'], '.')){
      $extension_part = @explode('.', $imgfile['name']);
	  $namefile = $extension_part[0];
   }
   $dat = $imgfile['tmp_name'];
   $tad = getimagesize($dat);
   $type = 'jpg';
   if($datos[2]==1){$type = 'gif';}
   if($datos[2]==2){$type = 'jpg';}
   if($datos[2]==3){$type = 'png';}
   $namefilen = 'factura'.rand(100, 1000000);
   $urlnew = 'files/'.$namefilen.'.'.$type;
   $dmc = $_SERVER['DOCUMENT_ROOT'].'/';
   $l = move_uploaded_file($dat, $dcm.$urlnew);
   if(!$l){ header('Location: '.RUTA_INDEX.'pedido.php?error=Hubo un error subiendo el archivo a '.$dcm.'/'.$urlnew); die; }
   //$urlimg = $_SERVER['HTTP_HOST'].'/'.$urlnew;
   $urlimg = RUTA_INDEX . $urlnew;
   $cabeceras = "From: $billing_email\r\nContent-type: text/html\r\n";
   $htmlm = '<style>@font-face {font-family: "Arvo";font-style: normal;font-weight: 400;src: local("Arvo"), url("http://themes.googleusercontent.com/static/fonts/arvo/v6/WJ6D195CfbTRlIs49IbkFw.woff") format("woff");}@font-face {font-family: "Lato";font-style: normal;font-weight: 900;src: local("Lato Black"), local("Lato-Black"), url("http://themes.googleusercontent.com/static/fonts/lato/v7/BVtM30trf7q_jfqYeHfjtA.woff") format("woff");}.lato { font-family: \'Lato\'; }.arvo { font-family: \'Arvo\'; }</style><div style="background:#fff; border:1px solid #000; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; padding:10px; text-align:center;"><h2 style="padding:0;margin:0; margin-bottom:20px;" class="arvo">Factura</h2><p class="lato"><b>Tipo Pedido: '.$tipo_pedido.'</b></p><p class="lato">'.$billing_email.'</p><p class="lato" style="text-transform:uppercase;">'.$billing_first_name.'</p><p class="lato"><b>Precio: '.$precio_pedido.' $US</b></p><p class="lato"><b>ID PEDIDO: '.$id_pedido.'</b></p><img style="padding:10px;" src="'.$urlimg.'" /></div>';
   mail('s@urglo.com', 'Recibo de compra', $htmlm, $cabeceras);
   header('Location: '.RUTA_INDEX.'pedido.php?success=El recibo ha sido enviado correctamente');
?>
