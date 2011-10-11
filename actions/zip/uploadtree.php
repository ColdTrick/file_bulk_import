<?php

	global $CONFIG;
	
	$container_guid = (int)get_input('container_guid');

	set_time_limit(0);

	$allowed_extensions = file_bulk_import_allowed_extensions();
	
	$parent_guid = (int)get_input('file_bulk_import_parent_guid');
	
	if (isset($_FILES['zip_file']) && !empty($_FILES['zip_file']['name'])) 
	{
		$extracted = false;
		
		$extension_array = explode('.', $_FILES['zip_file']['name']);	
		
		if(end($extension_array) == 'zip')
		{		
			$prefix = "file/";
			$file = $_FILES['zip_file'];
			
			if(!unzip($file, $parent_guid, $container_guid))
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