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
    
    $registry->transaction->save($refNo, $cost, $buyyer);
    
    function generateRandomString($length = 8) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
?>

<article id="payment_bankwire_detail"><pre>
You have chosen to pay by bank wire.
Please send us a bank wire with :  
• An amount of <span id="total_pay"><?php echo $cost;?></span> THB 
• To the account owner of <span><?php echo $accountName;?></span> 
• With these details account number <span id="accountNo"><?php echo $accountNo;?></span> saving account.
• To <span><?php echo $bank;?></span>, branch <span><?php echo $branch;?></span> 
• Do not forget to insert your order reference <span><?php echo $refNo;?></span> in the subject of your bank wire.
    An e-mail has been sent to you with this information.
    
• Your order will be sent as soon as we receive your settlement  

Please send a copy of your prove of payment to <span><?php echo $email;?></span> 
    and refer to your reference <span id="ref_number"><?php echo $refNo;?></span>.
</pre></article>