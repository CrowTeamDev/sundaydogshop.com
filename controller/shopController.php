<?php

Class shopController Extends baseController {
    public function index() 
    {
        if(!empty($_REQUEST["gb"])){
//            $viewMax = 12;
//            $viewIndex = 1;
            $groupBy = '';
            $listFilter = '';
            if($_REQUEST['gb']=='e'){
                $groupBy = "10000";
            }
            if($_REQUEST['gb']=='p'){
                $groupBy = "10001";
            }
            if($_REQUEST['gb']=='wa'){
                $groupBy = "10002";
            }
            if($_REQUEST['gb']=='we'){
                $groupBy = "10003";
            }
            if($_REQUEST['gb']=='sa'){
                $groupBy = "10004";
            }
            if($_REQUEST['gb']=='s'){
                $groupBy = "10004";
            }
            if($_REQUEST['gb']=='a'){
                $groupBy = "";
            }
            
//            if(!empty($_REQUEST["viewIndex"])){
//                $viewIndex = $_REQUEST["viewIndex"];
//            }
//            $result = $this->registry->shop->getProduct($groupBy, $findBy, $viewMax, $viewIndex);
            $result = $this->registry->shop->getProduct($groupBy, $listFilter);
            $this->registry->template->groupList = $result["data"];
            $this->registry->template->filterList = $result["filterList"];
            
//            $this->registry->template->viewHigh = $result["viewHigh"];
//            $this->registry->template->viewIndex = $viewIndex;
            $this->registry->template->groupBy = $_REQUEST['gb'];

            $this->registry->template->show('shop_index');
        }
        else{
            $this->registry->template->show('shop');
        }
    }
    
    public function productAjax() 
    {
        if(!empty($_REQUEST["gb"])){
            $groupBy = '';
            $listFilter = '';
            if($_REQUEST['gb']=='e'){
                $groupBy = "10000";
            }
            if($_REQUEST['gb']=='p'){
                $groupBy = "10001";
            }
            if($_REQUEST['gb']=='wa'){
                $groupBy = "10002";
            }
            if($_REQUEST['gb']=='we'){
                $groupBy = "10003";
            }
            if($_REQUEST['gb']=='sa'){
                $groupBy = "10004";
            }
            if($_REQUEST['gb']=='s'){
                $groupBy = "10005";
            }
            if($_REQUEST['gb']=='a'){
                $groupBy = "";
            }
            
            if(!empty($_REQUEST['brand']) || !empty($_REQUEST['color']) || !empty($_REQUEST['size'])){
                $listFilter = $_REQUEST['brand']."-".$_REQUEST['color']."-".$_REQUEST['size'];
            }
            
            $this->registry->template->groupBy = $_REQUEST['gb'];
            $result = $this->registry->shop->getProduct($groupBy, $listFilter);
            $this->registry->template->groupList = $result["data"];

            $this->registry->template->show('shop_product');
        }
        else{
            $this->registry->template->show('shop');
        }
    }
    
    public function productPaginateAjax() 
    {
        if(!empty($_REQUEST["gb"])){
            $viewMax = 12;
            $viewIndex = 1;
            $groupBy = '';
            $findBy = '';
            $listFilter = '';
            if($_REQUEST['gb']=='e'){
                $groupBy = "10000";
            }
            
            if(!empty($_REQUEST['brand']) || !empty($_REQUEST['color']) || !empty($_REQUEST['size'])){
                $listFilter = $_REQUEST['brand']."-".$_REQUEST['color']."-".$_REQUEST['size'];
            }
            
            if(!empty($_REQUEST["viewIndex"])){
                $viewIndex = $_REQUEST["viewIndex"];
            }

            $GLOBALS["findBy"] = $findBy;
            
            $result = $this->registry->shop->getProduct($groupBy, $listFilter, $viewMax, $viewIndex);

            if(!empty($findBy)){
                $this->registry->template->productList = $result["data"];
            }
            else{
                $this->registry->template->groupList = $result["data"];
            }
            $this->registry->template->groupBy = $_REQUEST['gb'];
            $this->registry->template->viewHigh = $result["viewHigh"];
            $this->registry->template->viewIndex = $viewIndex;
            $this->registry->template->paginate = TRUE;
            $this->registry->template->show('shop_product');
        }
        else{
            $this->registry->template->show('shop');
        }
    }
}