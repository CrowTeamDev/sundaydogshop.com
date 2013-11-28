/* 
 * payment.js
 * 
 * Control on _payment.html
 */

$(document).ready(function(){
   
    var payment_step;
    var payment_checkOut;
   
    setup_variable();
    setup_default();
    setup_eventHandle();
    
    function setup_variable(){
        payment_step = 0;
        payment_checkOut = $('#payment_checkOut');
    }
    
    function setup_default(){
        //Mock cart
            your_cart = new Cart();
            your_cart.item[0] = new Item('P001', 'Product 01', 500, 5.5);
            your_cart.item[1] = new Item('P002', 'Product 02', 350, 6.5);
        //
        
        current_step(payment_step);
        add_item(your_cart);
        
        function add_item(cart){
            var item_row = '<tr class="checkOut_item">' + $('.checkOut_item').html() + '</tr>';
            
            for(i in cart.item){
                $('.checkOut_item:last', payment_checkOut).after(item_row);
                
                var item = cart.item[i];
                $('.checkOut_item:last', payment_checkOut).find('#name').text(item.name);
                $('.checkOut_item:last', payment_checkOut).find('#price span').text(item.price);
            }
            $('.checkOut_item:first', payment_checkOut).remove();
        }
    }
    
    function setup_eventHandle(){
        $('.checkOut_item #remove').find('label').click(function(){
            //ToFix: Animation on remove, maybe add class, let css handle
            /*
            $(this).closest('tr')
                .children('td')
                .wrapInner('<div />')
                .children()
                .slideUp(function() { $(this).closest('tr').remove(); });
             */
            
            $(this).closest('tr').fadeOut(500);
        });
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