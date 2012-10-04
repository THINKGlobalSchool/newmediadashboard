<?php
/**
 * New Media Dashboard Library
 * 
 * @package NewMedia
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2012
 * @link http://www.thinkglobalschool.com/
 */

/**
 * Helper function to get and parse defined dashboard tags from
 * plugin settings
 * 
 * @return array
 */
function newmedia_get_dashboard_tags() {
	// Get tags from plugin settings
	$tags = elgg_get_plugin_setting('newmedia_tags', 'newmedia');
	
	$tags = explode("\n", $tags);
	$tags_array = array();
	foreach ($tags as $idx => $tag) {
		$tags[$idx] = explode("-", $tag);
		foreach ($tags[$idx] as $key => $info) {
				$tags[$idx][$key]= trim($info);
		}
		$tags_array[] = array(
			'name' => $tags[$idx][0],
			'tag' => $tags[$idx][1],
		);
	}
	return $tags_array;
}

/**
 * Helper function to get and parse defined dashboard subtypes form
 * plugin settings 
 * 
 * @return array
 */
function newmedia_get_dashboard_subtypes() {
	// Get tags from plugin settings
	$subtypes = elgg_get_plugin_setting('newmedia_subtypes', 'newmedia');
	
	if (!$subtypes) {
		return FALSE;
	}

	$subtypes = explode("\n", $subtypes);
	$subtypes_array = array();
	foreach ($subtypes as $subtype) {
		$subtypes_array[] = $subtype;
	}
	return $subtypes_array;
}

/**
 * Helper function to get and parse defined dashboard subtypes form
 * plugin settings 
 * 
 * @return array
 */
function newmedia_get_dashboard_terms() {
	// Get terms from plugin settings
	$terms = elgg_get_plugin_setting('newmedia_terms', 'newmedia');
	
	$terms = explode("\n", $terms);
	$terms_array = array();
	foreach ($terms as $idx => $term) {
		$terms[$idx] = explode("-", $term);
		foreach ($terms[$idx] as $key => $date) {
				$tags[$idx][$key]= trim($date);
		}

		// Make sure we have valid dates!
		if (!strtotime($terms[$idx][0]) || !strtotime($terms[$idx][1])) {
			continue; // Bail if we've got invalid dates in this term
		}

		$terms_array[] = array(
			'start' => $terms[$idx][0],
			'end' => $terms[$idx][1],
		);
	}
	return $terms_array;
}