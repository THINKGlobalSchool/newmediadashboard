<?php
/**
 * New Media Dashboard Plugin Settings
 * 
 * @package NewMedia
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2012
 * @link http://www.thinkglobalschool.com/
 */

// Tags input (Enter as: title -> tag)
$newmedia_tags_label = elgg_echo('newmedia:label:tagsettings');
$newmedia_tags_input = elgg_view('input/plaintext', array(
	'name' => 'params[newmedia_tags]', 
	'value' => $vars['entity']->newmedia_tags)
);

// Subtypes input (Enter one per line)
$newmedia_subtypes_label = elgg_echo('newmedia:label:subtypesettings');
$newmedia_subtypes_input = elgg_view('input/plaintext', array(
	'name' => 'params[newmedia_subtypes]', 
	'value' => $vars['entity']->newmedia_subtypes)
);

$content = <<<HTML
	<br />
	<div>
		<label>$newmedia_tags_label</label><br />
		$newmedia_tags_input
	</div>
	<div>
		<label>$newmedia_subtypes_label</label><br />
		$newmedia_subtypes_input
	</div>
HTML;

echo $content;