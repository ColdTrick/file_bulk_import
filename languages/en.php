<?php 

	$english = array(
		'zip_uploader:upload:new' => 'Upload zip file',
		'zip_uploader:upload:form:choose' => 'Choose file',
		
		//errors
		'zip_uploader:error:pageowner' => 'Error retrieving page owner.',
		'zip_uploader:error:nofilesextracted' => 'There were no allowed files found to extract.',
		'zip_uploader:error:cantopenfile' => 'Zip file couldn\'t be opened (check if the uploaded file is a .zip file).',
		'zip_uploader:error:nozipfilefound' => 'Uploaded file is not a .zip file.',
		'zip_uploader:error:nofilefound' => 'Choose a file to upload.',
	
		//messages
		'zip_uploader:error:fileuploadsuccess' => 'Zip file uploaded and extracted successfully.',
	
		//settings
		'zip_uploader:settings:allowed_extensions' => 'Allowed extension',
	);
	
	add_translation('en', $english);