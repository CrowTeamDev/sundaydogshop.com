<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class mail{
    var $refNo, $method;
    var $cart, $buyer, $seller;
    
    function __construct($model, $method = 0){
        $this->refNo = $model['refNo'];
        $this->cart = $model['cart'];
        $this->buyer = $model['buyer'];
        $this->seller = $model['seller'];
        $this->method = $method;
    }
    
    private function createMsg($cart, $buyer, $seller){
        
        $items = $cart['items'];
        $shippingCost = $cart['shippingCost'];
        $totalCost = $cart['totalCost'];
        
        $name = $buyer['name'];
        $mobile = $buyer['mobile'];
        $phone = $buyer['phone'];
        $address = $buyer['address'];
        
        $method = $this->method == 0 ? "bank-wire" : "paypal" ;
        
        $message_detail = 
            "Dear " . $name . ","
            . "<br>"
            . "<br>This mail was sent by Sunday Dog"
            . "<br>As the summary of purchase on " . date('j M') . " via <b> " . $method . "</b> payment method"
            . "<br>";
   
        $message_detail .= "<table border=\"0\" style='width:400px;'>";
        foreach($items as $item){
            $qty = $item['qty'] != null ? intval($item['qty']) : 1;
            $price = intval($item['price']);
            $total = $price * $qty;
            $message_detail .= "<tr>"
                    . "<td style='width:50%;'>- " . $item['name'] . "</td>"
                    . "<td style='width:30%;'>" . number_format($price) . " THB"
                    . "&nbsp;&nbsp;&nbsp;"
                    . "x" . $qty . "</td>"
                    . "<td style='width:20%;'><b>". number_format($total) ."</b> THB</td>"
                    . "</tr>";
        }
        $message_detail .= "<tr>"
                . "<td colspan=\"2\">- Shipping Cost </td>"
                . "<td><b>" . number_format($shippingCost) . "</b> THB</td>"
                . "</tr>"
                . "</table>";

        if ($this->method == 0){
            $accountNo = $seller['accountNo'];
            $accountName = $seller['accountName'];
            $bank = $seller['bank'];
            $branch = $seller['branch'];
            $email = $seller['email'];
            
            $message_detail .= "<br>"
                    . "Please send us a bank wire, total amount of <b>" . number_format($totalCost + $shippingCost) . "</b> THB"
                    . "<br>To one of these accounts:"
                    . "<br>";
            
            for ($i = 0; $i < count($accountNo); $i++) {
                $message_detail .= "<br>"
                        . "Account number <b>" . formatAccount($accountNo[$i][0]) . " - " . $accountName[$i][0] . "</b>"
                        . "<br>Saving account of " . $bank[$i][0] . " (" . $branch[$i][0] . ")<br>";
            }
            
            $message_detail .= "<br>"
                    . "Do not forget to insert your order reference " . $this->refNo . " in the subject of your bank wire."
                    . "<br>"
                    . "<br>Your order will be sent on this information:"
                    . "<br><i>" . $name . " " . $this->formatNumber($mobile) . ", " . $this->formatNumber($phone) . "<br>" . $address . "</i>"
                    . "<br>"
                    . "<br>Please send a copy of your prove of payment back to this mail <<i>" . $email . "</i>>"
                    . "<br>and also refer to your reference <b>" . $this->refNo . "</b>.";
        }
        else{
            $paypalAccount = $seller['accountPaypal'];
            $message_detail .= "<br>"
                    . "Please complete payment on PayPal, total amount of <b>" . number_format($totalCost + $shippingCost) . "</b> THB"
                    . "<br>To PayPal account <b>" . $paypalAccount . "</b>, on item reference <b>" . $this->refNo . "</b>."
                    . "<br>"
                    . "<br>Your order will be sent on this information:"
                    . "<br><i>" . $name . " " . $this->formatNumber($mobile) . ", " . $this->formatNumber($phone) . "<br>" . $address . "</i>"
                    . "<br>"
                    . "<br>After PayPal confirm the payment, you will recieve another confirm mail from us";
        }
        
        return $message_detail;
    }
   
    function sendMail($mail_seller, $mail_buyer){
        $mail_to        = $mail_buyer;
        $mail_subject   = 'Order on SundayDog Shop: ' . $this->refNo;
        $mail_message   = $this->createMsg($this->cart, $this->buyer, $this->seller);

        $mail_header    = 'MIME-Version: 1.0' . "\r\n";
        $mail_header   .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $mail_header   .= 'From: SundayDog Shop <' . $mail_seller . '>' . "\r\n";
        $mail_header   .= 'Bcc: ' . $mail_seller;

        return mail($mail_to, $mail_subject, $mail_message, $mail_header);
    }
    
    function formatAccount($account){
        return substr($account, 0, 3)."-".substr($account, 3, 1)."-".substr($account, 4, 5)."-".substr($account, -1, 1);
    }
    function formatNumber($number){
        return substr($number, 0, 3)."-".substr($number, 3, 3)."-".substr($number, 6, strlen($number) - 6);
    }
}