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
        
        function getContactDetail() {
            $query = "SELECT configValue FROM Config WHERE configName like 'contact_%' order by configName";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            return $data;
        }
        
        function getFAQQuestion() {
            $query = "SELECT configValue FROM Config WHERE configName like 'FAQ_question-%' order by configName";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            return $data;
        }
        
        function getFAQAnswer() {
            $query = "SELECT configValue FROM Config WHERE configName like 'FAQ_answer-%' order by configName";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            return $data;
        }
        
        function getShippingOption() {
            $query = "SELECT configName,configValue FROM Config WHERE configName like 'shipping_%' order by configValue";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            return $data;
        }
    }
?>
