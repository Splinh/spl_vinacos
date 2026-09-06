// Safe library stubs to prevent any ReferenceError from breaking execution
if (typeof window.Fancybox === 'undefined') window.Fancybox = { bind: function(){}, close: function(){} };
if (typeof window.CountUp === 'undefined') window.CountUp = function(){ this.start = function(){}; this.reset = function(){}; };
if (typeof window.Waypoint === 'undefined') window.Waypoint = function(){};
if (typeof window.Atropos === 'undefined') window.Atropos = function(){};
if (typeof window.AOS === 'undefined') window.AOS = { init: function(){} };

$((function(){
	try { APP.init(); } catch(e){}
	try { lozadInit(); } catch(e){}
	try { fancyboxInit(); } catch(e){}
	try { countUpInit(); } catch(e){}
	try { atroposInit(); } catch(e){}
	try { accordionCollapse(); } catch(e){}
	try { toggleMegaProduct(); } catch(e){}
	try { toggleContent(); } catch(e){}
	try { home4Init(); } catch(e){}
	try { formInit(); } catch(e){}
	try { $(".process-loading").addClass("hidden"); } catch(e){}
	try {
		if (typeof AOS !== 'undefined' && AOS.init) {
			AOS.init({disable:"phone",startEvent:"DOMContentLoaded",initClassName:"aos-init",animatedClassName:"aos-animate",useClassNames:!1,disableMutationObserver:!1,debounceDelay:50,throttleDelay:99,once:!0,offset:150,delay:300,duration:400,easing:"ease",mirror:!1,anchorPlacement:"top-bottom"});
		}
	} catch(e){}
	// Fallback to force display all data-aos elements immediately
	$("[data-aos]").addClass("aos-animate");
	// Force initialize key visual swiper slider, product showcase slider, product detail slider & about timeline slider
	initKeySwiper();
	initHome5Swiper();
	initProductDetailSwiper();
	initAboutTimelineSwiper();
	initAbout5Swiper();
	initAbout6Swiper();
	toggleMegaProduct();
}));


$(window).on("scroll",(function(){APP.fixed()}));
var header=$("header"),body=$("body"),backToTop=$(".back-to-top"),buttonMenu=$("#buttonMenu"),mobileWrap=$(".mobile-wrap"),buttonSearch=$("header .button-search"),searchWrap=$(".search-wrap"),heightHeader=$("header").height(),heightWindow=$(window).height(),widthWindow=$(window).width(),outerHeightWindow=$(window).outerHeight();
$.fn.extend({toggleText:function(e,t){return this.text(this.text()==t?e:t)}});

