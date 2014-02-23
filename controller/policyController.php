<?php
Class policyController Extends baseController {

    public function index() 
    {
        $this->registry->template->page = 'policy';
        $this->registry->template->info = $this->registry->config->getConfigValue('policy');
        
        $this->registry->template->show('information');
    }
}
?>