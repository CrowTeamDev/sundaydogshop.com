<?php

Class shopController Extends baseController {
	public function index() 
	{
	        $this->registry->template->shop_heading = 'This is the Shop Index';
	        $this->registry->template->productList = $this->registry->shop->getProduct();
	        $this->registry->template->show('shop_index');
	}
}
?>