(function ($) {


	// Selectric
	function selectricGforms() {
		$('.gform_wrapper select').selectric({
			disableOnMobile: false,
			nativeOnMobile: false,
			responsive: true,
			maxHeight: 264
		});
	}
	selectricGforms();
	// Slick - Global settings
	var slick_previous = '<button class="slick-arrow slick-arrow--previous"><i class="fal fa-angle-left"></i><span class="screen-reader-text"><i class="fal fa-angle-left"></i></span></button>';
	var slick_next = '<button class="slick-arrow slick-arrow--next"><i class="fal fa-angle-right"></i><span class="screen-reader-text"><i class="fal fa-angle-right"></i></span></button>';
	// Slick - Single Slide
	$('.js-slick-single').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		arrows: true,
		prevArrow: slick_previous,
		nextArrow: slick_next,
		dots: false,
		speed: 600,
		cssEase: 'ease-in-out',
		lazyLoad: 'ondemand'
	});
	$('.js-slick-single img').load(function () {
		$(this).addClass('slick-loaded');
		$(this).prev('.spinner').fadeOut().remove();
	});
	$('.featuredSlick').slick({
		dots: true,
		infinite: true,
		speed: 300,
		slidesToShow: 3,
		slidesToScroll: 3,
		prevArrow: slick_previous,
		nextArrow: slick_next,
		responsive: [
		  {
			breakpoint: 1030,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 2,
			  dots: true
			}
		  },
		  {
			breakpoint: 600,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		  // You can unslick at a given breakpoint now by adding:
		  // settings: "unslick"
		  // instead of a settings object
		]
	  });
	// Toggle offscreen menu
	$('.js-nav-toggle').click(function (e) {
		e.preventDefault();
		$('.js-nav-toggle').toggleClass('is-active');
		$('.offscreen').toggleClass('offscreen--active');
		$('body').toggleClass('body--offscreen-active');
	});
	// Superfish dropdown
	$('.nav--primary').superfish();
	// Close nav on anchor click
	$('.offscreen a[href^="#"]').click(function (event) {
		$('.js-nav-toggle').trigger("click");
	});
	// Smooth scroll for anchor links
	$('.js-link-anchor, .js-link-anchor a').click(function () {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top
				}, 1000);
				return false;
			}
		}
	});
	// Magnific Popup - Standard
	$('.js-magnific-popup').magnificPopup({
		type: 'inline',
		closeBtnInside: true,
		closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',
		midClick: true
	});
	// Magnific Popup - Video
	$('.js-magnific-video').magnificPopup({
		type: 'inline',
		midClick: true,
		callbacks: {
			open: function () {
				// Play video on open
				$(this.content).find('video')[0].play();
				var p = $(this.content).find('video')[0].player;
				p.setPlayerSize();
				p.setControlsSize();
			},
			close: function () {
				// Reset video on close
				$(this.content).find('video')[0].load();
			}
		}
	});
	// Magnific Popup - Ajax
	$('.js-magnific-ajax').magnificPopup({
		type: 'ajax',
		closeBtnInside: true,
		closeOnContentClick: false,
		closeOnBgClick: false,
		// removalDelay: 800, // Delay removal for animation
		tLoading: '<div class="spinner"></div>',
	});
	// Infinite Scroll
	// Infinite Scroll - Settings
	$container = $('.js-infinite-parent');
	$container.infiniteScroll({
		path: '.nav--pagination a',
		append: '.js-infinite-item',
		history: false,
		checkLastPage: true,
		scrollThreshold: 200
	});
	// Infinite Scroll - Loaded
	$container.on('append.infiniteScroll', function (event, response, path, items) {
		$('.js-match-height').matchHeight();
	});
	// Infinite Scroll - Last Page
	$container.on('last.infiniteScroll', function (event, response, path) {
		$('.nav-pagination').fadeOut().remove();
	});
	// Equal Heights
	$('.js-match-height').matchHeight();

	
	// Sticky header
	var headerHeight = $('.header').outerHeight();
	if ($(window).scrollTop() >= headerHeight) {
		$('.header').addClass('header--sticky');
	}
	$(window).scroll(function () {
		var sticky = $('.header'),
			scroll = $(window).scrollTop();
		if (scroll >= headerHeight) sticky.addClass('header--sticky');
		else sticky.removeClass('header--sticky');
	});
	// Accordion
	$('.accordion__item__content').hide(); // Close all accordions
	$('.js-accordion-toggle').click(function (e) {
		e.preventDefault();
		var accordion_id = $(this).data('target');
		if ($(this).parent().hasClass('accordion__item--active')) { // If the accordion is already open
			$('.accordion__item').removeClass('accordion__item--active');
			$('.accordion__item__content').slideUp();
			$(this).parent().removeClass('accordion__item--active');
			$('#' + accordion_id).slideUp();
		} else { // Else if the accordion is not open
			$('.accordion__item').removeClass('accordion__item--active');
			$('.accordion__item__content').slideUp();
			$(this).parent().addClass('accordion__item--active');
			$('#' + accordion_id).slideDown();
		}
	});
	// Responsive videos
	$('.js-fitvids').fitVids();
	// Lazy Loading images
	var bLazy = new Blazy({
		selector: '.b-lazy',
		loadInvisible: true,
		offset: 200,
		success: function (element) {
			$(element).prev('.spinner').fadeOut().remove();
		}
	});
	// Gravity Forms
	$(document).bind('gform_post_render', function () {
		selectricGforms();
	});

	$(".mainMenu .menu-item a").each(function (index) {
		if (!$(this).hasClass("menu--home")) {
			pageColor = $(this).data("pagecolor");

			if (pageColor) {
				$(this).addClass(pageColor);
			}
		}
	});

	if ($('.heroBackgroundText').length) {

		homeHero = $('.heroBackgroundText').text();
		var text = document.querySelector(".copyText");

		var repeatCount = text.dataset.count

		homeHero.split("");
		var i = 0,
			length = homeHero.length;

		for (var i = 0; i < repeatCount; i++) {
			delayCount = i * 200;
			$(".backText").clone().removeClass("backText").appendTo(".copiedTextArea").delay(delayCount).animate({
				opacity: 1
			}, 100);
		}

	}

	if ($('.heroBackgroundTextInner').length) {
	}


	$(document).on('facetwp-loaded', function () {
		if (FWP.loaded) {
			$('html, body').animate({
				scrollTop: $('.featuredProducts').offset().top
			}, 500);
		}
	});

	$("<span><strong>Color:</strong></span>").insertBefore(".attribute_pa_color_picker_label");


	$('.slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		prevArrow: slick_previous,
		nextArrow: slick_next,
		arrows: true,
		fade: true,
	});


	$(window).scroll(function () {

		function isScrolledIntoView(elem) {
			var docViewTop = $(window).scrollTop();
			var docViewBottom = docViewTop + $(window).height();
		
			var elemTop = $(elem).offset().top;
			var elemBottom = elemTop + $(elem).height();
		
			return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
		}
		
		$(window).scroll(function () {
			$('.contentTextArea h2').each(function () {
				if (isScrolledIntoView(this) === true) {
					$(this).addClass('visible-line');
				} else {
					$(this).removeClass('visible-line');
				}
			});
		
		});

		if ($(".shapesAnimation2").length) {
			if ($(".animateShapes").length) {
				var top_of_element = $(".animateShapes").offset().top;
				var bottom_of_element = $(".animateShapes").offset().top + $(".animateShapes").outerHeight();
				var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
				var top_of_screen = $(window).scrollTop();

				if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)) {
					$(".animateShapes .shape").each(function (index) {
						console.log(this);
						var leftRandom = Math.floor(Math.random() * 100) + 1;
						var topRandom = Math.floor(Math.random() * 100) + 1;
						$(this).animate({
							left: +leftRandom + "%",
							top: +topRandom + "%",
							opacity: 0
						}, 4000, function () {
							// Animation complete.
							console.log('finish animate');
							$( '.shape' ).stop();
							$('.animateShapes').removeClass('animateShapes');
						});
					});
				} 
			} else {
				// Not working
				// $(".shapesAnimation .shape").each(function (index) {
				// 	$(this).animate({
				// 		left: "50%",
				// 		top: "50%",
				// 		opacity: 1
				// 	}, 4000, function () {
				// 		// Animation complete.
				// 		$( '.shape' ).stop();
				// 		$('.shapesAnimation').addClass('animateShapes');
				// 	});
				// });
			}
		}

		
	}).scroll();
	
	// WooCommerce
	function customWooFields() {
		$('.woocommerce-shipping-methods label, .wc_payment_methods label, .woocommerce-terms-and-conditions-wrapper label, .custom-checkbox label').append('<span class="custom-input"></span>');	
	}

	customWooFields();

	$('body').on('updated_shipping_method country_to_state_changed updated_wc_div init_checkout updated_checkout', function(){
	    customWooFields();
	});

	AOS.init();


})(jQuery);

document.addEventListener("mousemove" , mouseMove);
function mouseMove(e) {
	this.querySelectorAll('.eachShape').forEach(layer => {
		const moveRate = layer.getAttribute('data-movement');
		const x = (window.innerWidth - e.pageX*moveRate )/100;
		const y = (window.innerWidth - e.pageY*moveRate )/100;

		layer.style.transform = `translateX(${x}px) translateY(${y}px)`;
	})
}