var APP={
	fixed:()=>{$(window).scrollTop()>heightHeader?header.addClass("active"):header.removeClass("active"),$(window).scrollTop()>outerHeightWindow-heightHeader?backToTop.addClass("active"):backToTop.removeClass("active")},
	backToTop:()=>{backToTop.on("click",(function(){$("html, body").animate({scrollTop:0},500)}))},
	mapping:()=>{$("header .navbar-nav").mapping({mobileWrapper:".mobile-wrap .navbar-nav-list",mobileMethod:"prependTo",desktopWrapper:"header .header-center",desktopMethod:"appendTo",breakpoint:1023.98})},
	megaMenu:()=>{$(".main-menu > .menu-item-has-children").on("mouseenter",(function(){$(".backdrop-mega-menu").fadeIn()})).on("mouseleave",(function(){$(".backdrop-mega-menu").fadeOut()})),$(".main-menu [data-walker-img]").on("mouseenter",(function(){const e=$(this).data("walker-img");$(this).parents(".menu-item-has-children").find(".walker-preview img").attr("src",e).fadeIn()}))},
	toggleMenuMobile:()=>{$(buttonMenu).on("click",(function(){mobileWrap.slideDown().toggleClass("active"),$(".backdrop-mobile").fadeIn()})),$(mobileWrap).find(".close-mobile").on("click",(function(){mobileWrap.fadeOut().removeClass("active"),$(".backdrop-mobile").fadeOut()})),$(document).on("click",(function(e){$(e.target).closest(mobileWrap).length||$(e.target).closest(buttonMenu).length||(mobileWrap.fadeOut().removeClass("active"),$(".backdrop-mobile").fadeOut())})),$(".main-menu .menu-item-has-children > .sub-menu").each((function(){var e=$('<span class="toggle-submenu"></span>');$(this).before(e)})),$(".main-menu .menu-item-has-children > .mega-menu").each((function(){var e=$('<span class="toggle-mega"></span>');$(this).before(e)})),$(".main-menu .menu-item-has-children > .mega-wrap").each((function(){var e=$('<span class="toggle-wrap"></span>');$(this).before(e)})),$(".main-menu .toggle-submenu, .main-menu .toggle-mega, .main-menu .toggle-wrap").on("click",(function(){widthWindow<1200&&($(this).toggleClass("active"),$(this).next().slideToggle())}))},
	toggleSearch:()=>{buttonSearch.on("click",(function(){searchWrap.fadeToggle(),searchWrap.find("input").trigger("focus"),$(".backdrop-search").fadeToggle("fast")})),$(document).on("click",(function(e){$(e.target).closest(searchWrap).length||$(e.target).closest(buttonSearch).length||(searchWrap.fadeOut("fast"),$(".backdrop-search").fadeOut("fast"))}))},
	toggleCategory:()=>{$(".toggle-category").on("click",(function(){$(".box-category").fadeIn(),$(".backdrop-category").fadeIn()})),$(".box-category .box-close").on("click",(function(){$(".box-category").slideUp(),$(".backdrop-category").fadeOut()})),$(document).on("click",(function(e){widthWindow<1024&&($(e.target).closest(".box-category").length||$(e.target).closest(".toggle-category").length||($(".box-category").slideUp(),$(".backdrop-category").fadeOut()))}))},
	init:()=>{APP.backToTop(),APP.mapping(),APP.megaMenu(),APP.toggleMenuMobile(),APP.toggleSearch(),APP.toggleCategory()}
};
defaultSettingSwiper={preventInteractionOnTransition:!0,observer:!0,observeParents:!0,lazy:{loadPrevNext:!0}};

function initKeySwiper(){
	var e=0;
	if (!document.querySelector(".banner-slider .swiper")) return;
	new Swiper(".banner-slider .swiper",{
		loop:!0,
		loopPreventsSliding:!0,
		effect:"fade",
		fadeEffect:{crossFade:!0},
		keyboard:{enabled:!0},
		shortSwipes:10,
		autoplay:{delay:5e3,disableOnInteraction:!1,pauseOnMouseEnter:!1,waitForTransition:!0},
		speed:1e3,
		...defaultSettingSwiper,
		navigation:{nextEl:".banner-slider .button-next",prevEl:".banner-slider .button-prev"},
		pagination:{el:".banner-slider .swiper-pagination",clickable:!0},
		on:{
			init:function(){
				$(".key-visual-slide").css("visibility","visible");
				var e=setInterval((function(){clearInterval(e)}),100);
			},
			slideChange:function(){
				$(".key-visual-slide").css("visibility","visible");
				$(".key-img-box").addClass("change");
				setTimeout((()=>{$(".key-img-box").removeClass("change")}),1e3);
			},
			slideChangeTransitionEnd:function(){e=this.activeIndex}
		}
	});
	$(".key-visual-slide").css("visibility","visible");
}

