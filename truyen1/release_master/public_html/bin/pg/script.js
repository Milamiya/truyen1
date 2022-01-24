/* Please ❤ this if you like it! */


(function($) { "use strict";
	
	//Switch light/dark
	
	$(".switch").on('click', function () {
		if ($("body").hasClass("light")) {
			$("body").removeClass("light");
			$(".switch").removeClass("switched");
		}
		else {
			$("body").addClass("light");
			$(".switch").addClass("switched");
		}
	});
	
	$(document).ready(function() {	
		
		/* Hero Case study images */			
		
		$('.slide-buttons li:nth-child(1)').on('mouseenter', function() {
			$('.slide-buttons li.active').removeClass('active');
			$('.hero-center-section.show').removeClass("show");
			$('.hero-center-section:nth-child(1)').addClass("show");
			$('.slide-buttons li:nth-child(1)').addClass('active');
		})
		$('.slide-buttons li:nth-child(2)').on('mouseenter', function() {
			$('.slide-buttons li.active').removeClass('active');
			$('.hero-center-section.show').removeClass("show");
			$('.hero-center-section:nth-child(2)').addClass("show");
			$('.slide-buttons li:nth-child(2)').addClass('active');
		})
		$('.slide-buttons li:nth-child(3)').on('mouseenter', function() {
			$('.slide-buttons li.active').removeClass('active');
			$('.hero-center-section.show').removeClass("show");
			$('.hero-center-section:nth-child(3)').addClass("show");
			$('.slide-buttons li:nth-child(3)').addClass('active');
		})
		$('.slide-buttons li:nth-child(4)').on('mouseenter', function() {
			$('.slide-buttons li.active').removeClass('active');
			$('.hero-center-section.show').removeClass("show");
			$('.hero-center-section:nth-child(4)').addClass("show");
			$('.slide-buttons li:nth-child(4)').addClass('active');
		})
		$('.slide-buttons li:nth-child(1)').trigger('mouseenter')   
		
	});
	
})(jQuery);