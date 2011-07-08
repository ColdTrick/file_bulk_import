<?php

$zip = $vars["entity"];

if($zip)
{
	$owner = $zip->getOwnerEntity();
	$container = $zip->getContainerEntity();
	
	$friendlytime = elgg_view_friendly_time($zip->time_created);

	echo '	<div class="file_bulk_import_list_zip">
				<div class="file_bulk_import_list_zip_icon"></div>
				<div class="file_bulk_import_list_zip_info"><a href="javascript: void(0);" rel="'.$zip->getGUID().'" loaded="false">'.$zip->title.'</a> <span class="timecreated">'.elgg_echo('file_bulk_import:list:uploaded').' '.$friendlytime.'</span></div> 
				<div class="file_bulk_import_list_zip_tools"><a onclick="javascript: if(!confirm(\''.addslashes(elgg_echo('file_bulk_import:deletezipandfiles:confirmtext')).'\')){return false;}" class="file_bulk_import_zip_delete" href="'.elgg_add_action_tokens_to_url('/action/file_bulk_import/zip/delete?guid='.$zip->getGUID()).'" title="('.elgg_echo('file_bulk_import:allfilesincluded').')">'.elgg_echo('delete').'</a></div>
				<div class="file_bulk_import_list_files" id="files_'.$zip->getGUID().'"></div>
				<div class="clearfloat"></div>
			</div>';
}