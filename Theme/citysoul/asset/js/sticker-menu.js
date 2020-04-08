(function($) {
	"use strict";
	$(document).ready(function() {
		var menu = $(".postion-menu-sticker");

	    var checkpos = menu.position();
	    if(typeof(checkpos)  != "undefined") {
	    	var pos = (checkpos.top)+200;
		    $(window).scroll(function() {
		        var windowpos = $(window).scrollTop();
		        if (windowpos >= pos) {$(".sticker").addClass("active");}
		        else {$(".sticker").removeClass("active");}
		    });
	    }
    });

})(jQuery);