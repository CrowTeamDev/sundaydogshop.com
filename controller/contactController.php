<?php

Class contactController Extends baseController {

    public function index() 
    {
            $this->registry->template->header = 'SundayDog Shop: Contact Us';
            $this->registry->template->contactDetail = $this->registry->config->getContactDetail();
            $this->registry->template->show('contact');
            if(isset($_POST['submit'])){
                //Send mail
                $mail_to        = $this->registry->template->contactDetail[0][0];
                $mail_subject   = 'Customer Message: ' . $_POST["subject"];
                $mail_message   = $_POST["message"];

                $mail_header    = 'MIME-Version: 1.0' . "\r\n";
                $mail_header   .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $mail_header   .= 'From: ' . $_POST["name"] . ' <' . $_POST["email"] . '>';

                mail($mail_to, $mail_subject, $mail_message, $mail_header);
            }
    }
    
    
    



}

?>