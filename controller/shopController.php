<?php

Class shopController Extends baseController {
	public function index() 
	{
                $viewMax = 12;
                $viewIndex = 1;
                $groupBy = '';
                $findBy = '';
                if(!empty($_REQUEST["gb"])){
                    if($_REQUEST['gb']=='c'){
                        $groupBy = 'Catagory';
                        if(!empty($_REQUEST['f'])){
                            $findBy = $_REQUEST['f'];
                        }
                    }
                    else if($_REQUEST['gb']=='b'){
                        $groupBy = 'Brand';
                    }
                    else if($_REQUEST['gb']=='s'){
                        $groupBy = 'size';
                        if(!empty($_REQUEST['f'])){
                            $findBy = $_REQUEST['f'];
                        }
                    }
                    else if($_REQUEST['gb']=='a'){
                        $groupBy = 'a';
                        $findBy = 'any';
                    }
                }
                
                if(!empty($_REQUEST["viewIndex"])){
                    $viewIndex = $_REQUEST["viewIndex"];
                }
                
                $GLOBALS["findBy"] = $findBy;
                $result = $this->registry->shop->getProduct($groupBy,$findBy,$viewMax,$viewIndex);
                if(!empty($findBy)){
                    $this->registry->template->productList = $result["data"];
                }
                else{
                    $this->registry->template->groupList = $result["data"];
                }
                $this->registry->template->viewHigh = $result["viewHigh"];
                $this->registry->template->viewIndex = $viewIndex;
                
	        $this->registry->template->show('shop_index');
	}
}
?>