<?php
class shop{
	public function getProduct($groupBy,$listFilter,$viewMax,$viewIndex) {
                $data = array();
                $sql = null;
                $viewHigh = 1;
                $viewSize = 0;
                $conditionList = null;
                if(!empty($listFilter)){
                    list($brand, $color, $size) = split('-', $listFilter);
                }
                if(!empty($brand)){
                    $brandList = split(',', $brand);
                    $conditionListOr = null;
                    for($x=0;$x<count($brandList);$x++){
                        if(!empty($brandList[$x]))
                            $conditionListOr = $conditionListOr."brands = $brandList[$x]";
                        if(!empty($brandList[$x+1]))
                            $conditionListOr = $conditionListOr." OR ";
                    }
                    $conditionList = $conditionListOr;
                }
//                if(!empty($color)){
//                    $colorList = split(',', $color);
//                    $conditionListOr = null;
//                    for($x=0;$x<count($colorList);$x++){
//                        if(!empty($colorList[$x]))
//                            $conditionListOr = "".$conditionListOr."color = '$colorList[$x]'";
//                        if(!empty($colorList[$x+1]))
//                            $conditionListOr = $conditionListOr." OR ";
//                    }
//                    $conditionList = "(".$conditionList.") AND (".$conditionListOr.")";
//                }
                if(!empty($size)){
                    $sizeList = split(',', $size);
                    $conditionListOr = null;
                    for($x=0;$x<count($sizeList);$x++){
                        if(!empty($sizeList[$x]))
                            $conditionListOr = "".$conditionListOr."size = '$sizeList[$x]'";
                        if(!empty($sizeList[$x+1]))
                            $conditionListOr = $conditionListOr." OR ";
                    }
                    $conditionList = "(".$conditionList.") AND (".$conditionListOr.")";
                }
//                if(!empty($filterBy) && empty($findBy) && $filterBy!='a'){
//                    if($filterBy=='Catagory' || $filterBy=='Brand'){
//                        $sql = db::getInstance()->query("SELECT * FROM ".$filterBy."");
//                    }
//                    else if($filterBy=='size'){
//                        $sql = db::getInstance()->query("SELECT * FROM Product GROUP BY ".$filterBy."");
//                    }
//                }
//                
//                if(!empty($filterBy) && !empty($findBy) && $filterBy!='a'){
//                    if($filterBy=='Catagory'){
//                        $sql = db::getInstance()->query("SELECT * FROM Product WHERE catagories = ".$findBy."");
//                    }
//                    else if($filterBy=='size'){
//                        $sql = db::getInstance()->query("SELECT * FROM Product WHERE size = '".$findBy."'");
//                    }
//                }
//                else if($filterBy=='a'){
//                    $sql = db::getInstance()->query("SELECT * FROM Product");
//                }
//                
//                // Show All Product
//                $sql = db::getInstance()->query("SELECT * FROM Product");
//                if($sql != null){
//                    if($sql->rowCount()!=0){
//                        $viewSize = $sql->rowCount();
//                        $result = $sql->fetchAll();
//                        $data = $this->paginate($result,$viewSize,$viewMax,$viewIndex);
//                    }
//                }
                if(!empty($groupBy)){
                    $sql = db::getInstance()->query("SELECT * FROM Product WHERE catagories = $groupBy");
                }
                if(!empty($conditionList) && !empty($groupBy)){
                    $sql = db::getInstance()->query("SELECT * FROM Product WHERE catagories = $groupBy AND $conditionList");
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