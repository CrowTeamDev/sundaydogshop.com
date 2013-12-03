<?php

Class productController Extends baseController {

    public function index() 
    {
            $this->registry->template->product_heading = 'This is the product Index';
            $this->registry->template->productList = $this->registry->product->getProduct();
	    $this->registry->template->show('product_index');
    }
    
    
    



}

?>