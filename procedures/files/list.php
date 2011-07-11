<?php

$return = array();

$return['valid'] = false;

$zip_guid = get_input('guid');

$return['guid'] = $zip_guid;

if(!empty($zip_guid) && ($zip = get_entity($zip_guid)))
{
	if($zip_files = $zip->getEntitiesFromRelationship('file_bulk_import_uploaded_zip_file', false, false, 0))
	{
		$return['count'] = count($zip_files);
	
		$return['content'] = '<h3 class="settings">'.count($zip_files).' '.elgg_echo('files').'</h3>';
		$return['content'] = '<div style="float: right; margin-right: 50px;">'.elgg_view('input/submit', array('value' => elgg_echo('file_bulk_import:deleteselectedfiles'), 'type' => 'submit')).'</div>';
		
		$return['content'] .= '<ul style="width: 60%">';
		$return['content'] .= '<li><input id="file_bulk_import_check_all_files" type="checkbox" name="check_all" /> '.elgg_echo('selectall').'</li>';
		foreach($zip_files as $file)
		{
			$return['content'] .= '<li><input type="checkbox" name="file_guids[]" value="'.$file->getGUID().'" /> <a href="'.$file->getURL().'">'.$file->title.'</a> <a style="float: right;" rel="'.$file->getGUID().'" class="file_bulk_import_zip_list_files_delete" href="javascript: void(0);">'.elgg_echo('delete').'</a></li>';
		}
		$return['content'] .= '</ul>';
		
		$return['valid'] = true;
	}
	
	
	$return['content'] = elgg_view('input/form', array(	'internalid' 	=> 'file_bulk_delete', 
														'internalname' 	=> 'file_bulk_delete', 
														'action' 		=> '/action/file_bulk_import/zip/bulkdelete',
														'body' 			=> $return['content']));
}

echo json_encode($return);
exit;