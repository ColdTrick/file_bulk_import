<?php
	global $CONFIG;
	
	define("FILE_BULK_IMPORT_BASEURL", 			$CONFIG->wwwroot."pg/file_bulk_import/");
	
	define("FILE_BULK_IMPORT_UPLOADED_ZIP", 	"UploadedZip");	

	function file_bulk_import_init()
	{
		global $CONFIG;
		
		if(is_plugin_enabled('file'))
		{
			include_once(dirname(__FILE__)."/lib/functions.php");
			include_once(dirname(__FILE__)."/classes/UploadedZip.php");
				
			register_page_handler("file_bulk_import", 	"file_bulk_import_page_handler");
			
			elgg_extend_view("css", "file_bulk_import/css");
			elgg_extend_view("metatags", "file_bulk_import/metatags");
		}
	}
	
	function file_bulk_import_page_handler($page)
	{		
		global $CONFIG;
		
		if(!empty($page[2]))
		{
			set_input('username', $page[2]);
		}
		
		if($page[0] == 'proc')
		{
			if(file_exists(dirname(__FILE__)."/procedures/".$page[1]."/".$page[2].".php"))
			{
				include(dirname(__FILE__)."/procedures/".$page[1]."/".$page[2].".php");
				
			} else {
				echo json_encode(array('valid' => 0));
				exit;
			}
		}
		else 
		{
			if(file_exists(dirname(__FILE__)."/pages/".$page[0]."/".$page[1].".php"))
			{
				include(dirname(__FILE__)."/pages/".$page[0]."/".$page[1].".php");
			}
			else
			{
				forward(REFERER);
			}
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
				add_submenu_item(elgg_echo('file_bulk_import:upload:new'), FILE_BULK_IMPORT_BASEURL . "zip/upload/".$page_owner->username);
				add_submenu_item(elgg_echo('file_bulk_import:upload:uploadedzips'), FILE_BULK_IMPORT_BASEURL . "zip/list/".$page_owner->username);
			}
		}
		elseif(get_context() == 'file')
		{
			if (can_write_to_container($_SESSION['guid'], page_owner()) && isloggedin())
			{
				add_submenu_item(elgg_echo('file_bulk_import:upload:new'), FILE_BULK_IMPORT_BASEURL . "zip/upload/".$page_owner->username);
				add_submenu_item(elgg_echo('file_bulk_import:upload:uploadedzips'), FILE_BULK_IMPORT_BASEURL . "zip/list/".$page_owner->username);
			}
		}
	}

	// register default elgg events
	register_elgg_event_handler("init", "system", "file_bulk_import_init");
	register_elgg_event_handler("pagesetup", "system", "file_bulk_import_pagesetup");
	
	register_action("file_bulk_import/zip/upload", false,dirname(__FILE__)."/actions/zip/upload.php");
	register_action("file_bulk_import/zip/delete", false,dirname(__FILE__)."/actions/zip/delete.php");
	register_action("file_bulk_import/zip/bulkdelete", false,dirname(__FILE__)."/actions/zip/bulkdelete.php");