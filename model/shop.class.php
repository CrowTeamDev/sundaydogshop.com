<?php
class shop{
	public function getProduct() {
                if(!empty($_GET['fb']) && empty($_GET['cn'])){
                    $shop->categoryList = db::getInstance()->query("SELECT * FROM Catagory");
                    return  $shop->categoryList;
                }
                if(!empty($_GET['fb']) && !empty($_GET['cn'])){
                    $shop->productList = db::getInstance()->query("SELECT * FROM Product WHERE catagories = ".$_GET['cn']."");
                    return  $shop->productList;
                }
	}
}
?>