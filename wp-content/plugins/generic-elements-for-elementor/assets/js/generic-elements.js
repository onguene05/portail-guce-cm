(function ($) {
	"use strict";

	// data - background
	$("[data-background]").each(function () {
		$(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
	});

	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	$("[data-left]").each(function () {
		$(this).css("left", $(this).attr("data-left"));
	});


	/*------------------------------------
		Slider
	--------------------------------------*/
	function mainSlider($data) {

		let active = $data.find(".bd-slider-active");
		let autoplay = parseInt(active.attr('autoplay-speed'));

		// data - background
		$("[data-background]").each(function () {
			$(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
		});

		if (jQuery(".bd-slider-active").length > 0) {

			let sliderActive1 = '.bd-slider-active';
			let sliderInit1 = new Swiper(sliderActive1, {
				// Optional parameters
				slidesPerView: 1,
				slidesPerColumn: 1,
				paginationClickable: true,
				loop: true,
				effect: 'fade',

				autoplay: {
					delay: autoplay,
				},

				// If we need pagination
				pagination: {
					el: '.t-swiper-pagination',
					// type: 'fraction',
					// clickable: true,
				},

				// Navigation arrows
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},

				a11y: false
			});


			if (jQuery(".bd-slider-active").data('swipper_autoplay_stop') == '') {
				sliderInit1.autoplay.stop();
			}


			function animated_swiper(selector, init) {
				let animated = function animated() {
					$(selector + ' [data-animation]').each(function () {
						let anim = $(this).data('animation');
						let delay = $(this).data('delay');
						let duration = $(this).data('duration');

						$(this).removeClass('anim' + anim)
							.addClass(anim + ' animated')
							.css({
								webkitAnimationDelay: delay,
								animationDelay: delay,
								webkitAnimationDuration: duration,
								animationDuration: duration
							})
							.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
								$(this).removeClass(anim + ' animated');
							});
					});
				};
				animated();
				// Make animated when slide change
				init.on('slideChange', function () {
					$(sliderActive1 + ' [data-animation]').removeClass('animated');
				});
				init.on('slideChange', animated);
			}
			animated_swiper(sliderActive1, sliderInit1);
		}
	}

	// team activation
	function teamActive(data) {

		let active = data.find(".bd-team-active");
		let autoplay = parseInt(active.attr('autoplay-speed'));
		let autoplay_toggle = active.attr('autoplay_stop');


		if (jQuery(".bd-team-active").length > 0) {
			let portfolio = new Swiper('.bd-team-active', {
				slidesPerView: 1,
				spaceBetween: 30,
				// direction: 'vertical',
				loop: true,
				autoplay: {
					delay: autoplay,
				},

				// If we need pagination
				pagination: {
					el: '.team-pagination',
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
					550: {
						slidesPerView: 2,
					},
					768: {
						slidesPerView: 2,
					},
					1200: {
						slidesPerView: 3,
					},
				}
			});

			if (autoplay_toggle == 'yes') {
				portfolio.autoplay.start();
			} else {
				portfolio.autoplay.stop();
			}
		}


	}

	function testimonialActive($data) {

		let active = $data.find(".testimonial-nav");

		let autoplay = active.attr('autoplay-toggle');

		let auto_speed = parseInt(active.attr('tes-speed'));

		// Testimonial Active
		var swiper = new Swiper(".testimonial-nav", {
			spaceBetween: 10,
			slidesPerView: 3,
			loop: true,

			allowTouchMove: false,
			autoplay: {
				delay: auto_speed,
			},
			infinite: true,

			speed: 100,
			centeredSlides: true,
			freeMode: true,
			watchSlidesProgress: true,
		});
		var swiper2 = new Swiper(".testimonial-text", {
			spaceBetween: 10,
			loop: true,
			infinite: true,
			autoplay: {
				delay: auto_speed,
			},
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			thumbs: {
				swiper: swiper,
			},
		});

		if (autoplay == 'yes') {
			swiper.autoplay.start();
			swiper2.autoplay.start();
		} else {
			swiper.autoplay.stop();
			swiper2.autoplay.stop();
		}
	}


	function instagramActive(data) {

		let active = data.find(".instagram-active");
		let autoplay = parseInt(active.attr('autoplay-speed'));
		let autoplay_toggle = active.attr('autoplay_stop');

		const swiper = new Swiper(".instagram-active", {
			// Default parameters
			slidesPerView: 6,
			spaceBetween: 30,
			loop: true,
			autoplay: {
				delay: autoplay,
			},
			// Responsive breakpoints
			breakpoints: {
				// when window width is >= 320px
				540: {
					slidesPerView: 1,
				},
				768: {
					slidesPerView: 2,
				},
				992: {
					slidesPerView: 4,
				},
				1200: {
					slidesPerView: 6,
				},
			},

		});
		if (autoplay_toggle == 'yes') {
			swiper.autoplay.start();
		} else {
			swiper.autoplay.stop();
		}
	}


	function skillActive() {
		// data - background
		$("[data-background]").each(function () {
			$(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
		});

		$("[data-width]").each(function () {
			$(this).css("width", $(this).attr("data-width"));
		});

		$("[data-left]").each(function () {
			$(this).css("left", $(this).attr("data-left"));
		});

		new WOW().init();

		// WOW active
		// var wow = new WOW({
		// 	mobile: false,
		// });
		// wow.init();
	}

	function videoActive() {
		/* magnificPopup img view */
		$('.popup-image,.insta-thumb a').magnificPopup({
			type: 'image',
			gallery: {
				enabled: true
			}
		});

		/* magnificPopup video view */
		$('.popup-video').magnificPopup({
			type: 'iframe'
		});
	}


	// FunFact Active
	function funfactActive() {
		$('.counter').counterUp({
			delay: 10,
			time: 1000
		});
	}


	$(window).on("elementor/frontend/init", function () {
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-slider.default",
			mainSlider
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-team.default",
			teamActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-testimonial.default",
			testimonialActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-instagram.default",
			instagramActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-skill.default",
			skillActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-videoinfo.default",
			videoActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-fun-factor.default",
			funfactActive
		);
	});

})(jQuery);