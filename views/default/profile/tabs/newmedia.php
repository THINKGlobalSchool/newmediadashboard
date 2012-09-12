<?php
/**
 * New Media Dashboard Profile Tab
 * 
 * @package NewMedia
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2012
 * @link http://www.thinkglobalschool.com/
 */

// Load JS/CSS
elgg_load_js('elgg.newmedia');
elgg_load_css('elgg.newmedia');
elgg_load_js('elgg.tagdashboards');
elgg_load_css('elgg.tagdashboards');

$page_owner = elgg_get_page_owner_entity();

$title = elgg_view_title(elgg_echo('newmedia:label:dashboard', array($page_owner->name)));

$user_input = elgg_view('input/hidden', array(
	'name' => 'dashboard_user_input', 
	'id' => 'newmedia-dashboard-user', 
	'value' => $page_owner->guid,
));

$content = <<<HTML
	<div style='float: left;'>
		$title
	</div>
	$user_input
	<div id='newmedia-dashboard-container'></div>
HTML;

echo $content;