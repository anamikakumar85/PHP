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
$string = file_get_contents("templates/ingredient_change.html");

$ingredient = $db->sql_select("select ingredient_table. *, quantity_table.*,unit_table.term from ingredient_table 
							INNER join quantity_table ON ingredient_table.sno = ingredient_id 
							INNER join unit_table ON unit_id = unit_table.nr where ingredient_id = ".$_GET["ingredientid"]); 
							
							
$details = "";
#print_r($ingredient );
#print_r($ingredient[0]["recipe_id"]);
$details .= "Ingredient name:".$ingredient[0]["ingredient"]."<br />";

$details .= "Amount:".$ingredient[0]["amount"]."<br />";

$details .= "Unit:".$ingredient[0]["term"]."<br />";	

$string= suchen_und_ersetzen("__DETAILS__", $details , $string);

$this->content .= $string;

$this->content .= "<h1>Are You sure  for Delete?</h1>";

$this->content .= "<form action='?action=admin' method='post'>
					<input type='submit' name='remove' value='Confirmation'>
					<input type='hidden' name='ingredientid' value='".$ingredient[0]["ingredient_id"]."' />
					</form>";	


?>