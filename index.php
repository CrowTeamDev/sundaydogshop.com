<?php
 session_start();
 if (isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
 }else{
    $cart = null;
 }

 /*** error reporting on ***/
 error_reporting(E_ALL);

 /*** define the site path ***/
 $site_path = realpath(dirname(__FILE__));
 define ('__SITE_PATH', $site_path);

 /*** include the init.php file ***/
 include 'includes/init.php';

 /*** load the router ***/
 $registry->router = new router($registry);

 /*** set the controller path ***/
 $registry->router->setPath (__SITE_PATH . '/controller');

 /*** load up the template ***/
 $registry->template = new template($registry);
 
 /*** load up DB ***/
 $registry->shop = new shop($registry);
 
 $registry->product = new product($registry);
 
 $registry->config = new config($registry);

 /*** load up var ***/
 $contentUrl = $registry->config->getConfigValue('contentUrl');
?>

<!DOCTYPE html>
<!--
    index

    main view for everything
    all the process will be load into #main
-->
<html>
    <head>
        <title>SundayDog Shop</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        
        <link rel="stylesheet/less" type="text/css" href="<?php echo $contentUrl;?>/css/layout.less" />
        <link rel="stylesheet/less" type="text/css" href="<?php echo $contentUrl;?>/css/simplePagination.less" />
        <link rel="stylesheet" type="text/css" href="<?php echo $contentUrl;?>/css/jquery.vegas.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $contentUrl;?>/css/supersized.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo $contentUrl;?>/css/supersized.shutter.css" media="screen" />
        <script type="text/javascript" src="<?php echo $contentUrl;?>/js/shared/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="<?php echo $contentUrl;?>/js/shared/jquery-ui-1.10.3.js"></script>
        <script type="text/javascript" src="<?php echo $contentUrl;?>/js/shared/jquery.elevatezoom.js"></script>
        <script type="text/javascript" src="<?php echo $contentUrl;?>/js/shared/less-1.5.0.min.js"></script>
        <script type="text/javascript" src="<?php echo $contentUrl;?>/js/shared/jquery.easing.min.js"></script>
        <script type="text/javascript" src="<?php echo $contentUrl;?>/js/shared/supersized.3.2.7.min.js"></script>
        <script type="text/javascript" src="<?php echo $contentUrl;?>/js/shared/supersized.shutter.min.js"></script>
        
        <script type="text/javascript" src="<?php echo $contentUrl;?>/js/views/intro.js"></script>
        <script type="text/javascript" src="<?php echo $contentUrl;?>/js/views/index.js"></script>
        <script type="text/javascript" src="<?php echo $contentUrl;?>/js/model.js"></script>
        
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    </head>
    <body>
        <input type="hidden" id="local_path" value="<?php echo $contentUrl;?>" />
        <div id="intro_bg">
            <div id="intro_dog"></div>
            <div id="intro_logo"></div>
            <div id="intro_logo_bg"></div>
        </div>
        <header id="start_menu">
            <label>MENU ∨</label>
        </header>
        <header id="top_menu">
            <ul>
                <li id="current_directory"></li>
                <li id="your_cart">YOUR CART (<span>0</span>)</li>
            </ul>
        </header>
        <header id="navigation_bar">
            <img src="<?php echo $contentUrl;?>/content/image/logo_2.png" id="logo_2" title="SundayDog Shop" alt="SundayDog Shop" />
            <img src="<?php echo $contentUrl;?>/content/image/logo_1.png" id="logo_1" title="SundayDog Shop" alt="SundayDog Shop" />
            <ul id="main_menu">
                <li id="home">HOME</li>
                <li id="shop">SHOP</li>
                <li id="about">ABOUT US</li>
                <li id="community">OUR COMMUNITY</li>
            </ul>
        </header>
        <div id="background_1"></div>
        <div id="background_2"></div>
        <div id="main">
            <?php
                echo $registry->router->loader();
            ?>
        </div> 
	<div id="controls-wrapper" class="load-item">
            <div id="controls">
                <ul id="slide-list"></ul>
            </div>
	</div>   
        <footer>
            <label id="policy">POLICY</label>
            <label id="copyright">©SUNDAYDOG2013</label>
            <label id="contact">CONTACT US</label>
            <img src="<?php echo $contentUrl;?>/content/image/icon_2.png" title="SundayDog's Facebook" alt="facebook" />
            <img src="<?php echo $contentUrl;?>/content/image/icon_3.png" title="SundayDog's Instagram" alt="instagram" />
        </footer>
        <input type="hidden" id="myCart" value='<?php echo $cart; ?>' />
        <div id="popup"></div>
    </body>
</html>
