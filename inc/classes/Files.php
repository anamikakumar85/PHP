<?php
namespace Classes;
class Files
{
	// Attribute
	protected $Fileinfo; // Array
	
	// GET- und SET-Methoden
	public function getFileinfo()
	{
		return $this->Fileinfo;
	}
	
	protected function setFileinfo($Fileinfo)
	{
		$this->Fileinfo = $Fileinfo;
	}
	
	public function __construct($fileinfo)
	{
		$this->setFileinfo($fileinfo);
	}	
}
?>