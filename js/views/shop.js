/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    set_menuOn('shop');
    shop_handle($('input#gb').val());
    
    $('.product').mouseover(function(){
       $('.product_detail').hide();
       $(this).find('.product_detail').show();
    });
    $('.product').mouseout(function(){
       $('.product_detail').hide();
    });
    
    $('.pagination-groupList').pagination({
            items: 1,   // Total number of items that will be used to calculate the pages.
            itemsOnPage: 1, // Number of items displayed on each page.
            pages:$('#viewHigh').val(),   // If specified, items and itemsOnPage will not be used to calculate the number of pages.
            displayedPages:5, // How many page numbers should be visible while navigating. Minimum allowed: 3 (previous, current & next)
            edges:2,    // How many page numbers are visible at the beginning/ending of the pagination.
            currentPage: $('#viewIndex').val(), // Which page will be selected immediately after init.
            hrefTextPrefix: "shop?gb="+$('#gb').val()+"&viewIndex=", // A string used to build the href attribute, added before the page number.
            hrefTextSuffix: '', // Another string used to build the href attribute, added after the page number.
            prevText: "Prev", // Text to be display on the previous button.
            nextText: "Next", // Text to be display on the next button.
            cssStyle: "light-theme", // The class of the CSS theme.
            selectOnClick: true, // Set to false if you don't want to select the page immediately after click.
    });
    $('.pagination-productList').pagination({
        items: 1,
        itemsOnPage: 1,
        pages:$('#viewHigh').val(),
        displayedPages:5,
        edges:2,
        currentPage: $('#viewIndex').val(),
        hrefTextPrefix: "shop?gb="+$('#gb').val()+"&f="+$('#f').val()+"&viewIndex=",
        hrefTextSuffix: '',
        prevText: "Prev",
        nextText: "Next",
        cssStyle: "light-theme",
        selectOnClick: true,
    });
});