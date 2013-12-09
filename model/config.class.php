<?php
    class config{
        
	function getURLPath($configName) {
                $query = "SELECT configValue FROM Config WHERE configName = '". $configName ."'";
		$sql = db::getInstance()->query($query);
		$data = $sql->fetchAll();
                return $data[0]['configValue'];
	}
}
        
    
?>
