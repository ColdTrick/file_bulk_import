<?php

$return['valid'] = false;
$file_guids = get_input('file_guids');

foreach($file_guids as $guid)
{
	if(!empty($guid) && ($file = get_entity($guid)))
	{
		if($file instanceof ElggFile)
		{
			if($file->canEdit())
			{
				$file->delete();
				
				$return['valid'] = true;
			}
		}
	}
}

echo json_encode($return);
exit;