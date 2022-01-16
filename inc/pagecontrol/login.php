<?php

use Classes\PDO\Database;
use Classes\form_generator\formgenerator;
use Classes\form_generator\Formfield;
use Classes\User;


use Classes\Files;
use Classes\Filemanager;
#######################################################################################



############# Form Validation ##############################
$failer =0;
if(isset($_POST["login_form"]))
{  
	if($_POST["login"]== "")
	{
		$failer++;
		$name_failer = "<span class='fehlertext'>Please write Login name!</span>";
	}
	if($_POST["password"]== "")
	{
		$failer++;
		$password_failer = "<span class='fehlertext'>Please Enter Password!</span>";
	}	
}
############################################################################
		
if(!isset($_POST["login_form"]) || $failer>0)
{
	$form_validation= file_get_contents("templates/login_form.html");
		
	$form_validation = suchen_und_ersetzen("__USER_NAME__ ", @$_POST["login"], $form_validation );
	$form_validation = suchen_und_ersetzen("__USER_NAME_ERROR__",@$name_failer, $form_validation );
	$form_validation = suchen_und_ersetzen("__USER_PASSWORD__",@$_POST["password"], $form_validation );
	$form_validation = suchen_und_ersetzen("__USER_PASSWORD_ERROR__",@$password_failer, $form_validation );

	$this->content = $form_validation;
}
else
{
	$db =new Database();
	#print_r('else loop is working');
	$user = $db->sql_select("select * from user_table where user_id =:login",
											array("login" => @$_POST['login']));
											
			if(count($user) == 1)
			{			
				$hash = $user[0]["user_password"]; # $2y$10$L2SrVQ8Ll5lO.OvyBHBzYOXuzXwGoIBwrzTHuFwKzCUNAVNk47uXe  \\hash for pasword 'p';
				if(password_verify($_POST["password"], $hash))
				{
					$_SESSION["userno"] = $user[0]["userno"];
					$this->content = file_get_contents("templates/user_profile.html");
					#$this->content .= "<h1>You have Successfully logged in</h1>\n";
					#$this->content .= $_SESSION["userno"];
				}
				else
				{
					$this->content = "<h1>Login failed.The user name or password does not match.</h1>";
				}
			}

}	
	
?>