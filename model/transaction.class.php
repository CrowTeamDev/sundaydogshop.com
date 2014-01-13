<?php
    class transaction{
        
	function checkRef($refNo) {
            $query = "SELECT ref_no FROM Transaction WHERE ref_no = '". $refNo ."'";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            
            return count($data) != 0;
	}
        
        function save($refNo, $total, $mail, $method = 0) {
            $query = "INSERT INTO Transaction(ref_no, customer_email, total_cost, method) VALUES(:ref, :mail, :cost, :met)";
            $sql = db::getInstance()->prepare($query);
            $sql->bindParam(':ref', $refNo);
            $sql->bindParam(':cost', $total);
            $sql->bindParam(':mail', $mail);
            $sql->bindParam(':met', $method);
            
            $sql->execute();
        }
    }
?>
