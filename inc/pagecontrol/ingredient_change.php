<?php

use Classes\PDO\Database;
use Classes\form_generator\formgenerator;
use Classes\form_generator\Formfield;
use Classes\User;


use Classes\Files;
use Classes\Filemanager;

######################################################################################################
#$this->content = "<h1>Ingredient Details</h1>";

$string = file_get_contents("templates/ingredient_change.html");




$db =new Database();
#print_r($_GET["ingredientid"]);
#print_r($_GET["recipeid"]);



 $ingredient = $db->sql_select("select ingredient_table. *, quantity_table.amount,unit_table.term from ingredient_table 
							INNER join quantity_table ON ingredient_table.sno = ingredient_id 
							INNER join unit_table ON unit_id = unit_table.nr where ingredient_id = ".$_GET["ingredientid"]); 
#print_r($ingredient);						
$processing_form = file_get_contents("templates/ingredient_processing_form.html");




							
$processing_form = suchen_und_ersetzen("__INGREDIENT_NAME__", $ingredient[0]["ingredient"] , $processing_form);							
$processing_form = suchen_und_ersetzen("__AMOUNT__", $ingredient[0]["amount"] , $processing_form);							
$processing_form = suchen_und_ersetzen("__UNIT__", $ingredient[0]["term"] , $processing_form);		
$processing_form = suchen_und_ersetzen("__INGREDIENTID__", $ingredient[0]["sno"] ,	$processing_form);#input for hidden btn
$processing_form = suchen_und_ersetzen("__RECIPEID__", $_GET["recipeid"] ,	$processing_form);#input for hidden btn


$string = suchen_und_ersetzen("__DETAILS__", $processing_form , $string);					
$this->content = $string;


					
?>