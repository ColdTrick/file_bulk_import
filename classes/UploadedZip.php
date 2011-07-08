<?php 

	class UploadedZip extends ElggObject 
	{
		const SUBTYPE = "uploadedzip";
		
		protected function initialise_attributes() 
		{
			global $CONFIG;
			parent::initialise_attributes();
			
			$this->attributes["subtype"] = self::SUBTYPE;
		}
	}