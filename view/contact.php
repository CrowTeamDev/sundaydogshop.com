<?php
    $contact_phone  = '+';
    $contact_phone  = '+' . substr($contactDetail[1][0], 0, 2) . ' ';
    $contact_phone .= '(' . substr($contactDetail[1][0], 2, 1) . ')';
    $contact_phone .= substr($contactDetail[1][0], 3, 2) . ' ';
    $contact_phone .= substr($contactDetail[1][0], 5, 3) . ' ';
    $contact_phone .= substr($contactDetail[1][0], 8, 4);
?>

<?php
    if (isset($result))
        //Show send mail success;
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
    <label>SEND US MESSAGE <?php echo $header ?></label>
    <div>
        <form action="" method="post">
            <table>
                <tr>
                    <td>NAME</td>
                    <td><input type="text" name="name" /></td>
                </tr>
                <tr>
                    <td>EMAIL</td>
                    <td><input type="text" name="email" /></td>
                </tr>
                <tr>
                    <td>SUBJECT</td>
                    <td><input type="text" name="subject" /></td>
                </tr>
                <tr>
                    <td>MESSAGE</td>
                    <td rowspan="2"><input type="text" name="message" /></td>
                </tr>
                <tr>
                    <td><input type="submit" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>