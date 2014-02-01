<?php

Class shopController Extends baseController {
	public function index() 
	{
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
                $GLOBALS["findBy"] = $findBy;
                $result = $this->registry->shop->getProduct($groupBy,$findBy);
                if(!empty($findBy)){
                    $this->registry->template->productList = $result;
                }
                else{
                    $this->registry->template->groupList = $result;
                }
	        $this->registry->template->show('shop_index');
	}
}
?>