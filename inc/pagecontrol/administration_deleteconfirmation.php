<?php

use Classes\PDO\Database;
use Classes\form_generator\formgenerator;
use Classes\form_generator\Formfield;
use Classes\User;


use Classes\Files;
use Classes\Filemanager;

######################################################################################################
$this->content = "<h1>Delete Confirmation</h1>";

$db =new Database();


$recipe = $db->sql_select("select * from recipe_table where sno=".$_GET["recipeid"]);
#print_r($recipe);
$string = file_get_contents("templates/recipe_details.html");

$string = suchen_und_ersetzen("__BACK_LINK__", 
'<a href="index.php?action=admin"><img border="0" alt="Back" src="image/pfeile.png" width="30" height="30" ></a>', $string);

$string = suchen_und_ersetzen(
		"__HEADLINE__", 
		
		$recipe[0]["sno"]." / ".
		"Date: ".$recipe[0]["date"],	
		$string);
// #################################################################################
// Recipe Categories 
// #################################################################################
$sub_categorie = $db->sql_select("select * from sub_categorie_table where sno =" .$recipe[0]["sub_categorie_id"]);

$string = suchen_und_ersetzen("__CATEGORIE__", $sub_categorie[0]["sub_categorie"]	,	$string);

// #################################################################################
// Recipe Detail
// #################################################################################

$details = "";


$details .= "Recipename:".$recipe[0]["recipe"]."<br />";
#$details .= "Content:".$recipe[0]["content"]."<br />";


$details .= "Level:".$recipe[0]["difficulty_level"]."<br />";
$details .= "Photo:".$recipe[0]["photo"]."<br />";	

$string= suchen_und_ersetzen("__DETAILS__", $details , $string);
$this->content .= $string;

$this->content .= "<h1>Are You sure  for Delete?</h1>";

$this->content .= "<form action='?action=admin' method='post'>
					<input type='submit' name='delete' value='Confirmation'>
					<input type='hidden' name='recipeid' value='".$recipe[0]["sno"]."' />
					</form>";	


?>