(function ($) {

	$.cymbupload = function(element,options) {
	
		var defaults = {
			size: 1024,
		};
		
		this.input = $("#"+element);
		
		this.settings = {};
		this.settings = $.extend({}, defaults, options);
		
		
		this.upload = function() {
			
			console.log($("#upload_form").serialize());
			var action = $("#upload_form").attr('action');
			$("#upload_form").submit(function () {
				$.ajax({
					type: "POST",
					url: action,
					data: $("#upload_form").serialize(),
					success: function(data) {
					
						console.log('success');
					},
					fail: function() {
						console.log('fail');
					}
				});
			});
			
		};
		
		
		
		
		//console.log(this.input);
		
		
		
		//$("#"+element).bind('change', this.upload());
			
		this.input.change(this.upload);
		
		
		return this;
	};

	$.fn.cymbupload = function () {
		console.log(this);
		
		$(this).bind('change',$.fn.cymbupload.test());
	};
	
	$.fn.cymbupload.test = function() {
		console.log('test');
	};
	
	/*$.widget('cymbupload', {
	
		options: {
			message : "Hello World",
		},
		_create: function() {
			this.test();
		},
		test: function() {
			console.log(this.options.message);
		},
	});*/

})(jQuery);