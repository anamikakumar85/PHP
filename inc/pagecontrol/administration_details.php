<?php

use Classes\PDO\Database;
use Classes\form_generator\formgenerator;
use Classes\form_generator\Formfield;
use Classes\User;


use Classes\Files;
use Classes\Filemanager;

######################################################################################################

$this->content = "<h1>Details</h1>";

$db =new Database();

$recipe = $db->sql_select("select * from recipe_table where sno=".$_GET["recipeid"]);


# print_r($recipe);

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

#print_r($sub_categorie);
$subcat_form = file_get_contents("templates/categorie_form.html");	
$subcat_form = suchen_und_ersetzen("__SUB_CAT__", $sub_categorie[0]["sub_categorie"]	,	$subcat_form);


$option = "";
$full_list = $db->sql_select("select * from sub_categorie_table");
foreach($full_list as $subcategorielist)
{ 
	
	$option .='<option value="'.$subcategorielist["sno"].';'.$subcategorielist["sub_categorie"].'">'
	.$subcategorielist["sub_categorie"].'</option>';
}
#print_r($recipe[0]["sno"]);
#print_r($subcategorielist["sno"]);
$subcat_form = suchen_und_ersetzen("__OPTION__", $option	,	$subcat_form); 
$subcat_form = suchen_und_ersetzen("__RECIPEID__", $recipe[0]["sno"]	,	$subcat_form);

	
$string = suchen_und_ersetzen("__CATEGORIE__", $subcat_form	,	$string);	




// #################################################################################
// Recipe Detail
// #################################################################################



$processing_form = file_get_contents("templates/recipe_processing_form.html");

$processing_form = suchen_und_ersetzen("__RECIPE_NAME__", $recipe[0]["recipe"] ,	$processing_form);
$processing_form = suchen_und_ersetzen("__CONTENT__", $recipe[0]["content"] ,	$processing_form);
$processing_form = suchen_und_ersetzen("__DIFFICULTY_LEVEL__", $recipe[0]["difficulty_level"] ,	$processing_form);
$processing_form = suchen_und_ersetzen("__PHOTO__", $recipe[0]["photo"] , $processing_form);
$processing_form = suchen_und_ersetzen("__DEFAULTRECIPEPHOTO__", $recipe[0]["photo"] , $processing_form);#input for hidden btn to add default photo

$processing_form = suchen_und_ersetzen("__RECIPEID__", $recipe[0]["sno"] ,	$processing_form);#input for hidden btn

$string= suchen_und_ersetzen("__DETAILS__", $processing_form , $string);
	
$this->content .= $string;


// #################################################################################
// Ingredient Detail
// #################################################################################

$string = file_get_contents("templates/ingredientshow_up.html");

$this->content .= $string;
#$ingredient = $db->sql_select("select ingredient_table. ingredient from ingredient_table INNER join amount_table ON ingredient_table.sno = ingredient_id where recipe_id=".$_GET["recipeid"]);
#select ingredient_table. ingredient , quantity_table.*,unit_table.term from ingredient_table INNER join quantity_table ON ingredient_table.sno = ingredient_id INNER join unit_table ON unit_id = unit_table.nr where recipe_id =
$allingredient = $db->sql_select("select ingredient_table. *, quantity_table.amount,quantity_table.recipe_id,unit_table.term from ingredient_table 
							INNER join quantity_table ON ingredient_table.sno = ingredient_id 
							INNER join unit_table ON unit_id = unit_table.nr where recipe_id = ".$_GET["recipeid"]."
							order by sno");

	
foreach($allingredient as $ingredientval => $sno)
	{
		
		$string = file_get_contents("templates/ingredientshow_mid.html");	
		$exchange_array = array(	"__SNO__"			=> $sno["sno"],
									"__INGREDIENT__"	=> $sno["ingredient"],
									"__AMOUNT__"		=> $sno["amount"],
									"__TERM__"			=> $sno["term"],	
									"__RECIPEID__"		=> $sno["recipe_id"]	
								);
		
			foreach($exchange_array as $placeholder => $exchangevalue)
			{
				$string = suchen_und_ersetzen($placeholder,$exchangevalue, $string);
			}
			$this->content .= $string;

	
} 
$string = file_get_contents("templates/ingredientshow_down.html");

$string= suchen_und_ersetzen("__RECIPEID__", $_GET["recipeid"] , $string);
$this->content .= $string;

?>