/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    set_menuOn('stock');
    setupAdmin();
    setupStock();
    
    $('.stock_category ul li').not('.selected').click(function(){
        var token = $('input#token').val();
        var cat = $('li').index(this);
        window.location.href = "stock&token=" + token + "&cat=" + cat;
    });
    
    $('input.stock').change(function(){
        if ($(this).val() !== $(this).attr('base'))
            $(this).addClass('changed');
        else
            $(this).removeClass('changed');
        
        $('.stock_detail a').text(countChange());
        if (countChange() > 0)
            $('.stock_detail').show();
        else
            $('.stock_detail, .stock_save').hide();
    });
    
    $('.stock_detail span').click(function(){
        $('.stock_save').fadeIn(function(){
            setTimeout(function(){
                $('.stock_save').fadeOut();
            }, 5000);
        });
    });
    
    $('.stock_save').click(function(){
        var items = [];
        $('input.changed').each(function(){
            var item = {
                number : $(this).attr('item'),
                size : $(this).attr('size'),
                stock : $(this).val()
            };
            items.push(item);
        });
        var data = {
            product : items,
            token : $('#token').val()
        };
        $.post('view/stock_save.php', data, function(){
            location.reload();
        });
    });
});

function setupAdmin(){
    $('header#start_menu, header#top_menu, #background_1, svg.arrow, div#controls-wrapper, footer, #myCart, #popup, #supersized-loader, #supersized').remove();
    document.title = "SD Admin";
    
    //tmp for Stock page only one created
    $('ul#main_menu li').not($('ul#main_menu li').first()).remove();
    
    $('ul#main_menu li:eq(0)').attr('id','stock');
    $('ul#main_menu li:eq(0)').text('STOCK');
}
function setupStock(){
    var number = $('input#category').val();
    $('.stock_category ul li:eq('+number+')').addClass('selected');
}
function countChange(){
    return $('.stock_main input.changed').size();
}
