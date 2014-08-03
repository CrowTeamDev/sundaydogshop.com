<?php
class shop{
	public function getProduct($groupBy,$listFilter) {
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
                            $conditionListOr = $conditionListOr."p.brands = $brandList[$x]";
                        if(!empty($brandList[$x+1]))
                            $conditionListOr = $conditionListOr." OR ";
                    }
                    $conditionList = $conditionListOr;
                }
                if(!empty($color)){
                    $colorList = split(',', $color);
                    $conditionListOr = null;
                    for($x=0;$x<count($colorList);$x++){
                        if(!empty($colorList[$x]))
                            $conditionListOr = "".$conditionListOr."pc.color = '$colorList[$x]'";
                        if(!empty($colorList[$x+1]))
                            $conditionListOr = $conditionListOr." OR ";
                    }
                    if(!empty($conditionList)){
                        $conditionList = "(".$conditionList.") AND (".$conditionListOr.")";
                    } else {
                        $conditionList = $conditionListOr;
                    }
                }
                if(!empty($size)){
                    $sizeList = split(',', $size);
                    $conditionListOr = null;
                    for($x=0;$x<count($sizeList);$x++){
                        if(!empty($sizeList[$x]))
                            $conditionListOr = "".$conditionListOr."ps.size = '$sizeList[$x]'";
                        if(!empty($sizeList[$x+1]))
                            $conditionListOr = $conditionListOr." OR ";
                    }
                    if(!empty($conditionList)){
                        $conditionList = "(".$conditionList.") AND (".$conditionListOr.")";
                    } else {
                        $conditionList = $conditionListOr;
                    }
                }
                if(!empty($groupBy)){
                    $sql = db::getInstance()->query("SELECT * FROM Product WHERE catagories = $groupBy");
                } else {
                    $sql = db::getInstance()->query("SELECT * FROM Product");
                }
                if(!empty($conditionList) && !empty($groupBy)){
                    $sql = db::getInstance()->query("SELECT p.*, pc.color as color, ps.size as size FROM Product p "
                            . "LEFT JOIN Product_Color pc ON p.item_no = pc.item_no "
                            . "LEFT JOIN Product_Size ps ON p.item_no = ps.item_no "
                            . "WHERE p.catagories = $groupBy AND $conditionList "
                            . "GROUP BY p.item_no");
                } else if(!empty($conditionList) && empty($groupBy)){
                    $sql = db::getInstance()->query("SELECT p.*, pc.color as color, ps.size as size FROM Product p "
                            . "LEFT JOIN Product_Color pc ON p.item_no = pc.item_no "
                            . "LEFT JOIN Product_Size ps ON p.item_no = ps.item_no "
                            . "WHERE $conditionList "
                            . "GROUP BY p.item_no");
                }
                $filterList = $this->getCategoryFilter($groupBy);
                if($sql != null){
                    if($sql->rowCount()!=0){
                        $viewSize = $sql->rowCount();
                        $data = $sql->fetchAll();
                    }
                }
//                if($sql != null){
//                    if($sql->rowCount()!=0){
//                        $viewSize = $sql->rowCount();
//                        $result = $sql->fetchAll();
//                        $data = $this->paginate($result,$viewSize,$viewMax,$viewIndex);
//                    }
//                }
//                $viewHigh = $viewSize/$viewMax;
//                $viewHigh = ceil($viewHigh);
                
//                return array ("data"=>$data,"viewHigh"=>$viewHigh, "filterList"=>$filterList);
                return array ("data"=>$data,"filterList"=>$filterList);
	}
        
        public function paginate($result, $viewSize, $viewMax, $viewIndex){
            $data = array_slice($result, ($viewIndex-1)*$viewMax, $viewMax);
            return $data;
        }
        
        public function getCategoryFilter($groupBy){
            $filterList = array();
            $whereCondition = "";
            if(!empty($groupBy)){
                $whereCondition = "WHERE p.catagories = $groupBy";
            }
            $brandList = db::getInstance()->query("SELECT * FROM Product p $whereCondition GROUP BY brands");
            if($brandList != null){
                if($brandList->rowCount()!=0){
                    $filterBrandList = array();
                    $brandList = $brandList->fetchAll();
                    foreach($brandList as $brand) {
                        $filterMap = array();
                        $brand_no = $brand['brands'];
                        $brandInfos = db::getInstance()->query("SELECT * FROM Brand WHERE brand_no = $brand_no");
                        $brandInfos = $brandInfos->fetchAll();
                        foreach($brandInfos as $brandInfo) {
                            $filterMap['brand_no'] = $brandInfo['brand_no'];
                            $filterMap['brand'] = $brandInfo['name'];
                        }
                        $filterBrandList[$brand_no] = $filterMap;    
                    }
                    $filterList['brand'] = $filterBrandList;
                }
            }
            $colorList = db::getInstance()->query("SELECT * FROM Product p LEFT JOIN Product_Color pc ON p.item_no = pc.item_no $whereCondition GROUP BY pc.color");
            if($colorList != null){
                if($colorList->rowCount()!=0){
                    $filterColorList = array();
                    $colorList = $colorList->fetchAll();
                    $count = 0;
                    foreach($colorList as $color) {
                        $filterMap = array();
                        $filterMap['color'] = $color['color'];
                        $filterColorList[$count] = $filterMap;
                        $count++;
                    }
                    $filterList['color'] = $filterColorList;
                }
            }
            $sizeList = db::getInstance()->query("SELECT * FROM Product p LEFT JOIN Product_Size ps ON p.item_no = ps.item_no $whereCondition GROUP BY ps.size");
            if($sizeList != null){
                if($sizeList->rowCount()!=0){
                    $filterSizeList = array();
                    $sizeList = $sizeList->fetchAll();
                    $count = 0;
                    foreach($sizeList as $size) {
                        if ($size['size'] != '-'){
                            $filterMap = array();
                            $filterMap['size'] = $size['size'];
                            $filterSizeList[$count] = $filterMap;
                            $count++;
                        }
                    }
                    $filterList['size'] = $filterSizeList;
                }
            }
            return $filterList;
        }
}
?>