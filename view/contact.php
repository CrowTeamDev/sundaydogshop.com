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
<div id="contact_FAQ" class="unselect">
    <label>FAQ</label>
    <div>
        <?php
            $html = "";
            for( $i=0; $i<count($FAQquestion); $i++){
                $html .= "<div class='question unselect'>";
                $html .= "<label>QUESTION ". ($i+1) ."</label>";
                $html .= "<div>";
                $html .= "<span>".$FAQquestion[$i][0]."</span>";
                $html .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                $html .= $FAQanswer[$i][0];
                $html .= "</div>";
                $html .= "</div>";
            }
            echo $html;
        ?>
    </div>
</div>
<div id="contact_main">
    <pre>QUESTION ABOUT ORDERS
OR GENERAL ENQUIRIES</pre>
    <pre>PLEASE CONTACT
<?php echo strtoupper($contactDetail[0][0]); ?></pre>
    <pre>TELEPHONE
<?php echo $contact_phone; ?></pre>
</div>
<div id="contact_mail" class="unselect">
    <label>SEND US MESSAGE</label>
    <div id="Test">
        <form action="" method="post">
            <table>
                <tr>
                    <td class="label">NAME</td>
                    <td><input type="text" name="name" /></td>
                </tr>
                <tr>
                    <td class="label">EMAIL</td>
                    <td><input type="text" name="email" /></td>
                </tr>
                <tr>
                    <td class="label">SUBJECT</td>
                    <td><input type="text" name="subject" /></td>
                </tr>
                <tr>
                    <td class="label">MESSAGE</td>
                    <td rowspan="2"><textarea name="message"></textarea></td>
                </tr>
                <tr>
                    <td class="label"><span>SEND</span></td>
                </tr>
            </table>
        </form>
    </div>
</div>