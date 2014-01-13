<?php
class shop{
	public function getProduct() {
                $findBy = "";
                if(!empty($_GET['fb'])){
                    if($_GET['fb']=='c'){
                        $findBy = 'Catagory';
                    }
                    else if($_GET['fb']=='b'){
                        $findBy = 'Brand';
                    }
                    else if($_GET['fb']=='s'){
                        $findBy = 'size';
                    }
                    else if($_GET['fb']=='a'){
                        $findBy = 'all';
                    }
                }
                if(!empty($_GET['fb']) && empty($_GET['cn']) && empty($_GET['size'])){
                    if($_GET['fb']=='c' || $_GET['fb']=='b'){
                        $shop->findBy = db::getInstance()->query("SELECT * FROM ".$findBy."");
                    }
                    else if($_GET['fb']=='s'){
                        $shop->findBy = db::getInstance()->query("SELECT * FROM Product GROUP BY ".$findBy."");
                    }
                    return  $shop->findBy;
                }
                
                if(!empty($_GET['fb']) && (!empty($_GET['cn']) || !empty($_GET['size']))){
                    if(!empty($_GET['cn'])){
                        $shop->productList = db::getInstance()->query("SELECT * FROM Product WHERE catagories = ".$_GET['cn']."");
                        //echo $shop->productList->rowCount();
                    }
                    else if(!empty($_GET['size'])){
                        $shop->productList = db::getInstance()->query("SELECT * FROM Product WHERE size = '".$_GET['size']."'");
                        //echo $shop->productList->rowCount();
                    }
                    return  $shop->productList;
                }
	}
}
?>