<?php
    class config{
        
	function getConfigValue($configName) {
            $query = "SELECT configValue FROM Config WHERE configName = '". $configName ."'";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            return $data[0][0];
	}
        
        function getPolicy() {
            $query = "SELECT configName, configValue FROM Config WHERE configName like 'policy%'";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            return $data;
	}
        
        function getPaymentMail() {
            $query = "SELECT configValue FROM Config WHERE configName = 'payment_email'";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            return $data;
        }
        
        function getPaymentAccountNo() {
            $query = "SELECT configValue FROM Config WHERE configName like 'payment_accountNo%' order by configName";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            return $data;
        }
        
        function getPaymentAccountName() {
            $query = "SELECT configValue FROM Config WHERE configName like 'payment_accountName%' order by configName";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            return $data;
        }
        
        function getPaymentAccountBank() {
            $query = "SELECT configValue FROM Config WHERE configName like 'payment_bank%' order by configName";
            $sql = db::getInstance()->query($query);
            $data = $sql->fetchAll();
            return $data;
        }
        
        function getPaymentAccountBranch() {
            $query = "SELECT configValue FROM Config WHERE configName like 'payment_branch' order by configName";
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
