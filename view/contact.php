<?php
    
    $contact_phone  = '+';
    $contact_phone  = '+' . substr($contactDetail[1][0], 0, 2) . ' ';
    $contact_phone .= '(' . substr($contactDetail[1][0], 2, 1) . ')';
    $contact_phone .= substr($contactDetail[1][0], 3, 2) . ' ';
    $contact_phone .= substr($contactDetail[1][0], 5, 3) . ' ';
    $contact_phone .= substr($contactDetail[1][0], 8, 4);
?>
<script src="js/views/contact.js" type="text/javascript"></script>
<div id="contact_FAQ">
    <label>FAQ</label>
</div>
<div id="contact_main">
    <pre>QUESTION ABOUT ORDERS
OR GENERAL ENQUIRIES</pre>
    <pre>PLEASE CONTACT
<?php echo strtoupper($contactDetail[0][0]); ?></pre>
    <pre>TELEPHONE
<?php echo $contact_phone; ?></pre>
</div>
<div id="contact_mail">
    <label>SEND US MESSAGE</label>
</div>