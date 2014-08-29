<?php
    class product{

	public function getProduct($id) {
            if(!empty($id)){
                $product->productList = db::getInstance()->query('SELECT * FROM Product where item_no='.$id."");
                return $product->productList;
            }
	}
        
        public function getColor($id) {
            if(!empty($id)){
                $product->colorList = db::getInstance()->query('SELECT color FROM Product_Color where item_no='.$id."");
                return $product->colorList;
            }
        }
        
        public function getSize($id) {
            if(!empty($id)){
                $sizeList = db::getInstance()->query('SELECT size, price, weight, out_of_stock, color_out FROM Product_Size where item_no='.$id.' ORDER BY weight DESC, size ASC');
                return $sizeList;
            }
        }
        
        public function getDimension($id) {
            if(!empty($id)){
                return db::getInstance()->query('SELECT size, dimension FROM Product_Size where item_no='.$id.' ORDER BY size ASC');
            }
        }
}