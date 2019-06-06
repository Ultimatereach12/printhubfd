(function($){
"use strict"; // Start of use strict
//Info Sticky
function gallery_fixed(){
	if($('.detail-gallery-sticky').length > 0){
		$('.detail-gallery-sticky').each(function(){
			var self = $(this);
			var info = self.parents('.product-detail').find('.detail-info');
			if($(window).width()>980){
				if($('.main-nav').hasClass('active')){
					self.parents('.product-detail').addClass('detail-on-sticky-menu');
				}else{
					self.parents('.product-detail').removeClass('detail-on-sticky-menu');
				}
				var st = $(window).scrollTop();
				var ot = self.offset().top;
				var sh = self.height();
				var dh = info.height();
				var stop = sh - dh;
				var top = st - ot;
				if(st < ot){
					info.css('top',0);
				}
				if(st > ot && st < ot+sh-dh){
					info.css('top',top+'px');
				}
				if(st > ot+sh-dh){
					info.css('top',stop+'px');
				}
			}else{
				info.css('top',0);
			}
		});
	}
}
//Add to Cart Sticky
function add_cart_sticky(){
	if($('.sticky-addcart').length > 0){
		$('.sticky-addcart').each(function(){
			var self = $(this);
			var cart = self.prev().find('form.cart');	
			var st = $(window).scrollTop();
			var ot = cart.offset().top;
			var stop = $('#footer').offset().top - $(window).height();
			if( st > ot && st < stop){
				self.addClass('active');
			}else{
				self.removeClass('active');
			}
		});
	}
}
//Offset Menu
function offset_menu(){
	if($(window).width()>767){
		$('.main-nav .sub-menu').each(function(){
			var wdm = $(window).width();
			var wde = $(this).width();
			var offset = $(this).offset().left;
			var tw = offset+wde;
			if(tw>wdm){
				$(this).addClass('offset-right');
			}
		});
	}else{
		return false;
	}
}
//Document Ready
jQuery(document).ready(function(){
	gallery_fixed();
	//Scroll Review
	$(".woocommerce-review-link").click(function(event){		
		event.preventDefault();
		$('html,body').animate({scrollTop:$(this.hash).offset().top}, 1000);
	});
	offset_menu();
	//Fix Menu Ipad
	$('.main-nav>ul>li>a,.main-nav .sub-menu>li>a').click(function(event){  
		if($(this).next().length>0){
			if(767 < $(window).width() && $(window).width() < 1025){
				$(this).toggleClass('active');
				if($(this).hasClass('active')){
					event.preventDefault();
					$(this).next().slideDown();
				}else{
					$(this).next().slideUp();
				}
			}
		}
	});
	//Hover Ditection
	if($('.box-hover-dir').length>0){
		$('.box-hover-dir').each( function() {
			$(this).hoverdir(); 
		});
	}
	
	//Hover Active
	if($('.box-hover-active').length>0){
		$('.box-hover-active').each(function(){
			$(this).find('.item-active').addClass('active');
			$(this).find('.item-hover-active').on('mouseover',function(){
				$(this).parents('.box-hover-active').find('.item-hover-active').removeClass('active');
				$(this).addClass('active');
			});
			$(this).on('mouseout',function(){
				$(this).find('.item-hover-active').removeClass('active');
				$(this).find('.item-active').addClass('active');
			});
		});
	}
	//Tag Toggle
	if($('.toggle-tab').length>0){
		$('.toggle-tab').each(function(){
			$(this).find('.item-toggle-tab.active .toggle-tab-content').slideDown();
			$(this).find('.toggle-tab-title').on('click',function(event){
				if($(this).next().length>0){
					event.preventDefault();
					var self = $(this);
					self.parent().siblings().removeClass('active');
					self.parent().toggleClass('active');
					self.parents('.toggle-tab').find('.toggle-tab-content').slideUp();
					self.next().stop(true,false).slideToggle();
				}
			});
		});
	}
	//Video Custom
	if($('.block-video-custom').length > 0){
		$('.block-video-custom').each(function(){
			var self = $(this);
			self.find('.video-button').on('click', function (event) {
				event.preventDefault();
				self.addClass('clicked');
				var video = self.find('.video-custom').get(0);
				$(this).toggleClass('active');
				if (video.paused) {
					video.play();
				} else {
					video.pause();
				}
			});
		});
	}
	//Menu Fixed
	if($(window).width()>767){
		$('.close-main-nav').on('click',function(event){
			$('body').removeClass('overlay');
			$('.menu-fixed').removeClass('active');
		});
		$('.btn-menu-fixed').on('click',function(event){
			event.preventDefault();
			event.stopPropagation();
			$('body').addClass('overlay');
			$(this).parent().addClass('active');
		});
	}
	//Sidebar Fixed
	if($('.block-filter-extra').length>0){
		$('.show-sidebar').on('click',function(event){
			$(this).parent().addClass('active');
		});
		$('.close-sidebar').on('click',function(event){
			$(this).parent().parent().removeClass('active');
		});
		$('.toggle-filter-extra').on('click',function(event){
			$(this).toggleClass('active');
			$(this).next().slideToggle();
		});
	}
	//Fancy Box
	if($('.fancybox').length>0){
		$('.fancybox').fancybox();	
	}
	if($('.fancybox-media').length>0){
		$('.fancybox-media').attr('rel', 'media-gallery').fancybox({
			openEffect : 'none',
			closeEffect : 'none',
			prevEffect : 'none',
			nextEffect : 'none',
			arrows : false,
			helpers : {
				media : {}
			}
		});
	}
});
//Window Load
jQuery(window).on('load',function(){ 
	add_cart_sticky();
	//Count Up
	if($('.count-up').length>0){
		$('.count-up').each( function() {
			$(this).countUp(); 
		});
	}
	$('.item-product-inner .wrap-cart-price .addcart-link').on('mouseover',function(){
		$(this).next().hide();
	});
	$('.item-product-inner .wrap-cart-price .addcart-link').on('mouseout',function(){
		$(this).next().show();
	});
	//Slick Slider
	if($('.portfolio-slider').length>0){
		$('.portfolio-slider').each(function(){
			var self = $(this);
			var rtl = self.data('rtl');
			self.find('.slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				prevArrow:'<span class="slick-prev"><i class="la la-angle-left"></i></span>',
				nextArrow:'<span class="slick-next"><i class="la la-angle-right"></i></span>',
				centerMode: true,
				centerPadding: '480px',
				rtl:rtl,
				responsive: [
					{
					  breakpoint: 1440,
					  settings: {
						centerPadding: '300px',
					  }
					},
					{
					  breakpoint: 1200,
					  settings: {
						centerPadding: '200px',
					  }
					},
					{
					  breakpoint: 767,
					  settings: {
						centerPadding: '0px',
					  }
					}
				]
			});
		})
	}
	//Animate
	if($('.wow').length>0){
		new WOW().init();
	}
	//Final Countdown
	if($('.final-countdown').length>0){
		$('.final-countdown').each(function(){
			var self = $(this);
			var finalDate = self.data('countdown');
			self.countdown(finalDate, function(event) {
				self.html(event.strftime(''
					+'<div class="clock day"><strong class="number">%D</strong><span class="text">DAYS</span></div>'
					+'<div class="clock hour"><strong class="number">%H</strong><span class="text">HUR</span></div>'
					+'<div class="clock min"><strong class="number">%M</strong><span class="text">MIN</span></div>'
					+'<div class="clock sec"><strong class="number">%S</strong><span class="text">SEC</span></div>'
				));
			});
		});
	}
	//Clock Countdown
	if($('.clock-coundown').length>0){
		$('.clock-coundown').each(function(){
			var self = $(this);
			var finalDate = self.data('countdown');
			self.countdown(finalDate, function(event) {
				self.html(event.strftime(''
					+'<div class="clock day"><strong class="number">%D</strong></div>'
					+'<div class="clock hour"><strong class="number">%H</strong></div>'
					+'<div class="clock min"><strong class="number">%M</strong></div>'
					+'<div class="clock sec"><strong class="number">%S</strong></div>'
				));
			});
		});
	}
	//Time Circle
	if($('.time-countdown').length>0){
		$(".time-countdown").each(function(){
			var data = $(this).data(); 
			$(this).TimeCircles({
				fg_width: data.width,
				bg_width: 0,
				text_size: 0,
				circle_bg_color: data.bg,
				time: {
					Days: {
						show: data.day,
						text: data.text[0],
						color: data.color,
					},
					Hours: {
						show: data.hou,
						text: data.text[1],
						color: data.color,
					},
					Minutes: {
						show: data.min,
						text: data.text[2],
						color: data.color,
					},
					Seconds: {
						show: data.sec,
						text: data.text[3],
						color: data.color,
					}
				}
			}); 
		});
	}
	//Circle Percentage
	$('.percentage').each(function(){
		var data = $(this).data();
		// console.log(data);
		$(this).circularloader({
			backgroundColor: "transparent",//background colour of inner circle
			fontColor: data.color,//font color of progress text
			fontSize: "24px",//font size of progress text
			radius: data.radius,//radius of circle
			progressBarBackground: "transparent",//background colour of circular progress Bar
			progressBarColor: data.color,//colour of circular progress bar
			progressBarWidth: 10,//progress bar width
			progressPercent: data.value,//progress percentage out of 100
			progressValue:0,//diplay this value instead of percentage
			showText: false,//show progress text or not
			title: "",//show header title for the progress bar
		});
	});
});
//Window Resize
jQuery(window).on('resize',function(){
	gallery_fixed();
	offset_menu();
});
//Window Scroll
jQuery(window).on('scroll',function(){
	gallery_fixed();
	add_cart_sticky();
});
})(jQuery); // End of use strict