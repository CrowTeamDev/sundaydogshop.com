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

    /*** load up var ***/
    $refNo = $_REQUEST['refNo'];
    $shippingCost = intval($_REQUEST['shippingCost']);
    $totalCost = intval($_REQUEST['totalCost']);
    $accountNo = $registry->config->getPaymentAccountNo();
    $accountName = $registry->config->getPaymentAccountName();
    $bank = $registry->config->getPaymentAccountBank();
    $branch = $registry->config->getPaymentAccountBranch();
    $email = $registry->config->getConfigValue('payment_email');

    $buyer_mail = $_REQUEST['email'];
    
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
    
    $registry->transaction->save($refNo, $totalCost + $shippingCost, $buyer_mail);
?>
