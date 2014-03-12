 $(document).click(function(){
    $('#intro_dog, #intro_logo, #intro_logo_bg').hide();
    $('#intro_bg').fadeOut(2500);
 });
    
 $(document).keypress(function(event){
    $('#intro_dog, #intro_logo, #intro_logo_bg').hide();
    $('#intro_bg').fadeOut(2500);
 });
 
 $(document).ready(function(){
    var url_path = $('#local_path').val();
    var walking_dog = url_path + '/content/image/intro_1.gif';
    var logo_0 = url_path + '/content/image/intro_3.png';
    var logo_1 = url_path + '/content/image/intro_2.gif';
    var logo_2 = url_path + '/content/image/intro_4.png';
    
    $('#intro_bg').css({
        'background':'#FFFFFF',
        'z-index':'5',
        'width':'100%',
        'height':'100%',
        'position':'fixed'
    });
    $('#intro_dog').css({
        'background':'url('+walking_dog+')',
        'background-size':'contain',
        'background-repeat':'no-repeat',
        'height':'20%',
        'width':'10%',
        'top':'35%',
        'left':'3%',
        'position':'fixed',
        'display':'none'
    });
    $('#intro_logo').css({
        'background':'url('+logo_1+')',
        'background-size':'contain',
        'background-repeat':'no-repeat',
        'height':'20%',
        'width':'10%',
        'top':'35%',
        'left':'45%',
        'position':'fixed',
        'display':'none'
    });
    $('#intro_logo_bg').css({
        'background':'url('+logo_0+')',
        'background-size':'contain',
        'background-repeat':'no-repeat',
        'height':'20%',
        'width':'10%',
        'top':'35%',
        'left':'45%',
        'position':'fixed',
        'display':'none'
    });
    
    $('#intro_dog').fadeIn(1000);
    $('#intro_dog').animate({'left':'45%'}, 7500, function(){
        $(this).hide();
        $('#intro_logo').show();
        $('#intro_logo_bg').fadeIn(3500);
    });
    setTimeout(function(){
        $('#intro_logo, #intro_logo_bg').fadeOut(2000, function(){
            $('#intro_logo').css('background-image','url('+logo_2+')');
            $('#intro_logo').fadeIn(2000);
        });
    }, 13000);
    setTimeout(function(){
        $('#intro_bg').fadeOut(5000);
    }, 20000);
});