function initHome5Swiper(){
	var section = document.querySelector(".home-5-section");
	if (!section) return;

	if (window._home5Instances) {
		try {
			if (window._home5Instances.preview && window._home5Instances.preview.destroy) {
				window._home5Instances.preview.destroy(true, true);
			}
			if (window._home5Instances.caption && window._home5Instances.caption.destroy) {
				window._home5Instances.caption.destroy(true, true);
			}
			if (window._home5Instances.image && window._home5Instances.image.destroy) {
				window._home5Instances.image.destroy(true, true);
			}
		} catch(e) {}
		window._home5Instances = null;
	}

	var previewSwiper = new Swiper(".home-5-preview", {
		effect: "fade",
		fadeEffect: { crossFade: true },
		speed: 600,
		allowTouchMove: false,
		observer: true,
		observeParents: true
	});

	var captionSwiper = new Swiper(".home-5-caption", {
		effect: "fade",
		fadeEffect: { crossFade: true },
		speed: 600,
		allowTouchMove: false,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
			pauseOnMouseEnter: true
		},
		observer: true,
		observeParents: true
	});

	var imageSwiper = new Swiper(".home-5-image", {
		slidesPerView: "auto",
		spaceBetween: 16,
		speed: 600,
		slideToClickedSlide: false,
		grabCursor: true,
		observer: true,
		observeParents: true,
		breakpoints: {
			768: {
				spaceBetween: 20
			}
		}
	});

	var isSyncing = false;
	function syncHome5(index) {
		if (typeof index === "undefined" || index === null || index < 0) return;
		if (isSyncing) return;
		isSyncing = true;

		if (previewSwiper && !previewSwiper.destroyed && previewSwiper.activeIndex !== index) {
			previewSwiper.slideTo(index, 600);
		}
		if (captionSwiper && !captionSwiper.destroyed && captionSwiper.activeIndex !== index) {
			captionSwiper.slideTo(index, 600);
		}
		if (imageSwiper && !imageSwiper.destroyed && imageSwiper.activeIndex !== index) {
			imageSwiper.slideTo(index, 600);
		}

		$(".home-5-image .swiper-slide")
			.removeClass("swiper-slide-thumb-active swiper-slide-active")
			.eq(index)
			.addClass("swiper-slide-thumb-active swiper-slide-active");

		setTimeout(function () {
			isSyncing = false;
		}, 100);
	}

	captionSwiper.on("slideChange", function () {
		syncHome5(this.realIndex);
	});

	$(document).off("click.home5Thumb", ".home-5-image .swiper-slide").on("click.home5Thumb", ".home-5-image .swiper-slide", function (e) {
		e.preventDefault();
		var idx = $(this).index();
		if (idx >= 0) {
			syncHome5(idx);
			if (captionSwiper && captionSwiper.autoplay) {
				captionSwiper.autoplay.stop();
				if (window._home5AutoplayTimer) clearTimeout(window._home5AutoplayTimer);
				window._home5AutoplayTimer = setTimeout(function () {
					if (captionSwiper && captionSwiper.autoplay && !captionSwiper.destroyed) {
						captionSwiper.autoplay.start();
					}
				}, 6000);
			}
		}
	});

	// Initialize active state on first slide
	$(".home-5-image .swiper-slide")
		.removeClass("swiper-slide-thumb-active swiper-slide-active")
		.eq(0)
		.addClass("swiper-slide-thumb-active swiper-slide-active");

	window._home5Instances = {
		preview: previewSwiper,
		caption: captionSwiper,
		image: imageSwiper
	};
}

function initProductDetailSwiper(){
	if (!document.querySelector(".product-detail-section")) return;

	var thumbsSwiper = new Swiper(".product-thumbs", {
		spaceBetween: 10,
		slidesPerView: 4,
		freeMode: true,
		watchSlidesProgress: true
	});

	var previewSwiper = new Swiper(".product-preview", {
		spaceBetween: 10,
		navigation: {
			nextEl: ".product-top .button-next",
			prevEl: ".product-top .button-prev"
		},
		thumbs: {
			swiper: thumbsSwiper
		}
	});
}

