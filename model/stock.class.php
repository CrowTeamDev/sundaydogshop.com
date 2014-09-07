<?php
    class stock{

	public function save($token, $email) {
            $query = "INSERT INTO Stock(token, email) VALUES(:token, :email)";
            $sql = db::getInstance()->prepare($query);
            $sql->bindParam(':token', $token);
            $sql->bindParam(':email', $email);
            
            $sql->execute();
        }
        
        public function checkToken($token) {
            $query = 'SELECT validation from Stock WHERE token = "'.$token.'"';
            $sql = db::getInstance()->query($query);
            if ($sql != null && $sql->rowCount()!=0){
                $data = $sql->fetchAll();
                return $data[0][0];
            }
            else{
                return null;
            }
        }
        
        public function getStock($category){
            $query = 'SELECT P.item_no, P.name, D.size, D.stock FROM Product_Detail D JOIN Product P on D.item_no = P.item_no '
                    . 'WHERE D.item_no LIKE "'.$category.'%" AND P.out_of_stock <> 1 ORDER BY D.item_no, D.size';
            $sql = db::getInstance()->query($query);
            if ($sql != null && $sql->rowCount()!=0){
                $data = $sql->fetchAll();
                return $data;
            }
            else{
                return null;
            }
        }
        
	public function update($item_no, $size, $stock) {
            $data = array($stock, $item_no, $size);
            
            $query = "UPDATE Product_Detail SET stock=? WHERE item_no=? AND size=?";
            $sql = db::getInstance()->prepare($query);
            $sql->execute($data);
        }
}