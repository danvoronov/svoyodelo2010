/*
 * jQuery Sliding Panel
 * version: 1.0.1 (2010-05-21)
 * @requires jQuery v1.3 or later
 * @requires jQueryUI v1.7 or later
 *
 * Examples and documentation at: http://site.pierrejeanparra.com/jquery-plugins/sliding-panel/
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
;(function($) {
	
	$.fn.slidingPanel = function(options) {
		var params, bindHover;
		
		if (!this.length) {
			return this;
		}
			
		$.slidingPanel = {
			defaults: {
				position: 'right',
				offset: 0,
				speed: 250,
				timeout: 500,
				hideTrigger: '.slidingpanel_hide_trigger',
				wrapperClass: 'slidingpanel_wrapper',
				slidingElementClass: 'slidingpanel_element',
				tabClass: 'slidingpanel_tab',
				wrapperTemplate: '<div></div>',
				tabTemplate: '<div></div>',
				tabText: 'E<br/>X<br/>A<br/>M<br/>P<br/>L<br/>E',
				openByDefault: true
			},
			show: function(slidingElement) {
				$.data(slidingElement, 'cancelHide', true);
				$(slidingElement).show('slide', {direction: params.position}, params.speed);
				$(slidingElement).closest('.' + params.wrapperClass).one('mouseleave', function() {
					$.slidingPanel.hide(slidingElement);
				});
			},
			hide: function(slidingElement) {
				$.data(slidingElement, 'cancelHide', false);
				setTimeout(function() {
					if (!$.data(slidingElement, 'cancelHide')) {
						$(slidingElement).hide('slide', {direction: params.position}, params.speed);
					}
				}, params.timeout);
				$(slidingElement).closest('.' + params.wrapperClass).one('mouseenter', function() {
					$.slidingPanel.show(slidingElement);
				});
			}
		};
		
		params = $.extend($.slidingPanel.defaults, options || {});
		 
		bindHover = function(slidingElement) {
			$(slidingElement).closest('.' + params.wrapperClass).one('mouseenter', function() {
				$.slidingPanel.show(slidingElement);
			});
		};
	
		return this.each(function() {
			var slidingElement = this,
				slidingElementCSS,
				wrapperCSS;
			
			switch (params.position) {
				case 'right':
					slidingElementCSS = {position: 'absolute', right: '0', marginRight: '16px'};
					wrapperCSS = {position: 'absolute', right: params.offset + 'px'};
					tabCSS = {position: 'absolute', right: '0'};
					break;
				case 'left':
					slidingElementCSS = {position: 'absolute', left: '0', marginLeft: '16px'};
					wrapperCSS = {position: 'absolute', left: params.offset + 'px'};
					tabCSS = {position: 'absolute', left: '0'};
					break;
			}
			
			$(slidingElement).addClass(params.slidingElementClass).css(slidingElementCSS).wrap($(params.wrapperTemplate).clone().addClass(params.wrapperClass))
				.closest('.slidingpanel_wrapper').css(wrapperCSS)
				.append($(params.tabTemplate).clone().addClass(params.tabClass).css(tabCSS).append(params.tabText));
			
			if (params.openByDefault) {
				$(params.hideTrigger).one('click', function() {
					$(slidingElement).hide('slide', {direction: params.position}, params.speed, function() {
						bindHover(slidingElement);
					});
				});
			}
			else {
				$(slidingElement).hide();
				bindHover(slidingElement);
			}
		});
	};

})(jQuery);