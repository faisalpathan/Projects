(function( $ ) {

	$.fn.customCheckbox = function() {

		return this.each(function() {

			// Get the original element
			var el = this;

			// Hide the checkbox
			$(this).hide();

			// Create replacement element
			var rep = $('<a href="#"><span></span></a>').addClass('cs-checkbox').insertAfter(this);

			// Set default state
			if($(this).is(':checked')) {
				$(rep).addClass('on');
			} else {
				$(rep).addClass('off');
			}

			// Click event
			$(rep).click(function(e) {

				e.preventDefault();

				if( $(el).is(':checked') ) {
					$(el).prop('checked', false);
					$(rep).removeClass('on').addClass('off');
				} else {
					$(el).prop('checked', true);
					$(rep).removeClass('off').addClass('on');
				}
			});
		});
	};

})( jQuery );

var CuteSlider = {

	uploadInput : null,
	dragContainer : null,
	dragIndex : 0,
	newIndex : 0,
	timeout : 0,
	counter : 0,

	selectMainTab : function(el) {

		// Remove highlight from the other tabs
		jQuery('#cs-main-nav-bar a').removeClass('active');

		// Highlight selected tab
		jQuery(el).addClass('active');

		// Hide other pages
		jQuery('#cs-pages .cs-page').removeClass('active');

		// Show selected page
		jQuery('#cs-pages .cs-page').eq( jQuery(el).index() ).addClass('active')
	},

	addLayer : function() {

		// Clone the sample layer page
		var clone = jQuery('#cs-sample-slide > div').clone();

		// Append to place
		clone.appendTo('#cs-layers');

		// Close other layers
		jQuery('#cs-layer-tabs a').removeClass('active');

		// Get layer index
		var index = clone.index();

		// Add layer tab
		var tab = jQuery('<a href="#">Slide #'+(index+1)+'<span class="ls-icon-layer-remove">x</span></a>').insertBefore('#cs-add-layer');

		// Open new layer
		tab.click();

		// Generate preview
		CuteSlider.generatePreview(index);
	},

	removeLayer : function(el) {

		if(confirm('Are you sure you want to remove this layer?')) {

			// Get menu item
			var item = jQuery(el).parent();

			// Get layer
			var layer = jQuery(el).closest('#cs-layer-tabs').next().children().eq( item.index() );

			// Open next or prev layer
			if(layer.next().length > 0) {
				item.next().click();

			} else if(layer.prev().length > 0) {
				item.prev().click();
			}

			// Remove menu item
			item.remove();

			// Remove the layer
			layer.remove();

			// Reindex layers
			CuteSlider.reindexLayers();
		}
	},

	selectLayer : function(el) {

		// Close other layers
		jQuery('#cs-layer-tabs a').removeClass('active');
		jQuery('#cs-layers .cs-layer-box').removeClass('active');

		// Open new layer
		jQuery(el).addClass('active');
		jQuery('#cs-layers .cs-layer-box').eq( jQuery(el).index() ).addClass('active');

		// Open first sublayer
		jQuery('#cs-layers .cs-layer-box').eq( jQuery(el).index() ).find('.cs-captions td:first').click();

		// Update preview
		CuteSlider.generatePreview( jQuery(el).index() );
	},

	duplicateLayer : function(el) {

		// Clone fix
		CuteSlider.cloneFix();

		// Get layer index
		var index = jQuery(el).closest('.cs-layer-box').index();

		// Append new tab
		jQuery('<a href="#">Slide #0<span>x</span></a>').insertBefore('#cs-layer-tabs a:last');

		// Rename tab
		CuteSlider.reindexLayers();

		// Clone layer
		var clone = jQuery(el).closest('.cs-layer-box').clone();

		// Append new layer
		clone.appendTo('#cs-layers');

		// Remove active class if any
		clone.removeClass('active');
	},

	addSublayer : function(el) {

		// Get clone from sample
		var clone = jQuery('#cs-sample-caption > tbody > tr').clone();

		// Appent to place
		clone.appendTo( jQuery(el).prev().find('.cs-captions') );

		// Get sublayer index
		var index = clone.index();

		// Rewrite sublayer number
		clone.find('.cs-caption-number').html( index + 1);
		clone.find('.cs-caption-title').val('Caption #' + (index + 1) );

		// Open it
		clone.click();
	},

	selectSubLayer : function(el) {

		if(jQuery(el).index() == jQuery(el).parent().children('.active:first').index() ) {
			return;
		}

		// Close other sublayers
		jQuery(el).parent().children().removeClass('active');

		// Open the new one
		jQuery(el).addClass('active');
	},

	selectSublayerPage : function(el) {

		// Close previous page
		jQuery(el).parent().children().removeClass('active');
		jQuery(el).parent().next().find('.cs-caption-page').removeClass('active');

		// Open the selected one
		jQuery(el).addClass('active');
		jQuery(el).parent().next().find('.cs-caption-page').eq( jQuery(el).index() ).addClass('active');
	},

	removeSublayer : function(el) {

		if(!confirm('Are you sure you want to remove this sublayer?')) {
			return;
		}

		// Get sublayer
		var sublayer = jQuery(el).closest('tr');

		// Get layer index
		var layer = jQuery(el).closest('.cs-layer-box');

		// Open the next or prev sublayer
		if(sublayer.next().length > 0) {
			sublayer.next().click();

		} else if(sublayer.prev().length > 0) {
			sublayer.prev().click();
		}

		// Remove menu item
		jQuery(el).remove();

		// Remove sublayer
		sublayer.remove();

		// Update preview
		CuteSlider.generatePreview( layer.index() );
	},


	duplicateSublayer : function(el) {

		// Clone fix
		CuteSlider.cloneFix();

		// Clone sublayer
		var clone = jQuery(el).closest('.cs-caption-wrapper').closest('tr').clone();

		// Remove active class
		clone.removeClass('active');

		// Append
		clone.appendTo( jQuery(el).closest('.cs-captions')  );

		// Rename sublayer
		clone.find('.cs-caption-title').val( clone.find('.cs-caption-title').val() + ' copy' );
		CuteSlider.reindexSublayers( jQuery(el).closest('.cs-layer-box') );

		// Update preview
		CuteSlider.generatePreview( jQuery(el).closest('.cs-layer-box').index() );
	},

	skipSublayer : function(el) {

		CuteSlider.generatePreview( jQuery(el).closest('.cs-layer-box').index()  );
	},


	setCallbackBoxesWidth : function() {
		jQuery('.cs-callback-box').width( (jQuery('.wrap').width() - 26) / 3 );
	},

	setTransitionBoxesWidth : function() {
		jQuery('.cs-transition-box').width( (jQuery('.cs-transitions-gallery .holder').width() - 30) / 3 );
	},

	willGeneratePreview : function(index) {
		clearTimeout(CuteSlider.timeout);
		CuteSlider.timeout = setTimeout(function() {

			if(index == -1) {
				jQuery('#cs-layers .cs-layer-box').each(function( index ) {
					CuteSlider.generatePreview(index);
				});
			} else {
				CuteSlider.generatePreview(index);
			}
		}, 1000);
	},

	checkUnit : function(str) {

		if(typeof str == "number") {
			return str + 'px';
		} else {
			return str;
		}
	},

	generatePreview : function(index) {

		// Get preview element
		var preview = jQuery('.cs-preview').eq( index + 1 );

		// Get the draggable element
		var draggable = preview.find('.draggable');

		// Get sizes
		var width = jQuery('.cs-settings input[name="width"]').val();
		var height = jQuery('.cs-settings input[name="height"]').val();

		// Set sizes
		preview.add(draggable).css({ width : width, height : height });
		preview.parent().css({ width : width });


		// Get layer background
		var background = jQuery('#cs-layers .cs-layer-box').eq(index).find('input[name="image"]').val();

		// Remove old background
		preview.find('.cs-slide-image').remove();

		if(background != '') {
			jQuery('<img>').attr('src', background).addClass('cs-slide-image').prependTo(preview);
		}

		// Empty draggable
		draggable.children().remove();

		// Iterate over the sublayers
		jQuery('#cs-layers .cs-layer-box').eq(index).find('.cs-captions > tr').each(function() {

			// Skip
			if(jQuery(this).find('input[name="skip"]').prop('checked')) {
				jQuery('<div>').appendTo(draggable);
				return true;
			}

			// Append the element
			var item = jQuery('<div>').appendTo(draggable);

			// Set HTML
			item.html( jQuery(this).find('textarea[name="html"]').val() );

			// Set custom styles
			item.attr('style', jQuery(this).find('textarea[name="style"]').val() );

			// Set dimensions
			item.width( CuteSlider.checkUnit(jQuery(this).find('input[name="width"]').val()) );
			item.height( CuteSlider.checkUnit(jQuery(this).find('input[name="height"]').val()) );

			// Set positions
			item.css('position', 'absolute');
			item.css({ zIndex : 10 + item.index() });
			item.css('top', CuteSlider.checkUnit(jQuery(this).find('input[name="top"]').val()) );
			item.css('left', CuteSlider.checkUnit(jQuery(this).find('input[name="left"]').val()) );

			// Set padding
			item.css('padding-top', CuteSlider.checkUnit(jQuery(this).find('input[name="padding_top"]').val()) );
			item.css('padding-right', CuteSlider.checkUnit(jQuery(this).find('input[name="padding_right"]').val()) );
			item.css('padding-bottom', CuteSlider.checkUnit(jQuery(this).find('input[name="padding_bottom"]').val()) );
			item.css('padding-left', CuteSlider.checkUnit(jQuery(this).find('input[name="padding_left"]').val()) );

			// Set border
			item.css('border-top', jQuery(this).find('input[name="border_top"]').val() );
			item.css('border-right', jQuery(this).find('input[name="border_right"]').val() );
			item.css('border-bottom', jQuery(this).find('input[name="border_bottom"]').val() );
			item.css('border-left', jQuery(this).find('input[name="border_left"]').val() );

			// Set font
			item.css('font-family', jQuery(this).find('input[name="font_family"]').val() );
			item.css('font-size', jQuery(this).find('input[name="font_size"]').val() );
			item.css('line-height', jQuery(this).find('input[name="line_height"]').val() );
			item.css('color', jQuery(this).find('input[name="color"]').val() );

			// Set misc
			item.css('background-color', jQuery(this).find('input[name="background"]').val() );

			// Add draggable
			CuteSlider.addDraggable();
		});
	},

	openMediaLibrary : function() {

		// New 3.5 media uploader
		if(newMediaUploader == true) {

			jQuery(document).on('click', '.cs-upload', function() {

				uploadInput = this;

				// Media Library params
				var frame = wp.media({
					title : 'Pick an image to use it in Cute Slider WP',
					multiple : false,
					library : { type : 'image'},
					button : { text : 'Insert' },
				});

				// Runs on select
				frame.on('select',function() {

					// Get the attachment details
					attachment = frame.state().get('selection').first().toJSON();

					// Set image URL
					jQuery(uploadInput).val( attachment['url'] );

					// Generate preview
					jQuery('#cs-layers .cs-layer-box').each(function( index ) {
						CuteSlider.generatePreview(index);
					});
				});

				// Open ML
				frame.open();
			});

		} else {

			// Bind upload button to show media uploader
			jQuery(document).on('click', '.cs-upload', function() {
				uploadInput = this;
				tb_show('Upload or select a new image to insert into Cute Slider WP', 'media-upload.php?type=image&amp;TB_iframe=true&width=650&height=400');
				return false;
			});
		}
	},

	insertUpload : function() {

		// Bind an event to image url insert
		window.send_to_editor = function(html) {

			// Get the image URL
			var img = jQuery('img',html).attr('src');

			// Set image URL
			jQuery(uploadInput).val( img );

			// Remove thickbox window
			tb_remove();

			// Generate preview
			jQuery('#cs-layers .cs-layer-box').each(function( index ) {
				CuteSlider.generatePreview(index);
			});
		};
	},

	addLayerSortables : function() {

		// Bind sortable function
		jQuery('#cs-layer-tabs').sortable({
			//axis : 'x',
			start : function() {
				CuteSlider.dragIndex = jQuery('.ui-sortable-placeholder').index() - 1;
			},
			change: function() {
				jQuery('.ui-sortable-helper').addClass('moving');
			},
			stop : function(event, ui) {

				// Get old index
				var oldIndex = CuteSlider.dragIndex;

				// Get new index
				var index = jQuery('.moving').index();

				if( index > -1 ){

					// Rearraange layer pages

					if(index == 0) {
						jQuery('#cs-layers .cs-layer-box').eq(oldIndex).prependTo('#cs-layers');
					}else{
						var layerObj = jQuery('#cs-layers .cs-layer-box').eq(oldIndex);
						jQuery('#cs-layers .cs-layer-box').eq(oldIndex).remove();

						layerObj.insertAfter('#cs-layers .cs-layer-box:eq('+(index-1)+')');
					}
				}

				jQuery('.moving').removeClass('moving');

				// Reindex layers
				CuteSlider.reindexLayers();
            },
            containment : 'parent',
			tolerance : 'pointer',
			items : 'a:not(.unsortable)'
        });
	},

	addDraggable : function() {
		jQuery('.draggable').children().draggable({
        	drag : function() {

        		CuteSlider.dragging();
        	},
        	stop : function() {

        		CuteSlider.dragging();
        	}
        });
	},

	dragging : function() {

		// Get positions
		var top = jQuery('.ui-draggable-dragging').position().top;
		var left = jQuery('.ui-draggable-dragging').position().left;

		// Get index
		var wrapper = jQuery('.ui-draggable-dragging').closest('.cs-layer-box');
		var index = jQuery('.ui-draggable-dragging').index();

		// Set positions
		wrapper.find('input[name="top"]').eq(index).val(top + 'px');
		wrapper.find('input[name="left"]').eq(index).val(left + 'px');
	},

	selectDragElement : function(el) {

		jQuery(el).closest('.cs-layer-box').find('.cs-captions > tr').eq( jQuery(el).index() ).click();
		jQuery(el).closest('.cs-layer-box').find('.cs-captions > tr').eq( jQuery(el).index() ).find('.cs-caption-nav a:eq(3)').click();
	},

	reindexSublayers : function(el) {

		jQuery(el).find('.cs-captions > tr').each(function(index) {

			// Reindex sublayer number
			jQuery(this).find('.cs-caption-number').html( index + 1 );

			// Reindex sublayer title if it is untoched
			if(
				jQuery(this).find('.cs-caption-title').val().indexOf('Sublayer') != -1 &&
				jQuery(this).find('.cs-caption-title').val().indexOf('copy') == -1
			) {
				jQuery(this).find('.cs-caption-title').val('Caption #' + (index + 1) );
			}
		});
	},

	reindexLayers : function() {
		jQuery('#cs-layer-tabs a:not(.unsortable)').each(function(index) {
			jQuery(this).html('Slide #' + (index + 1) + '<span>x</span>');
		});
	},

	buildTransitionList : function(type, obj) {

	},

	showPreview : function(el) {

		// Create preview
		var wrapper = jQuery('<div>').addClass('cs-transition-preview').prependTo('body');

		// Create iframe
		var iframe = jQuery('<iframe>').appendTo(wrapper);

		// Get transition
		var type = jQuery(el).attr('rel').split(',')[0];
		var tr = jQuery(el).attr('rel').split(',')[1];

		// Set iframe
		iframe.attr('src', '../index.php?page=cuteslider_preview&cstype='+type+'&cstr='+tr+'');

		// Get positions
		var e_top = jQuery(el).offset().top;
		var e_height = jQuery(el).height();
		var e_width = jQuery(el).width();
		var e_left = jQuery(el).offset().left;

		// Set positions
		wrapper.css({ top : (e_top - e_height - 160), left :  e_left - 155 + e_width / 2 });
	},

	removePreview : function() {
		jQuery('.cs-transition-preview').remove();
	},

	openTransitionGallery : function(type, obj) {

		if( !jQuery('#cs-hidden').length ){

			// Create hidden container
			jQuery('<div>').attr('id','cs-hidden').prependTo('body');

		}else{

			jQuery('#cs-hidden').html('');
		}

		// Create column wrapper
		jQuery('<div></div>').attr('id','cs-transitions-cols').appendTo(jQuery('#cs-hidden'));

		// Create text
		var helpText = jQuery('<p>').attr('id','cs-transition-text').appendTo(jQuery('#cs-transitions-cols'));
		helpText.text('Here can you preview all the available '+type.toUpperCase()+' transitions which can be used. With the "Add" button, you can select a transition which will be used on the current slide. To select multiple transitions, click each of the "Add" buttons of all selected transitions. In this case the slider will choose a random one from your selection. If you don\'t add any transition, CuteSlider WP will use a random one from all the available transitions.')

		// Create columns
		jQuery('<div class="cs-transitions-col1"></div><div class="cs-transitions-col2"></div><div class="cs-transitions-col3"></div><div class="clear"></div>').appendTo(jQuery('#cs-transitions-cols'));

		var counter = 0;

		for(c = 0; c < obj.length; c ++) {

			// Add box
			var box = jQuery('<div>').addClass('cs-transition-box cs-box block'+(c+1)+'').appendTo('#cs-hidden');

			// Add box title
			jQuery('<h3>').addClass('header').text(obj[c]['name']).appendTo(box);

			// Add inner
			var inner = jQuery('<ul></ul>').appendTo(box);

			// Iterate over the group members
			for(t = 0; t < obj[c]['trans'].length; t++) {

				// Increase counter
				counter++;

				// Create list item
				var item = jQuery('<li>').addClass('tr'+counter).appendTo(inner);

				// Add transistion link
				var transition = jQuery('<a>').addClass('transition').attr('href', '#').text(obj[c]['trans'][t]['name']).appendTo(item);
					transition.attr('rel', ''+type+','+counter+'');

				var index = jQuery('#cs-layers .active input[name='+type+'_transitions]').val().split(',').indexOf('tr'+counter);

				var displayAdd = index != -1 ? 'none' : 'inline';
				var displayRemove = index != -1 ? 'inline' : 'none';

				// Create "add" link
				jQuery('<a>').attr('href', '#').addClass('add').text('Add').css('display',displayAdd).click(function(e){

					e.preventDefault();
					CuteSlider.addTransition( jQuery(this), type );

				}).appendTo(item);

				// Create "remove" link
				jQuery('<a>').attr('href', '#').addClass('remove').text('Remove').css('display',displayRemove).click(function(e){

					e.preventDefault();
					CuteSlider.removeTransition( jQuery(this), type );

				}).appendTo(item);
			}
		}

		if( type == '3d' ){
			jQuery('.block1, .block6').appendTo('.cs-transitions-col1');
			jQuery('.block2, .block4').appendTo('.cs-transitions-col2');
			jQuery('.block3, .block5, .block7').appendTo('.cs-transitions-col3');
		}else{
			jQuery('.block1').appendTo('.cs-transitions-col1');
			jQuery('.block2').appendTo('.cs-transitions-col2');
			jQuery('.block3, .block4').appendTo('.cs-transitions-col3');
		}

		// Show Thickbox
		tb_show('Select '+type.toUpperCase()+' transitions for this slide', '#TB_inline?inlineId=cs-hidden&width=650&height=500');
	},

	addTransition : function(el,type) {

		var i = jQuery('#cs-layers .active input[name='+type+'_transitions]');
		el.css('display','none');
		el.parent().find('.remove').css('display','inline');
		if( i.val() == '' ){
			i.val( el.parent().attr('class') );
		}else{
			i.val( i.val()+','+el.parent().attr('class') );
		}
	},

	removeTransition : function(el,type) {

		var i = jQuery('#cs-layers .active input[name='+type+'_transitions]');
		el.css('display','none');
		el.parent().find('.add').css('display','inline');
		var list = i.val().split(',');
		var index = list.indexOf(el.parent().attr('class'));
		list.splice(index, 1);
		i.val( list.join(',') );
	},

	save : function(el) {

		// Temporary disable submit button
		jQuery('.cs-publish button').text('Saving ...').addClass('saving').attr('disabled', true);
		jQuery('.cs-saving-warning').text('Please do not navigate away from this page while CuteSlider WP saving your settings!');

		// Iterate over the settings
		jQuery('.cs-settings input, .cs-settings select').each(function() {

			// Save original name attr to element's data
			jQuery(this).data('name', jQuery(this).attr('name') );

			// Rewrite the name attr
			jQuery(this).attr('name', 'cuteslider-slides[properties]['+jQuery(this).attr('name')+']');
		});

		// Iterate over the layers
		jQuery('#cs-layers .cs-layer-box').each(function(layer) {

			// Iterate over layer settings
			jQuery(this).find('.cs-slide-options input, .cs-slide-options select').each(function() {

				// Save original name attr to element's data
				jQuery(this).data('name', jQuery(this).attr('name') );

				// Rewrite the name attr
				jQuery(this).attr('name', 'cuteslider-slides[layers]['+layer+'][properties]['+jQuery(this).attr('name')+']');

			});

			// Iterate over the sublayers
			jQuery(this).find('.cs-captions > tr').each(function(sublayer) {

				// Iterate over the sublayer properties
				jQuery(this).find('input, select, textarea').each(function() {

					// Save original name attr to element's data
					jQuery(this).data('name', jQuery(this).attr('name') );

					// Rewrite the name attr
					jQuery(this).attr('name', 'cuteslider-slides[layers]['+layer+'][sublayers]['+sublayer+']['+jQuery(this).attr('name')+']');
				});
			});
		});

		// Iterate over the callback functions
		jQuery('.cs-callback-page textarea').each(function() {

			// Save original name attr to element's data
			jQuery(this).data('name', jQuery(this).attr('name') );

			// Rewrite the name attr
			jQuery(this).attr('name', 'cuteslider-slides[properties]['+jQuery(this).attr('name')+']');
		});

		// Reset layer counter
		CuteSlider.counter = 0;

		setTimeout(function() {

			// Iterate over the layers
			jQuery('#cs-layers .cs-layer-box').each(function(layer) {

				// Reindex layerkey
				jQuery(this).find('input[name="layerkey"]').val(layer);

				// Data to send
				$data = jQuery('#cs-layers .cs-layer-box').eq(layer).find('input, textarea, select');
				$data = $data.add( jQuery('#cs-slider-form > input')  );
				$data = $data.add( jQuery('.cs-settings').find('input, textarea, select') );
				$data = $data.add( jQuery('.cs-callback-page textarea') );


				// Post layer
				jQuery.ajax(jQuery(el).attr('action'), {
					type : 'POST',
					data : $data.serialize(),
					async : false,
					success : function(id) {

						CuteSlider.counter += 1;

						if(jQuery('#cs-layers .cs-layer-box').length == CuteSlider.counter) {

							// Give feedback
							jQuery('.cs-publish button').text('Saved').removeClass('saving').addClass('saved');
							jQuery('.cs-saving-warning').text('');

							// Re-enable the button
							setTimeout(function() {
								jQuery('.cs-publish button').text('Save changes').attr('disabled', false).removeClass('saved');
							}, 2000);

							// Rewrote original name attr

								// Global settings
								jQuery('.cs-settings input, .cs-settings select').each(function() {
									jQuery(this).attr('name', jQuery(this).data('name'));
								});

								// Layers
								jQuery('#cs-layers .cs-layer-box').each(function(layer) {

									// Layer settings
									jQuery(this).find('.cs-slide-options input, .cs-slide-options select').each(function() {
										jQuery(this).attr('name', jQuery(this).data('name'));
									});

									// Sublayers
									jQuery(this).find('.cs-captions > tr').each(function(sublayer) {
										jQuery(this).find('input, select, textarea').each(function() {
											jQuery(this).attr('name', jQuery(this).data('name'));
										});
									});
								});

								// Iterate over the callback functions
								jQuery('.cs-callback-page textarea').each(function() {
									jQuery(this).attr('name', jQuery(this).data('name'));
								});

							// Redirect the edit page when adding new slider
							if(document.location.href.indexOf('cuteslider_add_new') != -1) {

								// Redirect
								document.location.href = 'admin.php?page=cuteslider&action=edit&id='+id+'';
							}
						}
					}
				});
			});
		}, 500);
	},

	cloneFix : function() {

		jQuery('textarea').each(function() {
			jQuery(this).text( jQuery(this).val() );
		});

		// Select clone fix
		jQuery('select').each(function() {

			// Get selected index
			var index = jQuery(this).find('option:selected').index();

			// Deselect old options
			jQuery(this).find('option').attr('selected', false);

			// Select the new one
			jQuery(this).find('option').eq( index ).attr('selected', true);
		});
	}
};

