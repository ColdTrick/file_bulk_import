<?php 

	function zip_file_error_message($errno)
	{
		$zipFileFunctionsErrors = array(
		'ZIPARCHIVE::ER_MULTIDISK' => 'Multi-disk zip archives not supported.',
		'ZIPARCHIVE::ER_RENAME' => 'Renaming temporary file failed.',
		'ZIPARCHIVE::ER_CLOSE' => 'Closing zip archive failed',
		'ZIPARCHIVE::ER_SEEK' => 'Seek error',
		'ZIPARCHIVE::ER_READ' => 'Read error',
		'ZIPARCHIVE::ER_WRITE' => 'Write error',
		'ZIPARCHIVE::ER_CRC' => 'CRC error',
		'ZIPARCHIVE::ER_ZIPCLOSED' => 'Containing zip archive was closed',
		'ZIPARCHIVE::ER_NOENT' => 'No such file.',
		'ZIPARCHIVE::ER_EXISTS' => 'File already exists',
		'ZIPARCHIVE::ER_OPEN' => 'Can\'t open file',
		'ZIPARCHIVE::ER_TMPOPEN' => 'Failure to create temporary file.',
		'ZIPARCHIVE::ER_ZLIB' => 'Zlib error',
		'ZIPARCHIVE::ER_MEMORY' => 'Memory allocation failure',
		'ZIPARCHIVE::ER_CHANGED' => 'Entry has been changed',
		'ZIPARCHIVE::ER_COMPNOTSUPP' => 'Compression method not supported.',
		'ZIPARCHIVE::ER_EOF' => 'Premature EOF',
		'ZIPARCHIVE::ER_INVAL' => 'Invalid argument',
		'ZIPARCHIVE::ER_NOZIP' => 'Not a zip archive',
		'ZIPARCHIVE::ER_INTERNAL' => 'Internal error',
		'ZIPARCHIVE::ER_INCONS' => 'Zip archive inconsistent',
		'ZIPARCHIVE::ER_REMOVE' => 'Can\'t remove file',
		'ZIPARCHIVE::ER_DELETED' => 'Entry has been deleted',
		);
		
		$errmsg = 'unknown';
		
		foreach ($zipFileFunctionsErrors as $constName => $errorMessage)
		{
			if (defined($constName) and constant($constName) === $errno)
			{
				return 'Zip File Function error: '.$errorMessage;
			}
		}
		
		return 'Zip File error: unknown';
	}
	
	function file_bulk_import_allowed_extensions()
	{
		$result = false;
		
		$allowed_extensions_settings = trim(get_plugin_setting('allowed_extensions', 'file_bulk_import'));
		
		if(!empty($allowed_extensions_settings))
		{
			$allowed_extensions = explode(',', $allowed_extensions_settings);
			array_walk($allowed_extensions, 'file_bulk_import_trim_array_values');
			
			$result = $allowed_extensions;	
		}
		
		return $result;
	}
	
	function file_bulk_import_trim_array_values(&$value) 
	{ 
	    $value = trim(strtolower($value)); 
	}