function initAboutTimelineSwiper(){
	if (!document.querySelector(".about-2-section")) return;

	var thumbsSwiper = new Swiper(".about-2-section .swiper-thumbs", {
		spaceBetween: 20,
		slidesPerView: 3,
		freeMode: true,
		watchSlidesProgress: true,
		loop: true,
		loopedSlides: 10,
		breakpoints: {
			576: { slidesPerView: 4 },
			768: { slidesPerView: 6 },
			1024: { slidesPerView: 8 }
		}
	});

	var topSwiper = new Swiper(".about-2-section .swiper-top", {
		spaceBetween: 30,
		loop: true,
		loopedSlides: 10,
		navigation: {
			nextEl: ".about-2-section .button-next",
			prevEl: ".about-2-section .button-prev"
		},
		thumbs: {
			swiper: thumbsSwiper
		}
	});
}

function initAbout5Swiper(){
	if (!document.querySelector(".about-5-section")) return;

	var captionSwiper = new Swiper(".about-5-caption", {
		spaceBetween: 20,
		slidesPerView: 1,
		effect: "fade",
		fadeEffect: { crossFade: true }
	});

	var imageSwiper = new Swiper(".about-5-image", {
		spaceBetween: 20,
		slidesPerView: 1,
		autoplay: { delay: 4000, disableOnInteraction: false },
		navigation: {
			nextEl: ".about-5-section .button-next",
			prevEl: ".about-5-section .button-prev"
		},
		pagination: {
			el: ".about-5-section .swiper-pagination",
			clickable: true
		}
	});

	imageSwiper.on("slideChange", function(){
		if (captionSwiper && captionSwiper.slideTo) {
			captionSwiper.slideTo(imageSwiper.activeIndex);
		}
	});
}

function initAbout6Swiper(){
	if (!document.querySelector(".about-6-section")) return;

	var captionSwiper = new Swiper(".about-6-caption", {
		spaceBetween: 20,
		slidesPerView: 1,
		effect: "fade",
		fadeEffect: { crossFade: true }
	});

	var imageSwiper = new Swiper(".about-6-image", {
		spaceBetween: 20,
		slidesPerView: 1,
		autoplay: { delay: 4000, disableOnInteraction: false },
		navigation: {
			nextEl: ".about-6-section .button-next",
			prevEl: ".about-6-section .button-prev"
		},
		pagination: {
			el: ".about-6-section .swiper-pagination",
			clickable: true
		}
	});

	imageSwiper.on("slideChange", function(){
		if (captionSwiper && captionSwiper.slideTo) {
			captionSwiper.slideTo(imageSwiper.activeIndex);
		}
	});
}

function initFullPageScroll() {
	if (window.innerWidth < 1025) return;

	var isHomePage = $("body").hasClass("home") || $("body").hasClass("front-page") || $("body").hasClass("page-template-template-page-home");
	var isAboutPage = $("body").hasClass("page-template-template-page-about") || $("body").hasClass("page-id-942") || $("body").hasClass("page-id-936");

	if (!isHomePage && !isAboutPage) return;

	var $sections;
	if (isHomePage) {
		if (!$(".home-banner").length) return;
		$sections = $(".home-banner, .home-banner + .about-1-section, .home-3-section, .home-4-section, .home-5-section, .home-9-section, footer.footer-vinacos");
	} else if (isAboutPage) {
		$sections = $(".about-story-section, .about-brand, .about-promises-section, .about-5-section, .about-6-section, footer.footer-vinacos");
	}

	if (!$sections || $sections.length <= 1) return;

	var isScrolling = false;
	var currentIndex = 0;

	function updateCurrentIndex() {
		var scrollTop = $(window).scrollTop();
		var headerHeight = $("header").outerHeight() || 84;
		var viewMid = scrollTop + headerHeight + ($(window).height() - headerHeight) / 2;
		$sections.each(function (idx) {
			var top = $(this).offset().top;
			var bottom = top + $(this).outerHeight();
			if (viewMid >= top && viewMid < bottom) {
				currentIndex = idx;
			}
		});
	}
	updateCurrentIndex();

	function scrollToSection(index) {
		if (index < 0 || index >= $sections.length) return;
		isScrolling = true;
		currentIndex = index;
		var $target = $sections.eq(index);
		var headerHeight = $("header").outerHeight() || 84;
		var targetTop = index === 0 ? 0 : Math.max(0, Math.round($target[0].getBoundingClientRect().top + window.pageYOffset - headerHeight));

		$("html, body").stop().animate({
			scrollTop: targetTop
		}, 650, "swing", function () {
			setTimeout(function () {
				isScrolling = false;
			}, 200);
		});
	}

	// Intercept wheel event on desktop with debounce
	window.addEventListener("wheel", function (e) {
		if (window.innerWidth < 1025) return;
		if (isScrolling) {
			e.preventDefault();
			return;
		}

		if (Math.abs(e.deltaY) > 20) {
			e.preventDefault();
			updateCurrentIndex();
			if (e.deltaY > 0) {
				if (currentIndex < $sections.length - 1) {
					scrollToSection(currentIndex + 1);
				}
			} else {
				if (currentIndex > 0) {
					scrollToSection(currentIndex - 1);
				}
			}
		}
	}, { passive: false });

	// Keyboard arrow & page navigation
	$(window).on("keydown", function (e) {
		if (window.innerWidth < 1025) return;
		if (isScrolling) return;

		if (e.key === "ArrowDown" || e.key === "PageDown") {
			if (currentIndex < $sections.length - 1) {
				e.preventDefault();
				updateCurrentIndex();
				scrollToSection(currentIndex + 1);
			}
		} else if (e.key === "ArrowUp" || e.key === "PageUp") {
			if (currentIndex > 0) {
				e.preventDefault();
				updateCurrentIndex();
				scrollToSection(currentIndex - 1);
			}
		}
	});

	// Back-to-top smooth scroll to top section
	$(".cta-fixed .back-to-top").off("click").on("click", function (e) {
		e.preventDefault();
		scrollToSection(0);
	});
}

