
var script = function(){

    var win = $(window);
    var html = $('html');
    var body = $('body');

    var mMenu = function(){
        var m_nav_btn=$('.menu-btn');
        var m_nav=$('.mobile-menu');

        m_nav.find("ul li").each(function() {
            if($(this).find("ul>li").length > 0){
                $(this).prepend('<i class="sub-menu-hide"></i>');
            }
        });

        m_nav_btn.click(function(){
            var nav = m_nav.children('ul');
            if(nav.is(":hidden")){
                $(this).children('i').removeClass('menu-btn-bar').addClass('menu-btn-close');
                nav.slideDown(200);
            }
            else {
                nav.slideUp(200);
                $(this).children('i').removeClass('menu-btn-close').addClass('menu-btn-bar');
                nav.find('ul').slideUp(200);
                nav.find('li>i').removeClass("sub-menu-show").addClass("sub-menu-hide");
            }
        });

        m_nav.find("li i").click(function(){
            var ul=$(this).nextAll("ul");
            if(ul.is(":hidden") === true){
                ul.parent('li').parent('ul').children('li').children('ul').slideUp(200);
                ul.parent('li').parent('ul').children('li').children('i').removeClass("sub-menu-show").addClass("sub-menu-hide");
                $(this).removeClass("sub-menu-hide").addClass("sub-menu-show");
                ul.slideDown(200);
            }
            else{
                $(this).removeClass("sub-menu-show").addClass("sub-menu-hide");
                ul.slideUp();
                ul.find('ul').slideUp(200);
                ul.find('li>i').removeClass("sub-menu-show").addClass("sub-menu-hide");
            }
        });

        win.click(function(event) {
            e=event;
            win_ = $(this);
            var menu = $(".mobile-menu");
            if(menu.has(e.target).length == 0 && !menu.is(e.target)){
                menu.find('ul').slideUp(200);
                menu.find('li>i').removeClass("sub-menu-show").addClass("sub-menu-hide");
                menu.children('.menu-btn').children('i').removeClass('menu-btn-close').addClass('menu-btn-bar');
            }
        });

        var ml_scroll = win.scrollTop();
        win.scroll(function() {    
            var win_ = $(this);

            var m_scroll = $(this).scrollTop();
            if(ml_scroll < m_scroll-50 && m_scroll > 80){
                m_nav.addClass('cnav-hide');
                menuReset();
            }
            if(ml_scroll > m_scroll+50 || m_scroll <=80){
                m_nav.removeClass('cnav-hide');
            }
            ml_scroll = m_scroll;
        });

        win.resize(function() {
            if($(this).width()>991){
                menuReset();
            }
        });

        function menuReset(){
            m_nav.find('ul').hide();
            m_nav.find('li>i').removeClass("sub-menu-show").addClass("sub-menu-hide");
            m_nav_btn.children('i').removeClass('menu-btn-close').addClass('menu-btn-bar');
        }
    }

    var backToTop = function(){
        var back_top = $('.back-to-top');

        if(win.scrollTop() > 500 && win.width()<=991){ back_top.fadeIn(); }

        back_top.click(function(){
            $("html, body").animate({ scrollTop: 0 }, 800 );
            return false;
        });

        win.resize(function() {
            if($(this).width()>991){
                back_top.fadeOut();
            }
        });

        win.scroll(function() {    
            if(win.scrollTop() > 500 && win.width()<=991 ) back_top.fadeIn(); 
            else back_top.fadeOut();
        });
    }

    var uiClickShow = function(){
        // var ani = 200;
        // $('[data-show]').each(function() {
        //     var this_ = $(this);
        //     var ct = $(this_.attr('data-show'));

        //     this_.click(function(e) {
        //         e.preventDefault();
        //         ct.slideToggle(ani);
        //     });
        // });

        // win.click(function(e) {
        //     if($(this).width() > 991){
        //         $('[data-show]').each(function() {
        //             var this_ = $(this);
        //             var ct = $(this_.attr('data-show'));
        //             if(ct.has(e.target).length == 0 && !ct.is(e.target) && this_.has(e.target).length == 0 && !this_.is(e.target)){
        //                 ct.slideUp(ani);
        //             }
        //         })
        //     }
        // });
    }

    function doAnimations( elems ) {
        var animEndEv = 'webkitAnimationEnd animationend';
        elems.each(function () {
            var $this = $(this),
            $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
            });
        });
    }

    var uiSlider = function(){
        var $myCarousel = $('#slider');
        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");     
        $myCarousel.carousel();   
        doAnimations($firstAnimatingElems);
        $myCarousel.on('slide.bs.carousel', function (e) {
            var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
            doAnimations($animatingElems);
        });
    }
    var uiSlick = function(){
        $('.big-cas').slick({
            nextArrow: '<i class="cas-arrow smooth next"></i>',
            prevArrow: '<i class="cas-arrow smooth prev"></i>',
            swipeToSlide: true,
            autoplaySpeed: 8000,
        })

        $('.post-cas').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            nextArrow: '<i class="smooth next"></i>',
            prevArrow: '<i class="smooth prev"></i>',
            autoplay: true,
            swipeToSlide: true,
            autoplaySpeed: 4000,
            responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                }
            }
            ],
        })

        $('.s-gallery').slick({
            nextArrow: '<i class="smooth next"></i>',
            prevArrow: '<i class="smooth prev"></i>',
            swipeToSlide: true,
            autoplaySpeed: 8000,
        })
    }

    return {

        uiInit: function($fun){
            switch ($fun) {
                case 'mMenu':
                mMenu();
                break;
                case 'backToTop':
                backToTop();
                break;
                case 'uiSlider':
                uiSlider();
                break;
                case 'uiSlick':
                uiSlick();
                break;
                case 'uiClickShow':
                uiClickShow();
                break;

                default:
                mMenu();
                backToTop();
                uiSlider();
                uiSlick();
                uiClickShow();
            }
        }
    }

}();


jQuery(function($) {
    var wow = new WOW({offset:50,mobile:false}); wow.init();
    script.uiInit();

    
});


$(window).bind("load", function() {
    $('body').append('<div id="fb-root"></div>');
    $.ajax({
        global: false,
        url: "theme/frontend/js/social.js",
        dataType: "script"
    });
    $.ajax({
        global: false,
        url: "https://apis.google.com/js/platform.js",
        dataType: "script"
    });
    window.___gcfg = {
        lang: 'vi',
        parsetags: 'onload'
    };

    var arr = $('.yt-iframe');
    var arrLe = arr.length;
    for (var i = 0; i < arrLe; i++) {
        var item = $(arr[i]);
        item.append('<iframe src="https://www.youtube.com/embed/'+item.attr('data-id')+'?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>');
    }
});