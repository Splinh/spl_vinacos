/**
 * HDA Admin Scripts
 *
 * Entry point — global admin pages (all admin screens).
 */

import '../styles/admin-core.scss';

jQuery(function ($) {
	// Notice dismiss handler
	$(document).on('click', '.notice-dismiss', function () {
		$(this)
			.closest('.notice.is-dismissible')
			.fadeOut(500, function () {
				$(this).remove();
			});
	});

	// Remove 'fixed' class from admin list tables (prevents sticky column issues).
	function unfixTables() {
		$('.wp-list-table.fixed, table.widefat.fixed, table.fixed').removeClass('fixed');
	}

	unfixTables();
	$(document).ajaxComplete(unfixTables);
});
