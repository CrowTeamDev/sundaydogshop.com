/* 
 * index.js
 * 
 * Control every front-end process on index.html
 */

//For debug
/*
$(document).keypress(function(event){
    if (String.fromCharCode(event.which) === 'z'){
        alert($('li.selected').attr('id'));
    } 
 });
 */


//public

var directory = {
    default: 'HOME',
    get: function(){ return $('#current_directory').text(); },
    add: function(value){
        var path = this.get() + '/' + value;
        $('#current_directory').text(path);
    },
    reset: function(value){
        var path = this.default + '/' + value.toUpperCase();
        $('#current_directory').text(path);
    }
};

cartItem = {
    set : function(value){ $('span', '#your_cart').text(value); },
    add : function(){
        var amount = parseInt($('span', '#your_cart').text())++;
        this.set(amount);
    }
};

function set_menuOn(menu_id){
    $('#start_menu').hide();
    $('#navigation_bar, #top_menu, footer').show();
 
    changeBackground(menu_id);
    directory.reset(menu_id);
    $('header ul li#'+menu_id).addClass('select');
}
function changeBackground(menu_id){
    var value;
    var url_path = $('#local_path').val();

    $('#background_1').show();
    switch (menu_id){
        case 'init':
            value = 'url('+ url_path + '/content/image/background/image_2.jpg)';
            break;
        case 'contact':
            value = 'url('+ url_path + '/content/image/background/image_3.jpg)';
            break;
        default:
            $('#background_1').hide();
            value = 'url('+ url_path + '/content/image/background/image_0.jpg)';
            break;
    }
    $('#background_2').css('background-image', value);
}

//private

$(document).ready(function(){
    
    var url_path;
    
    //Mock cart
        cart_obj = new Cart();
        cart_obj.item[0] = new Item('P001', 'Product 01', 500, 5);
        cart_obj.item[1] = new Item('P002', 'Product 02', 350, 3.5);
        cart_obj.item[2] = new Item('P003', 'Product 03', 150, 1.5);
    //
    
    setup_variable();
    setup_default();
    setup_eventHandle();
    
    function setup_variable(){
        url_path = $('#local_path').val();
    }
    
    function setup_default(){
        
        changeBackground('init');
        $('#start_menu').slideDown(650, function(){
            $(this).find('label').fadeIn(450);
        });
    }
    
    function setup_eventHandle(){
        $('#start_menu').click(function(){
            $(this).fadeOut(300, function(){
                $('#navigation_bar').addClass('page_load').fadeIn(2500);
                $('#top_menu, footer').addClass('page_load').fadeIn(500);
            });
        });
        $('#navigation_bar').find('li').mouseover(function(){
            var selected = $('li.select');

            $(this).addClass('select');
            selected.removeClass('select');
            selected.addClass('selected');
        });
        $('#navigation_bar').find('li').mouseout(function(){
            var selected = $('li.selected');

            $(this).removeClass('select');
            selected.removeClass('selected');
            selected.addClass('select');
        });
        $('header ul li').click(function(){
            var menu_id = $(this).attr('id');
            
            $(this).addClass('select');

            //changeBackground(menu_id);
            menu_handle(menu_id);
        });
        $('#main').scroll(function(){
            var position_scrolling = $(this).scrollTop();
            $('#logo_rope').width(position_scrolling);
        });
    }
    
    function menu_handle(id){
        var url_redirect;
        var main_width = $('#main').width();
        switch(id){
            case 'your_cart':
                url_redirect = url_path + '/view/_payment.php';
                main_width += 100;
                break;
            default:
                window.location.href = id;
                break;
        }
        $('#main').fadeOut(300, function(){
            $(this).width(main_width);
            $(this).load(url_redirect, function(){
                $(this).fadeIn(500);
            });
        });
    }
});