function mainStart(){
	initKeySwiper();
	initHome5Swiper();
	initProductDetailSwiper();
	initAboutTimelineSwiper();
	initAbout5Swiper();
	initAbout6Swiper();
	toggleMegaProduct();
	initFullPageScroll();
	$(".key-visual-swiper").removeClass("start");
	$("[data-aos]").addClass("aos-animate");
}


document.addEventListener("DOMContentLoaded",(function(e){
	mainStart();
}));

window.addEventListener("load",(function(){
	mainStart();
}));

$(".one-slider").each((function(e){var t={loop:!0},i={autoplay:{delay:5e3,disableOnInteraction:!1,pauseOnMouseEnter:!0}},a={},n={dynamicBullets:!0};$(this).hasClass("no-loop")&&(t={loop:!1}),$(this).hasClass("no-autoplay")&&(i={autoplay:!1}),$(this).hasClass("centered-slides")&&(a={centeredSlides:!0,centeredSlidesBounds:!0}),$(this).hasClass("no-dynamic-bullets")&&(n={dynamicBullets:!1}),$(this).find(".swiper").addClass(`swiper-one-${e}`),$(this).find(".swiper-pagination").addClass(`pagination-one-${e}`),$(this).find(".button-prev").addClass(`prev-one-${e}`),$(this).find(".button-next").addClass(`next-one-${e}`);new Swiper(`.swiper-one-${e}`,{...defaultSettingSwiper,...t,...i,...a,speed:1e3,spaceBetween:20,slidesPerView:1,slideToClickedSlide:!0,loopAdditionalSlides:1,navigation:{prevEl:`.one-slider .prev-one-${e}`,nextEl:`.one-slider .next-one-${e}`},pagination:{el:`.one-slider .pagination-one-${e}`,clickable:!0,...n},breakpoints:{1200:{spaceBetween:40}}})}));
$(".two-slider").each((function(e){var t={loop:!0},i={autoplay:{delay:5e3,disableOnInteraction:!1,pauseOnMouseEnter:!0}};$(this).hasClass("no-loop")&&(t={loop:!1}),$(this).hasClass("no-autoplay")&&(i={autoplay:!1}),$(this).hasClass("centered-slides"),$(this).find(".swiper").addClass(`swiper-two-${e}`),$(this).find(".swiper-pagination").addClass(`pagination-two-${e}`),$(this).find(".button-prev").addClass(`prev-two-${e}`),$(this).find(".button-next").addClass(`next-two-${e}`);new Swiper(`.swiper-two-${e}`,{...defaultSettingSwiper,...t,...i,speed:1e3,spaceBetween:16,slidesPerView:1,navigation:{prevEl:`.two-slider .prev-two-${e}`,nextEl:`.two-slider .next-two-${e}`},pagination:{el:`.two-slider .pagination-two-${e}`,clickable:!0,dynamicBullets:!0},breakpoints:{768:{slidesPerView:2,spaceBetween:32},1200:{slidesPerView:2,spaceBetween:32},1440:{slidesPerView:2,spaceBetween:40}}})}));
$(".three-slider").each((function(e){var t={loop:!0},i={autoplay:{delay:5e3,disableOnInteraction:!1,pauseOnMouseEnter:!0}};$(this).hasClass("no-loop")&&(t={loop:!1}),$(this).hasClass("no-autoplay")&&(i={autoplay:!1}),$(this).hasClass("centered-slides"),$(this).find(".swiper").addClass(`swiper-three-${e}`),$(this).find(".swiper-pagination").addClass(`pagination-three-${e}`),$(this).find(".button-prev").addClass(`prev-three-${e}`),$(this).find(".button-next").addClass(`next-three-${e}`);new Swiper(`.swiper-three-${e}`,{...defaultSettingSwiper,...t,...i,speed:1e3,spaceBetween:16,slidesPerView:1,navigation:{prevEl:`.three-slider .prev-three-${e}`,nextEl:`.three-slider .next-three-${e}`},pagination:{el:`.three-slider .pagination-three-${e}`,clickable:!0,dynamicBullets:!0},breakpoints:{576:{slidesPerView:2,spaceBetween:16},1024:{slidesPerView:3,spaceBetween:16},1200:{slidesPerView:3,spaceBetween:32},1440:{slidesPerView:3,spaceBetween:40}}})}));
$(".four-slider").each((function(e){var t={loop:!0},i={autoplay:{delay:5e3,disableOnInteraction:!1,pauseOnMouseEnter:!0}};$(this).hasClass("no-loop")&&(t={loop:!1}),$(this).hasClass("no-autoplay")&&(i={autoplay:!1}),$(this).hasClass("centered-slides"),$(this).find(".swiper").addClass(`swiper-four-${e}`),$(this).find(".swiper-pagination").addClass(`pagination-four-${e}`),$(this).find(".swiper-scrollbar").addClass(`scrollbar-four-${e}`),$(this).find(".button-prev").addClass(`prev-four-${e}`),$(this).find(".button-next").addClass(`next-four-${e}`);new Swiper(`.swiper-four-${e}`,{...defaultSettingSwiper,...t,...i,speed:1e3,spaceBetween:16,slidesPerView:1,navigation:{prevEl:`.four-slider .prev-four-${e}`,nextEl:`.four-slider .next-four-${e}`},pagination:{el:`.four-slider .pagination-four-${e}`,clickable:!0,dynamicBullets:!0},scrollbar:{el:`.four-slider .scrollbar-four-${e}`,hide:!1},breakpoints:{576:{slidesPerView:2,spaceBetween:16},768:{slidesPerView:3,spaceBetween:16},1200:{slidesPerView:4,spaceBetween:32},1440:{slidesPerView:4,spaceBetween:40}}})}));
$(".five-slider").each((function(e){var t={loop:!0},i={autoplay:{delay:5e3,disableOnInteraction:!1,pauseOnMouseEnter:!0}};$(this).hasClass("no-loop")&&(t={loop:!1}),$(this).hasClass("no-autoplay")&&(i={autoplay:!1}),$(this).hasClass("centered-slides"),$(this).find(".swiper").addClass(`swiper-five-${e}`),$(this).find(".swiper-pagination").addClass(`pagination-five-${e}`),$(this).find(".button-prev").addClass(`prev-five-${e}`),$(this).find(".button-next").addClass(`next-five-${e}`);new Swiper(`.swiper-five-${e}`,{...defaultSettingSwiper,...t,...i,speed:1e3,spaceBetween:16,slidesPerView:1,navigation:{prevEl:`.five-slider .prev-five-${e}`,nextEl:`.five-slider .next-five-${e}`},pagination:{el:`.five-slider .pagination-five-${e}`,clickable:!0,dynamicBullets:!0},breakpoints:{576:{slidesPerView:2,spaceBetween:16},768:{slidesPerView:3,spaceBetween:16},1200:{slidesPerView:4,spaceBetween:32},1440:{slidesPerView:5,spaceBetween:40}}})}));
$(".six-slider").each((function(e){var t={loop:!0},i={autoplay:{delay:5e3,disableOnInteraction:!1,pauseOnMouseEnter:!0}};$(this).hasClass("no-loop")&&(t={loop:!1}),$(this).hasClass("no-autoplay")&&(i={autoplay:!1}),$(this).hasClass("centered-slides"),$(this).find(".swiper").addClass(`swiper-six-${e}`),$(this).find(".swiper-pagination").addClass(`pagination-six-${e}`),$(this).find(".button-prev").addClass(`prev-six-${e}`),$(this).find(".button-next").addClass(`next-six-${e}`);new Swiper(`.swiper-six-${e}`,{...defaultSettingSwiper,...t,...i,speed:1e3,spaceBetween:16,slidesPerView:2,navigation:{prevEl:`.six-slider .prev-six-${e}`,nextEl:`.six-slider .next-six-${e}`},pagination:{el:`.six-slider .pagination-six-${e}`,clickable:!0,dynamicBullets:!0},breakpoints:{320:{slidesPerView:2,spaceBetween:16},576:{slidesPerView:3,spaceBetween:16},768:{slidesPerView:4,spaceBetween:16},1024:{slidesPerView:5,spaceBetween:16},1200:{slidesPerView:6,spaceBetween:32},1440:{slidesPerView:6,spaceBetween:40}}})}));
$(".auto-slider").each((function(e){var t={loop:!0},i={autoplay:{delay:5e3,disableOnInteraction:!1,pauseOnMouseEnter:!0},speed:1e3},a={};$(this).hasClass("no-loop")&&(t={loop:!1}),$(this).hasClass("no-autoplay")&&(i={autoplay:!1,speed:1e3}),$(this).hasClass("one-autoplay")&&(i={autoplay:{delay:1,disableOnInteraction:!1,pauseOnMouseEnter:!1},speed:4e3}),$(this).hasClass("centered-slides"),$(this).hasClass("is-free-mode")&&(a={freeMode:!0}),$(this).find(".swiper").addClass(`swiper-auto-${e}`),$(this).find(".swiper-pagination").addClass(`pagination-auto-${e}`),$(this).find(".swiper-scrollbar").addClass(`scrollbar-auto-${e}`),$(this).find(".button-prev").addClass(`prev-auto-${e}`),$(this).find(".button-next").addClass(`next-auto-${e}`);new Swiper(`.swiper-auto-${e}`,{...defaultSettingSwiper,...t,...i,...a,spaceBetween:16,slidesPerView:"auto",navigation:{prevEl:`.auto-slider .prev-auto-${e}`,nextEl:`.auto-slider .next-auto-${e}`},pagination:{el:`.auto-slider .pagination-auto-${e}`,clickable:!0},scrollbar:{el:`.auto-slider .scrollbar-auto-${e}`,draggable:!0},breakpoints:{1200:{spaceBetween:32},1440:{spaceBetween:40}}})}));

