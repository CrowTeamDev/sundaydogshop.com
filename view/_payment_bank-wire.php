<?php
    $site_path = '../';
    define ('__SITE_PATH', $site_path);

    include $site_path . 'includes/init.php';
    $registry->config = new config($registry);

    /*** load up var ***/
    $payment_detail = $registry->config->getPaymentDetail();
    
    $accountName = $payment_detail[0][0];
    $accountNo = $payment_detail[1][0];
    $bank = $payment_detail[2][0];
    $branch = $payment_detail[3][0];
    $email = $payment_detail[4][0];
?>

<article id="payment_bankwire_detail"><pre>
You have chosen to pay by bank wire.
Please send us a bank wire with :  
• An amount of <span id="total_pay"></span> THB 
• To the account owner of <?php echo $accountName;?> 
• With these details account number <span id="accountNo"><?php echo $accountNo;?></span> saving account.
• To <?php echo $bank;?>, branch <?php echo $branch;?> 
• Do not forget to insert your order reference <span id="ref_number"></span> in the subject of your bank wire.
    An e-mail has been sent to you with this information.
    
• Your order will be sent as soon as we receive your settlement  

Please send a copy of your prove of payment to <?php echo $email;?> 
    and refer to your reference <span id="ref_number"></span>.
</pre></article>