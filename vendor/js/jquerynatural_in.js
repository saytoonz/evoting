(function($) {

			'use strict';

			$('.modal-with-move-anim').magnificPopup({
				type: 'inline',

				fixedContentPos: false,
				fixedBgPos: true,

				overflowY: 'auto',

				closeBtnInside: true,
				preloader: false,

				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-slide-bottom',
				modal: true
			});

	/*
	Modal Dismiss
	*/
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});


}).apply(this, [jQuery]);

		
		$(document).ready(function() {
			
			$('input:radio[id="power1"]').change(function(){
				if ($(this).is(':checked') && $(this).val() == 'student') {
					$('label.opt1').html('Index Number');
					$('.admin-pass').hide('fadeInDown');
				}
				
			});

			$('input:radio[id="power3"]').change(function(){
				if ($(this).is(':checked') && $(this).val() == 'staff') {
					$('label.opt1').html('Staff ID');
					$('.admin-pass').hide('fadeInDown');
				}
				
			});
			$('input:radio[id="power2"]').change(function(){
				if ($(this).is(':checked') && $(this).val() == 'administrator') {
					$('label.opt1').html('Admin ID');
					$('.admin-pass').show('fadeInUp');
					$('#password').attr('required','required');
				}
				
			});

			
		});