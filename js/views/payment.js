/* 
 * payment.js
 * 
 * Control on _payment.html
 */
$(document).keypress(function(event){
    if (event.which === 13){
        $('#payment_next').click();
    } 
 });
 
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
            hide : function(){
                $('#payment_back', '#payment_page').hide();
                $('#payment_next', '#payment_page').hide();
            },
            show : function(){
                $('#payment_back', '#payment_page').show();
                $('#payment_next', '#payment_page').show();
            },
            done : function(){
                $('#payment_next', '#payment_page').show();
            },
            set : function(number){
                var className = "Page"+number;
                
                $('#payment_back').removeClass();
                $('#payment_back').addClass(className);
                
                $('#payment_next').removeClass();
                $('#payment_next').addClass(className);
                buttonsText.show();
            }
        };
    }
    
    function setup_default(){
        //Bug zoom
        $('.zoomContainer').remove();
        $('.zoomWindowContainer').remove();
        
        changeBackground('payment');
        current_step(payment_step);
        display_item(payment_checkOut, cart_obj);
        grandTotal.sum();
        handleMacOs();
        
        function handleMacOs(){
            if (navigator.appVersion.indexOf("Mac") !== -1){
                $('#payment_footer #payment_back').css({'padding-top':'8px', 'padding-bottom':'8px'});
            }
        }
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
            cart_obj.item[i].qty = parseInt(qty);
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
            cart_obj.item.splice(index, 1);
        });
        $('tr td.menu', payment_pay).click(function(){
            var otherPayment = $('td', payment_pay).index(this) === 0 ? 1 : 0;
            
            $(this).addClass('selected').removeClass('menu');
            $('tr', payment_pay).eq(otherPayment).hide();
            if (otherPayment === 1){
                var data = {
                    totalCost : cart_obj.totalCost,
                    shippingCost : cart_obj.shippingCost,
                    items : cart_obj.item,
                    buyyer : buyyer_obj.first+' '+buyyer_obj.last,
                    email : buyyer_obj.mail,
                    phone : buyyer_obj.phone,
                    mobile : buyyer_obj.mobile,
                    address : buyyer_obj.getAddress()
                };
                $.post('view/_payment_bank-wire.php', data, function(result){
                    $('tr', payment_pay).last().fadeIn(500);
                    $('tr', payment_pay).last().find('td').html(result);
                    format_payment_detail();
                    buttonsText.done();
                });
            }
            else{
                //Include html form_paypal, and trigger submit!
                var data = {
                    totalCost : cart_obj.totalCost,
                    shippingCost : cart_obj.shippingCost,
                    items : cart_obj.item,
                    first_name : buyyer_obj.first,
                    last_name : buyyer_obj.last,
                    address1 : buyyer_obj.getAddress(),
                    city : buyyer_obj.city,
                    state : buyyer_obj.state,
                    zip : buyyer_obj.zip,
                    country : buyyer_obj.country,
                    email : buyyer_obj.mail,
                    night_phone_b : buyyer_obj.mobile,
                    phone : buyyer_obj.phone
                };
                clearSession();
                $.post('view/_paypal_form.php', data, function(result){
                    $('tr', payment_pay).last().find('td').html(result);
                    $('tr', payment_pay).last().find('td form').submit();
                });
            }
        });
        $('#payment_back', '#main').click(function(){
            switch(payment_step){
                case 1:
                    window.location.href = 'shop';
                    break;
                case 4:
                    break;
                default:
                    current_step(payment_step--);
                    break;
            }
        });
        $('#payment_next', '#main').click(function(){
            switch(payment_step){
                case 1:
                    if (cart_obj.item.length === 0) return;
                    cart_obj.totalCost = grandTotal.value();
                    updateSession(cart_obj);
                    break;
                case 2:
                    if(!validateInputs()) return;
                    buyyer_obj = create_buyyer();
                    display_item(payment_summary, cart_obj);
                    display_address(buyyer_obj);
                    break;
                case 4:
                    clearSession();
                    displayPopup('<div align="center"><br>Order process sent<br><br>Thank you</div>', 'home');
                    break;
            }
            if(payment_step < 4)
                current_step(payment_step++);
        });
        $("#payment-navigation li").click(function(){
            var target_step = $("li", $(this).parent()).index(this) + 1;
            var present_step = payment_step;
            
            if (target_step < payment_step){
                payment_step = target_step;
                current_step(present_step);
            }
        });
        $("#shipping_option input:radio[name=shipping]").click(function() {
            display_item(payment_summary, cart_obj);
        });
        
        function validateInputs(){
            var row = function(i){ return $('tr:eq('+i+') td:eq(1)', payment_shipping).find('input,textarea'); };
            var result = true;
            
            $('tr', payment_shipping).each(function(){
                $(this).find('td:eq(2) span').text('');
            });
            
            if (!checkAphabet(0))
                result = false;
            
            if (!checkAphabet(1))
                result = false;
            
            var address = row(2).val();
            if (address === ''){
                displayError(2);
                result = false;
            }
            
            if (!checkNumber(3))
                result = false;
            
            if (!checkAphabet(4))
                result = false;
            
            if (!checkAphabet(5))
                result = false;
            
            if (!checkNumber(7))
                result = false;
            
            var mail = row(8).val();
            var atpos=mail.indexOf("@");
            var dotpos=mail.lastIndexOf(".");
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=mail.length){
                displayError(8);
                result = false;
            }
            
            function checkAphabet(i){
                var regexLetter = /[a-zA-z]/;
                if (!regexLetter.test(row(i).val())){
                    displayError(i);
                    return false;
                }
                return true;
            }
            function checkNumber(i){
                var regexNum = /\d/;
                if (!regexNum.test(row(i).val())){
                    displayError(i);
                    return false;
                }
                return true;
            }
            
            return result;
        }
        function displayError(i){
            var warning;
            
            switch(i){
                case 0:
                case 1:
                case 4:
                case 5:
                    warning = "Please input only alphabet";
                    break;
                case 2:
                    warning = "Please input address detail";
                    break;
                case 3:
                case 6:
                case 7:
                    warning = "Please input only number";
                    break;
                case 8:
                    warning = "Please input email address correctly";
                    break;
            }
            
            $('tr:eq('+i+') td:eq(2)', payment_shipping).find('span').text(warning);
        }
        function create_buyyer(){
            obj = new Buyyer();
            
            var row = function(i){ return $('tr:eq('+i+') td:eq(1)', payment_shipping).find('input,textarea'); };
            
            obj.first = row(0).val();
            obj.last = row(1).val();
            obj.address = row(2).val();
            obj.zip = row(3).val();
            obj.city = row(4).val();
            obj.country = row(5).val();
            obj.phone = row(6).val();
            obj.mobile = row(7).val();
            obj.mail = row(8).val();
            
            return obj;
        }
        function format_payment_detail(){
            var accountNo = $('#payment_bankwire_detail', payment_pay).find('#accountNo');
            accountNo.text(format_bankAccount(accountNo.text()));
            
            function format_bankAccount(account){
                return account.substring(0,3) + '-' + account.substring(3,9) + '-' + account.substring(9);
            }
        }
        function updateSession(cart){
            var data = { cart : JSON.stringify(cart) };
            $.post('view/_session.php', data);
            cartItem.set(cart.item.length);
        }
        function clearSession(){
            $.post('view/_session.php', null);
            cartItem.set(0);
        }
    }
    
    function current_step(previous_step){
        $("#payment-navigation li").css("cursor", "default");
        $("#payment-navigation").find("li").each(function(){
            if ($("li", $(this).parent()).index(this) < (payment_step-1)){
                $(this).css("text-decoration", "");
                $(this).css("cursor", "pointer");
            }
            else if ($("li", $(this).parent()).index(this) === (payment_step-1))
                $(this).css("text-decoration", "underline");
            else{
                $(this).css("text-decoration", "");
                $(this).css("cursor", "default");
            }
        });
        $('div[id*=payment_]', '#main').eq(previous_step-1).fadeOut(300, function(){
            show_page(payment_step);
        });
        window.scrollTo(0, 0);
        
        function show_page(step){
            $('div[id*=payment_]', '#main').eq(step-1).fadeIn(500);
            
            if (step === 4)
                buttonsText.hide();
            else
                buttonsText.set(step);
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
            target_row.find('#image img').attr('src', "content/image/product/" + item.id + "_1.jpg");
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
            cart.shippingCost = parseFloat($("#shipping_option input[name=shipping]:checked").val());
            cart.toalWeight = total_weight;
            cart.totalCost = total_price;
            
            if (cart.totalCost < 3500)
                cart.shippingCost = get_shippingCost(cart) + 50;
            else
                cart.shippingCost = 0;
            
            $('#shipping_cost', div_step).find('span').text(cart.shippingCost);
            $('#total_cost', div_step).find('span').text(cart.totalCost + cart.shippingCost);
        }
    }
    
    function display_address(buyyer){
        var address = buyyer.getAddress();
        $('div', payment_summary.parent()).find('span').text(address);
    }
    
    function get_shippingCost(cart){
        var result = 0;
        switch(cart.shippingCost){
            case 1:
                if (cart.toalWeight < 0.02)
                    result = 32;
                else if (cart.toalWeight < 0.1)
                    result = 37;
                else if (cart.toalWeight < 0.25)
                    result = 42;
                else if (cart.toalWeight < 0.5)
                    result = 52;
                else if (cart.toalWeight < 1)
                    result = 67;
                else if (cart.toalWeight < 1.5)
                    result = 82;
                else if (cart.toalWeight < 2)
                    result = 97;
                else if (cart.toalWeight < 2.5)
                    result = 122;
                else if (cart.toalWeight < 3)
                    result = 137;
                else if (cart.toalWeight < 5)
                    result = 157 + (Math.floor(((cart.toalWeight - 3) / 0.5)) * 20);
                else if (cart.toalWeight < 8)
                    result = 242 + (Math.floor(((cart.toalWeight - 5) / 0.5)) * 25);
                else if (cart.toalWeight < 10)
                    result = 397 + (Math.floor(((cart.toalWeight - 8) / 0.5)) * 30);
                else
                    result = 502 + (Math.floor(cart.toalWeight - 10) * 15);
                break;
            default:
                result = 0;
                break;
        }
        return result;
    }
});