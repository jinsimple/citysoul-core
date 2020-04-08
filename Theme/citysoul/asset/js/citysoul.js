(function($) {
	"use strict";

	//Click search
	$('.search-header .fa-search').click(function(event) {
		$('.element-search').toggleClass('active');
	});

	//Menu mobile
    $("#citysoul-mobile-menu button").click(function(){
        $(".mobile-menu .menu, #citysoul-mobile-menu button,.sticker").toggleClass("show-menu-mobile");
        $("body").toggleClass("show-menu-mobile");
    });

    $("#citysoul-mobile-menu .menu-item-has-children").click(function(){
        if ($('#citysoul-mobile-menu .mobile-menu ul li').hasClass('menu-item-has-children')) {
          $(this).find('.sub-menu').toggleClass('active');
        };
    });

    var size_screen = screen.width;
    if (size_screen<400) {
      $(".menu-item-has-children").prepend("<div class='arrow-menu'><i class='fa fa-angle-down'></i></div>");
    };

    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });

    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })


    $('.link-details a').click(function(event) {
      if (!$('.link-details').hasClass('active')) {
        $('.gallery-details-slide,.swiper-navigate,.link-details').addClass('active');
        setTimeout(function() {
            $('.bg-details-project').show('fast');
        }, 300);
      }
      else{
        $('.gallery-details-slide,.swiper-navigate,.link-details,.bg-details-project').removeClass('active');
        $('.bg-details-project').hide('fast');
      }
      return false;
    });

    $('.share a').click(function(event) {
      if (!$('.bg-share').hasClass('animated fadeIn')) {
        $('.bg-share').addClass('animated fadeIn');
      }
      else{
        //wait for animation to finish before removing classes
        window.setTimeout( function(){
            $('.bg-share').removeClass('animated fadeIn');
        }, 200);
      }
      return false;
    });

    //Woo js
    new WOW().init();

    //Lazy load
    $(document).ready(function () {
      $("img")
        .lazyload({
             event: "lazyload",
             effect: "fadeIn",
             effectspeed: 2000
           })
        .trigger("lazyload");

      setTimeout(function(){
        $('body').addClass('loaded');
      }, 1000);

      //Choose sidebar
      $('#page_template').change(function() {
        if ($(this).val() == 'templates/template-choose-sidebar.php') {
          $('#_beautheme_sidebar').show('slow');
        }else{
          $('#_beautheme_sidebar').hide('fast');
        }
      });
    });
    
})(jQuery);