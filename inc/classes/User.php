<?php
namespace Classes;
class User
{
	//Attribute
	protected $Userno;
	protected $Usertyp;
	protected $Firstname;
	protected $Lastname;
	protected $UserID;
	protected $Password;

	protected function getUserno()
	{
		return $this->Userno;
	}
	protected function setUserno($Userno)
	{
		$this->Userno = $Userno;
	}
	protected function getUsertyp()
	{
		return $this->Usertyp;
	}
	protected function setUsertyp($Usertyp)
	{
		$this->Usertyp = $Usertyp;
	}
	protected function getFirstname()
	{
		return $this->Firstname;
	}
	protected function setFirstname($Firstname)
	{
		$this->Firstname = $Firstname;
	}
	protected function getLastname()
	{
		return $this->Lastname;
	}
	protected function setLastname($Userno)
	{
		$this->Lastname = $Lastname;
	}
	protected function getUserID()
	{
		return $this->UserID;
	}
	protected function setUserID($Userno)
	{
		$this->UserID = $UserID;
	}
	protected function getPassword()
	{
		return $this->Password;
	}
	protected function setPassword($Password)
	{
		$this->Password = $Password;
	}
}
?>