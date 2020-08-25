"use strict";
if (typeof Placeholdem === 'function') {
	if (document.querySelectorAll('[placeholder]').length) {
		Placeholdem(document.querySelectorAll('[placeholder]'));
	};
}
//PieChart

function pieChart() {
	if (jQuery().easyPieChart) {
		var count = 0;
		//var colors = ['#fbcf61', '#e6557c', '#00c1e4'];
		var colors = ['#db325a'];
		jQuery('.chart').each(function() {
			var imagePos = jQuery(this).offset().top;
			var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow + 600) {
				jQuery(this).easyPieChart({
					barColor: colors[count],
					trackColor: '#f0f0f0',
					scaleColor: false,
					scaleLength: false,
					lineCap: 'butt',
					lineWidth: 20,
					size: 230,
					rotate: 0,
					animate: 2000,
					onStep: function(from, to, percent) {
						jQuery(this.el).find('.percent').text(Math.round(percent));
					}
				});
			}
			count++;
			if (count >= colors.length) {
				count = 0
			};
		});
	}
}
var password = document.getElementById("password"),
	confirm_password = document.getElementById("confirm_password");

function validatePassword() {
	if (password.value != confirm_password.value) {
		confirm_password.setCustomValidity("Passwörter stimmen nicht überein");
	} else {
		confirm_password.setCustomValidity('');
	}
}
if (password != null) {
	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
}
var currentVideo, countVideo = 0;
jQuery(document).ready(function() {
/*
    $("#Geburtsdatum").datepicker({
	dateFormat: 'dd.mm.yy'
    });
     $("#beschaftigt_seit").datepicker({
	dateFormat: 'dd.mm.yy'
    });
    */
	$('.video video').click(function() {
		currentVideo = $(this).attr('count');
	})
    
	$('.carousel-control').click(function() {
		var question = $(this).attr('question');
		var numberChoose = parseInt($('#question' + question + '').val());
        
		var count = 0;
        
		$('.content' + question + ' .question').each(function() {
			if ($(this).is(":checked")) count++;
		})
        
		if (count != numberChoose) {
			$('.message').html('Bitte beantworten Sie alle Fragen.');
			$('html, body').animate({
				scrollTop: 0
			}, 400);
		} else {
			if($(this).hasClass('carousel-control-next'))
              $('#next-page').click();
            else
               $('#previous-page').click();
               
            $('.message').html('');
		}
	})
    
	$('.title-lesson').click(function() {
		var level = $(this).attr('level');
		var watchVideo = $(this).attr('watch-video');
		var waitTime = $(this).attr('wait-time');
		var numberLesson = $(this).attr('number-lesson');
		var dataFolder = $(this).attr('data-folder');
		var dataVideo = $(this).attr('data-video');
		var dataPdf = $(this).attr('data-pdf');
		var onepage = $(this).attr('onepage');
        var passPercent = $(this).attr('pass-percent');
        var numberLesson_ = parseInt($(this).parent().attr('numberlesson'));
        var numberLessonBefore = parseInt($(this).parent().attr('numberLessonBefore'));
        var numberCourse = parseInt($('#numberCourse').val());
        
        jQuery.ajax({
			url: "./",
			type: 'POST',
			data: {
				level: level,
				numberLesson: numberLesson_,
                numberLessonBefore: numberLessonBefore,
                numberCourse: numberCourse,
			},
			success: function(msg) {
			    switch(msg) {
			       case 'yes':
                        $('#level').val(level);
                		$('#watch-video').val(watchVideo);
                		$('#wait-time').val(waitTime);
                		$('#number-lesson').val(numberLesson);
                		$('#data-folder').val(dataFolder);
                		$('#data-video').val(dataVideo);
                		$('#data-pdf').val(dataPdf);
                		$('#onepage').val(onepage);
                        $('#onepage').val(onepage);
                        $('#pass-percent').val(passPercent);
                		$('#form-course').submit();
                        break;
                   default:
                        $('.message').html(msg);
                        $('.message').css('color', 'red'); 
                        
                        $('html, body').animate({
            				scrollTop: 0
            			}, 400);	
			    }
            }
		});
    })
    
	$('.button_next_step').click(function() {
		$('.first_step').hide();
		$('.next_step').show();
	})
    
	$('.register-question').submit(function(event) {
		event.preventDefault();
        
	    jQuery.ajax({
				url: "./",
				type: 'POST',
				data: $(".register-question").serialize(),
				success: function(msg) {
					if(msg == 'success') {
					    $('.message').html('you pass');
                        $('.message').css('color', 'green');
                        
            			$('html, body').animate({
            				scrollTop: 0
            			}, 400);
					} else if(msg == 'failed') {
					    $('.message').html('you failed');
                        
                        $('html, body').animate({
            				scrollTop: 0
            			}, 400);
					} else {
					   $('.message').html(msg);
                        
                        $('html, body').animate({
            				scrollTop: 0
            			}, 400);
					}
				}
			});
	})
    
	$('input.question').click(function() {
		var nameclass = $(this).attr('class');
		var point = $(this).attr('point');
		var check = true;
		var yes = 'fGtzbXhjuzt';
		var no = 'fGtzbxhjuzt';
		//check choose wrong or correct
		$('input.question').each(function() {
			if ($(this).hasClass(nameclass) && $(this).attr('choose') == yes && $(this).is(":checked") == false) check = false;
			if ($(this).hasClass(nameclass) && $(this).attr('choose') == no && $(this).is(":checked") == true) check = false;
		})
		
		//set value to remember what is choose
		var history = $('#history').val();
		$('input.question').each(function() {
			if ($(this).is(":checked")) {
				if (history == history.replace($(this).attr('id'), '')) {
					history += $(this).attr('id') + ',';
					$('#history').val(history);
				}
			} else {
				history = history.replace($(this).attr('id'), '');
				$('#history').val(history);
			}
		})
	})
	$('.register-form').submit(function(event) {
		event.preventDefault();
		var username = $('#username').val();
		var password = $('.register-form #password').val();
		var email = $('.register-form #email').val();
		var register = "register";
		var title = $('#title').val();
		var Vorname = $('#Vorname').val();
		var name = $('#name').val();
		var Strasse = $('#Strasse').val();
		var Hausnummer = $('#Hausnummer').val();
		var Plz = $('#Plz').val();
		var ort = $('#ort').val();
		var country = $('#country').val();
		var Geburtsdatum = $('#Geburtsdatum').val();
		var Schuhgrosse = $('#Schuhgrsse').val();
		var email_gesch = $('#email_gesch').val();
		var Telefonnummer_privat = $('#Telefonnummer_privat').val();
		var Telefonnummer_geschaft = $('#Telefonnummer_geschaft').val();
		var Beschaftigt_bei = $('#Beschaftigt_bei').val();
		var beschaftigt_als = $('#beschaftigt_als').val();
		var beschaftigt_seit = $('#beschaftigt_seit').val();
		jQuery.ajax({
			url: "./",
			type: 'POST',
			data: {
				username: username,
				password: password,
				email: email,
				register: register,
				title: title,
				Vorname: Vorname,
				name: name,
				Strasse: Strasse,
				Hausnummer: Hausnummer,
				Plz: Plz,
				ort: ort,
				country: country,
				Geburtsdatum: Geburtsdatum,
				Schuhgrosse: Schuhgrosse,
				email_gesch: email_gesch,
				Telefonnummer_privat: Telefonnummer_privat,
				Telefonnummer_geschaft: Telefonnummer_geschaft,
				Beschaftigt_bei: Beschaftigt_bei,
				beschaftigt_als: beschaftigt_als,
				beschaftigt_seit: beschaftigt_seit
			},
			success: function(msg) {
				$('.register-form .title_form').html(msg);
			}
		});
	})
	$('.forgotpassword-form').submit(function(event) {
		event.preventDefault();
		var email = $('.forgotpassword-form #email').val();
		var token = $('.forgotpassword-form #token').val();
		var password = $('.forgotpassword-form #password').val();
		if (token == 'token') token = '';
		jQuery.ajax({
			url: "./",
			type: 'POST',
			data: {
				email_forgot_pw: email,
				token: token,
				password: password
			},
			success: function(msg) {
				msg = msg.split(';');
				//alert(msg[1]);
				//if is not email exist
				if (msg[1] == 0 || msg[1] == 2) $('.forgotpassword-form .message_forgotpassword').html(msg[0]);
				else if (msg[1] == 3) {
					$('.forgotpassword-form .message_forgotpassword').html(msg[0]);
					$('.forgotpassword-form .message_forgotpassword').addClass('success');
				} else {
					$('.forgotpassword-form .message_forgotpassword').html(msg[0]);
					$('.forgotpassword-form #email').hide();
					$('.forgotpassword-form #token').show();
					$('.forgotpassword-form #password').show();
					$('.forgotpassword-form #confirm_password').show();
					$('.forgotpassword-form #token').val('');
					$('.forgotpassword-form #password').val('');
					$('.forgotpassword-form #confirm_password').val('');
				}
			}
		});
	})
	$('.message a').click(function() {
		var class_name = $(this).attr('choose');
		if (class_name == '3') {
			$('form').animate({
				height: "toggle",
				opacity: "toggle"
			}, "slow");
			$('.register-form').hide();
		} else if (class_name == '4') {
			$('form').animate({
				height: "toggle",
				opacity: "toggle"
			}, "slow");
			$('.register-form').hide();
		} else {
			$('form').animate({
				height: "toggle",
				opacity: "toggle"
			}, "slow");
			$('.forgotpassword-form').hide();
		}
	});
	$('.test_success').click(function() {
		var id_user_test = $(this).attr('id');
        
		var title = $(this).html();
		jQuery.ajax({
			url: "./",
			type: 'POST',
			data: {
				id_user_test: id_user_test
			},
			success: function(msg) {
				$('.modal-body').html(msg);
				$('.modal-title').html(title);
                //$('.modal-body').html('dd');
				//$('.modal-title').html('fdf');
			}
		});
	});
	$('.test_success_admin').click(function() {
		var id_user_test = $(this).attr('id');
		var title = 'Test' + $(this).html() + '&nbsp;&nbsp;&nbsp;' + $(this).attr('date');
		jQuery.ajax({
			url: "../index.php",
			type: 'POST',
			data: {
				id_user_test: id_user_test
			},
			success: function(msg) {
				$('.modal-body').html(msg);
				$('.modal-title').html(title);
			}
		});
	});
	//menu
	if (jQuery().superfish) {
		jQuery('ul.sf-menu').superfish({
			delay: 700,
			animation: {
				opacity: 'show',
				height: 'show'
			},
			//animation:   {opacity:'show'},
			animationOut: {
				opacity: 'hide'
			},
			speed: 'fast',
			disableHI: false,
			cssArrows: false,
			autoArrows: false
		});
	}
	//toTop
	if (jQuery().UItoTop) {
		jQuery().UItoTop({
			easingType: 'easeOutQuart'
		});
	}
	//horizontal accordion
	if (jQuery().elastislide) {
		jQuery('#carousel').elastislide({
			// imageW : 260,
			// border : 0,
			minItems: 2,
			// margin : 30
			orientation: 'vertical'
		});
	}
	//parallax
	if (jQuery().parallax) {
		// jQuery('.parallax').parallax("50%", 0.5);
	}
	//prettyPhoto
	if (jQuery().prettyPhoto) {
		jQuery("a[rel^='prettyPhoto']").prettyPhoto({
			theme: 'facebook' /* light_rounded / dark_rounded / light_square / dark_square / facebook / pp_default*/
		});
	}
	//carousel
	if (jQuery().carousel) {
		jQuery('.carousel').carousel();
	}
	//owl carousel
	if (jQuery().owlCarousel) {
		//upcomming events carousel
		jQuery(".owl-carousel.classes").owlCarousel({
			navigation: true,
			navigationText: false,
			pagination: false,
			items: 4
		});
		//trainers carousel
		jQuery(".owl-carousel.trainers").owlCarousel({
			navigation: true,
			navigationText: false,
			pagination: false,
			items: 2,
			itemsDesktop: 2,
			itemsDesktopSmall: 2,
			itemsTablet: 3
		});
		//partners
		jQuery(".partners").owlCarousel({
			navigation: true,
			navigationText: false,
			pagination: false,
			items: 5,
			autoPlay: 5000
		});
	}
	//nice scroll
	if (jQuery().niceScroll) {
		jQuery("html").niceScroll({
			cursorcolor: '#f1f1f1',
			cursorborder: 'none',
			cursorborderradius: '0',
			cursorwidth: '8px'
		});
	}
	//bx slider
	if (jQuery().bxSlider) {
		jQuery('.bxslider').bxSlider({
			auto: true,
			controls: false,
			pager: false,
			mode: 'fade'
		});
		jQuery('.vertical-slider').bxSlider({
			mode: 'vertical',
			//slideWidth: 300,
			minSlides: 2,
			slideMargin: 30,
			pager: false
		});
	}
	//single page localscroll and scrollspy
	var navHeight = jQuery('#header').outerHeight(true) + 40;
	jQuery('body').scrollspy({
		target: '.mainmenu_wrap',
		offset: navHeight
	});
	if (jQuery().localScroll) {
		jQuery('#mainmenu, #land').localScroll({
			duration: 1900,
			easing: 'easeOutQuart',
			offset: 0
		});
	}
	//portfolio and horizontal slider animation
	jQuery('.portfolio_item_image .portfolio_links').css({
		opacity: 0
	});
	jQuery('.isotope-item, .horizontal_slider_introimg').hover(

	function() {
		jQuery(this).find('.portfolio_item_image .portfolio_links').stop().animate({
			opacity: 1
		}, 500, 'easeOutExpo').find('.p-view').toggleClass('moveFromLeft').end().find('.p-link').toggleClass('moveFromRight');
	}, function() {
		jQuery(this).find('.portfolio_item_image .portfolio_links').stop().animate({
			opacity: 0
		}, 300, 'easeOutExpo').find('.p-view').toggleClass('moveFromLeft').end().find('.p-link').toggleClass('moveFromRight');
	});
	//teaser style5 animation
	jQuery('.single_teaser.icons.style5').hover(

	function() {
		jQuery(this).find('i').addClass('moveFromLeft').end().find('h3').addClass('moveFromRight').end().find('p').addClass('moveFromBottom');
	}, function() {
		jQuery(this).find('i').removeClass('moveFromLeft').end().find('h3').removeClass('moveFromRight').end().find('p').removeClass('moveFromBottom');
	});
	//twitter
	//slide tweets
	jQuery('#tweets .twitter').bind('loaded', function() {
		jQuery(this).addClass('flexslider').find('ul').addClass('slides');
	});
	if (jQuery().tweet) {
		jQuery('.twitter').tweet({
			modpath: "./twitter/",
			count: 1,
			avatar_size: 48,
			loading_text: 'loading twitter feed...',
			join_text: 'auto',
			username: 'ThemeForest',
			template: "{avatar}{time}{join}<span class=\"tweet_text\">{tweet_text}</span>"
		});
	}
	//land slider
	jQuery('#land').find('.land').css({
		'opacity': 0
	}).end().find('.shown').css({
		'opacity': 1
	});
});
jQuery(window).load(function() {
	//land slider
	jQuery('.main-tab a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
		var newSlideId = jQuery(this).attr('class');
		var oldSlideId = e.relatedTarget.getAttribute('class');
		jQuery('#land').find('#' + oldSlideId).animate({
			opacity: 0
		}, {
			queue: false
		}).removeClass('shown').addClass('not_shown').end().find('#' + newSlideId).removeClass('not_shown').addClass('shown').animate({
			opacity: 1
		}, {
			queue: false
		})
	});
	setTimeout(function() {
		jQuery('.progress-bar').addClass('stretchRight');
	}, 600);
	//stick header to top
	if (jQuery().sticky) {
		jQuery("#header").sticky({
			topSpacing: 0,
			scrollBeforeStick: 10
		}, function() {
			jQuery("#header").stop().animate({
				opacity: 0
			}, 0).delay(500).stop().animate({
				opacity: 1
			}, 1000);
		}, function() {
			jQuery("#header").stop().animate({
				opacity: 0
			}, 0).delay(50).stop().animate({
				opacity: 1
			}, 2000);
		});
	}
	//circle progress bar
	pieChart();
	//flex slider
	if (jQuery().flexslider) {
		var $mainSlider = jQuery('#mainslider');
		jQuery(".flexslider").flexslider({
			animation: "fade",
			useCSS: true,
			controlNav: true,
			//animationLoop: false,
			smoothHeight: true,
			slideshowSpeed: 5000,
			animationSpeed: 800,
			after: function(slider) {
				//bg-color1 - class for #mainslider
				var currentClass = $mainSlider.find('.flex-active-slide').attr('data-bg');
				$mainSlider.attr('class', currentClass);
			}
		});
	}
	jQuery('body').delay(1000).scrollspy('refresh');
	//preloader
	jQuery(".preloaderimg").fadeOut();
	jQuery(".preloader").delay(200).fadeOut("slow").delay(200, function() {
		jQuery(this).remove();
	});
	//flickr
	// use http://idgettr.com/ to find your ID
	if (jQuery().jflickrfeed) {
		jQuery("#flickr").jflickrfeed({
			flickrbase: "http://api.flickr.com/services/feeds/",
			limit: 6,
			qstrings: {
				id: "63512867@N07"
			},
			itemTemplate: '<a href="{{image_b}}" rel="prettyPhoto[pp_gal]"><li><img alt="{{title}}" src="{{image_s}}" /></li></a>'
		}, function(data) {
			jQuery("#flickr a").prettyPhoto({
				theme: 'facebook'
			});
			jQuery("#flickr li").hover(function() {
				jQuery(this).find("img").stop().animate({
					opacity: 0.5
				}, 200);
			}, function() {
				jQuery(this).find("img").stop().animate({
					opacity: 1.0
				}, 400);
			});
		});
	}
	//animation to elements
	var windowHeight = jQuery(window).height();
	jQuery('.to_fade, .block-header, .block-header + p').each(function() {
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
		if (imagePos < topOfWindow + windowHeight - 100) {
			jQuery(this).addClass("animated fadeInUp");
		}
	});
	jQuery('.to_slide_left').each(function() {
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
		if (imagePos < topOfWindow + windowHeight - 100) {
			jQuery(this).addClass("animated fadeInLeft");
		}
	});
	jQuery('.to_slide_right').each(function() {
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
		if (imagePos < topOfWindow + windowHeight - 100) {
			jQuery(this).addClass("animated fadeInRight");
		}
	});
});
jQuery(window).resize(function() {
	jQuery("#header").sticky('update');
	jQuery('body').scrollspy('refresh');
	//flexslider
	jQuery(".slides").find("li").each(function() {
		var h = jQuery(this).height();
		var childH = jQuery(this).find(".leftcontent_wrap").actual("height");
		var childRH = jQuery(this).find(".rightcontent_wrap").actual("height");
		var childD = jQuery(this).find(".slide_description").actual("height");
		var padding = (h / 2) - (childH / 2);
		var paddingR = (h / 2) - (childRH / 2);
		var topD = ((h / 2) - ((childD / 2)));
		jQuery(this).find(".leftcontent_wrap").css("padding-top", padding);
		jQuery(this).find(".rightcontent_wrap").css("padding-top", paddingR);
		jQuery(this).find(".slide_description").css("top", topD);
	});
});
jQuery(window).scroll(function() {
	//circle progress bar
	pieChart();
	//animation to elements
	var windowHeight = jQuery(window).height();
	jQuery('.to_fade, .block-header, .block-header + p').each(function() {
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
		if (imagePos < topOfWindow + windowHeight - 100) {
			jQuery(this).addClass("animated fadeInUp");
		}
	});
	jQuery('.to_slide_left').each(function() {
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
		if (imagePos < topOfWindow + windowHeight - 100) {
			jQuery(this).addClass("animated fadeInLeft");
		}
	});
	jQuery('.to_slide_right').each(function() {
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
		if (imagePos < topOfWindow + windowHeight - 100) {
			jQuery(this).addClass("animated fadeInRight");
		}
	});
});