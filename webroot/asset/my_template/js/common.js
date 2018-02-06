/* グロナビ */
(function($) {
  
  $.fn.droppy = function(options) {

    options = $.extend({speed: 250, className: 'droppy', trigger: 'hover'}, options || {});

    this.each(function() {

      var root = this, zIndex = 1000;

      $(root).addClass(options.className);
            $(root).find('li:has(> ul) > a').addClass('has-subnav');

      function getSubnav(ele) {
        if (ele.nodeName.toLowerCase() == 'li') {
          var subnav = $('> ul', ele);
          return subnav.length ? subnav[0] : null;
        } else {
          return ele;
        }
      };

      function getActuator(ele) {
        if (ele.nodeName.toLowerCase() == 'ul') {
          return $(ele).parents('li')[0];
        } else {
          return ele;
        }
      };

      function hide() {
        var subnav = getSubnav(this);
        if (!subnav) return;
        $.data(subnav, 'cancelHide', false);
        setTimeout(function() {
          if (!$.data(subnav, 'cancelHide')) {
            $(subnav).slideUp(options.speed);
          }
        }, 500);
      };

      function show() {
        var subnav = getSubnav(this);
        if (!subnav) return;
        $.data(subnav, 'cancelHide', true);
        $(subnav).css({zIndex: zIndex++}).slideDown(options.speed);
        if (this.nodeName.toLowerCase() == 'ul') {
          var li = getActuator(this);
          $(li).addClass('hover');
          $('> a', li).addClass('hover');
          /* #12 Start Luvina Modify */
          $('a', li).click(function() {
              var href = $(this).attr("href");
              if(href != '') {
                  window.location = $(this).attr("href");
              }
  
          });
          /* #12 End Luvina Modify */
        }
        return false;
      };
  
      if (options.trigger == 'click') {
        $('> li', this).click(show);
        $('> li ul, > li li', this).hover(show, function() {});
        $('ul, li', this).hover(function() {}, hide);
      } else {
        if (typeof $.fn.hoverIntent == 'function') {
          $('ul, li', this).hoverIntent($.extend({
            sensitivity: 2, interval: 50, timeout: 100
          }, options.hoverIntent || {}, {over: show, out: hide}));
        } else {
          $('ul, li', this).hover(show, hide);
        }
      }
  
      $('li', this).hover(
        function() { $(this).addClass('hover'); $('> a', this).addClass('hover'); },
        function() { $(this).removeClass('hover'); $('> a', this).removeClass('hover'); }
      );

    });

  };

})(jQuery);
  $(function() {
    $('#navi,#user_menu').droppy({trigger: 'click'});
  });
/* ニュース */ 
$(function(){
    $(window).load(function(){
        var $setElm = $('.c_ticker');
        var effectSpeed = 1000;
        var switchDelay = 6000;
        var easing = 'swing';
        /* #12 Start Luvina Modify */
        $(".current_page").removeAttr("href");
        /* #12 End Luvina Modify */

        $setElm.each(function(){
            var effectFilter = $(this).attr('rel');

            var $targetObj = $(this);
            var $targetUl = $targetObj.children('ul');
            var $targetLi = $targetObj.find('li');
            var $setList = $targetObj.find('li:first');

            var ulWidth = $targetUl.width();
            var listHeight = $targetLi.height();
            $targetObj.css({height:(listHeight)});
            $targetLi.css({top:'0',left:'0',position:'absolute'});

            if(effectFilter == 'fade') {
                $setList.css({display:'block',opacity:'0',zIndex:'98'}).stop().animate({opacity:'1'},effectSpeed,easing).addClass('showlist');
                setInterval(function(){
                    var $activeShow = $targetObj.find('.showlist');
                    $activeShow.animate({opacity:'0'},effectSpeed,easing,function(){
                        $(this).next().css({display:'block',opacity:'0',zIndex:'99'}).animate({opacity:'1'},effectSpeed,easing).addClass('showlist').end().appendTo($targetUl).css({display:'none',zIndex:'98'}).removeClass('showlist');
                    });
                },switchDelay);
            } else if(effectFilter == 'roll') {
                $setList.css({top:'3em',display:'block',opacity:'0',zIndex:'98'}).stop().animate({top:'0',opacity:'1'},effectSpeed,easing).addClass('showlist');
                setInterval(function(){
                    var $activeShow = $targetObj.find('.showlist');
                    $activeShow.animate({top:'-3em',opacity:'0'},effectSpeed,easing).next().css({top:'3em',display:'block',opacity:'0',zIndex:'99'}).animate({top:'0',opacity:'1'},effectSpeed,easing).addClass('showlist').end().appendTo($targetUl).css({zIndex:'98'}).removeClass('showlist');
                },switchDelay);
            } else if(effectFilter == 'slide') {
                $setList.css({left:(ulWidth),display:'block',opacity:'0',zIndex:'98'}).stop().animate({left:'0',opacity:'1'},effectSpeed,easing).addClass('showlist');
                setInterval(function(){
                    var $activeShow = $targetObj.find('.showlist');
                    $activeShow.animate({left:(-(ulWidth)),opacity:'0'},effectSpeed,easing).next().css({left:(ulWidth),display:'block',opacity:'0',zIndex:'99'}).animate({left:'0',opacity:'1'},effectSpeed,easing).addClass('showlist').end().appendTo($targetUl).css({zIndex:'98'}).removeClass('showlist');
                },switchDelay);
            }
        });
    });
});
/* BBSタブ */
$(document).ready(function() {
    /* #12 Start Luvina Modify */
    var checkShow = false;
    $(".c_bbs_area").each(function(arg1, arg2) {
        if ($(arg2).css('display') == 'block') {
            checkShow = true;
        }
    });

    if(!checkShow) {
        $('.c_bbs_area:first').show();
    }

    if(!$('.c_bbs_tab li').hasClass('active')) {
        $('.c_bbs_tab li:first').addClass('active');
    }

    $('.c_bbs_tab li').click(function() {
        var currentId = $(this).attr('id');
        $('.link_bbs_view').attr('href', '/bbs/' + currentId + '/');
        $('.link_bbs_post').attr('href', '/bbs/?action_bbs_form=true&bbs_category_id=' + currentId);
    /* #12 End Luvina Modify */
        $('.c_bbs_tab li').removeClass('active');
        $(this).addClass('active');
        $('.c_bbs_area').hide();

        $($(this).find('a').attr('href')).fadeIn();
        return false;
    });
});
/*ぱんくず*/
$(function() {
    $('#bread li.e_btn_home img')
    .hover(
        function(){
            $(this).stop().animate({'marginLeft':'-14px'},'normal');
        },
        function () {
            $(this).stop().animate({'marginLeft':'0px'},'normal');
        }
    );
});