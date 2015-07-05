<?php
    class product{

	public function getProduct($id) {
            if(!empty($id)){
                return db::getInstance()->query('SELECT * FROM Product where item_no='.$id."");
            }
	}
        
        public function getColor($id) {
            if(!empty($id)){
                return db::getInstance()->query('SELECT color FROM Product_Color where item_no='.$id."");
            }
        }
        
        public function getSize($id) {
            if(!empty($id)){
                return db::getInstance()->query('SELECT size, price, weight, stock FROM Product_Detail where item_no='.$id.' and stock<>"0" ORDER BY weight DESC, size ASC');
            }
        }
        
        public function getStock($id) {
            if(!empty($id)){
                $sql = db::getInstance()->query('SELECT size, stock FROM Product_Detail where item_no='.$id.' and stock<>"0" ORDER BY size ASC');
                return $sql->fetchAll();
            }
        }
        
        public function getDimension($id) {
            if(!empty($id)){
                return db::getInstance()->query('SELECT size, dimension FROM Product_Detail where item_no='.$id.' ORDER BY size ASC');
            }
        }
}