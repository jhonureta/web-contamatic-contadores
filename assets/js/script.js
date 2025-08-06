/* ==================== 
Table of Content 
==================== 

1. Loader Animation
2. Featured Countdown 
3. Select Dropdown Globally
4. Donation Select
5. Select Light
6. Select Charity Home
7. On Scroll Header Animation
8. Search Popup
9. On Scroll Back To Top Arrow
10. Toggles
11. Animated Skill Bars
12. Animated Counter
13. Popup Gallery & Videos
*/

(function ($) {
    "use strict";

    // Initialize a new Lenis instance for smooth scrolling
    const lenis = new Lenis()

    // Listen for the 'scroll' event and log the event data to the console
    lenis.on('scroll', (e) => {
        //   console.log(e);
    });

    function raf(time) {
        lenis.raf(time)
        requestAnimationFrame(raf)
    }

    requestAnimationFrame(raf)

    $(document).on("click", "[data-lenis-start], [data-bs-toggle], .mfp-close, #request_popup a.close, #request_popup, .cbp-popup-lightbox, .cbp-popup-close, .overlay-close, .offcanvas-header .collapsed, .offcanvas-backdrop, .shop-sidebar .offcanvas-header .btn, #btn-close, .screen-overlay, .mobile-offcanvas .btn-close", function () {
        lenis.start();
    });

    $(document).on("click", "[data-lenis-stop], .about-video a, .video-popup a, .gallery-content span, .request-btn .btn-theme, .cbp-lightbox, #search_home, .icon-lines, #shopping-bag, .popup-video", function () {
        lenis.stop();
    });


    // Select all elements with the 'Sign Up' button class or id
    const signUpButtons = document.querySelectorAll('[data-trigger="#signup"]'); // or use '#sign-up-button' if it's an id

    if (signUpButtons.length > 0) {
        signUpButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                if (typeof lenis !== 'undefined') {
                    lenis.stop(); // Assuming lenis is defined globally and controls scroll behavior
                }
            });
        });
    }

    // Select all elements with the 'Sign In' button class or id
    const signInButtons = document.querySelectorAll('[data-trigger="#signin"]'); // or use '#sign-in-button' if it's an id

    if (signInButtons.length > 0) {
        signInButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                if (typeof lenis !== 'undefined') {
                    lenis.stop(); // Assuming lenis is defined globally and controls scroll behavior
                }
            });
        });
    }



    if($("#yearText").length > 0){
        document.getElementById("yearText").innerHTML = new Date().getFullYear();
    }

    $("[data-trigger]").on("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        var offcanvas_id =  $(this).attr('data-trigger');
        $(offcanvas_id).toggleClass("show");
        $('body').toggleClass("offcanvas-active");
        $(".screen-overlay").toggleClass("show");
    });
    $(document).on('keydown', function(event) {
        if(event.keyCode === 27) {
           $(".mobile-offcanvas").removeClass("show");
           $(".screen-overlay").removeClass("show");
           $("body").removeClass("overlay-active");
        }
    });

    $(".btn-close, .screen-overlay").on("click", function(e){
        $(".screen-overlay").removeClass("show");
        $(".mobile-offcanvas").removeClass("show");
        $("body").removeClass("offcanvas-active");
    });

    var headerHeight = $('header').height();
    $('header').css('height', headerHeight);

    $(window).on('load, resize, scroll', function() {
        var headerHeight = $('header').height();
        $('header').css('height', headerHeight);
    
    });

    /* On Scroll Text Effect */
	if ($('.section-title h2, .title h1').length) {		
		let	animatedTextElements = document.querySelectorAll('.section-title h2, .title h1');
		
		 animatedTextElements.forEach((element) => {
			//Reset if needed
			if (element.animation) {
				element.animation.progress(1).kill();
				element.split.revert();
			}

			element.split = new SplitText(element, {
				type: "lines,words,chars",
				linesClass: "split-line",
			});
			gsap.set(element, { perspective: 400 });

			gsap.set(element.split.chars, {
				opacity: 0,
				x: "50",
			});

			element.animation = gsap.to(element.split.chars, {
				scrollTrigger: { trigger: element,	start: "top 90%" },
				x: "0",
				y: "0",
				rotateX: "0",
				opacity: 1,
				duration: 1,
				ease: Back.easeOut,
				stagger: 0.02,
			});
		});		
	}

     // Loader Animation
     $(window).on("load",function () {
        $("#pageloader").delay(1200).fadeOut("slow");
        $(".loader-item").delay(700).fadeOut();
    });

    // Splitting();
    // Splitting({ target: $('.section-title h2, .marketing-banner h1'), by: 'lines' });

    var custom_js = {
        
        bootstrap_menu: function () {
            if ($('.dropdown-menu a.dropdown-submenu-toggle').length) {

                // Dropdown Menu For Mobile
                $('.dropdown-menu a.dropdown-submenu-toggle').on('click', function (e) {
                    if (!$(this).next().hasClass('show')) {
                        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
                    }
                    var $subMenu = $(this).next(".dropdown-menu");
                    $subMenu.toggleClass('show');

                    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
                        $('.dropdown-submenu .show').removeClass("show");
                    });

                    $('.dropdown-menu').slideToggle(300);

                    return false;
                });
            }
        },

        toggle_active: function () {
            jQuery( '.toggle-active' ).on( "click", function(event) {
                jQuery(this).toggleClass("active");
            })
        },

        // Select 2 Dropdown Theme
        select_light: function () {
            if ($('.form-light-select').length) {

                $('.form-light-select').select2({
                    width: 'resolve',
                    theme: "form-light",
                    minimumResultsForSearch: -1
                });
            }
        },

        select_dark: function () {
            if ($('select').length) {

                $('select').select2({
                    width: 'resolve',
                    theme: "form-dark",
                    minimumResultsForSearch: -1
                });
            }
        }, 

        select_light_bordered: function () {
            if ($('.select-light-bordered').length) {

                $('.select-light-bordered').select2({
                    width: 'resolve',
                    theme: "select-light-bordered",
                    minimumResultsForSearch: -1
                });
            }
        },

        select_dark_bordered: function () {
            if ($('.select-dark-bordered').length) {

                $('.select-dark-bordered').select2({
                    width: 'resolve',
                    theme: "select-dark-bordered",
                    minimumResultsForSearch: -1
                });
            }
        },

        select_light_bordered_bottom: function () {
            if ($('.select-light-bordered-bottom').length) {

                $('.select-light-bordered-bottom').select2({
                    width: 'resolve',
                    theme: "select-light-bordered-bottom",
                    minimumResultsForSearch: -1
                });
            }
        },

        select_dark_bordered_bottom: function () {
            if ($('.select-dark-bordered-bottom').length) {

                $('.select-dark-bordered-bottom').select2({
                    width: 'resolve',
                    theme: "select-dark-bordered-bottom",
                    minimumResultsForSearch: -1
                });
            }
        },
        // Select 2 Dropdown Theme

        header_anim: function () {
            if ($('.header-anim').length) {

                $(window).on("scroll", function () {
                    if ($(this).scrollTop() > 80) {
                        $('.header-anim').addClass('fixed-top animated fadeInDown');
                    } else {
                        $('.header-anim').removeClass('fixed-top animated fadeInDown');
                    }
                });
            }
        },

        back_to_top: function () {

            if ($('#back-to-top').length) {

                $(window).on("scroll", function () {

                    if ($(this).scrollTop() > 100) {
                        $('.back-to-top').addClass('on');
                    } else {
                        $('.back-to-top').removeClass('on');
                    }
                });

                $('.back-to-top').on('click', function(e) {
                    $("html, body").animate({
                        scrollTop: 0
                    }, 600);
                    return false;       
                });
            }
        },

        tooltip_globally: function () {
            if ($('[data-bs-toggle="tooltip"]').length) {                
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        },

        // Popup Gallery & Videos
        magnific_popup: function () {
            if ($('.popup-video').length) {
                $('.popup-video').magnificPopup({
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: true,
                    fixedContentPos: true
                });
            }
        },

        // Search Popup
        search_overlay: function () {
            if ($('.overlay-close').length) {

                $('#search_home, .overlay-close').on("click", function ($e) {
                    $e.preventDefault();
                    $(".overlay").toggleClass("open");
                });
            }
        },

        // coming Countdown
        coming_countdown: function () {
            if ($('#coming-soon').length) {

                var now = new Date();
                var day = now.getDate();
                var month = now.getMonth() + 1;
                var year = now.getFullYear() + 1;

                var nextyear = month + '/' + day + '/' + year + ' 07:07:07';

                $('#coming-soon').countdown({
                    date: nextyear, // TODO Date format: 07/27/2017 17:00:00
                    offset: +2, // TODO Your Timezone Offset
                    day: 'Day',
                    days: 'Days',
                    hideOnComplete: true
                }, function (container) {
                    alert('Done!');
                });
            }
        },

        isotope_gallery: function () {

            // Porfolio isotope and filter
            $(window).on('load', function () {
                var portfolioIsotope = $('.isotope-gallery').isotope({
                    itemSelector: '.gallery-item'
                });

                $('#portfolio-flters li').on('click', function () {
                    $("#portfolio-flters li").removeClass('filter-active');
                    $(this).addClass('filter-active');

                    portfolioIsotope.isotope({
                        filter: $(this).data('filter')
                    });
                    //aos_init();
                });
            });

            // Porfolio isotope and filter
            var portfolioIsotope = $('.isotope-gallery').isotope({
                itemSelector: '.gallery-item'
            });

            $('#portfolio-flters li').on('click', function () {
                $("#portfolio-flters li").removeClass('filter-active');
                $(this).addClass('filter-active');

                portfolioIsotope.isotope({
                    filter: $(this).data('filter')
                });
                //aos_init();
            });
        },

        portfolio_gallery : function(){

            if( $('.portfolio-img-gallery').length ){

                $('.portfolio-img-gallery').each(function() { // the containers for all your galleries
                    $(this).magnificPopup({
                        delegate: 'a', // the selector for gallery item
                        type: 'image',
                        gallery: {
                            enabled: true, // set to true to enable gallery
                        
                            preload: [0,2], // read about this option in next Lazy-loading section
                        
                            navigateByImgClick: true,
                        
                            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button
                        
                            tPrev: 'Previous (Left arrow key)', // title for left button
                            tNext: 'Next (Right arrow key)', // title for right button
                            tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
                        }
                    });
                });
            }
        },

       
        // Animated Skill Bars  
        animated_skillbar: function () {
            if ($('.skillbar').length) {

                $('.skillbar').appear();
                $('.skillbar').on('appear', function () {
                    $(this).find('.skillbar-bar').animate({
                        width: $(this).attr('data-percent')
                    }, 3000);
                });
            }
        },

        // Animated Counter
        animated_counter: function () {
            if ($('.timer').length) {

                $('.timer').countTo();
                $('.fun-fact').appear(function () {
                    $('.timer').countTo();
                }, {
                    accY: -10
                });
            }
        },


        // All Owl Carousel Slider
        slider_testimonials_shadow : function(){

            if( $('#testimonials-slider-shadow').length ){
    
                $('#testimonials-slider-shadow').owlCarousel({
    
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    slideBy: 1,
                    center: true,
                    autoplayTimeout: 10000,
                    smartSpeed: 1000,
                    nav: false,
                    dots: true,
                    autoplayHoverPause:true,
                    navText: ['<i class="srn-arrow-left"></i>', '<i class="srn-arrow-right"></i>'],
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 1
                        },
                        767: {
                            items: 2
                        },
                        1200: {
                            items: 3
                        }
                    }
                });
            }
        },

        slider_portfolio_single : function(){

            if( $('#portfolio-slider-single').length ){
    
                $('#portfolio-slider-single').owlCarousel({    
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    slideBy: 1,
                    items: 1,
                    autoplayTimeout: 10000,
                    smartSpeed: 1000,
                    nav: true,
                    dots: false,
                    autoplayHoverPause:true,
                    navText: ['<i class="srn-arrow-left"></i>', '<i class="srn-arrow-right"></i>']
                });
            }
        },

        portfolio_related_slider : function(){

            if( $('#portfolio-related-slider').length ){
    
                $('#portfolio-related-slider').owlCarousel({    
                    loop: true,
                    margin: 30,
                    autoplay: true,
                    slideBy: 1,
                    items: 1,
                    autoplayTimeout: 10000,
                    smartSpeed: 1000,
                    nav: true,
                    dots: false,
                    autoplayHoverPause:true,
                    navText: ['<i class="srn-arrow-left"></i>', '<i class="srn-arrow-right"></i>'],
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1200: {
                            items: 2
                        }
                    }
                });
            }
        },

        services_related_slider : function(){

            if( $('#services-related-slider').length ){
    
                $('#services-related-slider').owlCarousel({    
                    loop: true,
                    margin: 30,
                    autoplay: true,
                    slideBy: 1,
                    items: 1,
                    autoplayTimeout: 10000,
                    smartSpeed: 1000,
                    nav: true,
                    dots: false,
                    autoplayHoverPause:true,
                    navText: ['<i class="srn-arrow-left"></i>', '<i class="srn-arrow-right"></i>'],
                    responsive: {
                        0: {
                            items: 1
                        },
                        575: {
                            items: 2
                        },
                        767: {
                            items: 2
                        },
                        1200: {
                            items: 3
                        }
                    }
                });
            }
        },

        marketing_banner_slider : function(){

            if( $('#marketing-banner-slider').length ){
    
                $('#marketing-banner-slider').owlCarousel({    
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    slideBy: 1,
                    items: 1,
                    autoplayTimeout: 10000,
                    smartSpeed: 1000,
                    nav: false,
                    dots: false,
                    autoplayHoverPause:true,
                    navText: ['<i class="srn-arrow-left"></i>', '<i class="srn-arrow-right"></i>'],
                    responsive: {
                        0: {
                            items: 2
                        },
                        560: {
                            items: 3
                        },
                        768: {
                            items: 4
                        },
                        1024: {
                            items: 3
                        },
                        1400: {
                            items: 4
                        }
                    }
                });
            }
        },

        slider_testimonials_leftimg : function(){

            if( $('#testimonials-slider-leftimg').length ){
    
                $('#testimonials-slider-leftimg').owlCarousel({
    
                    loop: true,
                    margin: 30,
                    autoplay: false,
                    slideBy: 1,
                    items:1,
                    center: true,
                    autoplayTimeout: 3000,
                    smartSpeed: 1000,
                    nav: true,
                    dots: false,
                    autoplayHoverPause:true,
                    navText: ['<i class="srn-arrow-left"></i>', '<i class="srn-arrow-right"></i>']
                });
            }
        },

        slider_testimonials_single : function(){

            if( $('#testimonials-slider-single').length ){
    
                $('#testimonials-slider-single').owlCarousel({
    
                    loop: true,
                    margin: 30,
                    autoplay: true,
                    slideBy: 1,
                    items:1,
                    center: true,
                    autoplayTimeout: 3000,
                    smartSpeed: 1000,
                    nav: false,
                    dots: true,
                    autoplayHoverPause:true,
                    navText: ['<i class="srn-arrow-left"></i>', '<i class="srn-arrow-right"></i>']
                });
            }
        },

        slider_blog_post : function(){

            if( $('#blog-post').length ){
    
                $('#blog-post').owlCarousel({
    
                    loop: true,
                    margin: 0,
                    autoplay: false,
                    slideBy: 1,
                    items:1,
                    center: true,
                    autoplayTimeout: 3000,
                    smartSpeed: 1000,
                    nav: true,
                    dots: false,
                    autoplayHoverPause:true,
                    navText: ['<i class="srn-arrow-left"></i>', '<i class="srn-arrow-right"></i>']
                });
            }
        },

        client_default_home_slider : function(){

            if( $('#client-home-default').length ){
    
                $('#client-home-default').owlCarousel({
    
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    slideBy: 1,
                    items: 1,
                    autoplayTimeout: 10000,
                    smartSpeed: 1000,
                    nav: false,
                    dots: false,
                    autoplayHoverPause:true,
                    navText: ['<i class="srn-arrow-left"></i>', '<i class="srn-arrow-right"></i>'],
                    responsive: {
                        0: {
                            items: 2
                        },
                        560: {
                            items: 3
                        },
                        1024: {
                            items: 5
                        },
                        1200: {
                            items: 6
                        }
                    }
                });
            }
        },

        home_default_testimonials : function(){

            if( $('#home-default-testimonials').length ){
    
                $('#home-default-testimonials').owlCarousel({
    
                    loop: true,
                    margin: 30,
                    autoplay: false,
                    slideBy: 1,
                    items: 1,
                    autoplayTimeout: 10000,
                    smartSpeed: 1000,
                    nav: true,
                    dots: false,
                    autoplayHoverPause:true,
                    navText: ['<i class="srn-arrow-left"></i>', '<i class="srn-arrow-right"></i>'],
                    responsive: {
                        0: {
                            items: 1
                        },
                        1024: {
                            items: 2
                        },
                        1200: {
                            items: 2
                        }
                    }
                });
            }
        },

        home_coworking_banner : function(){

            if( $('#home-coworking-banner').length ){
    
                $('#home-coworking-banner').owlCarousel({
    
                    loop: true,
                    margin: 0,
                    autoplay: false,
                    slideBy: 1,
                    items: 1,
                    autoplayTimeout: 10000,
                    smartSpeed: 1000,
                    nav: true,
                    dots: false,
                    autoplayHoverPause:true,
                    navText: ['<i class="srn-arrow-left"></i>', '<i class="srn-arrow-right"></i>']
                });
            }
        },

        home_space_solutions : function(){

            if( $('#coworking-space-solutions').length ){
    
                $('#coworking-space-solutions').owlCarousel({
    
                    loop: true,
                    margin: 0,
                    autoplay: false,
                    slideBy: 1,
                    items: 1,
                    center: false,
                    stagePadding: 50,
                    autoplayTimeout: 3000,
                    smartSpeed: 1000,
                    nav: true,
                    dots: false,
                    autoplayHoverPause:true,
                    navText: ['<i class="srn-arrow-left"></i>', '<i class="srn-arrow-right"></i>'],
                    responsive: {
                        0: {
                            items: 1,
                            stagePadding: 20,
                        },
                        1024: {
                            items: 2
                        },
                        1200: {
                            items: 3,
                            nav: true,
                        }
                    }
                });
            }
        },
        
        // All Owl Carousel Slider


        wow_animation : function(){

        var wow = new WOW(
            {
                boxClass: 'wow',      // default
                animateClass: 'animated', // default
                offset: 0,          // default
                mobile: true,       // default
                live: true        // default
            }
        )
        wow.init();
        },

        contact_form_validate : function(){
            $("#contactusForm").validate({
                submitHandler: function (form) {

                    var s_name = $("#First_Name").val();
                    var s_lastname = $("#Last_Name").val();
                    var s_email = $("#Email_Address").val();
                    var s_phone = $("#Phone_Number").val();
                    var s_comment = $("#Your_Message").val();
                    $.post("contact_process.php", {
                        name: s_name,
                        lastname: s_lastname,
                        email: s_email,
                        phone: s_phone,
                        comment: s_comment
                    },
                        function (result) {
                            $('#sucessmessage').append(result);
                        });
                    $('#contactusForm').hide();
                    return false;
                },
            });
        },

        initializ: function () {

            //Select 2 Dropdown Functions
            this.select_light();
            this.select_dark();
            this.select_light_bordered();
            this.select_dark_bordered();
            this.select_light_bordered_bottom();
            this.select_dark_bordered_bottom();
            //Select 2 Dropdown Functions

            this.header_anim();
            this.back_to_top();
            this.magnific_popup();
            this.search_overlay();
            this.coming_countdown();
            this.isotope_gallery();
            this.portfolio_gallery();
            this.toggle_active();

            // All Owl Carousel Slider
            this.slider_testimonials_shadow();
            this.slider_portfolio_single();
            this.portfolio_related_slider();
            this.services_related_slider();
            this.marketing_banner_slider();
            this.slider_testimonials_leftimg();
            this.slider_testimonials_single();
            this.slider_blog_post();
            this.client_default_home_slider();
            this.home_default_testimonials();
            this.home_coworking_banner();
            this.home_space_solutions();
            // All Owl Carousel Slider

            this.tooltip_globally();
            this.animated_skillbar();
            this.animated_counter();

            this.wow_animation();
            this.bootstrap_menu();
            this.contact_form_validate();

            //Mizha

        }

    }

    /* ---------------------------------------------
    Document ready function
    --------------------------------------------- */
    $(function () {
        custom_js.initializ();
    });

})(jQuery);