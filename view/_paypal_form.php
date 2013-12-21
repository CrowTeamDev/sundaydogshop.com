<?php
    $site_path = '../';
    define ('__SITE_PATH', $site_path);

    include $site_path . 'includes/init.php';
    $registry->config = new config($registry);
    $registry->transaction = new transaction($registry);

    do{
        $refNo = generateRandomString();
    }while ($registry->transaction->checkRef($refNo));

    function generateRandomString($length = 8) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
?>
 
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_xclick" />
    <input type="hidden" name="business" value="PXG755ZX9FAU6" />
    <input type="hidden" name="item_name" value="SundayDog Purchased" />
    <input type="hidden" name="currency_code" value="THB" />
    <input type="hidden" name="button_subtype" value="services" />
    <input type="hidden" name="no_note" value="1" />
    <input type="hidden" name="no_shipping" value="1" />
    <input type="hidden" name="invoice" value="<?php echo $refNo; ?>" />
    <input type="hidden" name="item_number" value="<?php echo $refNo; ?>" />
    <input type="hidden" name="image_url" value=""/>
    <input type="hidden" name="amount" value="<?php echo $_REQUEST['amount']; ?>" />
    <input type="hidden" name="first_name" value="<?php echo $_REQUEST['first_name']; ?>" />
    <input type="hidden" name="last_name" value="<?php echo $_REQUEST['last_name']; ?>" />
    <input type="hidden" name="address1" value="<?php echo $_REQUEST['address1']; ?>" />
    <input type="hidden" name="city" value="<?php echo $_REQUEST['city']; ?>" />
    <input type="hidden" name="state" value="<?php echo $_REQUEST['state']; ?>" />
    <input type="hidden" name="zip" value="<?php echo $_REQUEST['zip']; ?>" />
    <input type="hidden" name="country" value="<?php echo $_REQUEST['country']; ?>" />
    <input type="hidden" name="email" value="<?php echo $_REQUEST['email']; ?>" />
    <input type="hidden" name="night_phone_b" value="<?php echo $_REQUEST['night_phone_b']; ?>" />
</form>