<?php 

	$english = array(
		'file_bulk_import:upload:new' => 'Upload zip file',
		'file_bulk_import:upload:form:choose' => 'Choose file',
		
		//errors
		'file_bulk_import:error:pageowner' => 'Error retrieving page owner.',
		'file_bulk_import:error:nofilesextracted' => 'There were no allowed files found to extract.',
		'file_bulk_import:error:cantopenfile' => 'Zip file couldn\'t be opened (check if the uploaded file is a .zip file).',
		'file_bulk_import:error:nozipfilefound' => 'Uploaded file is not a .zip file.',
		'file_bulk_import:error:nofilefound' => 'Choose a file to upload.',
	
		//messages
		'file_bulk_import:error:fileuploadsuccess' => 'Zip file uploaded and extracted successfully.',
	
		//settings
		'file_bulk_import:settings:allowed_extensions' => 'Allowed extensions (comma seperated)',
	);
	
	add_translation('en', $english);