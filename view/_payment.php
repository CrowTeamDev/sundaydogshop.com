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
                <td>PRICE</td>
                <td colspan="2">TOTAL</td>
            </tr>
            <tr class="checkOut_item">
                <td id="image"></td>
                <td id="name"></td>
                <td id="qty"><input type="number" min="1" max="99" value="1" /></td>
                <td id="update"><label>UPDATE</label></td>
                <td id="price"><span></span>THB</td>
                <td id="total"><span></span>THB</td>
                <td id="remove"><label>REMOVE</label></td>
            </tr>
            <tr>
                <td colspan="5">Total cost before shipping</td>
                <td colspan="2"><span></span>THB</td>
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
                <td>STATE*</td>
                <td><input type="text" /></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td>COUNTRY*</td>
                <td><input type="text" /></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td>HOME PHONE*</td>
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
        *REQUIRE FIELD
    </div>
    <div id="payment_summary">
        <table>
            <tr>
                <td colspan="2">PRODUCT</td>
                <td>QUANTITY</td>
                <td>PRICE</td>
                <td>TOTAL</td>
            </tr>
            <tr class="checkOut_item">
                <td id="image"></td>
                <td id="name"></td>
                <td id="qty"></td>
                <td id="price"><span></span>THB</td>
                <td id="total"><span></span>THB</td>
            </tr>
            <tr>
                <td colspan="4">Shipping cost</td>
                <td id="shipping_cost"><span></span>THB</td>
            </tr>
            <tr>
                <td colspan="4">Total cost (tax & shipping incl.)</td>
                <td id="total_cost"><span></span>THB</td>
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
                <td class="menu">PAY BY BANK WIRE (ORDER PROCESS WILL BE LONGER)</td>
            </tr>
            <tr>
                <td class="menu">PAY WITH YOUR CREDIT CARD OR YOUR PAYPAL ACCOUNT</td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
    </div>
    <label id="payment_back">CONTINUE SHOPPING</label>
    <label id="payment_next">CHECK OUT</label>
</article>
<div id="payment_cart"></div>