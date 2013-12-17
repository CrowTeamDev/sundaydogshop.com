<?php

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
        <script src="<?php echo $contentUrl;?>/js/shared/jquery-2.0.3.min.js" type="text/javascript"></script>
        <script src="<?php echo $contentUrl;?>/js/shared/less-1.5.0.min.js" type="text/javascript"></script>
        <script src="<?php echo $contentUrl;?>/js/views/index.js" type="text/javascript"></script>
        <script src="<?php echo $contentUrl;?>/js/model.js" type="text/javascript"></script>
    </head>
    <body>
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
            <img src="<?php echo $contentUrl;?>/content/image/logo_2.png" id="logo_2" title="SundayDog Logo" alt="SundayDog Shop" />
            <img src="<?php echo $contentUrl;?>/content/image/logo_1.png" id="logo_1" title="SundayDog Logo" alt="SundayDog Shop" />
            <ul>
                <li id="home">HOME</li>
                <li id="shop">SHOP</li>
                <li id="brand">BRANDS</li>
                <li id="about">ABOUT US</li>
                <li id="contact">CONTACT US</li>
                <li id="gallery">GALLERY</li>
            </ul>
        </header>
        <div id="background_1"></div>
        <div id="background_2"></div>
        <div id="main">
            <?php   
                echo $registry->router->loader();
            ?>
        </div>
        <footer>
            <label>POLICY</label>
            <label>COPYRIGHTS©</label>
            <img src="<?php echo $contentUrl;?>/content/image/icon_2.png" title="SundayDog's Facebook" alt="facebook" />
            <img src="<?php echo $contentUrl;?>/content/image/icon_3.png" title="SundayDog's Instagram" alt="instagram" />
        </footer>
        <input type="hidden" id="local_path" value="<?php echo $contentUrl;?>" />
    </body>
</html>
