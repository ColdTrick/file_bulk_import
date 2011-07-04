<?php
	global $CONFIG;
	
	define("FILE_BULK_IMPORT_BASEURL", 	$CONFIG->wwwroot."pg/file_bulk_import");
	
	include_once(dirname(__FILE__)."/lib/functions.php");

	function file_bulk_import_init()
	{
		global $CONFIG;
			
		register_page_handler("file_bulk_import", 	"file_bulk_import_page_handler");
	}
	
	function file_bulk_import_page_handler($page)
	{		
		global $CONFIG;
		
		if(!empty($page[2]))
		{
			set_input('username', $page[2]);
		}
		
		if(file_exists(dirname(__FILE__)."/pages/".$page[0]."/".$page[1].".php"))
		{
			include(dirname(__FILE__)."/pages/".$page[0]."/".$page[1].".php");
		}
		else
		{
			forward(REFERER);
		}
	}

	function file_bulk_import_pagesetup()
	{
		global $CONFIG;
		
		$page_owner = page_owner_entity();
		
		if(get_context() == 'file_bulk_import')
		{
			// Group submenu option	
			if ($page_owner instanceof ElggGroup && get_context() == "groups") {
    			if($page_owner->file_enable != "no"){ 
				    add_submenu_item(sprintf(elgg_echo("file:group"),$page_owner->name), $CONFIG->wwwroot . "pg/file/owner/" . $page_owner->username);
			    }
			}
				
			// General submenu options
			if ((page_owner() == $_SESSION['guid'] || !page_owner()) && isloggedin()) 
			{
				add_submenu_item(sprintf(elgg_echo("file:yours"),$page_owner->name), $CONFIG->wwwroot . "pg/file/owner/" . $page_owner->username);
				add_submenu_item(sprintf(elgg_echo('file:yours:friends'),$page_owner->name), $CONFIG->wwwroot . "pg/file/friends/". $page_owner->username);
			} 
			else if (page_owner()) 
			{
				add_submenu_item(sprintf(elgg_echo("file:user"),$page_owner->name), $CONFIG->wwwroot . "pg/file/owner/" . $page_owner->username);
				if ($page_owner instanceof ElggUser)
				{ 
					// This one's for users, not groups
					add_submenu_item(sprintf(elgg_echo('file:friends'),$page_owner->name), $CONFIG->wwwroot . "pg/file/friends/". $page_owner->username);
				}
			}
			
			add_submenu_item(elgg_echo('file:all'), $CONFIG->wwwroot . "pg/file/all/");
			if (can_write_to_container($_SESSION['guid'], page_owner()) && isloggedin())
			{
				add_submenu_item(elgg_echo('file:upload'), $CONFIG->wwwroot . "pg/file/new/". $page_owner->username);
				add_submenu_item(elgg_echo('file_bulk_import:upload:new'), FILE_BULK_IMPORT_BASEURL . "/upload/zip/".$page_owner->username);
			}
		}
		elseif(get_context() == 'file')
		{
			if (can_write_to_container($_SESSION['guid'], page_owner()) && isloggedin())
			{
				add_submenu_item(elgg_echo('file_bulk_import:upload:new'), FILE_BULK_IMPORT_BASEURL . "/upload/zip/".$page_owner->username);
			}
		}
	}

	// register default elgg events
	register_elgg_event_handler("init", "system", "file_bulk_import_init");
	register_elgg_event_handler("pagesetup", "system", "file_bulk_import_pagesetup");
	
	register_action("file_bulk_import/upload/zip", false,dirname(__FILE__)."/actions/upload/zip.php");