/* 
 * payment.js
 * 
 * Control on _payment.html
 */

$(document).ready(function(){
   
    var payment_step;
    var payment_checkOut;
    var grandTotal;
    var buttonsText;
   
    setup_variable();
    setup_default();
    setup_eventHandle();
    
    function setup_variable(){
        payment_step = 1;
        payment_checkOut = $('#payment_checkOut table');
        grandTotal = {
            self : payment_checkOut.find('tr:last td:last span'),
            value : function(){
                return parseInt(this.self.text());
            },
            sum : function(){
                var total_price = 0;
                payment_checkOut.find('.checkOut_item #total').each(function(){
                    total_price += parseInt($(this).find('span').text());
                });
                this.self.text(total_price);
            }
        };
        buttonsText = {
            set : function(back, next){
                $('#payment_back', '#payment_page').text(back).show();
                $('#payment_next', '#payment_page').text(next).show();
            },
            clear : function(){
                $('#payment_back', '#payment_page').hide();
                $('#payment_next', '#payment_page').hide();
            }
        };
    }
    
    function setup_default(){
        //Mock cart
            your_cart = new Cart();
            your_cart.item[0] = new Item('P001', 'Product 01', 500, 5.5);
            your_cart.item[1] = new Item('P002', 'Product 02', 350, 6.5);
            your_cart.item[2] = new Item('P003', 'Product 03', 150, 6.5);
        //
        
        current_step(payment_step);
        display_item(your_cart);
        grandTotal.sum();
        
        function display_item(cart){
            var item_row = '<tr class="checkOut_item">' + $('.checkOut_item').html() + '</tr>';
            
            for(i in cart.item){
                $('.checkOut_item:last', payment_checkOut).after(item_row);
                
                var item = cart.item[i];
                $('.checkOut_item:last', payment_checkOut).find('#name').text(item.name);
                $('.checkOut_item:last', payment_checkOut).find('#price span').text(item.price);
                $('.checkOut_item:last', payment_checkOut).find('#total span').text(item.price);
                if (item.qty !== undefined)
                    $('.checkOut_item:last', payment_checkOut).find('#qty input').val(item.qty);
            }
            $('.checkOut_item:first', payment_checkOut).remove();
        }
    }
    
    function setup_eventHandle(){
        $('.checkOut_item #update', payment_checkOut).find('label').click(function(){
            var row = $(this).closest('tr');
            var i = $('.checkOut_item', payment_checkOut).index(row);
            var price = row.find('#price span').text();
            var qty = row.find('#qty input').val();
            
            if(qty < 0 || qty > 99){ return false; }
            
            row.find('#total span').text(price * qty);
            grandTotal.sum();
            your_cart.update(i, parseInt(qty));
        });
        $('.checkOut_item #remove', payment_checkOut).find('label').click(function(){
            $(this).closest('tr')
                .children('td')
                .wrapInner('<div />')
                .children()
                .slideUp(function() {
                    $(this).closest('tr').remove();
                    grandTotal.sum();
            });
            var index = $('.checkOut_item', payment_checkOut).index($(this).closest('tr'));
            your_cart.remove(index);
        });
        $('#payment_back', '#main').click(function(){
            switch(payment_step){
                case 0:
                    $('#navigation_bar ul li:eq(1)').click().addClass('selected');
                    break;
            }
        });
        $('#payment_next', '#main').click(function(){
            switch(payment_step){
                case 0:
                    your_cart.totalCost = grandTotal.value();
                    break;
            }
            current_step(payment_step++);
        });
        $("#payment-navigation li").click(function(){
            if ($("li", $(this).parent()).index(this) < payment_step){
                current_step(payment_step--);
            }
        });
    }
    
    function current_step(previous_step){
        $("#payment-navigation li").css("cursor", "default");
        $("#payment-navigation").find("li").each(function(){
            if ($("li", $(this).parent()).index(this) < (payment_step-1)){
                $(this).css("color", "");
                $(this).css("cursor", "pointer");
            }
            else if ($("li", $(this).parent()).index(this) === (payment_step-1))
                $(this).css("color", "#FFFFFF");
            else{
                $(this).css("color", "");
                $(this).css("cursor", "default");
            }
        });
        $('div:eq('+previous_step+')', '#main').fadeOut(300, function(){
            show_page(payment_step);
        });
        
        function show_page(step){
            $('div:eq('+step+')', '#main').fadeIn(500);
            switch(step){
                case 1:
                    buttonsText.set('CONTINUE SHOPPING', 'CHECK OUT');
                    break;
                case 2:
                    buttonsText.set('BACK', 'NEXT');
                    break;
                case 3:
                    buttonsText.set('BACK', 'CONFIRM');
                    break;
                case 4:
                    buttonsText.clear();
                    break;
            }
        }
    }
});