/***************************************************
==================== JS INDEX ======================
****************************************************
01. PreLoader Js
02. Mobile Menu Js
03. Hero Js
04. Cart Toggle Js
05. Search Js
06. Sticky Header Js
07. Data Background Js
08.	Nice Select Js
09. Hero Slider Js)
10. Masonary Js
11. Wow Js
12. Data width Js
13. Cart Quantity Js
14. Show Login Toggle Js
15. Show Coupon Toggle Js
16. Create An Account Toggle Jss
17. Counter Js
18. Show Coupon Toggle Js
19. Parallax Js
20. InHover Active Js
21. Jquery Appear raidal
22. Testimonial-slider js
23. Testimonial-2-slider js
24. Testimonial-3-slider js
25. Portfolio activation
26. Portfolio-2 activation
27. Book-activation
28. Brand activation 
29. Brand-two activation
30. Client activation
31. Sponsors-slider activation
32. History-slider activation
33. Skill-slider activation
34. Course slider activation Js
35. Postbox__thumb slider activation Js
36. Course Slider Js

****************************************************/

(function ($) {
	("use strict");

	var windowOn = $(window);
	////////////////////////////////////////////////////

	//===== Prealoder
	$(window).on('load', function(event) {
        $('.preloader').delay(500).fadeOut(500);
    });

	////////////////////////////////////////////////////
	// 02. Mobile Menu Js
	$('#mobile-menu').meanmenu({
		meanMenuContainer: '.mobile-menu',
		meanScreenWidth: "1199",
		meanExpand: ['<i class="fal fa-plus"></i>'],
	});

	// menu-last class
	$(".main-menu nav > ul > li").slice(-4).addClass("menu-last");
	
	////////////////////////////////////////////////////
	// WOW active
	var wow = new WOW(
		{
			mobile: false,       // trigger animations on mobile devices (default is true)
		}
	);
	wow.init();

	////////////////////////////////////////////////////
	// 03. Sidebar Js
	$(".side-info-close,.offcanvas-overlay").on("click", function () {
		$(".side-info").removeClass("info-open");
		$(".offcanvas-overlay").removeClass("overlay-open");
	});
	$(".side-toggle").on("click", function () {
		$(".side-info").addClass("info-open");
		$(".offcanvas-overlay").addClass("overlay-open");
	});

	////////////////////////////////////////////////////
	// 04. Cart Toggle Js
	$(".cart-toggle-btn").on("click", function () {
		$(".cartmini__wrapper").addClass("opened");
		$(".body-overlay").addClass("opened");
	});
	$(".cartmini__close-btn").on("click", function () {
		$(".cartmini__wrapper").removeClass("opened");
		$(".body-overlay").removeClass("opened");
	});
	$(".body-overlay").on("click", function () {
		$(".cartmini__wrapper").removeClass("opened");
		$(".sidebar__area").removeClass("sidebar-opened");
		$(".header__search-3").removeClass("search-opened");
		$(".body-overlay").removeClass("opened");
	});

	////////////////////////////////////////////////////
    // 03. Sidebar Js
	$(".sidebar-toggle-btn").on("click", function () {
		$(".sidebar__area").addClass("sidebar-opened");
		$(".body-overlay").addClass("opened");
	});
	$(".sidebar__close-btn").on("click", function () {
		$(".sidebar__area").removeClass("sidebar-opened");
		$(".body-overlay").removeClass("opened");
	});


	////////////////////////////////////////////////////
	// 06. Sticky Header Js
	windowOn.on("scroll", function () {
		var scroll = $(window).scrollTop();
		if (scroll < 100) {
			$("#header-sticky").removeClass("sticky");
		} else {
			$("#header-sticky").addClass("sticky");
		}
	});

	////////////////////////////////////////////////////
	// 07. Data Background Js
	$("[data-background").each(function () {
		$(this).css("background-image", "url( " + $(this).attr("data-background") + "  )");
	});

	$("[data-bg-color").each(function () {
		$(this).css("background-color",$(this).attr("data-bg-color"));
	});


  	$("[data-top-space]").each(function () {
		$(this).css("padding-top", $(this).attr("data-top-space"));
	});

	$("[data-bottom-space]").each(function () {
		$(this).css("padding-bottom", $(this).attr("data-bottom-space"));
	});

	////////////////////////////////////////////////////
	// 08. Nice Select Js
	$("select").niceSelect();

	////////////////////////////////////////////////////
	// 09. Hero Slider Js
	if (jQuery(".bd-hero__active").length > 0) {
		let sliderActive1 = ".bd-hero__active";
		let sliderInit1 = new Swiper(sliderActive1, {
			// Optional parameters
			slidesPerView: 1,
			slidesPerColumn: 1,
			paginationClickable: true,
			loop: true,
			effect: "fade",

			autoplay: {
				delay: 5000,
			},

			// If we need pagination
			pagination: {
				el: ".hero-pagination",
				// dynamicBullets: true,
				clickable: true,
			},

			// Navigation arrows
			navigation: {
				nextEl: ".hero-button-next",
				prevEl: ".hero-button-prev",
			},
			a11y: false,
		});

		function animated_swiper(selector, init) {
			let animated = function animated() {
				$(selector + " [data-animation]").each(function () {
					let anim = $(this).data("animation");
					let delay = $(this).data("delay");
					let duration = $(this).data("duration");

					$(this)
						.removeClass("anim" + anim)
						.addClass(anim + " animated")
						.css({
							webkitAnimationDelay: delay,
							animationDelay: delay,
							webkitAnimationDuration: duration,
							animationDuration: duration,
						})
						.one(
							"webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
							function () {
								$(this).removeClass(anim + " animated");
							}
						);
				});
			};
			animated();
			// Make animated when slide change
			init.on("slideChange", function () {
				$(sliderActive1 + " [data-animation]").removeClass("animated");
			});
			init.on("slideChange", animated);
		}

		animated_swiper(sliderActive1, sliderInit1);
	}

	if (jQuery(".hero-active-2").length > 0) {
		let sliderActive1 = ".hero-active-2";
		let sliderInit1 = new Swiper(sliderActive1, {
			// Optional parameters
			slidesPerView: 1,
			slidesPerColumn: 1,
			paginationClickable: true,
			loop: true,
			effect: "fade",

			autoplay: {
				delay: 5000,
			},

			// If we need pagination
			pagination: {
				el: ".hero-sec-pagination",
				// dynamicBullets: true,
				clickable: true,
			},

			// Navigation arrows
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},

			a11y: false,
		});

		function animated_swiper(selector, init) {
			let animated = function animated() {
				$(selector + " [data-animation]").each(function () {
					let anim = $(this).data("animation");
					let delay = $(this).data("delay");
					let duration = $(this).data("duration");

					$(this)
						.removeClass("anim" + anim)
						.addClass(anim + " animated")
						.css({
							webkitAnimationDelay: delay,
							animationDelay: delay,
							webkitAnimationDuration: duration,
							animationDuration: duration,
						})
						.one(
							"webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
							function () {
								$(this).removeClass(anim + " animated");
							}
						);
				});
			};
			animated();
			// Make animated when slide change
			init.on("slideChange", function () {
				$(sliderActive1 + " [data-animation]").removeClass("animated");
			});
			init.on("slideChange", animated);
		}

		animated_swiper(sliderActive1, sliderInit1);
	}

	var themeSlider = new Swiper(".classname", {
		slidesPerView: 1,
		spaceBetween: 30,
		loop: true,
		pagination: {
			el: ".hero-sec-pagination",
			clickable: true,
		},
		breakpoints: {
			1200: {
				slidesPerView: 3,
			},
			992: {
				slidesPerView: 2,
			},
			768: {
				slidesPerView: 1,
			},
			576: {
				slidesPerView: 1,
			},
			0: {
				slidesPerView: 1,
			},
		},
	});

	////////////////////////////////////////////////////
	// 10. Masonary Js

	$(".grid").imagesLoaded(function () {
		var $grid = $(".grid").isotope({
			// options
			itemSelector: '.grid-item',
			percentPosition: true,
			masonry: {
			  // use outer width of grid-sizer for columnWidth
			  columnWidth: 1
			}
		});
		// filter items on button click
		$(".bd-portfolio-button").on("click", "button", function () {
			var filterValue = $(this).attr("data-filter");
			$grid.isotope({ filter: filterValue });
		});

		//for menu active class
		$(".bd-portfolio-button button").on("click", function (event) {
			$(this).siblings(".active").removeClass("active");
			$(this).addClass("active");
			event.preventDefault();
		});
	});

	/* magnificPopup img view */
	$(".image-popups").magnificPopup({ 
		type: "image",
		gallery: {
			enabled: true,
		},
	});

	/* magnificPopup video view */
	$(".popup-video").magnificPopup({
		type: "iframe",
	});

	////////////////////////////////////////////////////
	// 11. Wow Js
	new WOW().init();

	////////////////////////////////////////////////////
	// 12. Data width Js
	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	////////////////////////////////////////////////////
	// 13. Cart Quantity Js
	$(".cart-minus").click(function () {
		var $input = $(this).parent().find("input");
		var count = parseInt($input.val()) - 1;
		count = count < 1 ? 1 : count;
		$input.val(count);
		$input.change();
		return false;
	});
	$(".cart-plus").click(function () {
		var $input = $(this).parent().find("input");
		$input.val(parseInt($input.val()) + 1);
		$input.change();
		return false;
	});

	////////////////////////////////////////////////////
	// 14. Show Login Toggle Js
	$("#showlogin").on("click", function () {
		$("#checkout-login").slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 15. Show Coupon Toggle Js
	$("#showcoupon").on("click", function () {
		$("#checkout_coupon").slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 16. Create An Account Toggle Js
	$("#cbox").on("click", function () {
		$("#cbox_info").slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 17. Shipping Box Toggle Js
	$("#ship-box").on("click", function () {
		$("#ship-box-info").slideToggle(1000);
	});

	////////////////////////////////////////////////////
	// 18. Counter Js
	$(".counter").counterUp({
		delay: 10,
		time: 1000,
	});

	////////////////////////////////////////////////////
	// 19. Parallax Js
	if ($(".scene").length > 0) {
		$(".scene").parallax({
			scalarX: 10.0,
			scalarY: 15.0,
		});
	}

	////////////////////////////////////////////////////
	// 20. InHover Active Js
	$(".hover__active").on("mouseenter", function () {
		$(this)
			.addClass("active")
			.parent()
			.siblings()
			.find(".hover__active")
			.removeClass("active");
	});
	
	////////////////////////////////////////////////////
	// 21. Jquery Appear raidal
	if (typeof ($.fn.knob) != 'undefined') {
		$('.knob').each(function () {
		var $this = $(this),
		knobVal = $this.attr('data-rel');

		$this.knob({
		'draw': function () {
			$(this.i).val(this.cv + '%')
		}
		});

		$this.appear(function () {
		$({
			value: 0
		}).animate({
			value: knobVal
		}, {
			duration: 2000,
			easing: 'swing',
			step: function () {
			$this.val(Math.ceil(this.value)).trigger('change');
			}
		});
		}, {
		accX: 0,
		accY: -150
		});
	});
	}

	////////////////////////////////////////////////////
	// Testimonial-slider js
	if (jQuery(".bd-testimonial__slide").length > 0) {
		let sponsors = new Swiper('.bd-testimonial__slide', {
			// direction: 'vertical',
			loop: true,
			autoplay: {
					delay: 5000,
				},
			
			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			
			// Navigation arrows
			navigation: {
				nextEl: '.testimomial-button-next',
				prevEl: '.testimomial-button-prev',
			},
			
			// And if we need scrollbar
			scrollbar: {
				el: '.swiper-scrollbar',
			},
			breakpoints: {
				// when window width is >= 320px
				320: {
					slidesPerView: 1,
				},
				// when window width is >= 576px
				576: {
					slidesPerView: 1,
				},
				// when window width is >= 640px
				774: {
					slidesPerView: 1,
				},
				// when window width is >= 640px
				991: {
					slidesPerView: 1,
				},
				1200: {
					slidesPerView: 1,
				},
				1400: {
					slidesPerView: 1,
				}
			}
		});
	}

	////////////////////////////////////////////////////
	// Testimonial-2-slider js
	if (jQuery(".bd-testimonial-two-active").length > 0) {
		let testimonialTwo = new Swiper('.bd-testimonial-two-active', {
			slidesPerView: 2,
			spaceBetween: 20,
			// direction: 'vertical',
			loop: true,
			autoplay: {
					delay: 5000,
				},
			
			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			
			// Navigation arrows
			navigation: {
				nextEl: '.testimomial-button-next',
				prevEl: '.testimomial-button-prev',
			},
			
			// And if we need scrollbar
			scrollbar: {
				el: '.swiper-scrollbar',
			},
			breakpoints: {
				// when window width is >= 320px
				320: {
					slidesPerView: 1,
					spaceBetween: 20
				},
				// when window width is >= 480px
				480: {
					slidesPerView: 1,
					spaceBetween: 30
				},
				// when window width is >= 640px
				774: {
					slidesPerView: 2,
				},
				// when window width is >= 640px
				991: {
					slidesPerView: 3,
				},
				1200: {
					slidesPerView: 3,
				},
				1400: {
					slidesPerView: 3,
				}
			}
			});
	}

	////////////////////////////////////////////////////
	// Testimonial-3-slider js
	if (jQuery(".testimoniaal__slide-3").length > 0) {
		let sponsors = new Swiper('.testimoniaal__slide-3', {
			spaceBetween: 30,
			// direction: 'vertical',
			loop: true,
			autoplay: {
					delay: 5000,
				},
			
			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			
			// Navigation arrows
			navigation: {
				nextEl: '.testimomial-button-next',
				prevEl: '.testimomial-button-prev',
			},
			
			// And if we need scrollbar
			scrollbar: {
				el: '.swiper-scrollbar',
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
					spaceBetween: 20
				},
				576: {
					slidesPerView: 1,
				},
				774: {
					slidesPerView: 2,
				},
				991: {
					slidesPerView: 2,
				},
				1400: {
					slidesPerView: 2,
				}
			}
			});
	}

	////////////////////////////////////////////////////
	// Portfolio activation 
		const portfolio = new Swiper('.bd-portfolio__active', {
		// Default parameters
		spaceBetween: 50,
		loop: true,
		observer: true,
		observeParents: true,
		autoplay: {
			delay: 3000,
		},
		
		// Navigation arrows
		navigation: {
			nextEl: ".bd-portfolio-button-next",
			prevEl: ".bd-portfolio-button-prev",
		},
		pagination: {
			el: ".portfolio-pagination",
			// dynamicBullets: true,
			clickable: true,
		},

		// Responsive breakpoints
		breakpoints: {
			// when window width is >= 320px
			320: {
				slidesPerView: 1,
				spaceBetween: 20
			},
			// when window width is >= 480px
			480: {
				slidesPerView: 1,
				spaceBetween: 30
			},
			// when window width is >= 640px
			768: {
				slidesPerView: 2,
				spaceBetween: 20
			},
			// when window width is >= 640px
			991: {
				slidesPerView: 2,
				spaceBetween: 20
			},
			1200: {
				slidesPerView: 2,
				spaceBetween: 20
			},
			1400: {
				slidesPerView: 3,
				spaceBetween: 30
			},
			1600: {
				slidesPerView: 3,
				spaceBetween: 50
			},
		}
	})

	////////////////////////////////////////////////////
	// Portfolio-2 activation
	if (jQuery(".bd-portfolio__active-2").length > 0) {
		let portfolioTwo = new Swiper('.bd-portfolio__active-2', {
			loop: true,
			observer: true,
			observeParents: true,
			autoplay: {
				delay: 3000,
			},
			
			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			
			// Navigation arrows
			navigation: {
				nextEl: '.portfolio-2-button-next',
				prevEl: '.portfolio-2-button-prev',
			},
			
			// And if we need scrollbar
			scrollbar: {
				el: '.swiper-scrollbar',
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
					spaceBetween: 30,
				},
				768: {
					slidesPerView: 2,
					spaceBetween: 30,
				},
				991: {
					slidesPerView: 2,
					spaceBetween: 30,
				},
				1200: {
					slidesPerView: 2,
					spaceBetween: 45,
				},
				1400: {
					slidesPerView: 2,
					spaceBetween: 50,
				},
				}
			});
		}

	////////////////////////////////////////////////////
	// Book-activation
	if (jQuery(".bn-book__active").length > 0) {
		let portfolioTwo = new Swiper('.bn-book__active', {
			slidesPerView: 5,
			slidesPerView: "auto",
			loop:true,
			autoplay: {
					delay: 3000,
				},
			breakpoints: {
				320: {
					slidesPerView: 2,
					spaceBetween: 30,
				},
				500: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
				768: {
					slidesPerView: 4,
					spaceBetween: 30,
				},
				991: {
					slidesPerView: 4,
					spaceBetween: 30,
				},
				1200: {
					slidesPerView: 5,
					spaceBetween: 30,
				},
				1400: {
					slidesPerView: 5,
					spaceBetween: 50,
				},
				}
			});
		}

	////////////////////////////////////////////////////
	// Brand activation 
	const brand = new Swiper('.bd-brand__active', {
		// Default parameters
		spaceBetween: 40,
		loop: true,
		autoplay: {
			delay: 3000,
		},
		pagination: {
			el: ".brand-pagination",
			clickable: false,
		},
		// Navigation arrows
		navigation: {
			nextEl: ".brand-button-next",
			prevEl: ".brand-button-prev",
		},
		// Responsive breakpoints
		breakpoints: {
			// when window width is >= 320px
			320: {
				slidesPerView: 1,
				spaceBetween: 20
			},
			// when window width is >= 480px
			480: {
				slidesPerView: 1,
				spaceBetween: 30
			},
			// when window width is >= 576px
			576: {
				slidesPerView: 2,
				spaceBetween: 30
			},
			// when window width is >= 640px
			991: {
				slidesPerView: 3,
				spaceBetween: 30
			},
			1200: {
				slidesPerView: 4,
				spaceBetween: 40
			},
			1400: {
				slidesPerView: 5,
				spaceBetween: 40

			}
		}
	})

	////////////////////////////////////////////////////
	// Brand-two activation
	if (jQuery(".bd-brand_two__active").length > 0) {
		let brandTwo = new Swiper('.bd-brand_tw__active', {
			slidesPerView: 2,
			spaceBetween: 0,
			
			// direction: 'vertical',
			loop: true,
			autoplay: {
					delay: 5000,
				},
			
			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			
			// Navigation arrows
			navigation: {
				nextEl: '.brand-button-next',
				prevEl: '.brand-button-prev',
			},
			
			// And if we need scrollbar
			scrollbar: {
				el: '.swiper-scrollbar',
			},
			breakpoints: {
				// when window width is >= 320px
				320: {
					slidesPerView: 1,
					spaceBetween: 20
				},
				// when window width is >= 480px
				480: {
					slidesPerView: 2,
					spaceBetween: 30
				},
				// when window width is >= 640px
				640: {
					slidesPerView: 2,
					spaceBetween: 40
				},
				// when window width is >= 640px
				991: {
					slidesPerView: 3,
					spaceBetween: 30
				},
				1200: {
					slidesPerView: 4,
					spaceBetween: 80
				},
				1400: {
					slidesPerView: 5,
					spaceBetween: 80
		
				}
			}
			});
		}

	////////////////////////////////////////////////////
	// Client activation
	if (jQuery(".bd-client__active").length > 0) {
		let client = new Swiper('.bd-client__active', {
			slidesPerView: 2,
			spaceBetween: 0,
			// direction: 'vertical',
			loop: true,
			autoplay: {
					delay: 5000,
				},
			
			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			
			// Navigation arrows
			navigation: {
				nextEl: '.brand-button-next',
				prevEl: '.brand-button-prev',
			},
			
			// And if we need scrollbar
			scrollbar: {
				el: '.swiper-scrollbar',
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
				},
				768: {
					slidesPerView: 2,
				},
				991: {
					slidesPerView: 3,
				},
				1200: {
					slidesPerView: 4,
				},
				1400: {
					slidesPerView: 5,
				},
				}
			});
		}

	////////////////////////////////////////////////////
	// Sponsors-slider activation
	if (jQuery(".bd-sponsors-active").length > 0) {
		let sponsors = new Swiper('.bd-sponsors-active', {
			spaceBetween: 20,
			// direction: 'vertical',
			loop: true,
			autoplay: {
					delay: 5000,
				},
			
			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			
			// Navigation arrows
			navigation: {
				nextEl: '.testimomial-button-next',
				prevEl: '.testimomial-button-prev',
			},
			
			// And if we need scrollbar
			scrollbar: {
				el: '.swiper-scrollbar',
			},
			breakpoints: {
				// when window width is >= 320px
				320: {
					slidesPerView: 1,
					spaceBetween: 20
				},
				// when window width is >= 576px
				576: {
					slidesPerView: 2,
					spaceBetween: 30
				},
				// when window width is >= 640px
				774: {
					slidesPerView: 3,
				},
				// when window width is >= 640px
				991: {
					slidesPerView: 3,
				},
				1200: {
					slidesPerView: 4,
				},
				1400: {
					slidesPerView: 5,
				}
			}
			});
		}
	// History-slider activation
	if (jQuery(".bd-history-active").length > 0) {
		let history = new Swiper('.bd-history-active', {
			slidesPerView: 2,
			spaceBetween: 0,
			// direction: 'vertical',
			loop: true,
			autoplay: {
					delay: 3000,
				},
			
			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			// Navigation arrows
			navigation: {
			nextEl: '.bd-histoiry-button.next',
			prevEl: '.bd-histoiry-button.prev',
		},
			breakpoints: {
				320: {
					slidesPerView: 2,
					spaceBetween: 20
				},
				480: {
					slidesPerView: 2,
				},
				640: {
					slidesPerView: 3,
				},
				991: {
					slidesPerView: 4,
				},
				1200: {
					slidesPerView: 4,
				},
				1400: {
					slidesPerView: 5,
				}
			}
			});
		}
	////////////////////////////////////////////////////
	// Skill-slider activation
	var swiper = new Swiper(".bd-skill__active", {
		slidesPerView: "auto",
		spaceBetween: 40,
		loop: true,
		pagination: {
		el: ".swiper-pagination",
		clickable: true,
		},
		autoplay: {
			delay: 3000,
		},
	});

	////////////////////////////////////////////////////
	// Course slider activation Js
	if (jQuery(".bd-course__slide").length > 0) {
		let course__slider = new Swiper('.bd-course__slide', {
			slidesPerView: 4,
			spaceBetween: 40,
			// direction: 'vertical',
			loop: true,
			autoplay: {
					delay: 6000,
				},
			
			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			// Navigation arrows
			navigation: {
				nextEl: '.course-button-next',
				prevEl: '.course-button-prev',
			},
			
			// And if we need scrollbar
			scrollbar: {
				el: '.swiper-scrollbar',
			},
			breakpoints: {
				0: {
					slidesPerView: 1,
				},
				576: {
					slidesPerView: 2,
				},
				768: {
					slidesPerView: 2,
					spaceBetween: 30,
				},
				991: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
				1200: {
					slidesPerView: 4,
					spaceBetween: 30,
				},
				1400: {
					slidesPerView: 4,
					}
				}
		});
	}

	////////////////////////////////////////////////////
	// Postbox__thumb slider activation Js
	if (jQuery(".bd-postbox__thumb-active").length > 0) {
		let course__slider = new Swiper('.bd-postbox__thumb-active', {
		slidesPerView: 1,
		// direction: 'vertical',
		loop: true,
		autoplay: {
				delay: 6000,
			},
		
		// If we need pagination
		pagination: {
			el: '.swiper-paginatin',
			clickable: true,
		},
		// Navigation arrows
		navigation: {
			nextEl: '.bd-postbox__button.next',
			prevEl: '.bd-postbox__button.prev',
		},
		
		// And if we need scrollbar
		scrollbar: {
			el: '.swiper-scrollbar',
		},
		});
	}

	////////////////////////////////////////////////////
   	// 12. Course Slider Js
	   var swiper = new Swiper('.course__slider', {
		spaceBetween: 30,
		slidesPerView: 2,
		breakpoints: {  
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		});


	// blog gallery activation
	if (jQuery(".blog_gallery_active").length > 0) {
		let ablogimgactive = new Swiper('.blog_gallery_active', {
			slidesPerView: 1,
			spaceBetween: 30,
			autoplay: true,
			// direction: 'vertical',
			loop: true,
		  
			// If we need pagination
			pagination: {
			  el: '.swiper-pagination',
			  clickable: true,
			},
		  
			// Navigation arrows
			navigation: {
			  nextEl: '.swiper-blog-button-next',
			  prevEl: '.swiper-blog-button-prev',
			},
		  
			// And if we need scrollbar
			scrollbar: {
			  el: '.swiper-scrollbar',
			  dynamicBullets: true,
			},
			breakpoints: {
				640: {
				  slidesPerView: 1,
				},
				768: {
				  slidesPerView: 1,
				},
				1024: {
				  slidesPerView: 1,
				},
			  }
		  });
		}



		
})(jQuery);




























































