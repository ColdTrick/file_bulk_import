<?php 

	$allowed_extensions = zip_uploader_allowed_extensions();
	
	$container_guid = get_input('container_guid', get_loggedin_userid());
	
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
			$file = $_FILES['zip_file']['tmp_name'];
			
			if($zip = zip_open($file))
			{
				while($zip_entry = zip_read($zip)) 
				{
					if(zip_entry_filesize($zip_entry)>0)
					{
						$name_array = explode('/', zip_entry_name($zip_entry));						
						$extension_array = explode('.', end($name_array));
						
						$file_name 					= end($name_array);
						$file_extension				= end($extension_array);
						$file_size 					= zip_entry_filesize($zip_entry);
						$file_size_compressed 		= zip_entry_compressedsize($zip_entry);
						$file_compression_method 	= zip_entry_compressionmethod($zip_entry);
		
						if(zip_entry_open($zip, $zip_entry, "r")) 
						{
							if(in_array($file_extension, $allowed_extensions))
							{
					           	$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
					           	
								$filehandler = new ElggFile();
									$filehandler->setFilename($prefix . $file_name);
																	
									$filehandler->title 			= $file_name;
									$filehandler->originalfilename 	= $file_name;	
									
									$filehandler->container_guid 	= $container_guid;								
									$filehandler->access_id 		= $access_id;
	
									$filehandler->open("write");
									$filehandler->write($buf);
									$filehandler->save();
								
								$filehandler->close();
			        
								zip_entry_close($zip_entry);
								
								$extracted = true;
							}
						}
					}
				}
			
				zip_close($zip);
				
				if($extracted)
				{
					system_message(elgg_echo('zip_uploader:error:fileuploadsuccess'));
				}
				else
				{
					register_error(elgg_echo('zip_uploader:error:nofilesextracted'));
				}
			}
			else
			{
				register_error(elgg_echo('zip_uploader:error:cantopenfile'));
			}
		}
		else
		{
			register_error(elgg_echo('zip_uploader:error:nozipfilefound'));
		}
	}
	else
	{
		register_error(elgg_echo('zip_uploader:error:nofilefound'));
	}
	
	forward(REFERER);