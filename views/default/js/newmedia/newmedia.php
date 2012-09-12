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
	//console.log('NEW MEDIA');
}

elgg.register_hook_handler('init', 'system', elgg.newmedia.init);