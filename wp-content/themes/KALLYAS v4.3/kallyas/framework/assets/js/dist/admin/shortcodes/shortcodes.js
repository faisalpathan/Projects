(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
module.exports = function(obj){
var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};
with(obj||{}){
__p+='<div class="znhgtfw-modal-wrapper">\r\n\t<div class="znhgtfw-modal-header">\r\n\t\t<div class="znhgtfw-modal-title">\r\n\t\t\tShortcodes\r\n\t\t</div>\r\n\t\t<button type="button" class="button-link media-modal-close">\r\n\t\t\t<span class="media-modal-icon">\r\n\t\t\t\t<span class="screen-reader-text">Close media panel</span>\r\n\t\t\t</span>\r\n\t\t</button>\r\n\t</div>\r\n\t<div class="znhgtfw-modal-content-wrapper">\r\n\t\t<div class="znhgtfw-modal-sidebar"></div>\r\n\t\t<div class="znhgtfw-modal-content">\r\n\t\t\t<div class="znhgtfw-shortcode-mngr-nothing-selected">\r\n\t\t\t\t<p>Choose a shortcode from the sidebar to get started.</p>\r\n\t\t\t</div>\r\n\t\t</div>\r\n\t</div>\r\n\t<div class="znhgtfw-modal-footer">\r\n\t\t<div class="znhgtfw-footer-nav">\r\n\t\t\t<a href="#" class="znhgtfw-button znhg-shortcode-insert">Insert shortcode</a>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div class="znhgtfw-modal-backdrop"></div>';
}
return __p;
};

},{}],2:[function(require,module,exports){
module.exports = Backbone.Model.extend({
	defaults : {
		id : 'shortcode-tag',
		name : 'Shortcode Name',
		section : 'Section',
		description : 'Shortcode description',
		params : [],
	},
	setSelected:function() {
		this.collection.setSelected(this);
	}
});
},{}],3:[function(require,module,exports){
var ShortcodesCollection = Backbone.Collection.extend({
	model: require('./shortcodeModel'),
	initialize: function() {
		this.selected = null;
	},
	bySection : function(sectionName){
		filtered = this.filter(function ( shortcode ) {
			return shortcode.get('section') === sectionName;
		});
		return new ShortcodesCollection(filtered);
	},
	setSelected: function( shortcode ) {
		if (this.selected) {
			this.selected.set({selected:false});
		}
		shortcode.set({selected:true});
		this.selected = shortcode;
		this.trigger('shortcodeSelected', shortcode);
	},
	getSelected : function(){
		return this.selected;
	}
});

module.exports = ShortcodesCollection;
},{"./shortcodeModel":2}],4:[function(require,module,exports){
window.znhg = window.znhg || {};

znhgShortcodesManagerData = {};
znhgShortcodesManagerData.sections = [
	'Typography',
	'Layout',
	'Content',
	'Marketing'
];

znhgShortcodesManagerData.shortcodes = [
	{
		id : 'subtitle',
		name : 'Subtitle',
		section : 'Typography',
		hasContent: true,
		params : [
			{
				name : 'Subtitle',
				description : 'Enter the subtitle text',
				type : 'text',
				id : 'content'
			}
		],
	},
	{
		id : 'znhg_alternative_header',
		name : 'Alternative heading',
		section : 'Typography',
		hasContent: true,
		params : [
			{
				name : 'Heading type',
				id : 'heading_type',
				description : 'Choose what alternative heading type you want to use',
				type : 'select',
				value : 'h1',
				options: {
					'h1' : 'H1',
					'h2' : 'H2',
					'h3' : 'H3',
					'h4' : 'H4',
					'h5' : 'H5',
					'h6' : 'H6',
				}
			},
			{
				name : 'Heading text',
				id : 'content',
				description : 'Please enter the heading text you want to use',
				type : 'text',
				placeholder: 'heading text'
			},
		],
	},
	{
		id : 'blockquote',
		name : 'Blockquote',
		section : 'Typography',
		hasContent: true,
		params : [
			{
				name : 'Author',
				id : 'author',
				description : 'Enter the quote author name.',
				type : 'text',
				placeholder: 'John Doe'
			},
			{
				name : 'Quote',
				id : 'content',
				description : 'Enter the quote.',
				type : 'textarea',
			},
			{
				name : 'Alignment',
				id : 'align',
				description : 'Choose the quote alignment',
				type : 'select',
				value : 'left',
				options: {
					'left' : 'Left',
					'right' : 'Right'
				}
			},
		],
	},
	{
		id : 'code',
		name : 'Code',
		section : 'Typography',
		hasContent: true,
		params : [
			{
				name : 'Code content',
				id : 'content',
				description : 'Enter the desired code you want to display.',
				type : 'textarea',
			},
		],
	},
	{
		id : 'tooltip',
		name : 'Tooltip',
		section : 'Content',
		hasContent: true,
		params : [
			{
				name : 'Tooltip content',
				id : 'content',
				description : 'Enter the desired tooltip anchor text.',
				type : 'textarea',
			},
			{
				name : 'Tooltip title',
				id : 'title',
				description : 'Enter the desired tooltip content.',
				type : 'text',
			},
			{
				name : 'Tooltip placement',
				id : 'placement',
				description : 'Choose the desired tooltip placement.',
				type : 'select',
				value : 'top',
				options: {
					'top' : 'Top',
					'right' : 'Right',
					'bottom' : 'Bottom',
					'left' : 'Left'
				}
			},
			{
				name : 'Use border ?',
				id : 'border',
				description : 'Choose yes if you want to add a border around the tooltip.',
				type : 'select',
				value : 'yes',
				options: {
					'yes' : 'Yes',
					'no' : 'No'
				}
			},
		],
	},
	{
		id : 'row',
		name : 'Row',
		section : 'Layout',
		hasContent: true,
		params : [
			{
				name : 'css class',
				id : 'css_class',
				description : 'Enter the desired css class name that will be applied to this row.',
				type : 'text',
			},
		],
	},
	{
		id : 'znhg_column',
		name : 'Column',
		section : 'Layout',
		hasContent: true,
		params : [
			{
				name : 'Column size',
				id : 'size',
				description : 'Choose the desired column size.',
				type : 'select',
				value : 'col-sm-6',
				options: {
					'col-sm-6' : '1/2',
					'col-sm-4' : '1/3',
					'col-sm-3' : '1/4',
					'col-sm-8' : '2/3',
					'col-sm-9' : '3/4',
				}
			},
			{
				name : 'css class',
				id : 'css_class',
				description : 'Enter the desired css class name that will be applied to this row.',
				type : 'text',
			},
		],
	},
	{
		id : 'list',
		name : 'List',
		section : 'Content',
		hasContent: true,
		defaultContent: '<ul><li>First list item</li><li>Second list item</li></ul>',
		params : [
			{
				name : 'List style',
				id : 'type',
				description : 'Choose the desired list style you want to use.',
				type : 'select',
				value : 'list-style1',
				options: {
					'list-style1' : 'Arrow list',
					'list-style2' : 'Check list',
				}
			}
		]
	},
	{
		id : 'table',
		name : 'Table',
		section : 'Content',
		hasContent: true,
		defaultContent: '<table><thead><tr><th>#</th><th>First Name</th></tr></thead><tbody><tr><td>1</td><td>Mark</td></tr><tr><td>2</td><td>Jacob</td></tr><tr><td>3</td><td>Larry</td></tr></tbody></table>',
		params : [
			{
				name : 'Style',
				id : 'type',
				description : 'Choose the desired style you want to use.',
				type : 'select',
				value : 'table-striped',
				options: {
					'table-striped': 'Striped',
					'table-bordered': 'Bordered',
					'table-hover': 'Hover',
					'table-condensed': 'Condensed',
				}
			}
		]
	},
	{
		id : 'znhg_qr',
		name : 'Qr Code',
		section : 'Marketing',
		params : [
			{
				name : 'QR code URL',
				id : 'url',
				description : 'Enter the QR code url generated from <a target="_blank" href="http://goqr.me/">QR code generator</a>.',
				type : 'text',
				placeholder : 'QR code URL',
			},
			{
				name : 'Alignment',
				id : 'align',
				description : 'Choose the desired alignment.',
				type : 'select',
				value : 'right',
				options: {
					'right': 'Right',
					'left': 'Left',
				}
			},
		]
	},
	{
		id : 'button',
		name : 'Button',
		section : 'Content',
		hasContent: true,
		params : [
			{
				name : 'Style',
				id : 'style',
				description : 'Select the desired style you want to use for this button.',
				type : 'select',
				value : '',
				options: {
					'': 'Default',
					'btn-primary': 'Primary',
					'btn-info': 'Info',
					'btn-success': 'Success',
					'btn-warning': 'Warning',
					'btn-danger': 'Danger',
					'btn-inverse': 'Inverse',
				}
			},
			{
				name : 'Button content',
				id : 'content',
				description : 'Enter the desired button content text.',
				type : 'text',
				placeholder : 'Content',
			},
			{
				name : 'URL',
				id : 'url',
				description : 'Enter the desired button URL',
				type : 'text',
				placeholder : 'URL',
			},
			{
				name : 'Target',
				id : 'target',
				description : 'Select the desired target for this button.',
				type : 'select',
				value : '_self',
				options: {
					'_self': 'Self',
					'_blank': 'Blank',
				}
			},
			{
				name : 'Size',
				id : 'size',
				description : 'Select the desired size for this button.',
				type : 'select',
				value : '',
				options: {
					'': 'Default',
					'btn-lg': 'Large',
					'btn-md': 'Medium',
					'btn-sm': 'Small',
					'btn-xs': 'Extra small',
				}
			},
			{
				name : 'Block ?',
				id : 'block',
				description : 'Select if you want to display the button as block or not.',
				type : 'select',
				value : '',
				options: {
					'': 'Normal',
					'btn-block': 'Block',
				}
			},
		],
	},
	{
		id : 'accordion',
		name : 'Accordion',
		section : 'Content',
		params : [
			{
				name : 'Accordion title',
				id : 'title',
				description : 'Enter the desired title for this accordion.',
				type : 'text',
				placeholder : 'accordion title',
			},
			{
				name : 'Accordion content',
				id : 'content',
				description : 'Enter the desired content for this accordion.',
				type : 'textarea',
				placeholder : 'accordion content',
			},
			{
				name : 'Style',
				id : 'style',
				description : 'Choose the desired style.',
				type : 'select',
				value : 'default-style',
				options: {
					'default-style': 'Default style',
					'style2': 'Style 2',
					'style3': 'Style 3',
				}
			},
			{
				name : 'Collapsed ?',
				id : 'collapsed',
				description : 'Choose the initial state of the accordion pane.',
				type : 'select',
				value : 'false',
				options: {
					'false': 'Closed',
					'true': 'Open',
				}
			},
		]
	},
	{
		id : 'tabs',
		name : 'Tabs container',
		section : 'Content',
		hasContent : true,
		params : [
			{
				name : 'Style',
				id : 'style',
				description : 'Choose the desired style.',
				type : 'select',
				value : 'style1',
				options: {
					'style1': 'Style 1',
					'style2': 'Style 2',
					'style3': 'Style 3',
					'style4': 'Style 4',
				}
			},
		]
	},
	{
		id : 'tab',
		name : 'Single tab',
		section : 'Content',
		params : [
			{
				name : 'Tab title',
				id : 'title',
				description : 'Enter the desired tab title',
				type : 'text',
				placeholder : 'title'
			},
			{
				name : 'Tab content',
				id : 'content',
				description : 'Enter the desired tab content',
				type : 'textarea',
				placeholder : 'tab content'
			},
		]
	},
	{
		id : 'skills',
		name : 'Skills container',
		section : 'Content',
		hasContent : true,
		params : [
			{
				name : 'Main text',
				id : 'main_text',
				description : 'Enter the main text that will appear in the center of the skill bars.',
				type : 'text',
				placeholder : 'skills main text',
			},
			{
				name : 'Main color',
				id : 'main_color',
				description : 'Choose the main color you want to use.',
				type : 'colorpicker',
				value : '#193340',
			},
			{
				name : 'Text color',
				id : 'text_color',
				description : 'Choose the text color you want to use.',
				type : 'colorpicker',
				value : '#ffffff',
			},
		]
	},
	{
		id : 'skill',
		name : 'Single skill',
		section : 'Content',
		hasContent : true,
		params : [
			{
				name : 'Skill title',
				id : 'content',
				description : 'Enter the desired skill title',
				type : 'text',
				placeholder : 'My awesome skill'
			},
			{
				name : 'Main color',
				id : 'main_color',
				description : 'Choose the main color you want to use.',
				type : 'colorpicker',
				value : '#193340',
			},
			{
				name : 'Skill percentage',
				id : 'percentage',
				description : 'Enter the skill percentage value.',
				type : 'text',
				value : '',
				placeholder : '90',
			},
		]
	},
	{
		id : 'pricing_table',
		name : 'Pricing table container',
		section : 'Marketing',
		hasContent : true,
		params : [
			{
				name : 'Color',
				id : 'color',
				description : 'Choose the desired pricing table color.',
				type : 'select',
				value : 'red',
				options: {
					'red': 'Red',
					'blue': 'Blue',
					'green': 'Style 3',
					'turquoise': 'Turquoise',
					'orange': 'Orange',
					'purple': 'Purple',
					'yellow': 'Yellow',
					'green_lemon': 'Green lemon',
					'dark': 'Dark',
					'light': 'Light',
				}
			},
			{
				name : 'Columns',
				id : 'columns',
				description : 'Choose how many columns you want to use for this table.',
				type : 'select',
				value : '4',
				options: {
					'1': '1 Column',
					'2': '2 Columns',
					'3': '3 Columns',
					'4': '4 Columns',
					'6': '6 Columns',
				}
			},
			{
				name : 'Use rounded corners ?',
				id : 'rounded',
				description : 'Choose if you want to use rounded corners or not.',
				type : 'select',
				value : 'no',
				options: {
					'no': 'No',
					'yes': 'Yes',
				}
			},
		]
	},
	{
		id : 'pricing_caption',
		name : 'Pricing table caption',
		section : 'Marketing',
		hasContent : true,
		defaultContent: '<ul><li>First list item</li><li>Second list item</li></ul>',
		params : [
			{
				name : 'Name',
				id : 'name',
				description : 'Enter the desired pricing caption name',
				type : 'text',
				placeholder : 'column name',
			},
		]
	},
];

(function ($) {
	var App = function(){},
		ModalView = require('./views/modal'),
		ShortcodesCollection = require('./models/shortcodesCollection');

	/**
	 * Starts the main shortcode manager class
	 */
	App.prototype.start = function(){
		// Bind the click event
		$(document).on('click', '#znhgtfw-shortcode-modal-open', function(e){
			e.preventDefault();
			this.openModal();
		}.bind(this));

		this.shortcodesCollection = new ShortcodesCollection(znhgShortcodesManagerData.shortcodes);

		// Allow chaining
		return this;
	};

	/**
	 * Opens the modal window
	 */
	App.prototype.openModal = function(){
		// Only allow an instance of the modalView
		if( this.modalView === undefined ){
			this.modalView = new ModalView({collection: this.shortcodesCollection, app : this});
		}
	};

	/**
	 * Opens the modal window
	 */
	App.prototype.closeModal = function(){
		this.modalView = undefined;
	};

	znhg.shortcodesManager = new App().start();

})(jQuery);
},{"./models/shortcodesCollection":3,"./views/modal":5}],5:[function(require,module,exports){
var navView = require('./navView');

module.exports = Backbone.View.extend({
	id: "znhgtfw-shortcodes-modal",
	template : require('../html/modal.html'),
	events : {
		'click .znhgtfw-modal-backdrop': 'modalClose',
		'click .media-modal-close':      'modalClose',
		'click .znhg-shortcode-insert':  'insertShortcode'
	},
	initialize : function( options ){
		this.mainApp = options.app;
		this.listenTo(this.collection, 'shortcodeSelected', this.renderParams);
		this.render();
	},
	render : function(){
		this.$el.html( this.template() );

		// Add the navigation
		this.$('.znhgtfw-modal-sidebar').append( new navView().render().$el );

		// Finally.. add the modal to the page
		jQuery( 'body' ).append( this.$el ).addClass('znhgtfw-modal-open');

		return this;
	},
	modalClose : function(){
		this.$el.remove();
		jQuery('body').removeClass('znhgtfw-modal-open');
		this.mainApp.closeModal();
		this.remove();
	},
	renderParams: function( shortcode ){
		// We will need to render the form
		this.paramsCollection = znhg.optionsMachine.setupParams( shortcode.get('params') );
		var form = znhg.optionsMachine.renderOptionsGroup(this.paramsCollection);
		this.$('.znhgtfw-modal-content').html(form);
	},
	insertShortcode : function(shortcode){

		var shortcodeTag    = this.collection.selected.get( 'id' ),
			changedParams   = this.paramsCollection.where({ isChanged: true }),
			closeShortcode  = this.collection.selected.get( 'hasContent' ) || false,
			shortcodeContent = this.collection.selected.get( 'defaultContent' ) || false,
			output;

		// Open the shortcode tag
		output = '['+ shortcodeTag;
			// output all the shortcode params/attributes
			_.each(changedParams, function(param){
				// Don't add the content attribute
				if( param.get('id') === 'content' ){
					// Set the closeShortcode to true
					closeShortcode = true;
					shortcodeContent = param.get('value');
					return true;
				}
				// Output the param_name=param_value
				output += ' '+ param.get('id') + '="' + param.get('value') +'"';
			});
		output += ']';

		// If we have content, add the content and also add the closing tag
		if ( shortcodeContent ) {
			output += shortcodeContent;
		}

		// Check if we need to close the shortcode
		if( closeShortcode ){
			output += '[/' + shortcodeTag + ']';
		}

		window.wp.media.editor.insert( output );
		this.modalClose();
	}
});
},{"../html/modal.html":1,"./navView":8}],6:[function(require,module,exports){
module.exports = Backbone.View.extend({
	tagName : 'li',
	events : {
		'click' : 'selectShortcode'
	},
	render : function(){
		this.$el.html( jQuery('<a href="#">' + this.model.get('name') + '</a>') );
		return this;
	},
	selectShortcode : function(){
		this.model.setSelected();
	}
});
},{}],7:[function(require,module,exports){
var navItem = require('./navItem');
module.exports = Backbone.View.extend({
	tagName: 'ul',
	className : 'znhgtfw-modal-menu-dropdown',
	render : function(){
		this.collection.each(function( shortcode ){
			this.$el.append(new navItem({model: shortcode}).render().$el);
		}.bind(this));
		return this;
	}
});
},{"./navItem":6}],8:[function(require,module,exports){
var navSection = require('./navSection');
module.exports = Backbone.View.extend({
	tagName: 'ul',
	className : 'znhgtfw-modal-menu',
	events : {
		'click > li > a' : 'toggleSection'
	},
	render : function(){
		_(znhgShortcodesManagerData.sections).each(function(sectionName){
			var $li = jQuery('<li></li>');
			$li.append('<a href="#">'+ sectionName +'</a>');
			$li.append( new navSection( { collection: znhg.shortcodesManager.shortcodesCollection.bySection( sectionName ) } ).render().$el );
			this.$el.append($li);
		}.bind(this));
		return this;
	},
	toggleSection : function(e){
		this.$el.find('li').removeClass('active');
		jQuery(e.target).parent().addClass('active');
	}
});
},{"./navSection":7}]},{},[4])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJmcmFtZXdvcmsvYXNzZXRzL2pzL3NyYy9hZG1pbi9zaG9ydGNvZGVzL2h0bWwvbW9kYWwuaHRtbCIsImZyYW1ld29yay9hc3NldHMvanMvc3JjL2FkbWluL3Nob3J0Y29kZXMvbW9kZWxzL3Nob3J0Y29kZU1vZGVsLmpzIiwiZnJhbWV3b3JrL2Fzc2V0cy9qcy9zcmMvYWRtaW4vc2hvcnRjb2Rlcy9tb2RlbHMvc2hvcnRjb2Rlc0NvbGxlY3Rpb24uanMiLCJmcmFtZXdvcmsvYXNzZXRzL2pzL3NyYy9hZG1pbi9zaG9ydGNvZGVzL3Nob3J0Y29kZXMuanMiLCJmcmFtZXdvcmsvYXNzZXRzL2pzL3NyYy9hZG1pbi9zaG9ydGNvZGVzL3ZpZXdzL21vZGFsLmpzIiwiZnJhbWV3b3JrL2Fzc2V0cy9qcy9zcmMvYWRtaW4vc2hvcnRjb2Rlcy92aWV3cy9uYXZJdGVtLmpzIiwiZnJhbWV3b3JrL2Fzc2V0cy9qcy9zcmMvYWRtaW4vc2hvcnRjb2Rlcy92aWV3cy9uYXZTZWN0aW9uLmpzIiwiZnJhbWV3b3JrL2Fzc2V0cy9qcy9zcmMvYWRtaW4vc2hvcnRjb2Rlcy92aWV3cy9uYXZWaWV3LmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FDQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNQQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDWEE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDeEJBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDdmtCQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUMzRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDWkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNWQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbiBlKHQsbixyKXtmdW5jdGlvbiBzKG8sdSl7aWYoIW5bb10pe2lmKCF0W29dKXt2YXIgYT10eXBlb2YgcmVxdWlyZT09XCJmdW5jdGlvblwiJiZyZXF1aXJlO2lmKCF1JiZhKXJldHVybiBhKG8sITApO2lmKGkpcmV0dXJuIGkobywhMCk7dmFyIGY9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitvK1wiJ1wiKTt0aHJvdyBmLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsZn12YXIgbD1uW29dPXtleHBvcnRzOnt9fTt0W29dWzBdLmNhbGwobC5leHBvcnRzLGZ1bmN0aW9uKGUpe3ZhciBuPXRbb11bMV1bZV07cmV0dXJuIHMobj9uOmUpfSxsLGwuZXhwb3J0cyxlLHQsbixyKX1yZXR1cm4gbltvXS5leHBvcnRzfXZhciBpPXR5cGVvZiByZXF1aXJlPT1cImZ1bmN0aW9uXCImJnJlcXVpcmU7Zm9yKHZhciBvPTA7bzxyLmxlbmd0aDtvKyspcyhyW29dKTtyZXR1cm4gc30pIiwibW9kdWxlLmV4cG9ydHMgPSBmdW5jdGlvbihvYmope1xudmFyIF9fdCxfX3A9JycsX19qPUFycmF5LnByb3RvdHlwZS5qb2luLHByaW50PWZ1bmN0aW9uKCl7X19wKz1fX2ouY2FsbChhcmd1bWVudHMsJycpO307XG53aXRoKG9ianx8e30pe1xuX19wKz0nPGRpdiBjbGFzcz1cInpuaGd0ZnctbW9kYWwtd3JhcHBlclwiPlxcclxcblxcdDxkaXYgY2xhc3M9XCJ6bmhndGZ3LW1vZGFsLWhlYWRlclwiPlxcclxcblxcdFxcdDxkaXYgY2xhc3M9XCJ6bmhndGZ3LW1vZGFsLXRpdGxlXCI+XFxyXFxuXFx0XFx0XFx0U2hvcnRjb2Rlc1xcclxcblxcdFxcdDwvZGl2PlxcclxcblxcdFxcdDxidXR0b24gdHlwZT1cImJ1dHRvblwiIGNsYXNzPVwiYnV0dG9uLWxpbmsgbWVkaWEtbW9kYWwtY2xvc2VcIj5cXHJcXG5cXHRcXHRcXHQ8c3BhbiBjbGFzcz1cIm1lZGlhLW1vZGFsLWljb25cIj5cXHJcXG5cXHRcXHRcXHRcXHQ8c3BhbiBjbGFzcz1cInNjcmVlbi1yZWFkZXItdGV4dFwiPkNsb3NlIG1lZGlhIHBhbmVsPC9zcGFuPlxcclxcblxcdFxcdFxcdDwvc3Bhbj5cXHJcXG5cXHRcXHQ8L2J1dHRvbj5cXHJcXG5cXHQ8L2Rpdj5cXHJcXG5cXHQ8ZGl2IGNsYXNzPVwiem5oZ3Rmdy1tb2RhbC1jb250ZW50LXdyYXBwZXJcIj5cXHJcXG5cXHRcXHQ8ZGl2IGNsYXNzPVwiem5oZ3Rmdy1tb2RhbC1zaWRlYmFyXCI+PC9kaXY+XFxyXFxuXFx0XFx0PGRpdiBjbGFzcz1cInpuaGd0ZnctbW9kYWwtY29udGVudFwiPlxcclxcblxcdFxcdFxcdDxkaXYgY2xhc3M9XCJ6bmhndGZ3LXNob3J0Y29kZS1tbmdyLW5vdGhpbmctc2VsZWN0ZWRcIj5cXHJcXG5cXHRcXHRcXHRcXHQ8cD5DaG9vc2UgYSBzaG9ydGNvZGUgZnJvbSB0aGUgc2lkZWJhciB0byBnZXQgc3RhcnRlZC48L3A+XFxyXFxuXFx0XFx0XFx0PC9kaXY+XFxyXFxuXFx0XFx0PC9kaXY+XFxyXFxuXFx0PC9kaXY+XFxyXFxuXFx0PGRpdiBjbGFzcz1cInpuaGd0ZnctbW9kYWwtZm9vdGVyXCI+XFxyXFxuXFx0XFx0PGRpdiBjbGFzcz1cInpuaGd0ZnctZm9vdGVyLW5hdlwiPlxcclxcblxcdFxcdFxcdDxhIGhyZWY9XCIjXCIgY2xhc3M9XCJ6bmhndGZ3LWJ1dHRvbiB6bmhnLXNob3J0Y29kZS1pbnNlcnRcIj5JbnNlcnQgc2hvcnRjb2RlPC9hPlxcclxcblxcdFxcdDwvZGl2PlxcclxcblxcdDwvZGl2PlxcclxcbjwvZGl2PlxcclxcbjxkaXYgY2xhc3M9XCJ6bmhndGZ3LW1vZGFsLWJhY2tkcm9wXCI+PC9kaXY+Jztcbn1cbnJldHVybiBfX3A7XG59O1xuIiwibW9kdWxlLmV4cG9ydHMgPSBCYWNrYm9uZS5Nb2RlbC5leHRlbmQoe1xyXG5cdGRlZmF1bHRzIDoge1xyXG5cdFx0aWQgOiAnc2hvcnRjb2RlLXRhZycsXHJcblx0XHRuYW1lIDogJ1Nob3J0Y29kZSBOYW1lJyxcclxuXHRcdHNlY3Rpb24gOiAnU2VjdGlvbicsXHJcblx0XHRkZXNjcmlwdGlvbiA6ICdTaG9ydGNvZGUgZGVzY3JpcHRpb24nLFxyXG5cdFx0cGFyYW1zIDogW10sXHJcblx0fSxcclxuXHRzZXRTZWxlY3RlZDpmdW5jdGlvbigpIHtcclxuXHRcdHRoaXMuY29sbGVjdGlvbi5zZXRTZWxlY3RlZCh0aGlzKTtcclxuXHR9XHJcbn0pOyIsInZhciBTaG9ydGNvZGVzQ29sbGVjdGlvbiA9IEJhY2tib25lLkNvbGxlY3Rpb24uZXh0ZW5kKHtcclxuXHRtb2RlbDogcmVxdWlyZSgnLi9zaG9ydGNvZGVNb2RlbCcpLFxyXG5cdGluaXRpYWxpemU6IGZ1bmN0aW9uKCkge1xyXG5cdFx0dGhpcy5zZWxlY3RlZCA9IG51bGw7XHJcblx0fSxcclxuXHRieVNlY3Rpb24gOiBmdW5jdGlvbihzZWN0aW9uTmFtZSl7XHJcblx0XHRmaWx0ZXJlZCA9IHRoaXMuZmlsdGVyKGZ1bmN0aW9uICggc2hvcnRjb2RlICkge1xyXG5cdFx0XHRyZXR1cm4gc2hvcnRjb2RlLmdldCgnc2VjdGlvbicpID09PSBzZWN0aW9uTmFtZTtcclxuXHRcdH0pO1xyXG5cdFx0cmV0dXJuIG5ldyBTaG9ydGNvZGVzQ29sbGVjdGlvbihmaWx0ZXJlZCk7XHJcblx0fSxcclxuXHRzZXRTZWxlY3RlZDogZnVuY3Rpb24oIHNob3J0Y29kZSApIHtcclxuXHRcdGlmICh0aGlzLnNlbGVjdGVkKSB7XHJcblx0XHRcdHRoaXMuc2VsZWN0ZWQuc2V0KHtzZWxlY3RlZDpmYWxzZX0pO1xyXG5cdFx0fVxyXG5cdFx0c2hvcnRjb2RlLnNldCh7c2VsZWN0ZWQ6dHJ1ZX0pO1xyXG5cdFx0dGhpcy5zZWxlY3RlZCA9IHNob3J0Y29kZTtcclxuXHRcdHRoaXMudHJpZ2dlcignc2hvcnRjb2RlU2VsZWN0ZWQnLCBzaG9ydGNvZGUpO1xyXG5cdH0sXHJcblx0Z2V0U2VsZWN0ZWQgOiBmdW5jdGlvbigpe1xyXG5cdFx0cmV0dXJuIHRoaXMuc2VsZWN0ZWQ7XHJcblx0fVxyXG59KTtcclxuXHJcbm1vZHVsZS5leHBvcnRzID0gU2hvcnRjb2Rlc0NvbGxlY3Rpb247Iiwid2luZG93LnpuaGcgPSB3aW5kb3cuem5oZyB8fCB7fTtcclxuXHJcbnpuaGdTaG9ydGNvZGVzTWFuYWdlckRhdGEgPSB7fTtcclxuem5oZ1Nob3J0Y29kZXNNYW5hZ2VyRGF0YS5zZWN0aW9ucyA9IFtcclxuXHQnVHlwb2dyYXBoeScsXHJcblx0J0xheW91dCcsXHJcblx0J0NvbnRlbnQnLFxyXG5cdCdNYXJrZXRpbmcnXHJcbl07XHJcblxyXG56bmhnU2hvcnRjb2Rlc01hbmFnZXJEYXRhLnNob3J0Y29kZXMgPSBbXHJcblx0e1xyXG5cdFx0aWQgOiAnc3VidGl0bGUnLFxyXG5cdFx0bmFtZSA6ICdTdWJ0aXRsZScsXHJcblx0XHRzZWN0aW9uIDogJ1R5cG9ncmFwaHknLFxyXG5cdFx0aGFzQ29udGVudDogdHJ1ZSxcclxuXHRcdHBhcmFtcyA6IFtcclxuXHRcdFx0e1xyXG5cdFx0XHRcdG5hbWUgOiAnU3VidGl0bGUnLFxyXG5cdFx0XHRcdGRlc2NyaXB0aW9uIDogJ0VudGVyIHRoZSBzdWJ0aXRsZSB0ZXh0JyxcclxuXHRcdFx0XHR0eXBlIDogJ3RleHQnLFxyXG5cdFx0XHRcdGlkIDogJ2NvbnRlbnQnXHJcblx0XHRcdH1cclxuXHRcdF0sXHJcblx0fSxcclxuXHR7XHJcblx0XHRpZCA6ICd6bmhnX2FsdGVybmF0aXZlX2hlYWRlcicsXHJcblx0XHRuYW1lIDogJ0FsdGVybmF0aXZlIGhlYWRpbmcnLFxyXG5cdFx0c2VjdGlvbiA6ICdUeXBvZ3JhcGh5JyxcclxuXHRcdGhhc0NvbnRlbnQ6IHRydWUsXHJcblx0XHRwYXJhbXMgOiBbXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ0hlYWRpbmcgdHlwZScsXHJcblx0XHRcdFx0aWQgOiAnaGVhZGluZ190eXBlJyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdDaG9vc2Ugd2hhdCBhbHRlcm5hdGl2ZSBoZWFkaW5nIHR5cGUgeW91IHdhbnQgdG8gdXNlJyxcclxuXHRcdFx0XHR0eXBlIDogJ3NlbGVjdCcsXHJcblx0XHRcdFx0dmFsdWUgOiAnaDEnLFxyXG5cdFx0XHRcdG9wdGlvbnM6IHtcclxuXHRcdFx0XHRcdCdoMScgOiAnSDEnLFxyXG5cdFx0XHRcdFx0J2gyJyA6ICdIMicsXHJcblx0XHRcdFx0XHQnaDMnIDogJ0gzJyxcclxuXHRcdFx0XHRcdCdoNCcgOiAnSDQnLFxyXG5cdFx0XHRcdFx0J2g1JyA6ICdINScsXHJcblx0XHRcdFx0XHQnaDYnIDogJ0g2JyxcclxuXHRcdFx0XHR9XHJcblx0XHRcdH0sXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ0hlYWRpbmcgdGV4dCcsXHJcblx0XHRcdFx0aWQgOiAnY29udGVudCcsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnUGxlYXNlIGVudGVyIHRoZSBoZWFkaW5nIHRleHQgeW91IHdhbnQgdG8gdXNlJyxcclxuXHRcdFx0XHR0eXBlIDogJ3RleHQnLFxyXG5cdFx0XHRcdHBsYWNlaG9sZGVyOiAnaGVhZGluZyB0ZXh0J1xyXG5cdFx0XHR9LFxyXG5cdFx0XSxcclxuXHR9LFxyXG5cdHtcclxuXHRcdGlkIDogJ2Jsb2NrcXVvdGUnLFxyXG5cdFx0bmFtZSA6ICdCbG9ja3F1b3RlJyxcclxuXHRcdHNlY3Rpb24gOiAnVHlwb2dyYXBoeScsXHJcblx0XHRoYXNDb250ZW50OiB0cnVlLFxyXG5cdFx0cGFyYW1zIDogW1xyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdBdXRob3InLFxyXG5cdFx0XHRcdGlkIDogJ2F1dGhvcicsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnRW50ZXIgdGhlIHF1b3RlIGF1dGhvciBuYW1lLicsXHJcblx0XHRcdFx0dHlwZSA6ICd0ZXh0JyxcclxuXHRcdFx0XHRwbGFjZWhvbGRlcjogJ0pvaG4gRG9lJ1xyXG5cdFx0XHR9LFxyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdRdW90ZScsXHJcblx0XHRcdFx0aWQgOiAnY29udGVudCcsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnRW50ZXIgdGhlIHF1b3RlLicsXHJcblx0XHRcdFx0dHlwZSA6ICd0ZXh0YXJlYScsXHJcblx0XHRcdH0sXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ0FsaWdubWVudCcsXHJcblx0XHRcdFx0aWQgOiAnYWxpZ24nLFxyXG5cdFx0XHRcdGRlc2NyaXB0aW9uIDogJ0Nob29zZSB0aGUgcXVvdGUgYWxpZ25tZW50JyxcclxuXHRcdFx0XHR0eXBlIDogJ3NlbGVjdCcsXHJcblx0XHRcdFx0dmFsdWUgOiAnbGVmdCcsXHJcblx0XHRcdFx0b3B0aW9uczoge1xyXG5cdFx0XHRcdFx0J2xlZnQnIDogJ0xlZnQnLFxyXG5cdFx0XHRcdFx0J3JpZ2h0JyA6ICdSaWdodCdcclxuXHRcdFx0XHR9XHJcblx0XHRcdH0sXHJcblx0XHRdLFxyXG5cdH0sXHJcblx0e1xyXG5cdFx0aWQgOiAnY29kZScsXHJcblx0XHRuYW1lIDogJ0NvZGUnLFxyXG5cdFx0c2VjdGlvbiA6ICdUeXBvZ3JhcGh5JyxcclxuXHRcdGhhc0NvbnRlbnQ6IHRydWUsXHJcblx0XHRwYXJhbXMgOiBbXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ0NvZGUgY29udGVudCcsXHJcblx0XHRcdFx0aWQgOiAnY29udGVudCcsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnRW50ZXIgdGhlIGRlc2lyZWQgY29kZSB5b3Ugd2FudCB0byBkaXNwbGF5LicsXHJcblx0XHRcdFx0dHlwZSA6ICd0ZXh0YXJlYScsXHJcblx0XHRcdH0sXHJcblx0XHRdLFxyXG5cdH0sXHJcblx0e1xyXG5cdFx0aWQgOiAndG9vbHRpcCcsXHJcblx0XHRuYW1lIDogJ1Rvb2x0aXAnLFxyXG5cdFx0c2VjdGlvbiA6ICdDb250ZW50JyxcclxuXHRcdGhhc0NvbnRlbnQ6IHRydWUsXHJcblx0XHRwYXJhbXMgOiBbXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ1Rvb2x0aXAgY29udGVudCcsXHJcblx0XHRcdFx0aWQgOiAnY29udGVudCcsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnRW50ZXIgdGhlIGRlc2lyZWQgdG9vbHRpcCBhbmNob3IgdGV4dC4nLFxyXG5cdFx0XHRcdHR5cGUgOiAndGV4dGFyZWEnLFxyXG5cdFx0XHR9LFxyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdUb29sdGlwIHRpdGxlJyxcclxuXHRcdFx0XHRpZCA6ICd0aXRsZScsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnRW50ZXIgdGhlIGRlc2lyZWQgdG9vbHRpcCBjb250ZW50LicsXHJcblx0XHRcdFx0dHlwZSA6ICd0ZXh0JyxcclxuXHRcdFx0fSxcclxuXHRcdFx0e1xyXG5cdFx0XHRcdG5hbWUgOiAnVG9vbHRpcCBwbGFjZW1lbnQnLFxyXG5cdFx0XHRcdGlkIDogJ3BsYWNlbWVudCcsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnQ2hvb3NlIHRoZSBkZXNpcmVkIHRvb2x0aXAgcGxhY2VtZW50LicsXHJcblx0XHRcdFx0dHlwZSA6ICdzZWxlY3QnLFxyXG5cdFx0XHRcdHZhbHVlIDogJ3RvcCcsXHJcblx0XHRcdFx0b3B0aW9uczoge1xyXG5cdFx0XHRcdFx0J3RvcCcgOiAnVG9wJyxcclxuXHRcdFx0XHRcdCdyaWdodCcgOiAnUmlnaHQnLFxyXG5cdFx0XHRcdFx0J2JvdHRvbScgOiAnQm90dG9tJyxcclxuXHRcdFx0XHRcdCdsZWZ0JyA6ICdMZWZ0J1xyXG5cdFx0XHRcdH1cclxuXHRcdFx0fSxcclxuXHRcdFx0e1xyXG5cdFx0XHRcdG5hbWUgOiAnVXNlIGJvcmRlciA/JyxcclxuXHRcdFx0XHRpZCA6ICdib3JkZXInLFxyXG5cdFx0XHRcdGRlc2NyaXB0aW9uIDogJ0Nob29zZSB5ZXMgaWYgeW91IHdhbnQgdG8gYWRkIGEgYm9yZGVyIGFyb3VuZCB0aGUgdG9vbHRpcC4nLFxyXG5cdFx0XHRcdHR5cGUgOiAnc2VsZWN0JyxcclxuXHRcdFx0XHR2YWx1ZSA6ICd5ZXMnLFxyXG5cdFx0XHRcdG9wdGlvbnM6IHtcclxuXHRcdFx0XHRcdCd5ZXMnIDogJ1llcycsXHJcblx0XHRcdFx0XHQnbm8nIDogJ05vJ1xyXG5cdFx0XHRcdH1cclxuXHRcdFx0fSxcclxuXHRcdF0sXHJcblx0fSxcclxuXHR7XHJcblx0XHRpZCA6ICdyb3cnLFxyXG5cdFx0bmFtZSA6ICdSb3cnLFxyXG5cdFx0c2VjdGlvbiA6ICdMYXlvdXQnLFxyXG5cdFx0aGFzQ29udGVudDogdHJ1ZSxcclxuXHRcdHBhcmFtcyA6IFtcclxuXHRcdFx0e1xyXG5cdFx0XHRcdG5hbWUgOiAnY3NzIGNsYXNzJyxcclxuXHRcdFx0XHRpZCA6ICdjc3NfY2xhc3MnLFxyXG5cdFx0XHRcdGRlc2NyaXB0aW9uIDogJ0VudGVyIHRoZSBkZXNpcmVkIGNzcyBjbGFzcyBuYW1lIHRoYXQgd2lsbCBiZSBhcHBsaWVkIHRvIHRoaXMgcm93LicsXHJcblx0XHRcdFx0dHlwZSA6ICd0ZXh0JyxcclxuXHRcdFx0fSxcclxuXHRcdF0sXHJcblx0fSxcclxuXHR7XHJcblx0XHRpZCA6ICd6bmhnX2NvbHVtbicsXHJcblx0XHRuYW1lIDogJ0NvbHVtbicsXHJcblx0XHRzZWN0aW9uIDogJ0xheW91dCcsXHJcblx0XHRoYXNDb250ZW50OiB0cnVlLFxyXG5cdFx0cGFyYW1zIDogW1xyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdDb2x1bW4gc2l6ZScsXHJcblx0XHRcdFx0aWQgOiAnc2l6ZScsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnQ2hvb3NlIHRoZSBkZXNpcmVkIGNvbHVtbiBzaXplLicsXHJcblx0XHRcdFx0dHlwZSA6ICdzZWxlY3QnLFxyXG5cdFx0XHRcdHZhbHVlIDogJ2NvbC1zbS02JyxcclxuXHRcdFx0XHRvcHRpb25zOiB7XHJcblx0XHRcdFx0XHQnY29sLXNtLTYnIDogJzEvMicsXHJcblx0XHRcdFx0XHQnY29sLXNtLTQnIDogJzEvMycsXHJcblx0XHRcdFx0XHQnY29sLXNtLTMnIDogJzEvNCcsXHJcblx0XHRcdFx0XHQnY29sLXNtLTgnIDogJzIvMycsXHJcblx0XHRcdFx0XHQnY29sLXNtLTknIDogJzMvNCcsXHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9LFxyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdjc3MgY2xhc3MnLFxyXG5cdFx0XHRcdGlkIDogJ2Nzc19jbGFzcycsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnRW50ZXIgdGhlIGRlc2lyZWQgY3NzIGNsYXNzIG5hbWUgdGhhdCB3aWxsIGJlIGFwcGxpZWQgdG8gdGhpcyByb3cuJyxcclxuXHRcdFx0XHR0eXBlIDogJ3RleHQnLFxyXG5cdFx0XHR9LFxyXG5cdFx0XSxcclxuXHR9LFxyXG5cdHtcclxuXHRcdGlkIDogJ2xpc3QnLFxyXG5cdFx0bmFtZSA6ICdMaXN0JyxcclxuXHRcdHNlY3Rpb24gOiAnQ29udGVudCcsXHJcblx0XHRoYXNDb250ZW50OiB0cnVlLFxyXG5cdFx0ZGVmYXVsdENvbnRlbnQ6ICc8dWw+PGxpPkZpcnN0IGxpc3QgaXRlbTwvbGk+PGxpPlNlY29uZCBsaXN0IGl0ZW08L2xpPjwvdWw+JyxcclxuXHRcdHBhcmFtcyA6IFtcclxuXHRcdFx0e1xyXG5cdFx0XHRcdG5hbWUgOiAnTGlzdCBzdHlsZScsXHJcblx0XHRcdFx0aWQgOiAndHlwZScsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnQ2hvb3NlIHRoZSBkZXNpcmVkIGxpc3Qgc3R5bGUgeW91IHdhbnQgdG8gdXNlLicsXHJcblx0XHRcdFx0dHlwZSA6ICdzZWxlY3QnLFxyXG5cdFx0XHRcdHZhbHVlIDogJ2xpc3Qtc3R5bGUxJyxcclxuXHRcdFx0XHRvcHRpb25zOiB7XHJcblx0XHRcdFx0XHQnbGlzdC1zdHlsZTEnIDogJ0Fycm93IGxpc3QnLFxyXG5cdFx0XHRcdFx0J2xpc3Qtc3R5bGUyJyA6ICdDaGVjayBsaXN0JyxcclxuXHRcdFx0XHR9XHJcblx0XHRcdH1cclxuXHRcdF1cclxuXHR9LFxyXG5cdHtcclxuXHRcdGlkIDogJ3RhYmxlJyxcclxuXHRcdG5hbWUgOiAnVGFibGUnLFxyXG5cdFx0c2VjdGlvbiA6ICdDb250ZW50JyxcclxuXHRcdGhhc0NvbnRlbnQ6IHRydWUsXHJcblx0XHRkZWZhdWx0Q29udGVudDogJzx0YWJsZT48dGhlYWQ+PHRyPjx0aD4jPC90aD48dGg+Rmlyc3QgTmFtZTwvdGg+PC90cj48L3RoZWFkPjx0Ym9keT48dHI+PHRkPjE8L3RkPjx0ZD5NYXJrPC90ZD48L3RyPjx0cj48dGQ+MjwvdGQ+PHRkPkphY29iPC90ZD48L3RyPjx0cj48dGQ+MzwvdGQ+PHRkPkxhcnJ5PC90ZD48L3RyPjwvdGJvZHk+PC90YWJsZT4nLFxyXG5cdFx0cGFyYW1zIDogW1xyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdTdHlsZScsXHJcblx0XHRcdFx0aWQgOiAndHlwZScsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnQ2hvb3NlIHRoZSBkZXNpcmVkIHN0eWxlIHlvdSB3YW50IHRvIHVzZS4nLFxyXG5cdFx0XHRcdHR5cGUgOiAnc2VsZWN0JyxcclxuXHRcdFx0XHR2YWx1ZSA6ICd0YWJsZS1zdHJpcGVkJyxcclxuXHRcdFx0XHRvcHRpb25zOiB7XHJcblx0XHRcdFx0XHQndGFibGUtc3RyaXBlZCc6ICdTdHJpcGVkJyxcclxuXHRcdFx0XHRcdCd0YWJsZS1ib3JkZXJlZCc6ICdCb3JkZXJlZCcsXHJcblx0XHRcdFx0XHQndGFibGUtaG92ZXInOiAnSG92ZXInLFxyXG5cdFx0XHRcdFx0J3RhYmxlLWNvbmRlbnNlZCc6ICdDb25kZW5zZWQnLFxyXG5cdFx0XHRcdH1cclxuXHRcdFx0fVxyXG5cdFx0XVxyXG5cdH0sXHJcblx0e1xyXG5cdFx0aWQgOiAnem5oZ19xcicsXHJcblx0XHRuYW1lIDogJ1FyIENvZGUnLFxyXG5cdFx0c2VjdGlvbiA6ICdNYXJrZXRpbmcnLFxyXG5cdFx0cGFyYW1zIDogW1xyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdRUiBjb2RlIFVSTCcsXHJcblx0XHRcdFx0aWQgOiAndXJsJyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdFbnRlciB0aGUgUVIgY29kZSB1cmwgZ2VuZXJhdGVkIGZyb20gPGEgdGFyZ2V0PVwiX2JsYW5rXCIgaHJlZj1cImh0dHA6Ly9nb3FyLm1lL1wiPlFSIGNvZGUgZ2VuZXJhdG9yPC9hPi4nLFxyXG5cdFx0XHRcdHR5cGUgOiAndGV4dCcsXHJcblx0XHRcdFx0cGxhY2Vob2xkZXIgOiAnUVIgY29kZSBVUkwnLFxyXG5cdFx0XHR9LFxyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdBbGlnbm1lbnQnLFxyXG5cdFx0XHRcdGlkIDogJ2FsaWduJyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdDaG9vc2UgdGhlIGRlc2lyZWQgYWxpZ25tZW50LicsXHJcblx0XHRcdFx0dHlwZSA6ICdzZWxlY3QnLFxyXG5cdFx0XHRcdHZhbHVlIDogJ3JpZ2h0JyxcclxuXHRcdFx0XHRvcHRpb25zOiB7XHJcblx0XHRcdFx0XHQncmlnaHQnOiAnUmlnaHQnLFxyXG5cdFx0XHRcdFx0J2xlZnQnOiAnTGVmdCcsXHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9LFxyXG5cdFx0XVxyXG5cdH0sXHJcblx0e1xyXG5cdFx0aWQgOiAnYnV0dG9uJyxcclxuXHRcdG5hbWUgOiAnQnV0dG9uJyxcclxuXHRcdHNlY3Rpb24gOiAnQ29udGVudCcsXHJcblx0XHRoYXNDb250ZW50OiB0cnVlLFxyXG5cdFx0cGFyYW1zIDogW1xyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdTdHlsZScsXHJcblx0XHRcdFx0aWQgOiAnc3R5bGUnLFxyXG5cdFx0XHRcdGRlc2NyaXB0aW9uIDogJ1NlbGVjdCB0aGUgZGVzaXJlZCBzdHlsZSB5b3Ugd2FudCB0byB1c2UgZm9yIHRoaXMgYnV0dG9uLicsXHJcblx0XHRcdFx0dHlwZSA6ICdzZWxlY3QnLFxyXG5cdFx0XHRcdHZhbHVlIDogJycsXHJcblx0XHRcdFx0b3B0aW9uczoge1xyXG5cdFx0XHRcdFx0Jyc6ICdEZWZhdWx0JyxcclxuXHRcdFx0XHRcdCdidG4tcHJpbWFyeSc6ICdQcmltYXJ5JyxcclxuXHRcdFx0XHRcdCdidG4taW5mbyc6ICdJbmZvJyxcclxuXHRcdFx0XHRcdCdidG4tc3VjY2Vzcyc6ICdTdWNjZXNzJyxcclxuXHRcdFx0XHRcdCdidG4td2FybmluZyc6ICdXYXJuaW5nJyxcclxuXHRcdFx0XHRcdCdidG4tZGFuZ2VyJzogJ0RhbmdlcicsXHJcblx0XHRcdFx0XHQnYnRuLWludmVyc2UnOiAnSW52ZXJzZScsXHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9LFxyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdCdXR0b24gY29udGVudCcsXHJcblx0XHRcdFx0aWQgOiAnY29udGVudCcsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnRW50ZXIgdGhlIGRlc2lyZWQgYnV0dG9uIGNvbnRlbnQgdGV4dC4nLFxyXG5cdFx0XHRcdHR5cGUgOiAndGV4dCcsXHJcblx0XHRcdFx0cGxhY2Vob2xkZXIgOiAnQ29udGVudCcsXHJcblx0XHRcdH0sXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ1VSTCcsXHJcblx0XHRcdFx0aWQgOiAndXJsJyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdFbnRlciB0aGUgZGVzaXJlZCBidXR0b24gVVJMJyxcclxuXHRcdFx0XHR0eXBlIDogJ3RleHQnLFxyXG5cdFx0XHRcdHBsYWNlaG9sZGVyIDogJ1VSTCcsXHJcblx0XHRcdH0sXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ1RhcmdldCcsXHJcblx0XHRcdFx0aWQgOiAndGFyZ2V0JyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdTZWxlY3QgdGhlIGRlc2lyZWQgdGFyZ2V0IGZvciB0aGlzIGJ1dHRvbi4nLFxyXG5cdFx0XHRcdHR5cGUgOiAnc2VsZWN0JyxcclxuXHRcdFx0XHR2YWx1ZSA6ICdfc2VsZicsXHJcblx0XHRcdFx0b3B0aW9uczoge1xyXG5cdFx0XHRcdFx0J19zZWxmJzogJ1NlbGYnLFxyXG5cdFx0XHRcdFx0J19ibGFuayc6ICdCbGFuaycsXHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9LFxyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdTaXplJyxcclxuXHRcdFx0XHRpZCA6ICdzaXplJyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdTZWxlY3QgdGhlIGRlc2lyZWQgc2l6ZSBmb3IgdGhpcyBidXR0b24uJyxcclxuXHRcdFx0XHR0eXBlIDogJ3NlbGVjdCcsXHJcblx0XHRcdFx0dmFsdWUgOiAnJyxcclxuXHRcdFx0XHRvcHRpb25zOiB7XHJcblx0XHRcdFx0XHQnJzogJ0RlZmF1bHQnLFxyXG5cdFx0XHRcdFx0J2J0bi1sZyc6ICdMYXJnZScsXHJcblx0XHRcdFx0XHQnYnRuLW1kJzogJ01lZGl1bScsXHJcblx0XHRcdFx0XHQnYnRuLXNtJzogJ1NtYWxsJyxcclxuXHRcdFx0XHRcdCdidG4teHMnOiAnRXh0cmEgc21hbGwnLFxyXG5cdFx0XHRcdH1cclxuXHRcdFx0fSxcclxuXHRcdFx0e1xyXG5cdFx0XHRcdG5hbWUgOiAnQmxvY2sgPycsXHJcblx0XHRcdFx0aWQgOiAnYmxvY2snLFxyXG5cdFx0XHRcdGRlc2NyaXB0aW9uIDogJ1NlbGVjdCBpZiB5b3Ugd2FudCB0byBkaXNwbGF5IHRoZSBidXR0b24gYXMgYmxvY2sgb3Igbm90LicsXHJcblx0XHRcdFx0dHlwZSA6ICdzZWxlY3QnLFxyXG5cdFx0XHRcdHZhbHVlIDogJycsXHJcblx0XHRcdFx0b3B0aW9uczoge1xyXG5cdFx0XHRcdFx0Jyc6ICdOb3JtYWwnLFxyXG5cdFx0XHRcdFx0J2J0bi1ibG9jayc6ICdCbG9jaycsXHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9LFxyXG5cdFx0XSxcclxuXHR9LFxyXG5cdHtcclxuXHRcdGlkIDogJ2FjY29yZGlvbicsXHJcblx0XHRuYW1lIDogJ0FjY29yZGlvbicsXHJcblx0XHRzZWN0aW9uIDogJ0NvbnRlbnQnLFxyXG5cdFx0cGFyYW1zIDogW1xyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdBY2NvcmRpb24gdGl0bGUnLFxyXG5cdFx0XHRcdGlkIDogJ3RpdGxlJyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdFbnRlciB0aGUgZGVzaXJlZCB0aXRsZSBmb3IgdGhpcyBhY2NvcmRpb24uJyxcclxuXHRcdFx0XHR0eXBlIDogJ3RleHQnLFxyXG5cdFx0XHRcdHBsYWNlaG9sZGVyIDogJ2FjY29yZGlvbiB0aXRsZScsXHJcblx0XHRcdH0sXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ0FjY29yZGlvbiBjb250ZW50JyxcclxuXHRcdFx0XHRpZCA6ICdjb250ZW50JyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdFbnRlciB0aGUgZGVzaXJlZCBjb250ZW50IGZvciB0aGlzIGFjY29yZGlvbi4nLFxyXG5cdFx0XHRcdHR5cGUgOiAndGV4dGFyZWEnLFxyXG5cdFx0XHRcdHBsYWNlaG9sZGVyIDogJ2FjY29yZGlvbiBjb250ZW50JyxcclxuXHRcdFx0fSxcclxuXHRcdFx0e1xyXG5cdFx0XHRcdG5hbWUgOiAnU3R5bGUnLFxyXG5cdFx0XHRcdGlkIDogJ3N0eWxlJyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdDaG9vc2UgdGhlIGRlc2lyZWQgc3R5bGUuJyxcclxuXHRcdFx0XHR0eXBlIDogJ3NlbGVjdCcsXHJcblx0XHRcdFx0dmFsdWUgOiAnZGVmYXVsdC1zdHlsZScsXHJcblx0XHRcdFx0b3B0aW9uczoge1xyXG5cdFx0XHRcdFx0J2RlZmF1bHQtc3R5bGUnOiAnRGVmYXVsdCBzdHlsZScsXHJcblx0XHRcdFx0XHQnc3R5bGUyJzogJ1N0eWxlIDInLFxyXG5cdFx0XHRcdFx0J3N0eWxlMyc6ICdTdHlsZSAzJyxcclxuXHRcdFx0XHR9XHJcblx0XHRcdH0sXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ0NvbGxhcHNlZCA/JyxcclxuXHRcdFx0XHRpZCA6ICdjb2xsYXBzZWQnLFxyXG5cdFx0XHRcdGRlc2NyaXB0aW9uIDogJ0Nob29zZSB0aGUgaW5pdGlhbCBzdGF0ZSBvZiB0aGUgYWNjb3JkaW9uIHBhbmUuJyxcclxuXHRcdFx0XHR0eXBlIDogJ3NlbGVjdCcsXHJcblx0XHRcdFx0dmFsdWUgOiAnZmFsc2UnLFxyXG5cdFx0XHRcdG9wdGlvbnM6IHtcclxuXHRcdFx0XHRcdCdmYWxzZSc6ICdDbG9zZWQnLFxyXG5cdFx0XHRcdFx0J3RydWUnOiAnT3BlbicsXHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9LFxyXG5cdFx0XVxyXG5cdH0sXHJcblx0e1xyXG5cdFx0aWQgOiAndGFicycsXHJcblx0XHRuYW1lIDogJ1RhYnMgY29udGFpbmVyJyxcclxuXHRcdHNlY3Rpb24gOiAnQ29udGVudCcsXHJcblx0XHRoYXNDb250ZW50IDogdHJ1ZSxcclxuXHRcdHBhcmFtcyA6IFtcclxuXHRcdFx0e1xyXG5cdFx0XHRcdG5hbWUgOiAnU3R5bGUnLFxyXG5cdFx0XHRcdGlkIDogJ3N0eWxlJyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdDaG9vc2UgdGhlIGRlc2lyZWQgc3R5bGUuJyxcclxuXHRcdFx0XHR0eXBlIDogJ3NlbGVjdCcsXHJcblx0XHRcdFx0dmFsdWUgOiAnc3R5bGUxJyxcclxuXHRcdFx0XHRvcHRpb25zOiB7XHJcblx0XHRcdFx0XHQnc3R5bGUxJzogJ1N0eWxlIDEnLFxyXG5cdFx0XHRcdFx0J3N0eWxlMic6ICdTdHlsZSAyJyxcclxuXHRcdFx0XHRcdCdzdHlsZTMnOiAnU3R5bGUgMycsXHJcblx0XHRcdFx0XHQnc3R5bGU0JzogJ1N0eWxlIDQnLFxyXG5cdFx0XHRcdH1cclxuXHRcdFx0fSxcclxuXHRcdF1cclxuXHR9LFxyXG5cdHtcclxuXHRcdGlkIDogJ3RhYicsXHJcblx0XHRuYW1lIDogJ1NpbmdsZSB0YWInLFxyXG5cdFx0c2VjdGlvbiA6ICdDb250ZW50JyxcclxuXHRcdHBhcmFtcyA6IFtcclxuXHRcdFx0e1xyXG5cdFx0XHRcdG5hbWUgOiAnVGFiIHRpdGxlJyxcclxuXHRcdFx0XHRpZCA6ICd0aXRsZScsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnRW50ZXIgdGhlIGRlc2lyZWQgdGFiIHRpdGxlJyxcclxuXHRcdFx0XHR0eXBlIDogJ3RleHQnLFxyXG5cdFx0XHRcdHBsYWNlaG9sZGVyIDogJ3RpdGxlJ1xyXG5cdFx0XHR9LFxyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdUYWIgY29udGVudCcsXHJcblx0XHRcdFx0aWQgOiAnY29udGVudCcsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnRW50ZXIgdGhlIGRlc2lyZWQgdGFiIGNvbnRlbnQnLFxyXG5cdFx0XHRcdHR5cGUgOiAndGV4dGFyZWEnLFxyXG5cdFx0XHRcdHBsYWNlaG9sZGVyIDogJ3RhYiBjb250ZW50J1xyXG5cdFx0XHR9LFxyXG5cdFx0XVxyXG5cdH0sXHJcblx0e1xyXG5cdFx0aWQgOiAnc2tpbGxzJyxcclxuXHRcdG5hbWUgOiAnU2tpbGxzIGNvbnRhaW5lcicsXHJcblx0XHRzZWN0aW9uIDogJ0NvbnRlbnQnLFxyXG5cdFx0aGFzQ29udGVudCA6IHRydWUsXHJcblx0XHRwYXJhbXMgOiBbXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ01haW4gdGV4dCcsXHJcblx0XHRcdFx0aWQgOiAnbWFpbl90ZXh0JyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdFbnRlciB0aGUgbWFpbiB0ZXh0IHRoYXQgd2lsbCBhcHBlYXIgaW4gdGhlIGNlbnRlciBvZiB0aGUgc2tpbGwgYmFycy4nLFxyXG5cdFx0XHRcdHR5cGUgOiAndGV4dCcsXHJcblx0XHRcdFx0cGxhY2Vob2xkZXIgOiAnc2tpbGxzIG1haW4gdGV4dCcsXHJcblx0XHRcdH0sXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ01haW4gY29sb3InLFxyXG5cdFx0XHRcdGlkIDogJ21haW5fY29sb3InLFxyXG5cdFx0XHRcdGRlc2NyaXB0aW9uIDogJ0Nob29zZSB0aGUgbWFpbiBjb2xvciB5b3Ugd2FudCB0byB1c2UuJyxcclxuXHRcdFx0XHR0eXBlIDogJ2NvbG9ycGlja2VyJyxcclxuXHRcdFx0XHR2YWx1ZSA6ICcjMTkzMzQwJyxcclxuXHRcdFx0fSxcclxuXHRcdFx0e1xyXG5cdFx0XHRcdG5hbWUgOiAnVGV4dCBjb2xvcicsXHJcblx0XHRcdFx0aWQgOiAndGV4dF9jb2xvcicsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnQ2hvb3NlIHRoZSB0ZXh0IGNvbG9yIHlvdSB3YW50IHRvIHVzZS4nLFxyXG5cdFx0XHRcdHR5cGUgOiAnY29sb3JwaWNrZXInLFxyXG5cdFx0XHRcdHZhbHVlIDogJyNmZmZmZmYnLFxyXG5cdFx0XHR9LFxyXG5cdFx0XVxyXG5cdH0sXHJcblx0e1xyXG5cdFx0aWQgOiAnc2tpbGwnLFxyXG5cdFx0bmFtZSA6ICdTaW5nbGUgc2tpbGwnLFxyXG5cdFx0c2VjdGlvbiA6ICdDb250ZW50JyxcclxuXHRcdGhhc0NvbnRlbnQgOiB0cnVlLFxyXG5cdFx0cGFyYW1zIDogW1xyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdTa2lsbCB0aXRsZScsXHJcblx0XHRcdFx0aWQgOiAnY29udGVudCcsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnRW50ZXIgdGhlIGRlc2lyZWQgc2tpbGwgdGl0bGUnLFxyXG5cdFx0XHRcdHR5cGUgOiAndGV4dCcsXHJcblx0XHRcdFx0cGxhY2Vob2xkZXIgOiAnTXkgYXdlc29tZSBza2lsbCdcclxuXHRcdFx0fSxcclxuXHRcdFx0e1xyXG5cdFx0XHRcdG5hbWUgOiAnTWFpbiBjb2xvcicsXHJcblx0XHRcdFx0aWQgOiAnbWFpbl9jb2xvcicsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnQ2hvb3NlIHRoZSBtYWluIGNvbG9yIHlvdSB3YW50IHRvIHVzZS4nLFxyXG5cdFx0XHRcdHR5cGUgOiAnY29sb3JwaWNrZXInLFxyXG5cdFx0XHRcdHZhbHVlIDogJyMxOTMzNDAnLFxyXG5cdFx0XHR9LFxyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdTa2lsbCBwZXJjZW50YWdlJyxcclxuXHRcdFx0XHRpZCA6ICdwZXJjZW50YWdlJyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdFbnRlciB0aGUgc2tpbGwgcGVyY2VudGFnZSB2YWx1ZS4nLFxyXG5cdFx0XHRcdHR5cGUgOiAndGV4dCcsXHJcblx0XHRcdFx0dmFsdWUgOiAnJyxcclxuXHRcdFx0XHRwbGFjZWhvbGRlciA6ICc5MCcsXHJcblx0XHRcdH0sXHJcblx0XHRdXHJcblx0fSxcclxuXHR7XHJcblx0XHRpZCA6ICdwcmljaW5nX3RhYmxlJyxcclxuXHRcdG5hbWUgOiAnUHJpY2luZyB0YWJsZSBjb250YWluZXInLFxyXG5cdFx0c2VjdGlvbiA6ICdNYXJrZXRpbmcnLFxyXG5cdFx0aGFzQ29udGVudCA6IHRydWUsXHJcblx0XHRwYXJhbXMgOiBbXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ0NvbG9yJyxcclxuXHRcdFx0XHRpZCA6ICdjb2xvcicsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnQ2hvb3NlIHRoZSBkZXNpcmVkIHByaWNpbmcgdGFibGUgY29sb3IuJyxcclxuXHRcdFx0XHR0eXBlIDogJ3NlbGVjdCcsXHJcblx0XHRcdFx0dmFsdWUgOiAncmVkJyxcclxuXHRcdFx0XHRvcHRpb25zOiB7XHJcblx0XHRcdFx0XHQncmVkJzogJ1JlZCcsXHJcblx0XHRcdFx0XHQnYmx1ZSc6ICdCbHVlJyxcclxuXHRcdFx0XHRcdCdncmVlbic6ICdTdHlsZSAzJyxcclxuXHRcdFx0XHRcdCd0dXJxdW9pc2UnOiAnVHVycXVvaXNlJyxcclxuXHRcdFx0XHRcdCdvcmFuZ2UnOiAnT3JhbmdlJyxcclxuXHRcdFx0XHRcdCdwdXJwbGUnOiAnUHVycGxlJyxcclxuXHRcdFx0XHRcdCd5ZWxsb3cnOiAnWWVsbG93JyxcclxuXHRcdFx0XHRcdCdncmVlbl9sZW1vbic6ICdHcmVlbiBsZW1vbicsXHJcblx0XHRcdFx0XHQnZGFyayc6ICdEYXJrJyxcclxuXHRcdFx0XHRcdCdsaWdodCc6ICdMaWdodCcsXHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9LFxyXG5cdFx0XHR7XHJcblx0XHRcdFx0bmFtZSA6ICdDb2x1bW5zJyxcclxuXHRcdFx0XHRpZCA6ICdjb2x1bW5zJyxcclxuXHRcdFx0XHRkZXNjcmlwdGlvbiA6ICdDaG9vc2UgaG93IG1hbnkgY29sdW1ucyB5b3Ugd2FudCB0byB1c2UgZm9yIHRoaXMgdGFibGUuJyxcclxuXHRcdFx0XHR0eXBlIDogJ3NlbGVjdCcsXHJcblx0XHRcdFx0dmFsdWUgOiAnNCcsXHJcblx0XHRcdFx0b3B0aW9uczoge1xyXG5cdFx0XHRcdFx0JzEnOiAnMSBDb2x1bW4nLFxyXG5cdFx0XHRcdFx0JzInOiAnMiBDb2x1bW5zJyxcclxuXHRcdFx0XHRcdCczJzogJzMgQ29sdW1ucycsXHJcblx0XHRcdFx0XHQnNCc6ICc0IENvbHVtbnMnLFxyXG5cdFx0XHRcdFx0JzYnOiAnNiBDb2x1bW5zJyxcclxuXHRcdFx0XHR9XHJcblx0XHRcdH0sXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ1VzZSByb3VuZGVkIGNvcm5lcnMgPycsXHJcblx0XHRcdFx0aWQgOiAncm91bmRlZCcsXHJcblx0XHRcdFx0ZGVzY3JpcHRpb24gOiAnQ2hvb3NlIGlmIHlvdSB3YW50IHRvIHVzZSByb3VuZGVkIGNvcm5lcnMgb3Igbm90LicsXHJcblx0XHRcdFx0dHlwZSA6ICdzZWxlY3QnLFxyXG5cdFx0XHRcdHZhbHVlIDogJ25vJyxcclxuXHRcdFx0XHRvcHRpb25zOiB7XHJcblx0XHRcdFx0XHQnbm8nOiAnTm8nLFxyXG5cdFx0XHRcdFx0J3llcyc6ICdZZXMnLFxyXG5cdFx0XHRcdH1cclxuXHRcdFx0fSxcclxuXHRcdF1cclxuXHR9LFxyXG5cdHtcclxuXHRcdGlkIDogJ3ByaWNpbmdfY2FwdGlvbicsXHJcblx0XHRuYW1lIDogJ1ByaWNpbmcgdGFibGUgY2FwdGlvbicsXHJcblx0XHRzZWN0aW9uIDogJ01hcmtldGluZycsXHJcblx0XHRoYXNDb250ZW50IDogdHJ1ZSxcclxuXHRcdGRlZmF1bHRDb250ZW50OiAnPHVsPjxsaT5GaXJzdCBsaXN0IGl0ZW08L2xpPjxsaT5TZWNvbmQgbGlzdCBpdGVtPC9saT48L3VsPicsXHJcblx0XHRwYXJhbXMgOiBbXHJcblx0XHRcdHtcclxuXHRcdFx0XHRuYW1lIDogJ05hbWUnLFxyXG5cdFx0XHRcdGlkIDogJ25hbWUnLFxyXG5cdFx0XHRcdGRlc2NyaXB0aW9uIDogJ0VudGVyIHRoZSBkZXNpcmVkIHByaWNpbmcgY2FwdGlvbiBuYW1lJyxcclxuXHRcdFx0XHR0eXBlIDogJ3RleHQnLFxyXG5cdFx0XHRcdHBsYWNlaG9sZGVyIDogJ2NvbHVtbiBuYW1lJyxcclxuXHRcdFx0fSxcclxuXHRcdF1cclxuXHR9LFxyXG5dO1xyXG5cclxuKGZ1bmN0aW9uICgkKSB7XHJcblx0dmFyIEFwcCA9IGZ1bmN0aW9uKCl7fSxcclxuXHRcdE1vZGFsVmlldyA9IHJlcXVpcmUoJy4vdmlld3MvbW9kYWwnKSxcclxuXHRcdFNob3J0Y29kZXNDb2xsZWN0aW9uID0gcmVxdWlyZSgnLi9tb2RlbHMvc2hvcnRjb2Rlc0NvbGxlY3Rpb24nKTtcclxuXHJcblx0LyoqXHJcblx0ICogU3RhcnRzIHRoZSBtYWluIHNob3J0Y29kZSBtYW5hZ2VyIGNsYXNzXHJcblx0ICovXHJcblx0QXBwLnByb3RvdHlwZS5zdGFydCA9IGZ1bmN0aW9uKCl7XHJcblx0XHQvLyBCaW5kIHRoZSBjbGljayBldmVudFxyXG5cdFx0JChkb2N1bWVudCkub24oJ2NsaWNrJywgJyN6bmhndGZ3LXNob3J0Y29kZS1tb2RhbC1vcGVuJywgZnVuY3Rpb24oZSl7XHJcblx0XHRcdGUucHJldmVudERlZmF1bHQoKTtcclxuXHRcdFx0dGhpcy5vcGVuTW9kYWwoKTtcclxuXHRcdH0uYmluZCh0aGlzKSk7XHJcblxyXG5cdFx0dGhpcy5zaG9ydGNvZGVzQ29sbGVjdGlvbiA9IG5ldyBTaG9ydGNvZGVzQ29sbGVjdGlvbih6bmhnU2hvcnRjb2Rlc01hbmFnZXJEYXRhLnNob3J0Y29kZXMpO1xyXG5cclxuXHRcdC8vIEFsbG93IGNoYWluaW5nXHJcblx0XHRyZXR1cm4gdGhpcztcclxuXHR9O1xyXG5cclxuXHQvKipcclxuXHQgKiBPcGVucyB0aGUgbW9kYWwgd2luZG93XHJcblx0ICovXHJcblx0QXBwLnByb3RvdHlwZS5vcGVuTW9kYWwgPSBmdW5jdGlvbigpe1xyXG5cdFx0Ly8gT25seSBhbGxvdyBhbiBpbnN0YW5jZSBvZiB0aGUgbW9kYWxWaWV3XHJcblx0XHRpZiggdGhpcy5tb2RhbFZpZXcgPT09IHVuZGVmaW5lZCApe1xyXG5cdFx0XHR0aGlzLm1vZGFsVmlldyA9IG5ldyBNb2RhbFZpZXcoe2NvbGxlY3Rpb246IHRoaXMuc2hvcnRjb2Rlc0NvbGxlY3Rpb24sIGFwcCA6IHRoaXN9KTtcclxuXHRcdH1cclxuXHR9O1xyXG5cclxuXHQvKipcclxuXHQgKiBPcGVucyB0aGUgbW9kYWwgd2luZG93XHJcblx0ICovXHJcblx0QXBwLnByb3RvdHlwZS5jbG9zZU1vZGFsID0gZnVuY3Rpb24oKXtcclxuXHRcdHRoaXMubW9kYWxWaWV3ID0gdW5kZWZpbmVkO1xyXG5cdH07XHJcblxyXG5cdHpuaGcuc2hvcnRjb2Rlc01hbmFnZXIgPSBuZXcgQXBwKCkuc3RhcnQoKTtcclxuXHJcbn0pKGpRdWVyeSk7IiwidmFyIG5hdlZpZXcgPSByZXF1aXJlKCcuL25hdlZpZXcnKTtcclxuXHJcbm1vZHVsZS5leHBvcnRzID0gQmFja2JvbmUuVmlldy5leHRlbmQoe1xyXG5cdGlkOiBcInpuaGd0Znctc2hvcnRjb2Rlcy1tb2RhbFwiLFxyXG5cdHRlbXBsYXRlIDogcmVxdWlyZSgnLi4vaHRtbC9tb2RhbC5odG1sJyksXHJcblx0ZXZlbnRzIDoge1xyXG5cdFx0J2NsaWNrIC56bmhndGZ3LW1vZGFsLWJhY2tkcm9wJzogJ21vZGFsQ2xvc2UnLFxyXG5cdFx0J2NsaWNrIC5tZWRpYS1tb2RhbC1jbG9zZSc6ICAgICAgJ21vZGFsQ2xvc2UnLFxyXG5cdFx0J2NsaWNrIC56bmhnLXNob3J0Y29kZS1pbnNlcnQnOiAgJ2luc2VydFNob3J0Y29kZSdcclxuXHR9LFxyXG5cdGluaXRpYWxpemUgOiBmdW5jdGlvbiggb3B0aW9ucyApe1xyXG5cdFx0dGhpcy5tYWluQXBwID0gb3B0aW9ucy5hcHA7XHJcblx0XHR0aGlzLmxpc3RlblRvKHRoaXMuY29sbGVjdGlvbiwgJ3Nob3J0Y29kZVNlbGVjdGVkJywgdGhpcy5yZW5kZXJQYXJhbXMpO1xyXG5cdFx0dGhpcy5yZW5kZXIoKTtcclxuXHR9LFxyXG5cdHJlbmRlciA6IGZ1bmN0aW9uKCl7XHJcblx0XHR0aGlzLiRlbC5odG1sKCB0aGlzLnRlbXBsYXRlKCkgKTtcclxuXHJcblx0XHQvLyBBZGQgdGhlIG5hdmlnYXRpb25cclxuXHRcdHRoaXMuJCgnLnpuaGd0ZnctbW9kYWwtc2lkZWJhcicpLmFwcGVuZCggbmV3IG5hdlZpZXcoKS5yZW5kZXIoKS4kZWwgKTtcclxuXHJcblx0XHQvLyBGaW5hbGx5Li4gYWRkIHRoZSBtb2RhbCB0byB0aGUgcGFnZVxyXG5cdFx0alF1ZXJ5KCAnYm9keScgKS5hcHBlbmQoIHRoaXMuJGVsICkuYWRkQ2xhc3MoJ3puaGd0ZnctbW9kYWwtb3BlbicpO1xyXG5cclxuXHRcdHJldHVybiB0aGlzO1xyXG5cdH0sXHJcblx0bW9kYWxDbG9zZSA6IGZ1bmN0aW9uKCl7XHJcblx0XHR0aGlzLiRlbC5yZW1vdmUoKTtcclxuXHRcdGpRdWVyeSgnYm9keScpLnJlbW92ZUNsYXNzKCd6bmhndGZ3LW1vZGFsLW9wZW4nKTtcclxuXHRcdHRoaXMubWFpbkFwcC5jbG9zZU1vZGFsKCk7XHJcblx0XHR0aGlzLnJlbW92ZSgpO1xyXG5cdH0sXHJcblx0cmVuZGVyUGFyYW1zOiBmdW5jdGlvbiggc2hvcnRjb2RlICl7XHJcblx0XHQvLyBXZSB3aWxsIG5lZWQgdG8gcmVuZGVyIHRoZSBmb3JtXHJcblx0XHR0aGlzLnBhcmFtc0NvbGxlY3Rpb24gPSB6bmhnLm9wdGlvbnNNYWNoaW5lLnNldHVwUGFyYW1zKCBzaG9ydGNvZGUuZ2V0KCdwYXJhbXMnKSApO1xyXG5cdFx0dmFyIGZvcm0gPSB6bmhnLm9wdGlvbnNNYWNoaW5lLnJlbmRlck9wdGlvbnNHcm91cCh0aGlzLnBhcmFtc0NvbGxlY3Rpb24pO1xyXG5cdFx0dGhpcy4kKCcuem5oZ3Rmdy1tb2RhbC1jb250ZW50JykuaHRtbChmb3JtKTtcclxuXHR9LFxyXG5cdGluc2VydFNob3J0Y29kZSA6IGZ1bmN0aW9uKHNob3J0Y29kZSl7XHJcblxyXG5cdFx0dmFyIHNob3J0Y29kZVRhZyAgICA9IHRoaXMuY29sbGVjdGlvbi5zZWxlY3RlZC5nZXQoICdpZCcgKSxcclxuXHRcdFx0Y2hhbmdlZFBhcmFtcyAgID0gdGhpcy5wYXJhbXNDb2xsZWN0aW9uLndoZXJlKHsgaXNDaGFuZ2VkOiB0cnVlIH0pLFxyXG5cdFx0XHRjbG9zZVNob3J0Y29kZSAgPSB0aGlzLmNvbGxlY3Rpb24uc2VsZWN0ZWQuZ2V0KCAnaGFzQ29udGVudCcgKSB8fCBmYWxzZSxcclxuXHRcdFx0c2hvcnRjb2RlQ29udGVudCA9IHRoaXMuY29sbGVjdGlvbi5zZWxlY3RlZC5nZXQoICdkZWZhdWx0Q29udGVudCcgKSB8fCBmYWxzZSxcclxuXHRcdFx0b3V0cHV0O1xyXG5cclxuXHRcdC8vIE9wZW4gdGhlIHNob3J0Y29kZSB0YWdcclxuXHRcdG91dHB1dCA9ICdbJysgc2hvcnRjb2RlVGFnO1xyXG5cdFx0XHQvLyBvdXRwdXQgYWxsIHRoZSBzaG9ydGNvZGUgcGFyYW1zL2F0dHJpYnV0ZXNcclxuXHRcdFx0Xy5lYWNoKGNoYW5nZWRQYXJhbXMsIGZ1bmN0aW9uKHBhcmFtKXtcclxuXHRcdFx0XHQvLyBEb24ndCBhZGQgdGhlIGNvbnRlbnQgYXR0cmlidXRlXHJcblx0XHRcdFx0aWYoIHBhcmFtLmdldCgnaWQnKSA9PT0gJ2NvbnRlbnQnICl7XHJcblx0XHRcdFx0XHQvLyBTZXQgdGhlIGNsb3NlU2hvcnRjb2RlIHRvIHRydWVcclxuXHRcdFx0XHRcdGNsb3NlU2hvcnRjb2RlID0gdHJ1ZTtcclxuXHRcdFx0XHRcdHNob3J0Y29kZUNvbnRlbnQgPSBwYXJhbS5nZXQoJ3ZhbHVlJyk7XHJcblx0XHRcdFx0XHRyZXR1cm4gdHJ1ZTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdFx0Ly8gT3V0cHV0IHRoZSBwYXJhbV9uYW1lPXBhcmFtX3ZhbHVlXHJcblx0XHRcdFx0b3V0cHV0ICs9ICcgJysgcGFyYW0uZ2V0KCdpZCcpICsgJz1cIicgKyBwYXJhbS5nZXQoJ3ZhbHVlJykgKydcIic7XHJcblx0XHRcdH0pO1xyXG5cdFx0b3V0cHV0ICs9ICddJztcclxuXHJcblx0XHQvLyBJZiB3ZSBoYXZlIGNvbnRlbnQsIGFkZCB0aGUgY29udGVudCBhbmQgYWxzbyBhZGQgdGhlIGNsb3NpbmcgdGFnXHJcblx0XHRpZiAoIHNob3J0Y29kZUNvbnRlbnQgKSB7XHJcblx0XHRcdG91dHB1dCArPSBzaG9ydGNvZGVDb250ZW50O1xyXG5cdFx0fVxyXG5cclxuXHRcdC8vIENoZWNrIGlmIHdlIG5lZWQgdG8gY2xvc2UgdGhlIHNob3J0Y29kZVxyXG5cdFx0aWYoIGNsb3NlU2hvcnRjb2RlICl7XHJcblx0XHRcdG91dHB1dCArPSAnWy8nICsgc2hvcnRjb2RlVGFnICsgJ10nO1xyXG5cdFx0fVxyXG5cclxuXHRcdHdpbmRvdy53cC5tZWRpYS5lZGl0b3IuaW5zZXJ0KCBvdXRwdXQgKTtcclxuXHRcdHRoaXMubW9kYWxDbG9zZSgpO1xyXG5cdH1cclxufSk7IiwibW9kdWxlLmV4cG9ydHMgPSBCYWNrYm9uZS5WaWV3LmV4dGVuZCh7XHJcblx0dGFnTmFtZSA6ICdsaScsXHJcblx0ZXZlbnRzIDoge1xyXG5cdFx0J2NsaWNrJyA6ICdzZWxlY3RTaG9ydGNvZGUnXHJcblx0fSxcclxuXHRyZW5kZXIgOiBmdW5jdGlvbigpe1xyXG5cdFx0dGhpcy4kZWwuaHRtbCggalF1ZXJ5KCc8YSBocmVmPVwiI1wiPicgKyB0aGlzLm1vZGVsLmdldCgnbmFtZScpICsgJzwvYT4nKSApO1xyXG5cdFx0cmV0dXJuIHRoaXM7XHJcblx0fSxcclxuXHRzZWxlY3RTaG9ydGNvZGUgOiBmdW5jdGlvbigpe1xyXG5cdFx0dGhpcy5tb2RlbC5zZXRTZWxlY3RlZCgpO1xyXG5cdH1cclxufSk7IiwidmFyIG5hdkl0ZW0gPSByZXF1aXJlKCcuL25hdkl0ZW0nKTtcclxubW9kdWxlLmV4cG9ydHMgPSBCYWNrYm9uZS5WaWV3LmV4dGVuZCh7XHJcblx0dGFnTmFtZTogJ3VsJyxcclxuXHRjbGFzc05hbWUgOiAnem5oZ3Rmdy1tb2RhbC1tZW51LWRyb3Bkb3duJyxcclxuXHRyZW5kZXIgOiBmdW5jdGlvbigpe1xyXG5cdFx0dGhpcy5jb2xsZWN0aW9uLmVhY2goZnVuY3Rpb24oIHNob3J0Y29kZSApe1xyXG5cdFx0XHR0aGlzLiRlbC5hcHBlbmQobmV3IG5hdkl0ZW0oe21vZGVsOiBzaG9ydGNvZGV9KS5yZW5kZXIoKS4kZWwpO1xyXG5cdFx0fS5iaW5kKHRoaXMpKTtcclxuXHRcdHJldHVybiB0aGlzO1xyXG5cdH1cclxufSk7IiwidmFyIG5hdlNlY3Rpb24gPSByZXF1aXJlKCcuL25hdlNlY3Rpb24nKTtcclxubW9kdWxlLmV4cG9ydHMgPSBCYWNrYm9uZS5WaWV3LmV4dGVuZCh7XHJcblx0dGFnTmFtZTogJ3VsJyxcclxuXHRjbGFzc05hbWUgOiAnem5oZ3Rmdy1tb2RhbC1tZW51JyxcclxuXHRldmVudHMgOiB7XHJcblx0XHQnY2xpY2sgPiBsaSA+IGEnIDogJ3RvZ2dsZVNlY3Rpb24nXHJcblx0fSxcclxuXHRyZW5kZXIgOiBmdW5jdGlvbigpe1xyXG5cdFx0Xyh6bmhnU2hvcnRjb2Rlc01hbmFnZXJEYXRhLnNlY3Rpb25zKS5lYWNoKGZ1bmN0aW9uKHNlY3Rpb25OYW1lKXtcclxuXHRcdFx0dmFyICRsaSA9IGpRdWVyeSgnPGxpPjwvbGk+Jyk7XHJcblx0XHRcdCRsaS5hcHBlbmQoJzxhIGhyZWY9XCIjXCI+Jysgc2VjdGlvbk5hbWUgKyc8L2E+Jyk7XHJcblx0XHRcdCRsaS5hcHBlbmQoIG5ldyBuYXZTZWN0aW9uKCB7IGNvbGxlY3Rpb246IHpuaGcuc2hvcnRjb2Rlc01hbmFnZXIuc2hvcnRjb2Rlc0NvbGxlY3Rpb24uYnlTZWN0aW9uKCBzZWN0aW9uTmFtZSApIH0gKS5yZW5kZXIoKS4kZWwgKTtcclxuXHRcdFx0dGhpcy4kZWwuYXBwZW5kKCRsaSk7XHJcblx0XHR9LmJpbmQodGhpcykpO1xyXG5cdFx0cmV0dXJuIHRoaXM7XHJcblx0fSxcclxuXHR0b2dnbGVTZWN0aW9uIDogZnVuY3Rpb24oZSl7XHJcblx0XHR0aGlzLiRlbC5maW5kKCdsaScpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcclxuXHRcdGpRdWVyeShlLnRhcmdldCkucGFyZW50KCkuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xyXG5cdH1cclxufSk7Il19