jQuery(document).ready(function() {

	// indexOf IE hack

	if (!Array.prototype.indexOf) {
		Array.prototype.indexOf = function(obj, start) {
		     for (var i = (start || 0), j = this.length; i < j; i++) {
		         if (this[i] === obj) { return i; }
		     }
		     return -1;
		}
	}

	// List view
	if(
		document.location.href.indexOf('page=cuteslider') != -1 &&
		document.location.href.indexOf('cuteslider_add_new') == -1 &&
		document.location.href.indexOf('action=edit') == -1 &&
		document.location.href.indexOf('cuteslider_skin_editor') == -1
	) {

		// Slider remove
		jQuery('.cs-slider-list a.remove').click(function(e) {
			e.preventDefault();
			if(confirm('Are you sure you want to remove this slider?')){
				document.location.href = jQuery(this).attr('href');
			}
		});

	// Skin editor
	} else if(document.location.href.indexOf('cuteslider_skin_editor') != -1) {

		// Select
		jQuery('select[name="skin"]').change(function() {
			document.location.href = 'admin.php?page=cuteslider_skin_editor&skin=' + jQuery(this).children(':selected').val();
		});

		// Editor tab
		jQuery('#editor').keydown(function(e) {

			// Get button keycode
			var keyCode = e.keyCode || e.which;

			// Tab only
			if (keyCode == 9) {

				e.preventDefault();
				var start = jQuery(this).get(0).selectionStart;
				var end = jQuery(this).get(0).selectionEnd;

				// set textarea value to: text before caret + tab + text after caret
				jQuery(this).val(jQuery(this).val().substring(0, start)
				+ "\t"
				+ jQuery(this).val().substring(end));

				// put caret at right position again
				jQuery(this).get(0).selectionStart =
				jQuery(this).get(0).selectionEnd = start + 1;
			}
		});

	// Editor view
	} else {

		// Main tab bar page select
		jQuery('#cs-main-nav-bar a:not(.unselectable)').click(function(e) {
			e.preventDefault();
			CuteSlider.selectMainTab( this );
		});

		// Generate preview if user resizes the browser
		jQuery(window).resize(function(){
			CuteSlider.willGeneratePreview( jQuery('.cs-box.active').index() );
		});

		// Support menu
		jQuery('#cs-main-nav-bar a.support').click(function(e) {
			e.preventDefault();
			jQuery('#contextual-help-link').click();
		});

		// Settings: checkboxes
		jQuery('.cs-settings :checkbox').customCheckbox();

		// Generate preview
		jQuery(window).load(function() {
			CuteSlider.generatePreview( jQuery('.cs-box.active').index() );
		});

		// Uploads
		CuteSlider.openMediaLibrary();
		CuteSlider.insertUpload();

		// Settings: width, height
		jQuery('.cs-settings').find('input[name="width"], input[name="height"]').keyup(function() {
			CuteSlider.willGeneratePreview( jQuery('.cs-box.active').index() );
		});

		// Settings: reset button
		jQuery(document).on('click', '.cs-reset', function() {

			// Empty field
			jQuery(this).prev().val('');

			// Generate preview
			CuteSlider.generatePreview( jQuery('.cs-box.active').index() );
		});

		// Add layer
		jQuery('#cs-add-layer').click(function(e) {
			e.preventDefault();
			CuteSlider.addLayer();
		});

		// Select layer
		jQuery('#cs-layer-tabs').on('click', 'a:not(.unsortable)', function(e) {
			e.preventDefault();
			CuteSlider.selectLayer(this);
		});

		// Duplicate layer
		jQuery(document).on('click', '.cs-layer-options-thead a.duplicate', function(e){
			e.preventDefault();
			CuteSlider.duplicateLayer(this);
		});

		// Add sublayer
		jQuery(document).on('click', '.cs-add-sublayer', function(e) {
			e.preventDefault();
			CuteSlider.addSublayer(this);
		});

		// Remove layer
		jQuery('#cs-layer-tabs').on('click', 'a span', function(e) {
			e.preventDefault();
			e.stopPropagation();
			CuteSlider.removeLayer(this);
		});

		// Select sublayer
		jQuery('#cs-layers').on('click', '.cs-captions tr', function() {
			CuteSlider.selectSubLayer(this);
		});


		// Sublayer pages
		jQuery('#cs-layers').on('click', '.cs-caption-nav a:not(:last-child)', function(e) {
			e.preventDefault();
			CuteSlider.selectSublayerPage(this);
		});

		// Remove sublayer
		jQuery('#cs-layers').on('click', '.cs-caption-nav a:last-child', function(e) {
			e.preventDefault();
			CuteSlider.removeSublayer(this);
		});

		// Duplicate sublayer
		jQuery('#cs-layers').on('click', '.cs-caption-options button.duplicate', function(e) {
			e.preventDefault();
			CuteSlider.duplicateSublayer(this);
		});

		// Sublayer params
		jQuery('#cs-layers').on('keyup', '.cs-captions input, .cs-captions textarea', function() {
			CuteSlider.willGeneratePreview( jQuery(this).closest('.cs-layer-box').index() );
		});

		// Sublayer params
		jQuery('#cs-layers').on('change', '.cs-captions select', function() {
			CuteSlider.willGeneratePreview( jQuery(this).closest('.cs-layer-box').index() );
		});

		// Sublayer: sortables, draggable, etc
		CuteSlider.addDraggable();
		CuteSlider.addLayerSortables();

		// Sublayer: skip
		jQuery('#cs-layers').on('click', '.cs-caption-options input[name="skip"]', function() {
			CuteSlider.skipSublayer(this);
		});

		// Preview drag element select
		jQuery('#cs-layers').on('click', '.draggable > *', function() {
			CuteSlider.selectDragElement(this);
		});

		// Save changes
		jQuery('#cs-slider-form').submit(function(e) {
			e.preventDefault();
			CuteSlider.save(this);
		});

		// Callback boxes
		CuteSlider.setCallbackBoxesWidth();
		jQuery(window).resize(function() {
			CuteSlider.setCallbackBoxesWidth();
		});

		// Open transition list
		jQuery('#cs-layers').on('click', '.cs-open-transition-gallery', function(e) {

			// Prevent the default submission of the browser
			e.preventDefault();

			// Create overlay
			if(jQuery(this).hasClass('3d')) {
				CuteSlider.openTransitionGallery('3d', transitions3d);
			} else {
				CuteSlider.openTransitionGallery('2d', transitions2d);
			}
		});

		// Transition preview
		jQuery(document).on('mouseenter', '.cs-transition-box a:not(.add):not(.remove)', function() {
			CuteSlider.showPreview(this);
		});

		// Transition preview remove
		jQuery(document).on('mouseleave', '.cs-transition-box a:not(.add):not(.remove)', function() {
			CuteSlider.removePreview();
		});

		// Prevent navigatin away when clicking a transition
		jQuery(document).on('click', '.cs-transition-box .transition', function(e) {
			e.preventDefault();
		});

	}

});