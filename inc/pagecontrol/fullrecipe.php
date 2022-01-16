<?php

use Classes\PDO\Database;
use Classes\form_generator\formgenerator;
use Classes\form_generator\Formfield;
use Classes\User;


use Classes\Files;
use Classes\Filemanager;
######################################################
#print_r($_GET["recipeid"]);

$db =new Database();
$string= file_get_contents("templates/fullrecipeabove.html");


$string = suchen_und_ersetzen("__BACK_LINK__", 
'<a href="index.php?action=searchresult"><img border="0" alt="Back" src="image/pfeile.png" width="30" height="30" ></a>', $string);

$index = $db-> sql_select("select *from recipe_table where sno =".$_GET["recipeid"]);
$photo = "<img id ='photosize' src = 'uploads/". $index[0]["photo"]."'/>";


$string  = suchen_und_ersetzen("__RECIPE__NAME__",$index[0]["recipe"], $string );
$string  = suchen_und_ersetzen("__RECIPE__PHOTO__",$photo, $string );


#######################################################################


$this->content =  $string;

$allingredient = $db->sql_select("select ingredient_table. *, quantity_table.amount,quantity_table.recipe_id,unit_table.term from ingredient_table 
							INNER join quantity_table ON ingredient_table.sno = ingredient_id 
							INNER join unit_table ON unit_id = unit_table.nr where recipe_id = ".$_GET["recipeid"]);
							
foreach($allingredient as $ingredientval => $sno)
	{
		$string= file_get_contents("templates/fullrecipemid.html");
		
		$exchange_array = array(	"__INGREDIENT_QUANTITY__"			=> $sno["amount"],
									"__INGREDIENT_TERM__"				=> $sno["term"],
									"__INGREDIENT_NAME__"				=> $sno["ingredient"]
									
								);
		
			foreach($exchange_array as $placeholder => $exchangevalue)
			{
				$string = suchen_und_ersetzen($placeholder,$exchangevalue, $string);
			}
			$this->content .= $string;

} 
#############################################################
$string = file_get_contents("templates/fullrecipedown.html");


$string  = suchen_und_ersetzen("__RECIPE_CONTENT__",$index[0]["content"], $string );

$this->content .=  $string;

?>