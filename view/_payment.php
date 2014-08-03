<?php
    $site_path = '../';
    define ('__SITE_PATH', $site_path);

    include $site_path . 'includes/init.php';
    $registry->config = new config($registry);
    
    /*** load up var ***/
    $shippingOption = $registry->config->getShippingOption();
?>
<!DOCTYPE html>
<!--
    view for payment process

    load into #main
    via click #your_cart
-->
<script src="js/views/payment.js" type="text/javascript"></script>
<div id="payment-navigation">
    <ul>
        <li>CHECK OUT</li>
        <li>SHIPPING ADDRESS</li>
        <li>SUMMARY</li>
        <li>PAYMENT</li>
    </ul>
</div>
<article id="payment_page">
    <div id="payment_checkOut">
        <table>
            <tr>
                <td colspan="2">PRODUCT</td>
                <td colspan="2">QUANTITY</td>
                <td>PRICE (THB)</td>
                <td colspan="2">TOTAL (THB)</td>
            </tr>
            <tr class="checkOut_item">
                <td id="image"><img width="100%" /></td>
                <td id="name"></td>
                <td id="qty"><input type="number" min="1" max="99" value="1" /></td>
                <td id="update"><label></label></td>
                <td id="price"><span></span></td>
                <td id="total"><span></span></td>
                <td id="remove"><label></label></td>
            </tr>
            <tr>
                <td colspan="7"><hr></td>
            </tr>
            <tr>
                <td colspan="5">Total cost before shipping</td>
                <td colspan="2"><span></span></td>
            </tr>
        </table>
    </div>
    <div id="payment_shipping">
        <table>
            <tr>
                <td>FIRST NAME*</td>
                <td><input type="text" /></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td>LAST NAME*</td>
                <td><input type="text" /></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td>ADDRESS*</td>
                <td><textarea></textarea></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td>ZIP CODE*</td>
                <td><input type="text" /></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td>CITY*</td>
                <td><input type="text" /></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td>COUNTRY*</td>
                <td><input type="text" /></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td>HOME PHONE</td>
                <td><input type="text" /></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td>MOBILE PHONE*</td>
                <td><input type="text" /></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td>E-MAIL*</td>
                <td><input type="text" /></td>
                <td><span></span></td>
            </tr>
        </table>
        *REQUIRED FIELD
    </div>
    <div id="payment_summary">
        <table>
            <tr>
                <td colspan="2">PRODUCT</td>
                <td id="qty_head">QUANTITY</td>
                <td>PRICE (THB)</td>
                <td>TOTAL (THB)</td>
            </tr>
            <tr class="checkOut_item">
                <td id="image"><img width="100%" /></td>
                <td id="name"></td>
                <td id="qty"></td>
                <td id="price"><span></span></td>
                <td id="total"><span></span></td>
            </tr>
            <tr>
                <td colspan="5"><hr></td>
            </tr>
            <tr>
                <td id="shipping_option" colspan="4">
                    <span>Shipping cost</span>
                    <?php
                        foreach($shippingOption as $option){
                            $name = explode("_", $option[0]);
                            $html = '<input type="radio" name="shipping" value="'. $option[1] .'" checked />';
                            //$html.= $name[1];
                            
                            echo $html;
                        }
                    ?>
                </td>
                <td id="shipping_cost"><span></span></td>
            </tr>
            <tr>
                <td colspan="4">Total cost (tax & shipping incl.)</td>
                <td id="total_cost"><span></span></td>
            </tr>
        </table>
        <div>
            <label>SHIPPING ADDRESS</label>
            <span></span>
        </div>
    </div>
    <div id="payment_pay">
        <table>
            <tr>
                <td class="menu">
                    PAY BY BANK WIRE (ORDER PROCESS WILL BE LONGER)
                    <label id="wire"></label>
                </td>
            </tr>
            <tr>
                <td class="menu">
                    PAY WITH YOUR CREDIT CARD OR YOUR PAYPAL ACCOUNT
                    <label id="paypal"></label>
                    <label id="visa"></label>
                    <label id="master"></label>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
    </div>
    <table id="payment_footer">
        <tr>
            <td><label id="payment_back" class="Page1"></label></td>
            <td><label id="payment_next" class="Page1"></label></td>
        </tr>
    </table>
</article>
<div id="payment_cart"></div>