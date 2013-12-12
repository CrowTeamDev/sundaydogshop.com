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
    $cost = $_GET['cost'];
    $buyyer = $_GET['mail'];
    
    $detail = 
            "You have chosen to pay by bank wire."
            . "<br>Please send us a bank wire with : "
            . "<br>• An amount of <span id='total_pay'>" . $cost . "</span> THB"
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
    
    $registry->transaction->save($refNo, $cost, $buyyer);
    
    //Send mail
    $mail_to        = $buyyer;
    $mail_subject   = 'Order on SundayDog Shop: ' . $refNo;
    $mail_message   = $detail;
    $mail_header    = 'From: ' . $email . '\r\n' .
                      'Bcc: ' . $email;
    mail($mail_to, $mail_subject, $mail_message, $mail_header);
    
    function generateRandomString($length = 8) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
?>

<article id="payment_bankwire_detail"><?php echo $detail; ?></article>