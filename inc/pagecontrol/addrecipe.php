<?php

use Classes\PDO\Database;
use Classes\form_generator\formgenerator;
use Classes\form_generator\Formfield;
use Classes\User;


use Classes\Files;
use Classes\Filemanager;
#############################################################################################
$failer = 0;
$db =new Database();
$this->formData = $_POST;


if(isset($this->formData["recipe_submit_btn"]))
{  
	if($_POST["new_recipe"] =="")
	{
		$failer++;
		$name_failer ="<span class='fehlertext'>Please give the Recipe name!</span>";
	}
	
}


if(!isset($this->formData["recipe_submit_btn"]) || $failer >0)
{  
#print_r('i am working');
$newrecipe_form = file_get_contents("templates/add_recipe_form.html");

$option = "";
$full_list = $db->sql_select("select * from sub_categorie_table");
foreach($full_list as $subcategorielist)
{ 
	
	$option .='<option value="'.$subcategorielist["sno"].';'.$subcategorielist["sub_categorie"].'">'
	.$subcategorielist["sub_categorie"].'</option>';
}

$newrecipe_form = suchen_und_ersetzen("__OPTION__", $option	,	$newrecipe_form); 
$newrecipe_form = suchen_und_ersetzen("__NEW_RECIPE_NAME__",@$_POST["new_recipe"] ,	$newrecipe_form); 
$newrecipe_form = suchen_und_ersetzen("____COOKING_DIRECTION____",@$_POST["direction"] ,	$newrecipe_form); 
$newrecipe_form = suchen_und_ersetzen("__RECIPE_NAME_ERROR__",@$name_failer ,	$newrecipe_form);

$this->content .= $newrecipe_form;

}


else
{
	
	$level = $this->formData["difficulty_level"];
			if($level==1)
			{
				$difficulty ="Easy";
			}
			if($level==2)
			{
				$difficulty ="Medium";
			}
			if($level==3)
			{
				$difficulty ="Hard";
			}
			
			
			$db = new Database();
			$file = new Files($_FILES["uploadfile"]);
			$filemanager = new Filemanager();
			
			$insert_id = $db->sql_insert
				("insert into recipe_table
						(sub_categorie_id,recipe,difficulty_level,content,photo)
						values
						(
						:placeholder_sub_categorie_id,
						:placeholder_recipe,
						:placeholder_difficulty_level,
						:placeholder_content,
						:placeholder_photo
						)",
					array
					(
						"placeholder_sub_categorie_id"=>$this->formData["sub_categorie"],
						"placeholder_recipe"=>$this->formData["new_recipe"],
						"placeholder_difficulty_level"=> $difficulty,
						"placeholder_content"=>$this->formData["direction"],
						"placeholder_photo"=>$filemanager->file_upload($file->getFileinfo())
					)
				);
			
			$this->content .= "<div style='color:red;'><h4>New Recipe has been saved</h4></div>";
			 /*$this->content .= "<form action='?action=addRecipe&modus=addingredient' method='post'>
								<input type='hidden' name='newrecipeid' value= '".$insert_id."'>
								<input type='submit' name='more' value= 'More'>
									</form>";  	*/
									
			  #print_r($insert_id);
			$this->content .= "<a href='?action=addRecipe&modus=addingredient&newrecipeid=$insert_id'>Next</a>";  
	
}



?>