<?php
Class communityController Extends baseController {

    public function index() 
    {
        $this->registry->template->page = 'community';
        $this->registry->template->info = 'COMING SOON';
        
        $this->registry->template->show('information');
    }
}
?>