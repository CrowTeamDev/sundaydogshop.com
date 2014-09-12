<?php
    $site_path = '../';
    define ('__SITE_PATH', $site_path);

    include $site_path . 'includes/init.php';
    $registry->stock = new stock($this->registry);

    if(isset($_POST["token"])){
        $validate_time = $registry->stock->checkToken($_POST["token"]);
        if(
            isset($_POST["product"]) &&
            time() - strtotime($validate_time) < 7200
        ) {
            foreach ($_POST["product"] as $item) {
                $registry->stock->update($item["number"], $item["size"], $item["stock"]);
            }
        }
    }