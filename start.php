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
	// Register CSS
	$nm_css = elgg_get_simplecache_url('css', 'newmedia/css');
	elgg_register_simplecache_view('css/tagdashboards/css');	
	elgg_register_css('elgg.newmedia', $nm_css);
	
	// Register tag dashboards JS library
	$nm_js = elgg_get_simplecache_url('js', 'newmedia/newmedia');
	elgg_register_simplecache_view('js/newmedia/newmedia');	
	elgg_register_js('elgg.newmedia', $nm_js);
	
	// Temp..
	elgg_load_js('elgg.newmedia');
	elgg_load_css('elgg.newmedia');
	
	// Add a new tab to the tabbed profile
	elgg_register_plugin_hook_handler('tabs', 'profile', 'newmedia_profile_tab_hander');
}

/**
 * Handler to add a new media tab to the tabbed profile 
 */
function newmedia_profile_tab_hander($hook, $type, $value, $params) {
	$value[] = 'newmedia';
	return $value;
}
