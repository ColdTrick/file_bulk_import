<?php 

	$english = array(
		'file_bulk_import:upload:new' => 'Upload zip file',
		'file_bulk_import:upload:uploadedzips' => 'View uploaded zip files',
		'file_bulk_import:upload:form:choose' => 'Choose file',
	
		'file_bulk_import:list:uploaded' => 'Uploaded',
	
		'file_bulk_import:allfilesincluded' => 'all files included',
		'file_bulk_import:deleteselectedfiles' => 'delete selected files',
		'file_bulk_import:nofilesfound' => 'No zip files uploaded.',
		'file_bulk_import:confirmtext' => 'Are you sure?',
		'file_bulk_import:deletezipandfiles:confirmtext' => 'Are you sure you want to remove this zip and all it\'s files?',
		
		//errors
		'file_bulk_import:error:pageowner' => 'Error retrieving page owner.',
		'file_bulk_import:error:nofilesextracted' => 'There were no allowed files found to extract.',
		'file_bulk_import:error:cantopenfile' => 'Zip file couldn\'t be opened (check if the uploaded file is a .zip file).',
		'file_bulk_import:error:nozipfilefound' => 'Uploaded file is not a .zip file.',
		'file_bulk_import:error:nofilefound' => 'Choose a file to upload.',
	
		//messages
		'file_bulk_import:error:fileuploadsuccess' => 'Zip file uploaded and extracted successfully.',
		'file_bulk_import:error:zipdeletesuccess' => 'Zip and it\'s files successfully deleted.',
	
		//settings
		'file_bulk_import:settings:allowed_extensions' => 'Allowed extensions (comma seperated)',
	
		'selectall' => 'select all',
	);
	
	add_translation('en', $english);