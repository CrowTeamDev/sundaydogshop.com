<?php
    $site_path = '../';
    define ('__SITE_PATH', $site_path);

    include $site_path . 'includes/init.php';
    $registry->config = new config($registry);
    $registry->transaction = new transaction($registry);

    /*** load up var ***/
    $payment_detail = $registry->config->getPaymentDetail();
    
    $accountName = $payment_detail[0][0];
    $accountNo = $payment_detail[1][0];
    $bank = $payment_detail[2][0];
    $branch = $payment_detail[3][0];
    $email = $payment_detail[4][0];
    
    do{
        $refNo = generateRandomString();
    }while ($registry->transaction->checkRef($refNo));
    
    $totalCost = $_REQUEST['totalCost'];
    $shippingCost = $_REQUEST['shippingCost'];
    $items = $_REQUEST['items'];
    $buyyer = $_REQUEST['buyyer'];
    $mail = $_REQUEST['mail'];
    
    
    $message_detail = 
            "Dear " . $buyyer . ","
            . "<br>"
            . "<br>This mail was sent by SundayDog Shop"
            . "<br>As the summary of purchase on " . date('j M') . " via <b>bank-wire</b> payment method"
            . "<br>";
   
    foreach($items as $item){
        $qty = $item['qty'] != null ? intval($item['qty']) : 1;
        $total = intval($item['price']) * $qty;
        $message_detail .= "<br>"
                . "• " . $item['name']
                . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                . $item['price'] . " THB"
                . "&nbsp;&nbsp;&nbsp;"
                . "x" . $qty
                . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                . "<b>". $total ."</b> THB";
    }
    $message_detail .= "<br>• Shipping Cost <b>" . $shippingCost . "</b> THB";
    
    $message_detail .= "<br>"
            . "<br>Please send us a bank wire total amount of <b>" . $totalCost . "</b> THB"
            . "<br>To account number <b>" . $accountNo . "; "
            . $accountName . "</b> saving account of " . $bank . " (" . $branch . ")"
            . "<br>Do not forget to insert your order reference " . $refNo . " in the subject of your bank wire."
            . "<br>"
            . "<br>Your order will be sent as soon as we receive your settlement"
            . "<br>"
            . "<br>Please send a copy of your prove of payment back to this mail <<i>" . $email . "</i>>"
            . "<br>and also refer to your reference <b>" . $refNo . "</b>.";
   
    $registry->transaction->save($refNo, $totalCost, $mail);
    
    //Send mail
    $mail_to        = $mail;
    $mail_subject   = 'Order on SundayDog Shop: ' . $refNo;
    $mail_message   = $message_detail;
    
    $mail_header    = 'MIME-Version: 1.0' . "\r\n";
    $mail_header   .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $mail_header   .= 'From: SundayDog Shop <' . $email . '>' . "\r\n";
    $mail_header   .= 'Bcc: ' . $email;
    
    mail($mail_to, $mail_subject, $mail_message, $mail_header);
    
    $summary = 
            "You have chosen to pay by bank wire."
            . "<br>Please send us a bank wire with : "
            . "<br>• An amount of <span id='total_pay'>" . $totalCost . "</span> THB"
            . "<br>• To the account owner of <span>" . $accountName . "</span>"
            . "<br>• With these details account number <span id='accountNo'>" . $accountNo . "</span> saving account."
            . "<br>• To <span>" . $bank . "</span>, branch <span>" . $branch . "</span>"
            . "<br>• Do not forget to insert your order reference <span>" . $refNo . "</span> in the subject of your bank wire."
            . "<br>An e-mail has been sent to you with this information."
            . "<br>"
            . "<br>• Your order will be sent as soon as we receive your settlement"
            . "<br>"
            . "<br>Please send a copy of your prove of payment to <span>" . $email . "</span>"
            . "<br>and refer to your reference <span id='ref_number'>" . $refNo . "</span>.";
    
    function generateRandomString($length = 8) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
?>

<article id="payment_bankwire_detail"><?php echo $message_detail; ?></article>