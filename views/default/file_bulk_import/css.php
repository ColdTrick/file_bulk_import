<?php 
	$graphics_folder = $vars["url"] . "mod/file_bulk_import/_graphics/";
?>
.file_bulk_import_list_zip
{
	padding: 10px;
    margin: 0 10px 5px;
	
	background: none repeat scroll 0 0 white;
    border-radius: 8px 8px 8px 8px;
}

.file_bulk_import_list_zip_icon
{
	float: left;
	height: 35px;
	width: 35px;
	margin-right: 5px;
	background-image: url(<?php echo $graphics_folder;?>icons/zip_icon.png);
}

.file_bulk_import_list_zip_info
{
	float: left;
}

.timecreated
{
	color: #666666;
}

.file_bulk_import_list_zip_tools
{
	float: right;
}

.file_bulk_import_list_files
{
	float: left;
	display: none;
	width: 100%;
	padding: 10px;
	height: 100px;
	
	background-image: url(<?php echo $graphics_folder;?>ajax_loader.gif);
	background-repeat: no-repeat;
	background-position: 50% 50%;
}

.file_bulk_import_list_files ul
{
	list-style: none;
}

#file_bulk_delete ul
{
	margin: 0px;
	padding: 0px;
}