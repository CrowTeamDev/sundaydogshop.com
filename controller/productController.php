<?php

Class productController Extends baseController {

    public function index() 
    {
            $id = $_GET["id"];
            $this->registry->template->product_heading = 'This is the product Index';
            $this->registry->template->productList = $this->registry->product->getProduct($id);
	    $this->registry->template->show('product_index');
    }
}