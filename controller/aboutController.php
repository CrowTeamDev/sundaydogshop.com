<?php
Class aboutController Extends baseController {

    public function index() 
    {
        $this->registry->template->page = 'about';
        $this->registry->template->info = $this->registry->config->getConfigValue('about_us');
        
        $this->registry->template->show('information');
    }
}
?>