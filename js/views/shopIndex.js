/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function loadProductPage(pageNumber){
    var brand = "";
    var color = "";
    var size = "";
     $('input[type=checkbox]').each(function(){
         if($(this).attr("class") === 'brand'){
             var sBrand = (this.checked ? this.id : "");
              brand += ( brand === "" ? sBrand : "," + sBrand );
         }
         if($(this).attr("class") === 'color'){
             var sColor = (this.checked ? this.id : "");
              color += ( color === "" ? sColor : "," + sColor );
         }
         if($(this).attr("class") === 'size'){
             var sSize = (this.checked ? this.id : "");
              size += ( size === "" ? sSize : "," + sSize );
         }
     });
     $.ajax({
         url: "shop/productPaginateAjax",
         data: {
             gb: $("#gb").val(),
             brand: brand,
             color:color,
             size:size,
             viewIndex:pageNumber
         },
         success: function( data ) {
             data = $(data).filter("#main").attr("id","");
             jQuery("#products-grid").fadeOut( 1100 , function() {
                 $("#products-grid").html(data);
             }).fadeIn( 1000 );
         }
     });
}
$(function(){
    set_menuOn('shop');
    alert($('input#gb').val());
    //set_shopOn($('input#gb').val(), 's');
    //shop_handle($('input#gb').val());
    
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
        hrefTextPrefix: "#viewIndex=", // A string used to build the href attribute, added before the page number.
        hrefTextSuffix: '', // Another string used to build the href attribute, added after the page number.
        prevText: "Prev", // Text to be display on the previous button.
        nextText: "Next", // Text to be display on the next button.
        cssStyle: "light-theme", // The class of the CSS theme.
        selectOnClick: true, // Set to false if you don't want to select the page immediately after click.
        onPageClick: function(pageNumber, event) {
            loadProductPage(pageNumber);
        }
    });
    
    // Sidebar
    
    var sidebarResize = function(){
          $('#ob-sidebar-wrapper, #ob-sidebar').height($(window).height()-120-$("footer").outerHeight());
          $('#ob-sidebar').niceScroll().resize();
    };
    $('#ob-sidebar-wrapper, #ob-sidebar').height($(window).height()-120-$("footer").outerHeight());
    $('#ob-sidebar-wrapper').fadeTo('fast',1);
    var bar = $('#ob-sidebar').niceScroll();
    bar.resize();
    $(window).resize(sidebarResize);

    /*
     * Show/Hide sidebar
     */

    var side_hidden = false;
    $('#sidebar-button').click(function(e){
            if(!side_hidden) {
                    $('#ob-sidebar-wrapper').animate({
                            'left': '-200'
                    }, 500, 'easeInOutQuint', function(e){
                            $(this).addClass('collapsed');
    bar.hide();
                    });

            $('#main-content').animate({'margin-left': 30},500,'easeInOutQuint',function(e){});

            } else {
                    $('#ob-sidebar-wrapper').animate({
                            'left': '0'
                    }, 500, 'easeInOutQuint', function(e){
                            $(this).removeClass('collapsed');
    bar.show();
                    });

                    $('#main-content').animate({'margin-left': 100},500,'easeInOutQuint',function(e){});
            }
            side_hidden = !side_hidden;
    });

    /*
     * Category filter
     */

    $('.categories').click(function(e){
            var self = this;
            $(this).addClass('active').siblings('.active').removeClass('active');
            $('.category-loader').show();
            $productsGrid.animate({opacity: 0}, function(){
                    var selector = $(self).children('a').attr('data-category');
                    $productsGrid.isotope({ filter: selector, containerStyle: {position: 'relative'}});
                    setTimeout(function(){$productsGrid.animate({opacity: 1});$('.category-loader').hide();}, 500);
            });
            e.preventDefault();
    });

    /*
     * Sort by featured
     */

    $('#sort-by-featured').click(function(e){
        if($(this).hasClass('hover')) {
                $productsGrid.isotope({sortBy: 'original-order', sortAscending: true});
                $(this).removeClass('hover');
        } else {
                $productsGrid.isotope({sortBy: 'featured', sortAscending: false});
                $(this).addClass('hover');
        }
        e.preventDefault();
    });
});