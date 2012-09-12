<?php
/**
 * New Media Dashboard Start
 * 
 * @package NewMedia
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2012
 * @link http://www.thinkglobalschool.com/
 */

elgg_register_event_handler('init', 'system', 'newmedia_init');

// Newmedia init
function newmedia_init() {
	// Register and load library
	elgg_register_library('newmedia', elgg_get_plugins_path() . 'newmedia/lib/newmedia.php');
	elgg_load_library('newmedia');
	
	// Register CSS
	$nm_css = elgg_get_simplecache_url('css', 'newmedia/css');
	elgg_register_simplecache_view('css/tagdashboards/css');	
	elgg_register_css('elgg.newmedia', $nm_css);
	
	// Register tag dashboards JS library
	$nm_js = elgg_get_simplecache_url('js', 'newmedia/newmedia');
	elgg_register_simplecache_view('js/newmedia/newmedia');	
	elgg_register_js('elgg.newmedia', $nm_js);
	
	// Add a new tab to the tabbed profile
	elgg_register_plugin_hook_handler('tabs', 'profile', 'newmedia_profile_tab_hander');
	
	// Ajax whitelist
	elgg_register_ajax_view('newmedia/dashboard/content');
}

/**
 * Handler to add a new media tab to the tabbed profile 
 */
function newmedia_profile_tab_hander($hook, $type, $value, $params) {
	$value[] = 'newmedia';
	return $value;
}
