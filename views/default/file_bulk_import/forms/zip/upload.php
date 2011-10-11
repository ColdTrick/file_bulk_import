<?php
	echo elgg_view('input/securitytoken');
	
	$form_body .= '<label>'.elgg_echo("file_bulk_import:upload:form:choose").'</label><br />';
	$form_body .= elgg_view("input/file",array('internalname' => 'zip_file')).'<br />';
	
	
	
	if(is_plugin_enabled('file_tree'))
	{
		$folders = file_bulk_import_get_folders(page_owner_entity()->guid);
		$options = file_bulk_import_build_select_options($folders);
		
		$form_body .= '<select name="file_bulk_import_parent_guid">' . $options . '</select><br />';
		
		$action = $vars['url'].'action/file_bulk_import/zip/uploadtree';
	}
	else
	{
		$action = $vars['url'].'action/file_bulk_import/zip/upload';
	}

	$form_body .= elgg_view('input/hidden', array('internalname' => 'container_guid', 'value' => page_owner_entity()->guid));
	
	$form_body .= elgg_view('input/submit', array('value' => elgg_echo('upload')));
	
	
	
	
	$form = elgg_view('input/form', array(	'internalid' 	=> 'file_bulk_import', 
											'internalname' 	=> 'file_bulk_import', 
											'action' 		=> $action, 
											'enctype' 		=> 'multipart/form-data', 
											'body' 			=> $form_body));
	
	echo elgg_view('page_elements/contentwrapper', array('body' => $form));