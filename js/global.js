jQuery( function($) {
	
	$(document).ready(function(){

		// Vars
		var $window = $(window);
	
		// remove wrong "x topics" titles from tag cloud
		$('.tags a').attr("title", "");

		// Menu Dropdowns
		$("#site-navigation li.menu-item-has-children > a").on('click touchstart', function () {
			var $this = $(this);
			$this.children('.fa').toggleClass('fa-caret-down fa-caret-up');
			$this.next('ul').stop(true,true).slideToggle( 'fast' );
			return false;
		});

		// FadeIn single post image
		var $singleContainer = $('.single-post-media');
		$singleContainer.imagesLoaded(function(){
			$('.single-post-media img').css({
				opacity: 1
			});
			$singleContainer.addClass('remove-loader');
		});

		// Lightbox
		$('.wpex-lightbox').magnificPopup({ type: 'image' });
		$('.wpex-gallery-lightbox').each(function() {
			$(this).magnificPopup({
				delegate: 'a',
				type: 'image',
				gallery: {
					enabled:true
				}
			});
		});

		// Back to top link
		$scrollTopLink = $( 'a.site-scroll-top' );
		$window.scroll(function () {
			if ($(this).scrollTop() > 100) {
				$scrollTopLink.fadeIn();
			} else {
				$scrollTopLink.fadeOut();
			}
		});
		$scrollTopLink.on('click', function() {
			$( 'html, body' ).animate({scrollTop:0}, 400);
			return false;
		} );

		// Social Share
		function wpex_social_share() {
			if ( wpexLocalize.mobile == 'yes' ) {
				$(".social-share-toggle").on('click', function () {
					$(this).toggleClass('active');
					return false;
				});
			} else {
				$(".social-share-toggle").on('click', function () {
					$(".social-share-toggle").removeClass('active');
					$(this).addClass('active');
				});
				$('.social-share-toggle').click( function( event ) {
					event.stopPropagation();
				});
				$(document).click( function(){
					$('.social-share-toggle').removeClass('active');
				});
			}
		} wpex_social_share();

		// Gallery slider
		function wpex_gallery_slider() {
			$('div.post-gallery .flexslider').flexslider( {
				slideshow : true,
				animation : 'fade',
				pauseOnHover: true,
				animationSpeed : 400,
				smoothHeight : true,
				directionNav: true,
				controlNav: false,
				prevText : '',
				nextText : ''
			});
		}
		
		// Read Later Buttons (which service should be displayed is defined by user selection or cookie)
		function addReadLaterButtons(readlaterservices) {
			
				$('.nobtns').each(function() {
			    	
			    	$(this).removeClass('nobtns');
			    	
			    	title = $(this).find('h2.loop-entry-title').text();
			    	link = $(this).find('h2.loop-entry-title a').attr('href');
			    	description = $(this).find('.loop-entry-excerpt p').text();
			    	console.log(description);
			    	
			    	if (readlaterservices.indexOf("Instapaper") > -1) {
			    		$(this).find('.instapaper').html("<div class='instabutton'><iframe border='0' scrolling='no' width='78' height='17' allowtransparency='true' frameborder='0' style='margin-bottom: -3px; z-index: 1338; border: 0px; background-color: transparent; overflow: hidden;' src='http://www.instapaper.com/e2?url=" + link + "&title=" + title + "&description=#weeklyfilet " + description + "'></iframe></div>");
			    	}
			    	
			    	else $(this).find('.instapaper').html("");
			    	
			    	if (readlaterservices.indexOf("Pocket") > -1) {
			    		$(this).find('.pocket').html("<div class='pocketbutton'><a href='https://getpocket.com/save' class='pocket-btn' data-lang='en' data-save-url='" + link + "' data-pocket-count='none' data-pocket-align='left'>Pocket</a><script type='text/javascript'>!function(d,i){if(!d.getElementById(i)){var j=d.createElement('script');j.id=i;j.src='https://widgets.getpocket.com/v1/j/btn.js?v=1';var w=d.getElementById(i);d.body.appendChild(j);}}(document,'pocket-btn-js');</script></div>");
			    	}
			    	
			    	else $(this).find('.pocket').html("");		
			    });
		};
	
		// Read Later Settings
         var readlaterservices;
			
		/*	 // read cookie to know which services to use        
         getSettings() {
	         addReadLaterButtons(readlaterservices);
         }
         */
         
         $('.readlateroption').on('change',function(e){
            $('#readlaterselection').submit(e);
	            e.preventDefault();
	            readlaterservices = [];
	            
	            $("input:checkbox[name=readlaterservice]:checked").each(function() {
		            readlaterservices.push($(this).val());
	            });
	            
	            // make sure all buttons get refreshed
	            $('.loop-entry-inner').addClass('nobtns');
	            
	            addReadLaterButtons(readlaterservices);
	            
	            // TODO updateCookie(readlaterservice)
	            
            });		
		
		// Masonry
		var $container = $('.masonry-grid');
		$container.imagesLoaded(function(){
			// FlexSlider run after images are loaded
			wpex_gallery_slider();
			$container.masonry({
				itemSelector: '.loop-entry',
				transitionDuration: '0.3s'
			});
		});

		// Infinite scroll
		var $container = $('.masonry-grid');
		$container.infinitescroll( {
			loading: {
				msg: null,
				finishedMsg : null,
				msgText : null,
				msgText: '<div class="infinite-scroll-loader"><i class="fa fa-spinner fa-spin"></i></div>',
			},
				navSelector  : 'div.page-jump',
				nextSelector : 'div.page-jump div.older-posts a',
				itemSelector : '.loop-entry',
			},
			// trigger Masonry as a callback
			function( newElements ) {
				// hide new items while they are loading
				var $newElems = $( newElements ).css({ opacity: 0 });
				// ensure that images load before adding to masonry layout
				$newElems.imagesLoaded(function(){
					// Social Share
					wpex_social_share();
					// Slider
					wpex_gallery_slider();
					// show elems now they're ready
					$newElems.animate({ opacity: 1 });
					$container.masonry( 'appended', $newElems, true );
					addReadLaterButtons(readlaterservices);
					// Twitter
					// if ( twttr ) { twttr.widgets.load(); }
					// Self hosted audio and video
					jQuery(newElements).find('audio,video').mediaelementplayer();
					// Lightbox
					$('.wpex-lightbox').magnificPopup({ type: 'image' });
					$('.wpex-gallery-lightbox').each(function() {
						$(this).magnificPopup({
							delegate: 'a',
							type: 'image',
							gallery: {
								enabled:true
							}
						});
					});
			});
		});

		// Load more button
		if ( wpexLocalize.pagination == 'load-more' ) {
			$(window).unbind('.infscr');
			$('a.load-more-posts').click(function() {
				$(document).trigger('retrieve.infscr');
				return false;
			});
			$(document).ajaxError(function(e,xhr,opt) {
				if(xhr.status==404)
				$('a.load-more-posts').remove();
			});
		}

		// Fluid Videos
		fluidvids.init({
			selector: '.entry iframe', // runs querySelectorAll()
			players: ['www.youtube.com', 'player.vimeo.com'] // players to support
		});

		// Mobile toggle
		function wpex_mobile_toggle() {
			$("#sidebar-content-toggle a").on('click touchstart', function () {
				$(this).children('.fa').toggleClass('fa-bars fa-times')
				$('#main-sidebar-content').toggleClass('active');
				return false;
			});
			$('#main-sidebar-content a').click( function( event ) {
				event.stopPropagation();
			});
			$(document).click( function(){
				$('#main-sidebar-content a').removeClass('active');
			});
		} wpex_mobile_toggle();
		
	}); // End doc ready
	
});