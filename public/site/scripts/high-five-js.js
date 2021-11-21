
    $(document).ready(function() {

       ////////////////////////////////////
        $(".tab1").css("display", "block");
        $(".main-title h2").click(function(e) {
        $(".main-title h2.active").removeClass("active");
            $(this).addClass("active");
            
            $(".tabul.active").fadeOut(50).removeClass("active");
            $(".home-products.active").fadeOut(50).removeClass("active");
            $(" .tab" + $(".main-title h2.active").attr("data")).fadeIn(50).addClass("active");
            
            return false;
        });
////////////////////////////////////
$('.responsive-menu').each(function () {
            $(this).parent().eq(0).click(
                function () {

                    if ($('.showMenu a').hasClass('act')) {
                        $('.responsive-menu', this).eq(0).stop(true, true).slideUp(500);
                        $('a', this).eq(0).removeClass("act");

                    } else {
                        $('.responsive-menu', this).eq(0).stop(true, true).slideDown(500);
                        $('a', this).eq(0).addClass("act");

                    }
                });
        });
        ///////////////////////////////////////
         $('.submenu').each(function() {
            $(this).parent().eq(0).hover(
            function(){
                //this  -->  list item (li) that contain the current submenu
                $('.submenu', this).eq(0).stop(true,true).slideDown(400);
                $('a', this).eq(0).addClass("active");
            },
            function(){
                $('.submenu', this).eq(0).stop(true,true).slideUp(400);
                $('a', this).eq(0).removeClass("active");
            });
        });

        $('.south').tipsy({fade: true, gravity: 's'});
        $('.west').tipsy({fade: true, gravity: 'w'});
        $('.east').tipsy({fade: true, gravity: 'e'});
        $('.north').tipsy({fade: true, gravity: 'n'});

});
function isEnglishKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if(charCode == 32)
        return false;
    if (charCode == 46 || charCode == 95)
        return true;
    if (charCode > 47 && charCode< 58)
        return true;
    if(65 <= charCode && charCode <= 90)
        return true;
    if(97 <= charCode && charCode <= 122)
        return true;
    

    return false;
}

