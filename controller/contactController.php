<?php

Class contactController Extends baseController {

    public function index() 
    {
        $contact = $this->registry->config->getContactDetail();
        
        if($_SERVER['REQUEST_METHOD']== "POST"){
            //Send mail
            $mail_to        = $contact[0][0];
            $mail_subject   = 'Customer Message: ' . $_REQUEST["subject"];
            $mail_message   = $_REQUEST["message"];

            $mail_header    = 'MIME-Version: 1.0' . "\r\n";
            $mail_header   .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $mail_header   .= 'From: ' . $_REQUEST["name"] . ' <' . $_REQUEST["email"] . '>';

            mail($mail_to, $mail_subject, $mail_message, $mail_header);
        }
        
        $this->registry->template->header = 'SundayDog Shop: Contact Us';
        $this->registry->template->contactDetail = $contact;
        
        $this->registry->template->show('contact');
    }
    
    
    



}

?>