<?php
	echo elgg_view('input/securitytoken');
	
	$form_body .= '<label>'.elgg_echo("zip_uploader:upload:form:choose").'</label><br />';
	$form_body .= elgg_view("input/file",array('internalname' => 'zip_file')).'<br />';


	$form_body .= elgg_view('input/hidden', array('internalname' => 'container_guid', 'value' => page_owner_entity()->guid));
	
	$form_body .= elgg_view('input/submit', array('value' => elgg_echo('upload')));
	
	
	
	
	$form = elgg_view('input/form', array(	'internalid' 	=> 'file_bulk_import', 
											'internalname' 	=> 'file_bulk_import', 
											'action' 		=> $vars['url'].'action/file_bulk_import/upload/zip', 
											'enctype' 		=> 'multipart/form-data', 
											'body' 			=> $form_body));
	
	echo elgg_view('page_elements/contentwrapper', array('body' => $form));