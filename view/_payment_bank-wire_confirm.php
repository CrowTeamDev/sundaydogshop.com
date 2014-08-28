<?php

    if (isset($_SESSION['cart'])){
        unset($_SESSION['cart']);
    }
    
    $site_path = '../';
    define ('__SITE_PATH', $site_path);

    include $site_path . 'includes/init.php';
    include $site_path . 'model/mail.class.php';
    $registry->config = new config($registry);
    $registry->transaction = new transaction($registry);

    $refNo = $_REQUEST['refNo'];
    $totalCost = intval($_REQUEST['totalCost']);
    $shippingCost = intval($_REQUEST['shippingCost']);
    $buyer_mail = $_REQUEST['email'];

    $registry->transaction->save($refNo, $totalCost + $shippingCost, $buyer_mail);
    
    $accountNo = $registry->config->getPaymentAccountNo();
    $accountName = $registry->config->getPaymentAccountName();
    $bank = $registry->config->getPaymentAccountBank();
    $branch = $registry->config->getPaymentAccountBranch();
    $email = $registry->config->getConfigValue('payment_email');
    
    $model = array(
        'refNo' => $refNo,
        'cart' => array(
            'items' => $_REQUEST['items'],
            'shippingCost' => $shippingCost,
            'totalCost' => $totalCost
        ),
        'buyer' => array(
            'name' => $_REQUEST['buyer'],
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
    
    $mail_pros = new mail($model);
    $mail_pros->sendMail($email, $buyer_mail);
    
    function formatAccount($account){
        return substr($account, 0, 3)."-".substr($account, 3, 1)."-".substr($account, 4, 5)."-".substr($account, -1, 1);
    }