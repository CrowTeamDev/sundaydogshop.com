/* 
 * payment.js
 * 
 * Control on _payment.html
 */

$(document).ready(function(){
   
    var payment_step;
    var payment_checkOut;
    var payment_shipping;
    var payment_summary;
    var payment_pay;
    var grandTotal;
    var shippingCost;
    var buttonsText;
    
    buyyer_obj = new Buyyer();
   
    setup_variable();
    setup_default();
    setup_eventHandle();
    
    function setup_variable(){
        payment_step = 1;
        payment_checkOut = $('#payment_checkOut table');
        payment_shipping = $('#payment_shipping table');
        payment_summary = $('#payment_summary table');
        payment_pay = $('#payment_pay table');
        grandTotal = {
            self : payment_checkOut.find('tr:last td:last span'),
            value : function(){
                return parseInt(this.self.text());
            },
            sum : function(){
                var total_price = 0;
                payment_checkOut.find('.created #total').each(function(){
                    total_price += parseInt($(this).find('span').text());
                });
                this.self.text(total_price);
            }
        };
        shippingCost = {
            self : payment_summary.find('#shipping_cost span'),
            value : function(){
                return parseInt(this.self.text());
            }
        };
        buttonsText = {
            set : function(back, next){
                $('#payment_back', '#payment_page').text(back).show();
                $('#payment_next', '#payment_page').text(next).show();
            },
            hide : function(){
                $('#payment_back', '#payment_page').hide();
                $('#payment_next', '#payment_page').hide();
            },
            show : function(){
                $('#payment_back', '#payment_page').show();
                $('#payment_next', '#payment_page').show();
            }
        };
    }
    
    function setup_default(){
        changeBackground('payment');
        current_step(payment_step);
        display_item(payment_checkOut, cart_obj);
        grandTotal.sum();
    }
    
    function setup_eventHandle(){
        $('.checkOut_item #update', payment_checkOut).find('label').click(function(){
            var row = $(this).closest('tr');
            var i = $('.created', payment_checkOut).index(row);
            var price = row.find('#price span').text();
            var qty = row.find('#qty input').val();
            
            if(qty < 0 || qty > 99){ return false; }
            
            row.find('#total span').text(price * qty);
            grandTotal.sum();
            cart_obj.update(i, parseInt(qty));
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
            var index = $('.created', payment_checkOut).index($(this).closest('tr'));
            cart_obj.remove(index);
        });
        $('tr td', payment_pay).click(function(){
            var otherPayment = $('td', payment_pay).index(this) === 0 ? 1 : 0;
            var total_pay = cart_obj.totalCost;
            var buyyer = buyyer_obj.mail;
            
            $(this).addClass('selected');
            $('tr', payment_pay).eq(otherPayment).hide();
            $.post('view/_payment_bank-wire.php?cost='+total_pay+'&mail='+buyyer, function(data){
                $('tr', payment_pay).last().fadeIn(500);
                $('tr', payment_pay).last().find('td').html(data);
                format_payment_detail();
            });
        });
        $('#payment_back', '#main').click(function(){
            switch(payment_step){
                case 1:
                    $('#navigation_bar ul li:eq('+id+')').click();
                    break;
                case 4:
                    break;
                default:
                    current_step(payment_step--);
                    break;
            }
        });
        $('#payment_next', '#main').click(function(){
            current_step(payment_step++);
            switch(payment_step){
                case 2:
                    cart_obj.totalCost = grandTotal.value();
                    break;
                case 3:
                    buyyer_obj = create_buyyer();
                    display_item(payment_summary, cart_obj);
                    display_address(buyyer_obj);
                    break;
                case 4:
                    break;
            }
        });
        $("#payment-navigation li").click(function(){
            var target_step = $("li", $(this).parent()).index(this) + 1;
            var present_step = payment_step;
            
            if (target_step < payment_step){
                payment_step = target_step;
                current_step(present_step);
            }
        });
        
        function create_buyyer(){
            obj = new Buyyer();
            
            var row = function(i){ return $('tr:eq('+i+') td:eq(1)', payment_shipping).find('input,textarea'); };
            
            obj.first = row(0).val();
            obj.last = row(1).val();
            obj.address = row(2).val();
            obj.zip = row(3).val();
            obj.city = row(4).val();
            obj.state = row(5).val();
            obj.country = row(6).val();
            obj.phone = row(7).val();
            obj.mobile = row(8).val();
            obj.mail = row(9).val();
            
            return obj;
        }
        
        function format_payment_detail(){
            var accountNo = $('#payment_bankwire_detail', payment_pay).find('#accountNo');
            accountNo.text(format_bankAccount(accountNo.text()));
            
            function format_bankAccount(account){
                return account.substring(0,3) + '-' + account.substring(3,9) + '-' + account.substring(9);
            }
        }
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
        $('div[id*=payment_]', '#main').eq(previous_step-1).fadeOut(300, function(){
            show_page(payment_step);
        });
        
        function show_page(step){
            $('div[id*=payment_]', '#main').eq(step-1).fadeIn(500);
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
                    buttonsText.set('OTHER PAYMENT METHOD', 'I CONFIRM MY ORDER');
                    buttonsText.hide();
                    break;
            }
        }
    }
    
    function display_item(div_step, cart){
        var item_row = '<tr class="checkOut_item created">' + $('.checkOut_item:first', div_step).html() + '</tr>';
        var isCheckOutPage = $('tr:last', div_step).find('#total_cost').length === 0;
        var total_price = 0;
        var total_weight = 0;

        div_step.find('.created').remove();

        for(i in cart.item){
            $('.checkOut_item:last', div_step).after(item_row);
            var target_row = $('.created:last', div_step);

            var item = cart.item[i];
            target_row.find('#name').text(item.name);
            target_row.find('#price span').text(item.price);
            target_row.find('#total span').text(item.price * item.qty);
            
            if (isCheckOutPage)
                target_row.find('#qty input').val(item.qty);
            else{
                target_row.find('#qty').text(item.qty);
                total_weight += (item.weight * item.qty);
                total_price += (item.price * item.qty);
            }
        }
        $('.checkOut_item:first', div_step).hide();
        
        if(!isCheckOutPage){
            cart.totalCost = total_price;
            cart.addShippingCost(total_weight);
            
            $('#shipping_cost', div_step).find('span').text(cart.shippingCost);
            $('#total_cost', div_step).find('span').text(cart.totalCost);
        }
    }
    
    function display_address(buyyer){
        var address = buyyer.getAddress();
        $('div', payment_summary.parent()).find('span').text(address);
    }
});