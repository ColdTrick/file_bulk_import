<?php

$return = array();

$return['valid'] = false;

$file_guid = get_input('guid');

if(!empty($file_guid) && ($file = get_entity($file_guid)))
{
	if($file instanceof ElggFile)
	{
		$file->delete();
		
		$return['valid'] = true;
	}
}

echo json_encode($return);
exit;