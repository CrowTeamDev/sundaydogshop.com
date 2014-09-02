<?php

Class productController Extends baseController {

    public function index() 
    {
            $id = $_GET["id"];
            $this->registry->template->product_heading = 'This is the product Index';
            $this->registry->template->productList = $this->registry->product->getProduct($id);
            $this->registry->template->colorList = $this->registry->product->getColor($id);
            $this->registry->template->detailList = $this->registry->product->getSize($id);
            $this->registry->template->stockList = $this->registry->product->getStock($id);
            $this->registry->template->dimensionList = $this->registry->product->getDimension($id);
	    $this->registry->template->show('product_index');
    }
}