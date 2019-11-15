jQuery(function($) {
	
	'use strict';
	
	
	/**
	 * jQuery Tiny Pub/Sub
	 * https://github.com/cowboy/jquery-tiny-pubsub
	 *
	 * Copyright (c) 2013 "Cowboy" Ben Alman
	 * Licensed under the MIT license.
	 **********************************************************************/
	var o = $({});
	$.subscribe = function() {o.on.apply(o, arguments);};
	$.unsubscribe = function() {o.off.apply(o, arguments);};
	$.publish = function() {o.trigger.apply(o, arguments);};
	
	/**
	 * Save the main building block of DOM elements; for the 
	 * sake of succinctness
	 **********************************************************************/
	var DOM = (function ( dom ) {
		
		var dom = dom || {};
		
		dom.body = $('body:eq(0)');
		
		
		return dom;
		
	}( DOM ) );
	
	/**
	 * Simple cookie utilities
	 **********************************************************************/
	var COOKIES = (function ( cookies ) {
		
		var cookies = cookies || {};
		
		cookies.setItem = function ( name, value, durationInDays ) {
			var d = new Date();
			d.setTime( d.getTime() + ( durationInDays * 24 * 60 * 60 * 1000 ) );
			var expires = 'expires=' + d.toUTCString();
			document.cookie = name + '=' + value + ';' + expires + ';path=/';
		};
		
		cookies.getItem = function ( name ) {
			var name = name + '=',
				decodedCookie = decodeURIComponent( document.cookie ),
				ca = decodedCookie.split(';');
				
			for ( var i = 0; i < ca.length; i++ ) {
				
				var c = ca[ i ];
				
				while ( c.charAt( 0 ) == ' ' ) {
					c = c.substring(1);
				}
				
				if ( c.indexOf( name ) == 0 ) {
					return c.substring( name.length, c.length );
				}
			}
			return null;
		}
		
		cookies.deleteItem = function ( name ) {
			document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
		};
		
		return cookies;
		
	}( COOKIES ) );
	
	/**
	* We need to trigger WhatsApp application if it exists. Fall back to
	* web if it doesn't.
	**********************************************************************/
	(function () {
		
		
		
	}());
	
	/**
	* Centralize the process of hide/show of the box.
	**********************************************************************/
	(function () {
		
		$.subscribe('wptwa-widget-ready', function () {
			var wptwa = DOM.body.find( '.wptwa-container' ),
				box = wptwa.find( '.wptwa-box' ),
				toggleBox = function ( e ) {
					box.toggleClass( 'show' );
					if ( ! COOKIES.getItem( 'wptwa' ) ) {
						COOKIES.setItem( 'wptwa', 'toggled', 1 );
					}
				};
			
			$.subscribe('wptwa-toggle-box', toggleBox);
		});
		
	}());
	
	/**
	* Show and hide the box.
	**********************************************************************/
	(function () {
		
		$.subscribe('wptwa-widget-ready', function () {
			
			var wptwaFlag = DOM.body.find( '.wptwa-flag' ),
				wptwa = DOM.body.find( '.wptwa-container' ),
				delayTime = parseInt( wptwa.data( 'delay-time' ) ),
				inactiveTime = parseInt( wptwa.data( 'inactive-time' ) ),
				scrollLength = parseInt( wptwa.data( 'scroll-length' ) ),
				autoDisplayOnMobile = wptwa.data( 'auto-display-on-mobile' ),
				box = wptwa.find( '.wptwa-box' ),
				handler = wptwa.find( '.wptwa-handler' ),
				close = wptwa.find( '.wptwa-close' ),
				autoShow
				;
			
			if ( ! wptwa.length || ! wptwaFlag.length ) {
				return;
			}
			
			/* Toggle box on handler's (or close's) click */
			handler.add( close ).on( 'click', function () {
				$.publish('wptwa-toggle-box');
			} );
			
			/* Check if we should also use auto display on mobile. */
			if ( 'on' !== autoDisplayOnMobile && window.getComputedStyle( wptwaFlag.get(0), ':after' ).content == '"mobile"' ) {
				return;
			}
			
			/* 	Show box after a delay time on page load and only if it has 
				not been shown before.
				*/
			if ( delayTime > 0 ) {
				autoShow = setTimeout( function () {
					if ( ! box.is( '.show' ) && ! COOKIES.getItem( 'wptwa' ) ) {
						$.publish('wptwa-toggle-box');
					}
				}, delayTime * 1000 );
			}
			
			/* 	Trigger after inactivity and only if it has not been shown 
				before.
				*/
			var cb,
				executed = false,
				events = 'mousemove mousedown mouseup onkeydown onkeyup focus scroll',
				showAfterInactivity = function () {
					clearTimeout( cb );
					if ( ! executed ) {
						cb = setTimeout(function () {
							if ( ! COOKIES.getItem( 'wptwa' ) && ! box.is( '.show' ) ) {
								$.publish('wptwa-toggle-box');
							}
							$( document ).off( events, showAfterInactivity );
						}, inactiveTime * 1000 );
					}
				};
			
			if ( inactiveTime > 0 ) {
				$( document ).on( events, showAfterInactivity );
			}
			
			/* 	Trigger after scrolling.
				Accessing DOM on-scroll is a bad idea. Let's execute the function 
				every half a second during/post scroll instead.
				*/
			var percentage = Math.abs( scrollLength ) / 100,
				scrolling,
				timing = true,
				scrollHandler = function() {
					
					scrolling = true;
					
					if ( timing ) {
						
						setTimeout(function () {
							if ( $( window ).scrollTop() >= ( $( document ).height() - $( window ).height() ) * percentage ){
								if ( ! COOKIES.getItem( 'wptwa' ) && ! box.is( '.show' ) ) {
									$.publish('wptwa-toggle-box');
								}
								$( window ).off( 'scroll', scrollHandler );
							}
							timing = true;
							scrolling = false;
						}, 500 );
						
						if ( scrolling ) {
							timing = false;
						}
					}
				}
				;
			
			if ( scrollLength > 0 ) {
				$( window ).on( 'scroll', scrollHandler );
			}
		});
		
	}());
	
	/**
	* If avatar is not provided or provided but error, add a hint to 
	* .wptwa-face so we can show a default image.
	**********************************************************************/
	(function () {
		
		$.subscribe('wptwa-widget-ready', function () {
			DOM.body.find( '.wptwa-container .wptwa-face' ).each(function () {
				var el = $( this ),
					img = el.find( 'img' ),
					noImage = true
					;
				
				if ( img.length ) {
					var url = img.attr( 'src' ),
						tester = new Image();
					tester.src = url;
					
					tester.onerror = function () {
						el.addClass( 'no-image' );
					};
					
				}
				else {
					el.addClass( 'no-image' );
				}
				
			});
		});
		
	}());
	
	/**
	* If we're on desktop, use web.whatsapp.com instead. But if not,
	* remove the target attribute because it will simply open the app.
	**********************************************************************/
	(function () {
		
		var alterURL = function () {
			var wptwaAccounts = DOM.body.find( '.wptwa-account' ),
				wptwaFlag = DOM.body.find( '.wptwa-flag' )
				;
			
			if ( ! wptwaFlag.length ) {
				return;
			}
			
			/* Change URL to web.whatsapp.com if the user is using a desktop. */
			if ( window.getComputedStyle( wptwaFlag.get(0), ':after' ).content == '"desktop"' || window.getComputedStyle( wptwaFlag.get(0), ':after' ).content == 'desktop' ) {
				
				wptwaAccounts.each(function () {
					var el = $( this ),
						number = el.data( 'number' ),
						text = el.data( 'auto-text' )
						;
					
					if ( '' === number ) {
						return true;
					}
					el.attr( 'href', 'https://web.whatsapp.com/send?phone=' + number + '&text=' + text );
				});
				
			}
		};
		
		alterURL();
		$.subscribe('wptwa-widget-ready', function () {
			alterURL();
		});
		
	}());
	
	/**
	* Get widget via AJAX
	**********************************************************************/
	(function () {
		
		var data = {
			'action': 'display_widget',
			'when': Date.now()
		};
	
		$.post( ajax_object.ajax_url, data, function( response ) {
			if ( 'no-show' === response ) {
				return;
			}
			
			$( response ).appendTo( DOM.body );
			setTimeout( function () {
				$.publish('wptwa-widget-ready');
			}, 100 );
		});
		
	}());
	
	/**
	* 
	**********************************************************************/
	(function () {
		
		
		
	}());
	
});