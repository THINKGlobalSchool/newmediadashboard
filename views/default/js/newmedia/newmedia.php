<?php
/**
 * New Media Dashboard JS Library
 * 
 * @package NewMedia
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2012
 * @link http://www.thinkglobalschool.com/
 */
?>
//<script>
elgg.provide('elgg.newmedia');

// Init function
elgg.newmedia.init = function () {
	// Ajax load the portfolio content
	elgg.newmedia.loadDashboard();
	
	// Delegate event handle for term select change
	$(document).delegate('#newmedia-dashboard-term', 'change', elgg.newmedia.termChange);
}

/**	
 * Load dashboard content 
 */
elgg.newmedia.loadDashboard = function() {
	var $container = $('#newmedia-dashboard-container');

	// Don't load unless we have the container
	if ($container.length) {
		var user_guid = $('input#newmedia-dashboard-user').val();
		var lower_date = $('#newmedia-lower-date').val();
		var upper_date = $('#newmedia-upper-date').val();
		
		var url = elgg.get_site_url() + 'ajax/view/newmedia/dashboard/content'

		elgg.get(url, {
			data: {
				user_guid: user_guid,
				lower_date: lower_date,
				upper_date: upper_date
			},
			success: function(data){
				$container.html(data);
			}
		});
	}
}

/**
 * Term select change handler
 */
elgg.newmedia.termChange = function(event) {
	var value = $(this).val();
	
	if (value && value != "0") {
		var array = eval(value);
		$('#newmedia-lower-date').val(array[0]);
		$('#newmedia-upper-date').val(array[1]);		
	} else {
		$('#newmedia-lower-date').val(null);
		$('#newmedia-upper-date').val(null);
	}
	
	elgg.newmedia.loadDashboard();
	
	event.preventDefault();
}

elgg.register_hook_handler('init', 'system', elgg.newmedia.init);