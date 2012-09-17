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

$terms = newmedia_get_dashboard_terms();

$terms_values = array(0 => 'All');

foreach ($terms as $term) {
	$start = strtotime($term['start']);
	$end = strtotime($term['end']);

	$title = date('F jS Y', $start) . " - " . date('F jS Y', $end);

	$terms_values["[$start,$end]"] = $title;
}

$term_label = elgg_echo('newmedia:label:termselect');
$term_input = elgg_view('input/dropdown', array(
	'name' => 'dashboard_term_input',
	'id' => 'newmedia-dashboard-term',
	'options_values' => $terms_values,
));

$title = elgg_view_title(elgg_echo('newmedia:label:dashboard', array($page_owner->name)));

$user_input = elgg_view('input/hidden', array(
	'name' => 'dashboard_user_input', 
	'id' => 'newmedia-dashboard-user', 
	'value' => $page_owner->guid,
));

$lower_input = elgg_view('input/hidden', array(
	'name' => 'lower_input',
	'id' => 'newmedia-lower-date',
	'value' => ELGG_ENTITIES_ANY_VALUE,
));

$upper_input = elgg_view('input/hidden', array(
	'name' => 'upper_input',
	'id' => 'newmedia-upper-date',
	'value' => ELGG_ENTITIES_ANY_VALUE,
));

$achievements_title = elgg_view_title(elgg_echo('newmedia:label:achievements'));
$achievements = elgg_get_config('achievements');

$new_media_achievements = array();

foreach ($achievements['classes'] as $name => $info) {
	if ($info['type'] == 'newmedia') {
		$a = new $name();
		foreach($a->getAchievementNames() as $a_name) {
			$new_media_achievements[] = $a_name;
		}
	}
}

$user_achievements = get_user_achievements($page_owner);

$new_media_achievements = array_intersect($new_media_achievements, $user_achievements);

if (!$new_media_achievements || empty($new_media_achievements)) {
	$achievements_content .= "<label>" . elgg_echo('achievements:label:none') . "</label>";
} else {
	foreach ($new_media_achievements as $achievement) {
		$name = strtolower($achievement);
		$achievements_content .= elgg_view("achievements/achievement", array('name' => $name, 'view_type' => 'gallery'));
	}
}

$content = <<<HTML
	<div style='float: left;'>
		$title
	</div>
	<div class='clearfix'></div>
	<hr class='newmedia' />
	$user_input
	<label>$term_label</label>
	$term_input
	<br />
	$lower_input
	$upper_input
	<div id='newmedia-dashboard-container'></div>
	<hr class='newmedia' />
	<div style='clear: both;'>
		$achievements_title
		$achievements_content
	</div>
HTML;

echo $content;