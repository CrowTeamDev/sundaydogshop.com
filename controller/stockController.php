<?php

Class stockController Extends baseController {

    public function index() 
    {
        $this->registry->stock = new stock($this->registry);
        
        if (!isset($_REQUEST["token"])){
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $token = '';
            for ($i = 0; $i < 8; $i++) {
                $token .= $characters[rand(0, strlen($characters) - 1)];
            }
            
            $this->registry->config = new config($this->registry);
            $contentUrl = $this->registry->config->getConfigValue('contentUrl');
            $email = $this->registry->config->getConfigValue('payment_email');
            $this->registry->stock->save($token, $email);
            $mail_pros = new mail(0, 2);
            $mail_pros->sendValidationLink($contentUrl, $token, $email);
            $this->registry->template->error = 499;
            $this->registry->template->show('error');
        }else{
            try{
                $validate_time = $this->registry->stock->checkToken($_REQUEST["token"]);
                if ($validate_time == null){
                    $this->registry->template->error = 401;
                    $this->registry->template->show('error');
                }
                else if(time() - strtotime($validate_time) < 1800) {
                    if(!isset($_GET["cat"])){
                        $this->registry->template->stock = $this->registry->stock->getStock('1');
                        $this->registry->template->category = 0;
                    }else{
                        $this->registry->template->stock = $this->registry->stock->getStock($_GET["cat"]);
                        $this->registry->template->category = $_GET["cat"] - 1;
                    }
                    $this->registry->template->token = $_REQUEST["token"];
                    $this->registry->template->show('stock');
                }else{
                    $this->registry->template->error = 419;
                    $this->registry->template->show('error');
                }
            }  catch (Exception $e){
                $this->registry->template->error = 401;
                $this->registry->template->show('error');
            }
        }
    }
}