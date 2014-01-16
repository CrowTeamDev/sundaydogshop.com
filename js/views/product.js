$(function(){
    set_menuOn('shop');
    shop_handle($('input#gb').val());
    
    $(".productImage").elevateZoom({
        gallery: 'productImage',
        cursor: 'pointer',
        galleryActiveClass: 'active',
        imageCrossfade: true,
        loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
    }); 
    $(".productImage").bind("click", function(e) {  
        var ez = $('.productImage').data('elevateZoom');	
        $.fancybox(ez.getGalleryList());
        return false;
    });
});

function buy(){
    var newDiv = $(document.createElement('div')); 
    if($("#quantity").val()!==''){
        var quantity = $("#quantity").val();
        newDiv.html('<p align="center">you just added<br> '+quantity +' "'+ $("#name").val()  +'"<br> to your cart </p>');
        newDiv.dialog({
            hide: ('fade',3000),
            show: ('fade',3000),
            modal: true,
            dialogClass: "no-close success-dialog",
            open: function(event, ui){
                setTimeout(newDiv.dialog('close'),5000);
            }
        });
        $(".ui-dialog-titlebar").hide();
    }
}