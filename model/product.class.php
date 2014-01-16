<?php
    class product{

	public function getProduct($id) {
                if(!empty($id)){
                    $product->productList = db::getInstance()->query('SELECT * FROM Product where item_no='.$id."");
                    return $product->productList;
                }
	}
}