<?php

// Llenamos los parametros
$receiver_id = '61553';
$subject = ''.$_POST['tipo'].'';
$body = '';
$amount = ''.$_POST['total'].'';
$notify_url = '';
$return_url = '';
$cancel_url = '';
$transaction_id = '';
$expires_date = time() + 30*24*60*60; //treinta dias a partir de ahora
$payer_email = '';
$bank_id='';
$picture_url = '';
$secret = 'd998ed99ccf410b4374c187641a815d5ebdb9a8e';
$custom = '';

$khipu_url = 'https://khipu.com/api/1.3/createPaymentPage';

$concatenated = "receiver_id=$receiver_id&subject=$subject&body=$body&amount=$amount&payer_email=$payer_email&bank_id=$bank_id&expires_date=$expires_date&transaction_id=$transaction_id&custom=$custom&notify_url=$notify_url&return_url=$return_url&cancel_url=$cancel_url&picture_url=$picture_url";

$hash = hash_hmac('sha256', $concatenated , $secret);

?>
<form action="<?php echo $khipu_url ?>" method="post">
<input type="hidden" name="receiver_id" value="<?php echo $receiver_id ?>"> 
<input type="hidden" name="subject" value="<?php echo $subject ?>"/>
<input type="hidden" name="body" value="<?php echo $body ?>">
<input type="hidden" name="amount" value="<?php echo $amount ?>">
<input type="hidden" name="notify_url" value="<?php echo $notify_url ?>"/>
<input type="hidden" name="return_url" value="<?php echo $return_url ?>"/>
<input type="hidden" name="cancel_url" value="<?php echo $cancel_url ?>"/>
<input type="hidden" name="custom" value="<?php echo $custom ?>">
<input type="hidden" name="transaction_id" value="<?php echo $transaction_id ?>">
<input type="hidden" name="payer_email" value="<?php echo $payer_email ?>">
<input type="hidden" name="expires_date" value="<?php echo $expires_date ?>">
<input type="hidden" name="bank_id" value="<?php echo $bank_id ?>">
<input type="hidden" name="picture_url" value="<?php echo $picture_url ?>">
<input type="hidden" name="hash" value="<?php echo $hash ?>">
<input type="image" name="submit" src="https://s3.amazonaws.com/static.khipu.com/buttons/200x50.png">
</form>