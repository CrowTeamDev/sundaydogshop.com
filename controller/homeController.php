<?php
Class homeController Extends baseController {

    public function index() 
    {
        $this->registry->template->page = 'home';
        $this->registry->template->info = 'will be here soon';
        
        $this->registry->template->show('home');
    }
}