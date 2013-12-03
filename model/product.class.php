<?php
    class product{

	public function getProduct() {
		$product->productList = db::getInstance()->query('SELECT * FROM Product');
		return  $product->productList;
                
	}
}
        
    
?>
