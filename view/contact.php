<?php
    $contact_phone  = '+';
    $contact_phone  = '+' . substr($contactDetail[2][0], 0, 2) . ' ';
    $contact_phone .= '(' . substr($contactDetail[2][0], 2, 1) . ')';
    $contact_phone .= substr($contactDetail[2][0], 3, 2) . ' ';
    $contact_phone .= substr($contactDetail[2][0], 5, 3) . ' ';
    $contact_phone .= substr($contactDetail[2][0], 8, 4);
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
                $html .= "<label>".strtoupper($FAQquestion[$i][0])."</label>";
                $html .= "<div>";
                $html .= $FAQanswer[$i][0];
                $html .= "</div>";
                $html .= "</div>";
            }
            echo $html;
        ?>
    </div>
</div>
<div id="contact_main">
    <div>
    If you can't find an answer to your question or would like to make a comment or suggestion, please send us an email at
    <?php echo $contactDetail[0][0]; ?><br>
    If you have a question regarding the product purchased, please send us an email at
    <?php echo $contactDetail[1][0]; ?><br>
    Sunday Dog is in Monday through Friday, 10:00 am to 6:00 pm GMT.<br>
    <br>
    Contact Info<br>
    29/3 Langsuan Rd. Lumpini Patumwan, 10330, Bangkok, Thailand<br>
    <br>
    Tel: <?php echo $contact_phone; ?><br>
    Hours: Mon–Fri
    </div>
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