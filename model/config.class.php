<?php
    class config{
        
	function getConfigValue($configName) {
            $query = "SELECT configValue FROM Config WHERE configName = '". $configName ."'";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            return $data[0][0];
	}
        
        function getPaymentDetail() {
            $query = "SELECT configValue FROM Config WHERE configName like 'payment_%' order by configName";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            return $data;
        }
}
        
    
?>
