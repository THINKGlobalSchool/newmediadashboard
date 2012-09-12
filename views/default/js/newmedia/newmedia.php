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
}

/**	
 * Load dashboard content 
 */
elgg.newmedia.loadDashboard = function() {
	var $container = $('#newmedia-dashboard-container');

	// Don't load unless we have the container
	if ($container.length) {
		var user_guid = $('input#newmedia-dashboard-user').val();
		var url = elgg.get_site_url() + 'ajax/view/newmedia/dashboard/content'


		elgg.get(url, {
			data: {
				user_guid: user_guid
			},
			success: function(data){
				$container.html(data);
			}
		});
	}
}

elgg.register_hook_handler('init', 'system', elgg.newmedia.init);