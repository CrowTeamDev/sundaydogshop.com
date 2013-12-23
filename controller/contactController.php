<?php

Class contactController Extends baseController {

    public function index() 
    {
        $contact = $this->registry->config->getContactDetail();
        
        //Send mail
        if($_SERVER['REQUEST_METHOD']== "POST"){
            $mail_to        = $contact[0][0];
            $mail_subject   = 'Customer Message: ' . $_REQUEST["subject"];
            $mail_message   = 'There is a message from the customer, <i>' . $_REQUEST["name"] . '</i>';
            $mail_message  .= '<br>';
            $mail_message  .= '<br><b>&nbsp;&nbsp;&nbsp;&nbsp;"';
            $mail_message  .= $_REQUEST["message"];
            $mail_message  .= '"</b>';

            $mail_header    = 'MIME-Version: 1.0' . "\r\n";
            $mail_header   .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $mail_header   .= 'From: ' . $_REQUEST["name"] . ' <' . $_REQUEST["email"] . '>';

            $this->registry->template->result = mail($mail_to, $mail_subject, $mail_message, $mail_header);
        }
        
        $this->registry->template->header = 'SundayDog Shop: Contact Us';
        $this->registry->template->contactDetail = $contact;
        
        $this->registry->template->show('contact');
    }
    
    
    



}

?>