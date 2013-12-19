/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_xclick" />
    <input type="hidden" name="business" value="PXG755ZX9FAU6" />
    <input type="hidden" name="lc" value="TH" />
    <input type="hidden" name="item_name" value="SundayDog Purchased" />
    <input type="hidden" name="currency_code" value="THB" />
    <input type="hidden" name="button_subtype" value="services" />
    <input type="hidden" name="item_number" value="<?php echo "x"; ?>" />
    <input type="hidden" name="amount" value="<?php echo "x"; ?>" />
    <input type="hidden" name="first_name" value="<?php echo "x"; ?>" />
    <input type="hidden" name="last_name" value="<?php echo "x"; ?>" />
    <input type="hidden" name="address1" value="<?php echo "x"; ?>" />
    <input type="hidden" name="city" value="<?php echo "x"; ?>" />
    <input type="hidden" name="state" value="<?php echo "x"; ?>" />
    <input type="hidden" name="zip" value="<?php echo "x"; ?>" />
    <input type="hidden" name="country" value="<?php echo "x"; ?>" />
    <input type="hidden" name="night_phone_a" value="<?php echo "x"; ?>" />
    <input type="hidden" name="night_phone_b" value="<?php echo "x"; ?>" />
    <input type="submit" id="paypal_submit" />
</form>


