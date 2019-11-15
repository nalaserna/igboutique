jQuery(function($) {
	
	'use strict';
	
	/**
	 * Save the main building block of DOM elements; for the 
	 * sake of succinctness
	 **********************************************************************/
	var DOM = (function ( dom ) {
		
		var dom = dom || {};
		
		dom.body = $( 'body:eq(0)' );
		
		return dom;
		
	} ( DOM ) );
	
	/**
	* I use MiniColor library for the color picker. It should be use on 
	* all inputs with a .minicolors class name.
	**********************************************************************/
	(function () {
		
		if( $.minicolors ) {
			DOM.body.find( '.minicolors' ).minicolors({
				opacity: true,
				format: 'rgb'
			});
		}
		
	}());
	
	/**
	* 
	**********************************************************************/
	(function () {
		
		var handleMediaPicker = function () {
			
			DOM.body.find( '.media-picker' ).each(function () {
				var el = $( this ),
					container,
					button,
					buttonText = el.data( 'button-text' ),
					preview
					;
				
				el.wrap( '<div class="wptwa-picker-container"></div>' );
				container = el.parents( '.wptwa-picker-container' );
				if ( ! container.find( '.wptwa-clicker' ).length ) {
					container.append( '<span class="wptwa-clicker">' + buttonText + '</span>' );
					container.append( '<div class="wptwa-picker-preview"></div>' );
				}
				button = container.find( 'span.wptwa-clicker' );
				preview = container.find( '.wptwa-picker-preview' );
				
				el.css({
					paddingRight: Math.ceil( parseInt( button.outerWidth() ) ) + 3
				});
				
				container.off().on( 'click', '.wptwa-close-preview', function () {
					el.val( '' );
					preview.html( '' );
				} );
				
				if ( '' !== el.val() ) {
					preview.addClass( 'show' ).html( '<span class="wptwa-image-container"><img src="' + el.val() + '" /><span class="wptwa-close-preview"></span></span>' );
				}
				
			});
		};
		
		handleMediaPicker();
		
		/* When the button is clicked, open the media library */
		DOM.body.on( 'click', '.wptwa-picker-container .wptwa-clicker', function ( e ) {
			e.preventDefault();
			
			var el = $( this ),
				inputField = el.prev( 'input' ),
				preview = el.next( '.wptwa-picker-preview' ),
				insertImage = wp.media.controller.Library.extend({
					defaults :  _.defaults({
							id: 'insert-image',
							title: 'Insert Image Url',
							allowLocalEdits: true,
							displaySettings: true,
							displayUserSettings: true,
							multiple : true,
							type : 'image' /* audio, video, application/pdf, ... etc */
					  }, wp.media.controller.Library.prototype.defaults)
				});
			
			/* Setup media frame */
			var frame = wp.media({
				button : { text : 'Select' },
				state : 'insert-image',
				states : [
					new insertImage()
				]
			});
			
			frame.on('select',function() {
				
				var state = frame.state('insert-image')
					, selection = state.get('selection')
					;
				
				if (!selection) {
					return;
				}
				var imgSrc = ''
					, attachmentIds = []
					, isImage = true;
					;
				selection.each(function(attachment) {
					var display = state.display(attachment).toJSON()
						, obj_attachment = attachment.toJSON()
						;
					
					display = wp.media.string.props(display, obj_attachment);
					imgSrc = display['src'] || display['linkUrl'];
					
					if ( ! display['src'] ) {
						isImage = false;
					}
					
					/* What is being returned? */
					attachmentIds.push(attachment.id);
				});
				
				inputField.val( imgSrc );
				
				/* 	If the selected file is an image, set the value into an <img> and 
					show the preview. Otherwise, hide the preview. */
				if ( isImage ) {
					preview.addClass('show').html( '<span class="wptwa-image-container"><img src="' + imgSrc + '" /><span class="wptwa-close-preview"></span></span>' );
				}
				else {
					preview.removeClass('show').html( '' );
				}
				
			});

			/* reset selection in popup, when open the popup */
			frame.on('open',function() {
				var selection = frame.state('insert-image').get('selection');
				
				/* remove all the selection first */
				selection.each(function(image) {
					var attachment = wp.media.attachment( image.attributes.id );
					attachment.fetch();
					selection.remove(attachment ? [attachment] : []);
				});				
			});

			/* now open the popup */
			frame.open();
			
		} );
		
		/*	Add new contact. */
		var template = DOM.body.find( 'template#account-item' ).html(),
			currentId = parseInt( DOM.body.find( '.wptwa-account-item' ).length ),
			accountContainer = DOM.body.find( '.wptwa-account-items' )
			;
		
		DOM.body.find( '.wptwa-add-account' ).on( 'click', function (e) {
			e.preventDefault();
			accountContainer.append( template.replace( /#id#/g, ++currentId ) );
			//$( this ).parents( '.form-table' ).before( template.replace( /#id#/g, ++currentId ) );
			handleMediaPicker();
		} );
		
		/*	Remove contact. */
		DOM.body.on( 'click', '.wptwa-remove-account', function (e) {
			e.preventDefault();
			$( this ).parents( '.wptwa-account-item' ).remove();
		} );
		
	}());
	
	/**
	* Search posts to exclude
	**********************************************************************/
	(function () {
		
		DOM.body.find( '.wptwa-search-posts input' ).on( 'keydown keyup focus blur', function ( e ) {
			
			var el = $( this )
				, parent = el.parents( 'td' )
				, searchContainer = parent.find( '.wptwa-search-posts' )
				, searchList = searchContainer.find( 'ul' )
				, searchInput = searchContainer.find( 'input' )
				, nonce = searchInput.data( 'nonce' )
				, searching
				, xhr = false
				;
			
			/* Do nothing when Enter key is pressed */
			if( e.keyCode == 13 ) {
				e.preventDefault();
			}
			
			if ( e.type === 'focus' ) {
				searchList.addClass( 'wptwa-show' );
				return true;
			}
			
			if ( e.type === 'blur' ) {
				searchList.removeClass( 'wptwa-show' );
				return true;
			}
			
			if ( e.type === 'keyup' ) {
				
				clearTimeout( searching );
				if ( xhr ) {
					xhr.abort();
					searchContainer.removeClass( 'wptwa-show-loader' );
				}
				
				searching = setTimeout( function () {
					var data = {
						action: 'search_posts',
						security: nonce,
						title: el.val()
					};
					
					if ( '' === data.title ) {
						searchList.removeClass( 'wptwa-show' ).html( '' );
						return;
					}
					
					searchContainer.addClass( 'wptwa-show-loader' );
					xhr = $.post( ajaxurl, data, function( response ) {
						
						if ( 'no-result' !== response ) {
							searchList.addClass( 'wptwa-show' ).html( response );
						}
						else {
							searchList.removeClass( 'wptwa-show' ).html( '' );
						}
						
						searchContainer.removeClass( 'wptwa-show-loader' );
						
					} );
					
				}, 250 );
				
			}
			
		} );
		
		DOM.body.find( '.wptwa-search-posts ul' ).on( 'click', 'li', function () {
			
			var el = $( this )
				, inclusion = el.parents( 'td' ).find( '.wptwa-inclusion' )
				, id = el.data( 'id' )
				, permalink = el.find( '.wptwa-permalink' ).text()
				, title = el.find( '.wptwa-title' ).text()
				, deleteLabel = inclusion.data( 'delete-label' )
				, arrayName = inclusion.is( '.wptwa-included-posts' ) ? 'included' : 'excluded'
				;
			
			$(  '<li id="wptwa-excluded-' + id + '">' +
					'<p class="wptwa-title">' + title + '</p> ' +
					'<p class="wptwa-permalink"><a href="' + permalink + '" target="_blank">' + permalink + '</a></p> ' +
					'<span class="dashicons dashicons-no"></span>' +
					'<input type="hidden" name="' + arrayName + '[]" value="' + id + '"/>' +
				'</li>' ).appendTo( inclusion );
			
		} );
		
		DOM.body.find( '.wptwa-inclusion' ).on( 'click', '.dashicons', function () {
			$( this ).parent( 'li' ).remove();
		} );
		
	}());
	
	/**
	* Move an account up or down
	**********************************************************************/
	(function () {
		
		DOM.body.on( 'click', '.wptwa-queue-buttons span', function () {
			
			var el = $( this ),
				direction = el.is( '.wptwa-move-up' ) ? 'up' : 'down',
				table = el.parents( 'table' )
				;
			
			if ( el.is( '.wptwa-move-up' ) ) {
				table.insertBefore( table.prev( 'table' ) );
			}
			else {
				table.insertAfter( table.next( 'table' ) );
			}
			
		} );
		
	}());
	
	/**
	* Executed on 'product' post type.
	**********************************************************************/
	(function () {
		
		var cbRemoveButton = DOM.body.find( 'input#wptwa_remove_button' ),
			settingsTable = DOM.body.find( '#wptwa-custom-wc-button-settings' ),
			toggleSettings = function () {
				if ( cbRemoveButton.is( ':checked' ) ) {
					settingsTable.hide();
				}
				else {
					settingsTable.show();
				}
			}
			;
			
		toggleSettings();
		
		cbRemoveButton.change(function () {
			toggleSettings();
		});
		
	}());
	
	/**
	* 
	**********************************************************************/
	(function () {
		
		
		
	}());
	
});
