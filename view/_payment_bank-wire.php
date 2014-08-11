<?php
    if (isset($_SESSION['cart'])){
        unset($_SESSION['cart']);
    }
    
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
    
    do{
        $refNo = generateRandomString();
    }while ($registry->transaction->checkRef($refNo));
    
    $totalCost = intval($_REQUEST['totalCost']);
    $shippingCost = intval($_REQUEST['shippingCost']);
    $buyyer_mail = $_REQUEST['email'];
    
    $model = array(
        'refNo' => $refNo,
        'cart' => array(
            'items' => $_REQUEST['items'],
            'shippingCost' => number_format($shippingCost),
            'totalCost' => $totalCost
        ),
        'buyyer' => array(
            'name' => $_REQUEST['buyyer'],
            'mobile' => $_REQUEST['mobile'],
            'phone' => $_REQUEST['phone'],
            'address' => $_REQUEST['address']
        ),
        'seller' => array(
            'accountNo' => $accountNo,
            'accountName' => $accountName,
            'bank' => $bank,
            'branch' => $branch,
            'email' => $email
        )
    );
    
    include $site_path . 'model/mail.class.php';
    $mail_pros = new mail($model);
    $mail_pros->sendMail($email, $buyyer_mail);
    
    $registry->transaction->save($refNo, $totalCost + $shippingCost, $buyyer_mail);
    
    $summary = 
            "<a id='header'>You have chosen to pay by bank wire.</a>"
            . "<br><br><a>Please send us a bank wire with:</a>"
            . "<br><br>- An amount of <span id='total_pay'>" . number_format($totalCost + $shippingCost) . "</span> THB"
            . "<br><br>- To one of these accounts:"
            . "<br><br><ul>";
    
    for ($i = 0; $i < count($accountNo); $i++) {
            $summary .= "<br>  the account owner of <span>" . $accountName[$i][0] . "</span>"
            . "<br>  with these details account number <span id='accountNo'>" . formatAccount($accountNo[$i][0]) . "</span> saving account."
            . "<br>  to <span>" . $bank[$i][0] . "</span>, " . $branch[$i][0] . " branch"
            . "<br>";
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
    function formatNumber($number){
        return substr($number, 0, 3)."-".substr($number, 3, 3)."-".substr($number, 6, strlen($number) - 6);
    }
?>

<article id="payment_bankwire_detail"><?php echo $summary; ?></article>