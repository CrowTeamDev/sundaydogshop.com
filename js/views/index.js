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

String.prototype.replaceAll = function (find, replace) {
    var str = this;
    return str.replace(new RegExp(find.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'), 'g'), replace);
};

var directory = {
    default: '<a href="home">HOME</a>',
    get: function(){ return $('#current_directory').html(); },
    add: function(value, path){
        value = '<a href="' + path + '">' + value.toUpperCase() + '</a>';
        $('#current_directory').html(this.get() + '/' + value);
    },
    reset: function(value){
        value = '<a href="' + value + '">' + value.toUpperCase() + '</a>';
        if (value !== this.default)
            $('#current_directory').html(this.default + '/' + value);          
    }
};
var cartItem = {
    set : function(value){ $('span', '#your_cart').text(value); },
    add : function(){
        var amount = parseInt($('span', '#your_cart').text());
        this.set(amount+1);
    }
};

function set_menuOn(menu_id){
    $('#start_menu').hide();
    $('#intro_bg').remove();
    $('#navigation_bar, #top_menu, footer').show();
 
    changeBackground(menu_id);
    directory.reset(menu_id);
    $('header ul li#'+menu_id).addClass('select');
    $('footer label#'+menu_id).addClass('select');
    setTimeout(function(){
        $('#main').fadeIn(3500);
    }, 1500);
}
function set_shopOn(shop_id){
    directory.add(shop_id);
}
function changeBackground(menu_id){
    var value;
    var url_path = $('#local_path').val();

    $('#background_1').show();
    switch (menu_id){
        case 'init':
            break;
        case 'home':
            value = 'url('+ url_path + '/content/image/background/image_2.jpg)';
            break;
        case 'shop':
        case 'product':
            value = 'url('+ url_path + '/content/image/background/image_8.jpg)';
            break;
        case 'about':
            value = 'url('+ url_path + '/content/image/background/image_9.jpg)';
            break;
        case 'contact':
            value = 'url('+ url_path + '/content/image/background/image_3.jpg)';
            break;
        case 'community':
            value = 'url('+ url_path + '/content/image/background/image_5.jpg)';
            break;
        case 'policy':
            value = 'url('+ url_path + '/content/image/background/image_7.jpg)';
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
    
    setup_variable();
    setup_default();
    setup_eventHandle();
    
    function setup_variable(){
        url_path = $('#local_path').val();
        
        if ($('#myCart').val().length > 0){
            var cart = $('#myCart').val();
            cart = cart.replaceAll("\\", "");
            cart_obj = JSON.parse(cart);
        }
        else
            cart_obj = new Cart();
    }
    
    function setup_default(){
        changeBackground('init');
        cartItem.set(cart_obj.item.length);
        $('#start_menu').slideDown(650, function(){
            $(this).find('label').fadeIn(450);
        });
    }
    
    function setup_eventHandle(){
        $('#start_menu').click(function(){
            $(this).fadeOut(300, function(){
                $('#navigation_bar').addClass('page_load').fadeIn(2500);
                $('#top_menu, footer').addClass('page_load').fadeIn(500);
                $('#main').fadeIn(5000);
                $(".load-item").hide();
                var pauseSlide = setInterval(function(){
                    if (vars.is_paused)
                        clearInterval(pauseSlide);
                    if (!vars.in_animation && !vars.is_paused)
                        api.playToggle();
                }, 1000);
            }); 
        });
        $('#navigation_bar #main_menu li, footer label').not('#copyright').mouseover(function(){
            var selected = $('li.select');
            if (selected.attr('id') === undefined)
                selected = $('footer label.select');

            $(this).addClass('select');
            
            selected.removeClass('select');
            selected.addClass('selected');
        });
        $('#navigation_bar #main_menu li, footer label').not('#copyright').mouseout(function(){
            var selected = $('li.selected');
            if (selected.attr('id') === undefined)
                selected = $('footer label.selected');

            $(this).removeClass('select');
            
            selected.removeClass('selected');
            selected.addClass('select');
        });
        $('header ul li, footer label').not('#copyright').click(function(){
            var id = $(this).attr('id');
            
            var url_redirect;
            switch(id){
                case 'your_cart':
                    url_redirect = url_path + '/view/_payment.php';
                    $('#main').addClass('paymentMode');
                    break;
                default:
                    window.location.href = id;
                    break;
            }
            $('#main').load(url_redirect, function(){
                $('#main').fadeIn(500);
            });
        });
//        $('#main').scroll(function(){
//            var position_scrolling = $(this).scrollTop();
//            $('#logo_rope').width(position_scrolling);
//        });
    }

});
$(window).load(function(){
    if(directory.get() === "")
        startBackground();
     
    function startBackground(){	
        var url_path = $('#local_path').val();
        $.supersized({
            slideshow : 1,              // Slideshow on/off
            autoplay : 1,               // Slideshow starts playing automatically
            start_slide : 1,            // Start slide (0 is random)
            stop_loop : 0,              // Pauses slideshow on last slide
            random : 0,                 // Randomize slide order (Ignores start slide)
            slide_interval : 5000,      // Length between transitions
            transition : 1,             // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
            transition_speed : 4000,    // Speed of transition
            new_window : 1,             // Image links open in new window/tab
            pause_hover : 0,            // Pause slideshow on hover
            keyboard_nav : 0,           // Keyboard navigation on/off
            performance : 0,            // 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
            image_protect : 1,          // Disables image dragging and right click with Javascript
            min_width : 0,              // Min width allowed (in pixels)
            min_height : 0,             // Min height allowed (in pixels)
            vertical_center : 1,        // Vertically center background
            horizontal_center : 1,      // Horizontally center background
            fit_always : 0,             // Image will never exceed browser width or height (Ignores min. dimensions)
            fit_portrait : 1,           // Portrait images will not exceed browser height
            fit_landscape : 0,          // Landscape images will not exceed browser width					
            slide_links : 'blank',      // Individual links for each slide (Options: false, 'num', 'name', 'blank')
            thumb_links : 1,            // Individual thumb links for each slide
            thumbnail_navigation : 1,   // Thumbnail navigation
            slides : [                  // Slideshow Images
                {image : url_path + '/content/image/background/image_1.jpg'},
                {image : url_path + '/content/image/background/image_2.jpg'},
                {image : url_path + '/content/image/background/image_3.jpg'},  
                {image : url_path + '/content/image/background/image_4.jpg'},  
                {image : url_path + '/content/image/background/image_5.jpg'},  
                {image : url_path + '/content/image/background/image_6.jpg'},  
                {image : url_path + '/content/image/background/image_7.jpg'},  
                {image : url_path + '/content/image/background/image_8.jpg'},  
                {image : url_path + '/content/image/background/image_9.jpg'},  
                {image : url_path + '/content/image/background/image_10.jpg'},  
                {image : url_path + '/content/image/background/image_11.jpg'}
            ],
            progress_bar : 1,           // Timer for each slide							
            mouse_scrub : 0
        });
    }
});
