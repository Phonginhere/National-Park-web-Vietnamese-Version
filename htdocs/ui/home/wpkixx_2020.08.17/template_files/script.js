jQuery(document).ready(function () {
    'use strict';
	
	//Responsive Header
	$('.responsive-menu li.menu-item-has-children > a').on('click', function () {
            var parent = $(this).parent();
            var parent_sibling = $(this).parent().siblings();
            parent_sibling.children('ul').slideUp();
            parent_sibling.removeClass('active');
            parent.children('ul').slideToggle();
            parent.toggleClass('active');
            return false;
	});
	
	//for open responsive menu
            $('#nav-icon3').on('click', function () {
                $('.responsive-menu').toggleClass('slidein');
                return false;
            });
	
            // responsive search
            $('.res-search').on('click', function () {
                $('.search-insite').addClass('open');
                return false;
            });
            $('.search-insite > i').on('click', function () {
                $('.search-insite').removeClass('open');
                return false;
            });
			
			//scrollbar plugin
            if ($.isFunction($.fn.perfectScrollbar)) {
                $('.responsive-menu').perfectScrollbar();
            }
	
	//for open and close button rotation
            $('#nav-icon3').on('click', function(){
                $(this).toggleClass('open');
                return false;
            });
			
	//parallax
		if ($.isFunction($.fn.scrolly)) {
		$('.parallax').scrolly({bgParallax: true});
		}
	
	// Index Page Scripts End
	if ($.isFunction($.fn.downCount)) {
		$('.countdown').downCount({
			date: '09/26/2020 12:00:00',
			offset: +10
		});
	}
    //===== Header Search =====//
    $('.header-search > a').on('click', function () {
        $('.search-here').addClass('active');
        return false;
    });
    $('.search-here > i').on('click', function () {
        $('.search-here').removeClass('active');
        return false;
    });
	
	//Login dropdown	
		$('.login-register a').on('click', function() {
			$('.login-wraper').addClass('active');
			return false;
			});
			
		$('.close').on('click', function() {
			$('.login-wraper').removeClass('active');
			return false;
			});
			
/*=================== Dropdown Anmiation ===================*/ 
var drop = $('nav > ul > li > ul > li') 
$('nav > ul > li').each(function(){
    var delay = 0;
    $(this).find(drop).each(function(){
    $(this).css({transitionDelay: delay+'ms'});
    delay += 50;
    });
});  
var drop2 = $('nav  > ul > li > ul > li >  ul > li')
$('nav > ul > li > ul > li').each(function(){      
    var delay2 = 0;
    $(this).find(drop2).each(function(){
    $(this).css({transitionDelay: delay2+'ms'});
    delay2 += 50;
    });
}); 
			
	//News caro
			$('.news-caro').owlCarousel({
			  autoplay:true,
			  autoplayTimeout:2500,
			  loop:false,
			  animateOut: 'slideInDown',
			  animateIn: 'slideOutDown',
			  nav: false,
			  dots: false,
			  margin:0,
			  mouseDrag:true,
			  items:1,
			  autoHeight:true,
			  responsive:{
				320:{nav:false},
				480:{nav:false},
				980:{nav:false},
				1200:{nav:false}
			  }
			});
		//footer popular carousel	
			$('.ftr-popular-caro').owlCarousel({
				loop:true,
				margin:0,
				smartSpeed: 1000,
				responsiveClass:true,
				nav:false,
				dots:false,
				autoplay:true,
				responsive:{
					0:{
						items:1,
					},
					600:{
						items:1,
					},
					1000:{
						items:1,
						loop:false,
					}
				}
			});
			//progress bar carousel	
			$('.progress-caro').owlCarousel({
				loop:true,
				margin:0,
				smartSpeed: 1000,
				responsiveClass:true,
				nav:false,
				dots:true,
				autoplay:true,
				responsive:{
					0:{
						items:1,
						nav:false,
						dots:false
					},
					600:{
						items:1,
						nav:false
					},
					1000:{
						items:1,
						nav:false,
						dots:true
					}
				}
			});
			//progress widget carousel
			  $('.carousel-btn').owlCarousel({
				items:3,  
				loop:true,
				margin:4,
				smartSpeed: 1000,
				responsiveClass:true,
				nav:false,
				dots:false,
				autoplay:true,
				URLhashListener:true,
				startPosition: 'URLHash',
				responsive:{
					0:{
						items:3,
						nav:false,
						dots:false
					},
					600:{
						items:5,
						nav:false
					},
					1000:{
						items:3,
						nav:false,
						loop:false,
						dots:false
					}
				}
			});
			 $('.popular-video').owlCarousel({
				items:1,
				loop:false,
				center:true,
				margin:0,
				dots:false,
				URLhashListener:true,
				autoplayHoverPause:true,
				startPosition: 'URLHash'
			});
			
			//related video posts carousel in single page
			$('.related-post-caro').owlCarousel({
				loop:false,
				margin:30,
				smartSpeed: 1000,
				responsiveClass:true,
				nav: false,
				dots:false,
				autoplay:false,
				responsive:{
					0:{
						items:2,
					},
					600:{
						items:4,
					},
					1000:{
						items:6,
						loop:false,
					}
				}
			});
			// featured post carousel 
			$('.hl-featured-caro').owlCarousel({
				stagePadding: 250,
				loop:true,
				margin:10,
				nav:false,
				dots:false,
				smartSpeed: 1000,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:1
					}
				}
			});
			
			// single caro 
			$('.single-caro').owlCarousel({
				loop:false,
				margin:0,
				smartSpeed: 1000,
				responsiveClass:true,
				nav:true,
				dots:false,
				autoplay:false,
				responsive:{
					0:{
						items:1,
						nav:false,
						dots:false
					},
					600:{
						items:1,
						nav:true
					},
					1000:{
						items:1,
						nav:true,
						loop:false,
						dots:false
					}
				}
			});
			
});

