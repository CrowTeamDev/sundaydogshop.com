/* 
 * payment.js
 * 
 * Control on _payment.html
 */

$(document).ready(function(){
   
    var payment_step;
   
    setup_variable();
    setup_default();
    setup_eventHandle();
    
    function setup_variable(){
        payment_step = 0;
    }
    
    function setup_default(){
        current_step(payment_step);
    }
    
    function setup_eventHandle(){
        
    }
    
    function current_step(step){
        $("#payment_navigation li").css("cursor", "default");
        $("#payment_navigation").find("li").each(function(){
            if ($("li", $(this).parent()).index(this) < step)
                $(this).css("cursor", "pointer");
            else{
                $(this).css("color", "#FFFFFF");
                return false;
            }
        });
    }
});