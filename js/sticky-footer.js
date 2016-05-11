jQuery(function( $ ){
		$(window).load(function() {

			function stickyFooter() {
				var bodyHeight = $("body").height();
				var vwptHeight = $(window).height();
				if (vwptHeight > bodyHeight) {
					$(".site-footer").css("position","absolute").css("bottom",0);
					$(".nav-footer").css("position","absolute").css("bottom",37).css("width","100%");
					$(".site-footer, .nav-footer").addClass('sticky');
				}
				else {
					$(".site-footer").css("position","static");
					$(".site-footer").removeClass('sticky');
				}
			} stickyFooter();

			/*resize*/
			var isIE8 = $.browser.msie && +$.browser.version === 8;
			if (isIE8) {
				document.body.onresize = function () {
					stickyFooter();
				};
			} else {
				$(window).resize(function () {
					stickyFooter();
				});
			}

			// Orientation change
			window.addEventListener("orientationchange", function() {
				stickyFooter();
			});

	});
});