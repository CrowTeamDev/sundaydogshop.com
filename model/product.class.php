<?php
    class product{

	public function getProduct() {
                if(!empty($_GET["id"])){
                    $id = $_GET["id"];
                    $product->productList = db::getInstance()->query('SELECT * FROM Product where item_no='.$_GET["id"]."");
                    return  $product->productList;
                }
	}
}
        
    
?>
