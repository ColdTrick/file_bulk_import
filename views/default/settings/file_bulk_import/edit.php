<?php 
	global $CONFIG;
	
	echo elgg_echo('file_bulk_import:settings:allowed_extensions');
	if(!empty($vars['entity']->allowed_extensions))
	{
		$value = $vars['entity']->allowed_extensions;
	}
	else
	{
		$value = 'txt,jpg,jpeg,png,bmp,gif,pdf,doc,docx,xls,xlsx,pptx';
	}
	echo elgg_view('input/text', array('internalname' => 'params[allowed_extensions]', 'value' => $value)).'<br />';