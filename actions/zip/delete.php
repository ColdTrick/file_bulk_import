<?php

$zip_guid = get_input('guid');

if(!empty($zip_guid) && ($zip = get_entity($zip_guid)))
{
	if($zip->canEdit())
	{
		if($zip_files = $zip->getEntitiesFromRelationship('file_bulk_import_uploaded_zip_file', false, false, 0))
		{
			foreach($zip_files as $file)
			{
				$file->delete();
			}
		}
		
		$zip->delete();
		
		system_message(elgg_echo('file_bulk_import:error:zipdeletesuccess'));
	}
}
forward(REFERER);