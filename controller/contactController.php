<?php

Class contactController Extends baseController {

    public function index() 
    {
            $this->registry->template->header = 'SundayDog Shop: Contact Us';
            $this->registry->template->contactDetail = $this->registry->config->getContactDetail();
	    $this->registry->template->show('contact');
    }
    
    
    



}

?>