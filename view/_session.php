<?php
    session_start();
    
    if ($_REQUEST['cart'] != null){
        $_SESSION['cart'] = $_REQUEST['cart'];
    }
    else{
        session_destroy();
    }