function lozadInit(){ if(typeof lozad!=="undefined"){ const e=lozad(".lozad",{threshold:.1,enableAutoReload:!0}),t=lozad(".lozad-bg",{threshold:.1});e.observe(),t.observe() } }
function fancyboxInit(){ if(typeof Fancybox!=="undefined"){ Fancybox.bind("[data-fancybox]",{showLoading:!0,preload:!0,infinite:!1,mainClass:"fancybox-wrapper"}),Fancybox.bind("a.popup-link",{showLoading:!0,type:"iframe",preload:!0}),Fancybox.bind('[data-fancybox="single"]',{groupAttr:!1}),$(".btn-close-fancybox").on("click",(function(){Fancybox.close()})) } }
function countUpInit(){ if(typeof CountUp!=="undefined" && typeof Waypoint!=="undefined"){ $(".count-up").each((function(e){$(this).attr("id",`countUp-${e}`);const t=$(this).data("count"),i=new CountUp(`countUp-${e}`,t,{separator:"",enableScrollSpy:!0,scrollSpyDelay:1e3,scrollSpyOnce:!0,useEasing:!0,useGrouping:!0});new Waypoint({element:document.getElementsByClassName("home-4-section")[0],handler:function(e){"up"==e?i.reset():i.start()},offset:"50%"})})) } }
function atroposInit(){ if(typeof Atropos!=="undefined" && $(".atropos").length&&widthWindow>=1200){ $(".atropos").each((function(e){$(this).addClass(`my-atropos-${e}`);Atropos({el:`.my-atropos-${e}`})})) } }
function accordionCollapse(){
	$(".accordion-item .accordion-head").off("click").on("click", (function(e){
		e.preventDefault();
		var $item = $(this).closest(".accordion-item");
		var $content = $(this).next(".accordion-content");
		if ($item.hasClass("active")) {
			$item.removeClass("active");
			$content.stop(true, true).slideUp();
		} else {
			$item.siblings(".accordion-item").removeClass("active").find(".accordion-content").stop(true, true).slideUp();
			$item.addClass("active");
			$content.stop(true, true).slideDown();
		}
	}));
}
function toggleMegaProduct(){
	$(".box-category .toggle-mega").off("click").on("click", (function(e){
		e.preventDefault();
		e.stopPropagation();
		var $hasMega = $(this).closest(".has-mega");
		var $subList = $hasMega.children(".mega-list");
		if ($hasMega.hasClass("active")) {
			$hasMega.removeClass("active");
			$subList.stop(true, true).slideUp();
		} else {
			$hasMega.siblings(".has-mega").removeClass("active").children(".mega-list").stop(true, true).slideUp();
			$hasMega.addClass("active");
			$subList.stop(true, true).slideDown();
		}
	}));
	$(".box-category li.has-mega.active > .mega-list").show();
}
function home4Init(){$(".home-4-item").on("mouseenter",(function(){const e=$(".home-4-image figure img").get(0).getBoundingClientRect(),t=e.left+e.width/2,i=e.top+e.height/2,a=this.getBoundingClientRect(),n=a.left+a.width/2,o=a.top+a.height/2;$(".home-4-image figure img").css({transform:`translate(${(n-t)/10}px, ${(o-i)/10}px)`})})).on("mouseleave",(function(){$(".home-4-image figure img").css({transform:"translate(0, 0)"})}))}
function formInit(){$("#product_title").val($(".product-detail-title").text()),$(".information-top").length&&$(".information-top .button a").on("click",(function(e){e.preventDefault(),$("html, body").animate({scrollTop:$(".career-form").offset().top-100},100)}))}
function toggleContent(){$(".product-section .full-content").each((function(){var e=$(this),t=e.parents(".product-section"),i=e.parents(".toggle-content").find(".btn-toggle-content"),a=$(this).height(),n=!1;function o(){widthWindow<1200?e.css("max-height","500px"):e.css("max-height","952px")}a>500&&widthWindow<1200||a>952&&widthWindow>1200?(o(),i.on("click",(function(i){i.preventDefault(),$(this).toggleClass("active"),n?(o(),n=!n,$("html, body").animate({scrollTop:t.offset().top-100},100)):(e.css("max-height","none"),n=!0)}))):$(this).parents(".toggle-content").find(".button").hide()}))}
