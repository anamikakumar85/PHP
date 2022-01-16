<?php
namespace classes\PDO;
class Database
{
	// Attribute
	public $host="localhost";
	public $port=3306;
	public $dbname="project2";
	public $user="root";
	public $password="";
	public $db_object;	// PDO Objekt
	
	################################################################################################
	
	public function __construct()
	{
		$this->connect_make();
		#echo "<h1>PDO</h1>";
	}
	
	################################################################################################
	//Methods
	protected function connect_make()
	{
		$this->db_object = new \PDO("mysql:host=".$this->host."; dbname=".$this->dbname.";port:".
		$this->port."",$this->user, $this->password,
			array
			(
				\PDO::ATTR_ERRMODE 					=> \PDO::ERRMODE_WARNING,
				\PDO::ATTR_DEFAULT_FETCH_MODE 		=> \PDO::FETCH_ASSOC,
				\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY 	=> true,
				\PDO::MYSQL_ATTR_INIT_COMMAND 		=> "SET NAMES utf8"
			)
		);		
	}
	public function query_execute($sql,$array = array())
	{
		$answer = $this->db_object->prepare($sql);
		$answer->execute($array);
		return $answer;
	}
	public function sql_insert($sql, $array = array())
	{
		$answer = $this->query_execute($sql, $array);
		return $this->db_object->lastInsertId();
	}
	
	public function sql_update($sql, $array = array())
	{
		$answer = $this->query_execute($sql, $array);
		if($answer->rowCount() == 0)
		{
			return "Update failed: ".$answer->rowCount()." Records updated";
		}
		else
		{
			return "Update  successful: ".$answer->rowCount()." Records updated";
		}		
	}
	public function sql_select($sql, $array = array())
	{
		$answer = $this->query_execute($sql, $array);
		$data = $answer->fetchAll(); // all records
		return $data;
	}
	public function sql_delete($sql, $array = array())
	{
		$answer = $this->query_execute($sql, $array);
		if($answer->rowCount() == 0)
		{
			return "Delete failed: ".$answer->rowCount()." Records deleted";
		}
		else
		{
			return "Delete successful: ".$answer->rowCount()." Records deleted";
		}		
	}	
	
	
}
/* $db = new Database();
if(isset($_POST["Firstname"]))
{
$insert_id = $db->sql_insert("insert into user_table (first_name, last_name,user_id,user_password) values(?,?,?,?);",
array($_POST["Firstname"],$_POST["Lastname"],$_POST["UserID"],$_POST["Password"]));
echo $insert_id; 
}
#$this->content="<h1>You have successfully register.</h1>";*/
?>