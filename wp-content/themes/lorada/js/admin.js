/**
 *	Admin JS
 */

jQuery(document).ready(function($) {
	'use strict';

	/* Nav Menu Style */
	function lorada_menu_style(selected_val) {
		if ( 'default-menu' != selected_val.val() ) {
			if ( 'full-width-mega' == selected_val.val() ) {
				selected_val.parents('.menu-item-settings').find('p.field-size-width').css('display', 'none');
				selected_val.parents('.menu-item-settings').find('p.field-size-height').css('display', 'none');
				selected_val.parents('.menu-item-settings').find('p.field-html-block').css('display', 'block');
			} else if ( 'sized-mega' == selected_val.val() ) {
				selected_val.parents('.menu-item-settings').find('p.field-size-width').css('display', 'block');
				selected_val.parents('.menu-item-settings').find('p.field-size-height').css('display', 'block');
				selected_val.parents('.menu-item-settings').find('p.field-html-block').css('display', 'block');
			}
		} else {
			selected_val.parents('.menu-item-settings').find('p.field-size-width').css('display', 'none');
			selected_val.parents('.menu-item-settings').find('p.field-size-height').css('display', 'none');
			selected_val.parents('.menu-item-settings').find('p.field-html-block').css('display', 'none');
		}
	}

	$('p.field-menu-style .edit-menu-item-style').each(function() {
		lorada_menu_style($(this));

		$(this).on('change', function() {
			lorada_menu_style($(this));
		});
	});
});

