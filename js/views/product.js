$(function(){
    set_menuOn('shop');
    shop_handle($('input#gb').val());
    
    $(".productImage").elevateZoom({gallery:'productImage', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'}); 
    $(".productImage").bind("click", function(e) {  
        var ez = $('.productImage').data('elevateZoom');	
        $.fancybox(ez.getGalleryList());
        return false;
    });
});

function buy(){
    var newDiv = $(document.createElement('div')); 
    if($("#quantity").val()!==''){
        var quantity = trimNumber($("#quantity").val());
        newDiv.html('<p align="center">you just added<br> '+quantity +' "'+ $("#name").val()  +'"<br> to your cart </p>');
        newDiv.dialog({
            hide:  ('fade',3000),
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
function isNumber(evt) {
   evt = (evt) ? evt : window.event;
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode > 31 && (charCode < 48 || charCode > 57)) {
       return false;
   }
   return true;
}
function trimNumber(s) {
    while (s.substr(0,1) === '0' && s.length > 1)
        s = s.substr(1,9999);
    return s;
}