<?php
    class transaction{
        
	function checkRef($refNo) {
            $query = "SELECT ref_no FROM transaction WHERE ref_no = '". $refNo ."'";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            
            return count($data) != 0;
	}
        
        function save($refNo, $total, $mail) {
            $query = "INSERT INTO transaction(ref_no, customer_email, total_cost) VALUES(:ref, :mail, :cost)";
            $sql = db::getInstance()->prepare($query);
            $sql->bindParam(':ref', $refNo);
            $sql->bindParam(':cost', $total);
            $sql->bindParam(':mail', $mail);
            
            $sql->execute();
        }
    }
?>
