<?php 

	gatekeeper();	
	
	$page_owner = page_owner_entity();
		
	if($page_owner)
	{
		$title_text = elgg_echo("file_bulk_import:upload:uploadedzips");
	
		$title = elgg_view_title($title_text . $back_text);
		
		$entities_options = array(
			'type' 			=> 'object',
			'subtype' 		=> 'uploadedzip',
			'container_guid'=> $page_owner->getGUID(),
		);
		
		$zip_files = elgg_get_entities($entities_options);
		
		$entities_options['count'] = true;
		
		$zip_files_count = elgg_get_entities($entities_options);
		
		if($zip_files_count>0)
		{
			$content = elgg_view_entity_list($zip_files, $zip_files_count);
		}
		else
		{
			$content = elgg_view('page_elements/contentwrapper', array('body' => elgg_echo('file_bulk_import:nofilesfound')));
		}
		
		$page_data = $title . $content;
		
		$body = elgg_view_layout("two_column_left_sidebar", "", $page_data);
		
		page_draw($title_text, $body);
	}
	else 
	{
		register_error(elgg_echo("file_bulk_import:error:pageowner"));
		forward();
	}