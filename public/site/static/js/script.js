var swiper = new Swiper('.slider', {
    slidesPerView: 1,
    spaceBetween: 30,
    autoHeight: true,
    autoplay: {
        delay: 2000,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
        768: {
            slidesPerView: 1
        },
        480: {
            slidesPerView: 1
        }
    },
});
// document.querySelectorAll('a[href^="#"]').forEach(anchor => {
//     anchor.addEventListener('click', function (e) {
//         e.preventDefault();

//         document.querySelector(this.getAttribute('href')).scrollIntoView({
//             behavior: 'smooth'
//         });
//     });
// });

$(document).ready(function(){
    var scroll = $(window).scrollTop();
    if(scroll > 5){
        $( "navbar.navbar-default" ).css('background-color','white');
    }else{
        $( "navbar.navbar-default" ).css('background-color','transparent');
    }
});

var tStart = 0
  , tEnd = 200
  , cStart = [243, 188, 120]
  , cEnd = [13, 22, 39]
  , cDiff = [cEnd[0] - cStart[0], cEnd[1] - cStart[1], cEnd[2] - cStart[2]];

$(window).scroll(function (event) {
    var scroll = $(window).scrollTop();
    const c = Math.min(scroll/200,1);
    $( ".navbar.navbar-default" ).css('background-color','rgba(255,255,255,'+c+')');


    var p = ($(this).scrollTop() - tStart) / (tEnd - tStart); // % of transition
        p = Math.min(1, Math.max(0, p)); // Clamp to [0, 1]
        var cBg = [Math.round(cStart[0] + cDiff[0] * p), Math.round(cStart[1] + cDiff[1] * p), Math.round(cStart[2] + cDiff[2] * p)];
    $( ".navbar.navbar-default" ).find('i, span').css({'cssText':'color:rgba('+ cBg.join(',') +',1) !important'});
  });
