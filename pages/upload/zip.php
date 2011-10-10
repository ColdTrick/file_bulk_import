<?php 

	gatekeeper();	
	
	$page_owner = page_owner_entity();
		
	if($page_owner)
	{
		$title_text = elgg_echo("zip_uploader:upload:new");
		
		$form = elgg_view("file_bulk_import/forms/zip/upload");
	
		$title = elgg_view_title($title_text . $back_text);
		
		$page_data = $title . $form;
		
		$body = elgg_view_layout("two_column_left_sidebar", "", $page_data);
		
		page_draw($title_text, $body);
	}
	else 
	{
		register_error(elgg_echo("zip_uploader:error:pageowner"));
		forward();
	}