/* Dummy Import */
jQuery(function($) {
	"use strict";

	function alertLeavePage(e) {
		var dialogText = "Are you sure you want to leave?";
		e.returnValue = dialogText;
		return dialogText;
	}

	function addAlertLeavePage() {
		$('.import-demo-area .lorada-install-demo-button').attr('disabled', 'disabled');
		$(window).bind('beforeunload', alertLeavePage);
	}

	function removeAlertLeavePage() {
		$('.import-demo-area .lorada-install-demo-button').removeAttr('disabled');
		$(window).unbind('beforeunload', alertLeavePage);
		setTimeout(function() {
			$('.lorada-demo-import #import-status').slideUp().html('');
		}, 3000);
	}

	function showImportMessage(selected_demo, message, count, index) {
		var html = '',
			percent = 0;

		if (selected_demo) {
			html += '<h3>Installing ' + $('#' + selected_demo).html() + '</h3>';
		}
		if (message) {
			html += '<strong>' + message + '</strong>';
		}
		if (count && index) {
			percent = parseInt( index / count * 100 );
			if (percent > 100) {
				percent = 100;
			}

			html += '<div class="import-progress-bar" data-progress="' + percent + '"><div style="width:' + percent + '%;"></div></div>';
		}
		$('.lorada-demo-import #import-status').stop().show().html(html);
	}

	// install demo
	$('.lorada-install-demo-button').on( 'click', function(e) {
		e.preventDefault();

		var $this = $(this),
			selected_demo = $this.data('demo-id'),
			disabled = $this.attr('disabled');

		if ( disabled ) {
			return;
		}

		addAlertLeavePage();

		$('#lorada-install-demo-type').val(selected_demo);
		$('#lorada-install-options').slideDown();
		$('.import-success.importer-notice').slideUp();

		$('html, body').stop().animate({
			scrollTop: $('#lorada-install-options').offset().top - 50
		}, 600);
	} );

	$('.lorada-install-demo-button[disabled="disabled"]').on('click', function(e) {
		e.preventDefault();

		return;
	});

	// cancel import button
	$('#lorada-import-no').click(function() {
		$('#lorada-install-options').slideUp();
		removeAlertLeavePage();
	});

	// import
	$('#lorada-import-yes').click(function() {
		var demo = $('#lorada-install-demo-type').val(),
			options = {
				demo: demo,
				reset_menus: $('#lorada-reset-menus').is(':checked'),
				reset_widgets: $('#lorada-reset-widgets').is(':checked'),
				import_dummy: $('#lorada-import-dummy').is(':checked'),
				import_widgets: $('#lorada-import-widgets').is(':checked'),
				import_options: $('#lorada-import-options').is(':checked'),
			};

		if (options.demo) {
			showImportMessage(demo, '');
			lorada_import_options(options);
		}
		$('#lorada-install-options').slideUp();
	});

	// import options
	function lorada_import_options(options) {
		if ( ! options.demo ) {
			removeAlertLeavePage();
			return;
		}
		if ( options.import_options ) {
			var demo = options.demo,
				data = {'action': 'lorada_import_options', 'demo': demo};

			showImportMessage(demo, 'Importing theme options');

			$.post(ajaxurl, data, function(response) {
				if ( response ) {
					showImportMessage(demo, response);
				}
				lorada_reset_menus(options);
			})
			.fail(function(response) {
				lorada_reset_menus(options);
			});
		} else {
			lorada_reset_menus(options);
		}
	}

	// reset_menus
	function lorada_reset_menus(options) {
		if ( ! options.demo ) {
			removeAlertLeavePage();
			return;
		}
		if ( options.reset_menus ) {
			var demo = options.demo,
				data = {'action': 'lorada_reset_menus'};

			$.post(ajaxurl, data, function(response) {
				if (response) showImportMessage(demo, response);
				lorada_reset_widgets(options);
			}).fail(function(response) {
				lorada_reset_widgets(options);
			});
		} else {
			lorada_reset_widgets(options);
		}
	}

	// reset widgets
	function lorada_reset_widgets(options) {
		if ( ! options.demo ) {
			removeAlertLeavePage();
			return;
		}
		if ( options.reset_widgets ) {
			var demo = options.demo,
				data = {'action': 'lorada_reset_widgets'};

			$.post(ajaxurl, data, function(response) {
				if (response) showImportMessage(demo, response);
				lorada_import_dummy(options);
			}).fail(function(response) {
				lorada_import_dummy(options);
			});
		} else {
			lorada_import_dummy(options);
		}
	}

	// import dummy content
	var dummy_index = 0, dummy_count = 0, dummy_process = 'import_start';
	function lorada_import_dummy(options) {
		if ( ! options.demo ) {
			removeAlertLeavePage();
			return;
		}
		if ( options.import_dummy ) {
			var demo = options.demo,
				data = {'action': 'lorada_import_dummy', 'process':'import_start', 'demo': demo};

			dummy_index = 0;
			dummy_count = 0;
			dummy_process = 'import_start';
			lorada_import_dummy_process(options, data);
		} else {
			lorada_import_widgets(options);
		}
	}

	// import dummy content process
	function lorada_import_dummy_process(options, args) {
		var demo = options.demo;
		$.post(ajaxurl, args, function(response) {
			if ( response && /^[\],:{}\s]*$/.test(response.replace(/\\["\\\/bfnrtu]/g, '@' ).
				replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
				replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
				response = $.parseJSON(response);
				if (response.process != 'complete') {
					var requests = {'action': 'lorada_import_dummy'};
					if (response.process) requests.process = response.process;
					if (response.index) requests.index = response.index;

					requests.demo = demo;
					lorada_import_dummy_process(options, requests);

					dummy_index = response.index;
					dummy_count = response.count;
					dummy_process = response.process;

					showImportMessage(demo, response.message, dummy_count, dummy_index);
				} else {
					showImportMessage(demo, response.message);
					lorada_import_widgets(options);
				}
			} else {
				showImportMessage(demo, 'Failed importing! Please check the "System Status" tab to ensure your server meets all requirements for a successful import. Settings that need attention will be listed in red.');
				lorada_import_widgets(options);
			}
		}).fail(function(response) {
			if ( dummy_index < dummy_count ) {
				var requests = {'action': 'lorada_import_dummy'};
				requests.process = dummy_process;
				requests.index = ++dummy_index;
				requests.demo = demo;

				lorada_import_dummy_process(options, requests);
			} else {
				var requests = {'action': 'lorada_import_dummy'};
				requests.process = dummy_process;
				requests.demo = demo;

				lorada_import_dummy_process(options, requests);
			}
		});
	}

	// import widgets
	function lorada_import_widgets(options) {
		if ( ! options.demo ) {
			removeAlertLeavePage();
			return;
		}
		if ( options.import_widgets ) {
			var demo = options.demo,
				data = {'action': 'lorada_import_widgets', 'demo': demo};

			showImportMessage(demo, 'Importing widgets');

			$.post(ajaxurl, data, function(response) {
				if (response) showImportMessage(demo, response);
				lorada_import_finished(options);
			}).fail(function(response) {
				lorada_import_finished(options);
			});
		} else {
			lorada_import_finished(options);
		}
	}

	// import finished
	function lorada_import_finished(options) {
		if ( ! options.demo ) {
			removeAlertLeavePage();
			return;
		}

		var demo = options.demo;

		showImportMessage(demo, 'Import Finished!');
		setTimeout(removeAlertLeavePage, 600);

		$('.import-success.importer-notice').slideDown();
	}
});
