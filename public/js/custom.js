(function(){

	var Rewise = {

		init: function() {
			this.enableDatepicker();
			this.enableSelect();
			this.enableMarkdownEditor();
		},

		enableDatepicker: function() {
			var $datepicker = $('.datepicker');

			if ( !$datepicker.length ) { return; }

			$datepicker.each(function() {

				var $this = $(this);

				var options = {
					todayHighlight: true,
					format: 'mm/dd/yyyy'
				}

				if($this.data('plugin-options')) {
					$.extends(options, $this.data('plugin-options') );
				}

				$this.datepicker(options);

			});
		},

		enableSelect: function() {

			var $el = $('.selectpicker');

			if( !$el.length ) return ;


			$el.each(function(){

				var $this = $(this);

				$this.selectize({
					persist: false,
			    createOnBlur: true,
			    create: true
				});

			});

		},

		enableMarkdownEditor: function() {

			var $el = $('.markdown-editor');

			if( !$el.length ) return ;


			$el.each(function(){

				new SimpleMDE(this);

			});

		}

	};

	$(document).ready(function(){
		Rewise.init();
	});

})();
