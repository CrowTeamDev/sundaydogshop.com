<?php
Class aboutController Extends baseController {

    public function index() 
    {
        $this->registry->template->page = 'about';
        $this->registry->template->show('information');
    }
}
?>