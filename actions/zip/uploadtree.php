<?php

	global $CONFIG;
	
	$owner_guid = get_input('owner');

	set_time_limit(0);

	$allowed_extensions = file_bulk_import_allowed_extensions();
	
	$container_guid = get_input('container_guid', get_loggedin_userid());
	
	$parent_guid = get_input('file_bulk_import_parent_guid', 0);
	
	$page_owner = get_entity($container_guid); 
	
	if($page_owner instanceof ElggUser)
	{
		$access_id = get_default_access();
	}
	elseif($page_owner instanceof ElggGroup)
	{
		$access_id = $page_owner->group_acl;
	}
	else
	{
		forward(REFERER);
	}
	
	if (isset($_FILES['zip_file']) && !empty($_FILES['zip_file']['name'])) 
	{
		$extracted = false;
		
		$extension_array = explode('.', $_FILES['zip_file']['name']);	
		
		if(end($extension_array) == 'zip')
		{		
			$prefix = "file/";
			$file = $_FILES['zip_file'];
			
			if(!unzip($file, $parent_guid, $owner_guid))
			{
				register_error(elgg_echo('file_bulk_import:error:nofilesextracted'));
			}
			else
			{
				system_message(elgg_echo('file_bulk_import:error:fileuploadsuccess'));
			}
		}
		else
		{
			register_error(elgg_echo('file_bulk_import:error:nozipfilefound'));
		}
	}
	else
	{
		register_error(elgg_echo('file_bulk_import:error:nofilefound'));
	}
	
	forward(REFERER);