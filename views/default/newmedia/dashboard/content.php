<?php
/**
 * New Media Dashboard Content
 * 
 * @package NewMedia
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2012
 * @link http://www.thinkglobalschool.com/
 */

$user = get_entity(elgg_extract('user_guid', $vars));

$lower_date = elgg_extract('lower_date', $vars);
$upper_date = elgg_extract('upper_date', $vars);

$tags = newmedia_get_dashboard_tags();
$subtypes = newmedia_get_dashboard_subtypes();

$tags_array = array();

foreach ($tags as $tag) {
	$tags_array[] = $tag['tag'];
	$titles_array[] = $tag['name'] . " (" . $tag['tag'] . ")";
}

if (elgg_instanceof($user, 'user')) {

	// Tag Dashboard Content inputs
	$td_type_input = elgg_view('input/hidden', array(
		'name' => 'type', 
		'id' => 'type', 
		'value' => 'custom',
	));

	$td_subtypes_input = elgg_view('input/hidden', array(
		'name' => 'subtypes', 
		'id' => 'subtypes', 
		'value' => json_encode($subtypes)
	));
	
	$td_custom_input = elgg_view('input/hidden', array(
		'name' => 'custom_tags',
		'id' => 'custom_tags',
		'value' => json_encode($tags_array)
	));
	
	$td_custom_titles_input = elgg_view('input/hidden', array(
		'name' => 'custom_titles',
		'id' => 'custom_titles',
		'value' => json_encode($titles_array)
	));

	$td_search_input = elgg_view('input/hidden', array(
		'name' => 'search', 
		'id' => 'search', 
		'value' => '',
	));

	$td_owner_guids_input = elgg_view('input/hidden', array(
		'name' => 'owner_guids', 
		'id' => 'owner_guids', 
		'value' => json_encode(array($user->guid))
	));
	
	$td_lower_input = elgg_view('input/hidden', array(
		'name' => 'lower_date', 
		'id' => 'lower_date', 
		'value' => $lower_date,
	));
	
	$td_upper_input = elgg_view('input/hidden', array(
		'name' => 'upper_date', 
		'id' => 'upper_date', 
		'value' => $upper_date,
	));

	$content .= <<<HTML
		<div class='clearfix'></div>
		<div class='tagdashboard-container'>
			<div class='tagdashboard-options'>
				$td_type_input
				$td_subtypes_input
				$td_custom_input
				$td_custom_titles_input
				$td_search_input
				$td_owner_guids_input
				$td_lower_input
				$td_upper_input
			</div>
			<div class='tagdashboards-content-container'></div>
		</div>
		<script type='text/javascript'>
			// Init Dashboard
			elgg.tagdashboards.init();
		</script>
HTML;
} else {
	elgg_echo('tagdashboards:error:invaliduser');
}

echo $content;