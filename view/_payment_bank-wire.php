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
    $payment_detail = $registry->config->getPaymentDetail();
    
    $accountName = $payment_detail[0][0];
    $accountNo = $payment_detail[1][0];
    $bank = $payment_detail[2][0];
    $branch = $payment_detail[3][0];
    $email = $payment_detail[4][0];
    
    do{
        $refNo = generateRandomString();
    }while ($registry->transaction->checkRef($refNo));
    
    $totalCost = intval($_REQUEST['totalCost']);
    $buyyer_mail = $_REQUEST['email'];
    
    $model = array(
        'refNo' => $refNo,
        'cart' => array(
            'items' => $_REQUEST['items'],
            'shippingCost' => number_format(intval($_REQUEST['shippingCost'])),
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
    
    $registry->transaction->save($refNo, $totalCost, $buyyer_mail);
    
    $summary = 
            "You have chosen to pay by bank wire."
            . "<br>Please send us a bank wire with : "
            . "<br>• An amount of <span id='total_pay'>" . number_format($totalCost) . "</span> THB"
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
    function formatAccount($account){
        return substr($account, 0, 3)."-".substr($account, 3, 6)."-".substr($account, -1, 1);
    }
    function formatNumber($number){
        return substr($number, 0, 3)."-".substr($number, 3, 3)."-".substr($number, 6, strlen($number) - 6);
    }
?>

<article id="payment_bankwire_detail"><?php echo $summary; ?></article>