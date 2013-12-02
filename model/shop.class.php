<?php
class shop{
	public function getProduct() {
		$product->productList = db::getInstance()->query('SELECT name FROM Product');
		return  $product->productList;
	}
}
?>