<?php
    $site_path = '../';
    define ('__SITE_PATH', $site_path);

    include $site_path . 'includes/init.php';
    $registry->config = new config($registry);
    $registry->transaction = new transaction($registry);

    /*** load up var ***/
    $accountName = $registry->config->getPaymentAccountName();
    $accountNo = $registry->config->getPaymentAccountNo();
    $bank = $registry->config->getPaymentAccountBank();
    $branch = $registry->config->getPaymentAccountBranch();

    $email = $registry->config->getConfigValue('payment_email');
    $totalCost = intval($_REQUEST['totalCost']);
    $shippingCost = intval($_REQUEST['shippingCost']);

    do{
        $refNo = generateRandomString();
    }while ($registry->transaction->checkRef($refNo));

    $summary = 
            "<a id='header'>You have chosen to pay by bank wire.</a>"
            . "<br><br><a>Please send us a bank wire with:</a>"
            . "<br><br>- An amount of <span id='total_pay'>" . number_format($totalCost + $shippingCost) . "</span> THB"
            . "<br><br>- To one of these accounts:"
            . "<br><br><ul>";
    
    for ($i = 0; $i < count($accountNo); $i++) {
            $summary .= "<li>the account owner of <span>" . $accountName[$i][0] . "</span>"
            . "<br>  with these details account number <span id='accountNo'>" . formatAccount($accountNo[$i][0]) . "</span> saving account."
            . "<br>  to <span>" . $bank[$i][0] . "</span>, " . $branch[$i][0] . " branch"
            . "</li>";
    }
    
    $summary .=
            "</ul><br><br>* Do not forget to insert your order reference <span>" . $refNo . "</span> in the subject of your bank wire."
            . "<br><br>** Please send a copy of your prove of payment to <span>" . $email . "</span>"
            . "<br>and refer to your reference <span id='ref_number'>" . $refNo . "</span>."
            . "<br><br><a id='header'>An e-mail has been sent to you with this information."
            . "<br>Your order will be sent as soon as we receive your settlement</a>";
    
    function generateRandomString($length = 8) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    function formatAccount($account){
        return substr($account, 0, 3)."-".substr($account, 3, 1)."-".substr($account, 4, 5)."-".substr($account, -1, 1);
    }
?>

<article id="payment_bankwire_detail"><?php echo $summary; ?></article>
<input id="refNo" type="hidden" value="<?php echo $refNo; ?>">