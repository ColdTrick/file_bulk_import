<?php 
	global $CONFIG;
	
	echo elgg_echo('zip_uploader:settings:allowed_extensions');
	echo elgg_view('input/text', array('internalname' => 'params[allowed_extensions]', 'value' => $vars['entity']->allowed_extensions)).'<br />';