<?php
class shop{
	public function getProduct($filterBy,$findBy,$viewMax,$viewIndex) {
                $data = array();
                $sql = null;
                $viewHigh = 1;
                $viewSize = 0;
                if(!empty($filterBy) && empty($findBy) && $filterBy!='a'){
                    if($filterBy=='Catagory' || $filterBy=='Brand'){
                        $sql = db::getInstance()->query("SELECT * FROM ".$filterBy."");
                    }
                    else if($filterBy=='size'){
                        $sql = db::getInstance()->query("SELECT * FROM Product GROUP BY ".$filterBy."");
                    }
                }
                
                if(!empty($filterBy) && !empty($findBy) && $filterBy!='a'){
                    if($filterBy=='Catagory'){
                        $sql = db::getInstance()->query("SELECT * FROM Product WHERE catagories = ".$findBy."");
                    }
                    else if($filterBy=='size'){
                        $sql = db::getInstance()->query("SELECT * FROM Product WHERE size = '".$findBy."'");
                    }
                }
                else if($filterBy=='a'){
                    $sql = db::getInstance()->query("SELECT * FROM Product");
                }
                if($sql != null){
                    if($sql->rowCount()!=0){
                        $viewSize = $sql->rowCount();
                        $result = $sql->fetchAll();
                        $data = $this->paginate($result,$viewSize,$viewMax,$viewIndex);
                    }
                }
                
                $viewHigh = $viewSize/$viewMax;
                $viewHigh = ceil($viewHigh);
                
                return array ("data"=>$data,"viewHigh"=>$viewHigh);
	}
        public function paginate($result, $viewSize, $viewMax, $viewIndex){
            $data = array_slice($result, ($viewIndex-1)*$viewMax, $viewMax);
            return $data;
        }
}
?>