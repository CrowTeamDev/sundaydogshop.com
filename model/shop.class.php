<?php
class shop{
	public function getProduct($filterBy,$findBy) {
                if(!empty($filterBy) && empty($findBy) && $filterBy!='a'){
                    if($filterBy=='Catagory' || $filterBy=='Brand'){
                        $sql = db::getInstance()->query("SELECT * FROM ".$filterBy."");
                        $data = $sql->fetchAll();
                    }
                    else if($filterBy=='size'){
                        $sql = db::getInstance()->query("SELECT * FROM Product GROUP BY ".$filterBy."");
                        $data = $sql->fetchAll();
                    }
                    return  $data;
                }
                
                if(!empty($filterBy) && !empty($findBy) && $filterBy!='a'){
                    if($filterBy=='Catagory'){
                        $sql = db::getInstance()->query("SELECT * FROM Product WHERE catagories = ".$findBy."");
                        $data = $sql->fetchAll();
                        //echo $shop->productList->rowCount();
                    }
                    else if($filterBy=='size'){
                        $sql = db::getInstance()->query("SELECT * FROM Product WHERE size = '".$findBy."'");
                        $data = $sql->fetchAll();
                        //echo $shop->productList->rowCount();
                    }
                    return  $data;
                }
                else if($filterBy=='a'){
                    $sql = db::getInstance()->query("SELECT * FROM Product");
                    $data = $sql->fetchAll();
                    return  $data;
                }
	}
}
?>