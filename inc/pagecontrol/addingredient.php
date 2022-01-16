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

print_r($_SESSION['newrecipeid']);

if(isset($this->formData["Add_More_ingredient_btn"])) 
{
	if($_POST["ingredientname"] =="")
	{
		$failer++;
		$ingredientname_failer ="<span class='fehlertext'>Please give the ingredient name !</span>";
	}
	if($_POST["quantity"] =="")
	{
		$failer++;
		$quantity_failer ="<span class='fehlertext'>Please give the quantity !</span>";
	}
	if($_POST["unitname"] =="")
	{
		$failer++;
		$unit_failer ="<span class='fehlertext'>Please give the unit !</span>";
	}
	

}



 if(!isset($this->formData["Add_More_ingredient_btn"]) || $failer >0) 
{
	$ingredient_form = file_get_contents("templates/add_ingredients_form.html");
	
	
	$ingredient_form = suchen_und_ersetzen("__NEW_INGREDIENT_NAME__",@$_POST["ingredientname"] ,$ingredient_form); 
	$ingredient_form = suchen_und_ersetzen("__QUANTITY__",@$_POST["quantity"] ,$ingredient_form);
	$ingredient_form = suchen_und_ersetzen("__UNIT__",@$_POST["unitname"] ,$ingredient_form);
	$ingredient_form = suchen_und_ersetzen("__INGREDIENT_NAME_ERROR__",@$ingredientname_failer ,$ingredient_form);
	$ingredient_form = suchen_und_ersetzen("__QUANTITY_ERROR__",@$quantity_failer ,	$ingredient_form);
	$ingredient_form = suchen_und_ersetzen("__UNIT_ERROR__",@$unit_failer ,	$ingredient_form);

	$this->content .= $ingredient_form;
}

else
{
	
			#########-----for saving the value (first letter in gross)
			$ingredientname = anfang_gross_schreiben($this->formData['ingredientname']);
			$Quantityterm = anfang_gross_schreiben($this->formData['unitname']);
			
			
			/////////////////// to show on screen ,last ingredient we have added ///////////////////////////////////////
			
			#$concatenate= $this->formData['ingredientname']."-"."\n".$this->formData['quantity']."\n".$term[0]['term'].",";
			$concatenate= $ingredientname."-"."\n".$this->formData['quantity']."\n".$Quantityterm;
			$this->content .= "<h2>Last Ingredient You have Entered </h2><br/>"."<h4>". $concatenate."</h4>";
			
			
			##################  to check for unit   #####################
			$term = $db->sql_select("select nr from unit_table WHERE term = '".$Quantityterm."'");
			
			if(count($term) == 1)
			{ 
				$finalunit = $term[0]["nr"];
				#print_r($finalunit);
			}
			else
			{
				$insertterm = $db->sql_insert("insert into unit_table
												(term)values(:placeholder_term)",
												array
												(
													"placeholder_term" => $Quantityterm
												)	
											); 
											#print_r($insertterm);
					$finalunit = $insertterm;
			}
			######## No duplicate ingredient in DB table #################
			$checkingredient=$db->sql_select
				("select * from ingredient_table WHERE ingredient LIKE '$ingredientname'");
				
					if(count($checkingredient) == 1)
					{
						$this->content .="<div style='color:green; text-align:center;'><h5>The ingredient is already there,<br/>
											Quantity for the recipe has been saved</h5></div> ";
						
						######### To check ingredient id ####################
						
						
					    $_SESSION["ingredient_id"] = $checkingredient[0]["sno"];
						#print_r( $_SESSION["ingredient_id"]);
						#print_r( $this->formData["quantity"]);
						#print_r(  $this->formData["unit"]);
						######## Inserting in  quantity table only  ###################
						$db->sql_insert
							("insert into quantity_table 
								(recipe_id , ingredient_id , amount, unit_id)
								values
								(
								:placeholder_recipe_id,
								:placeholder_ingredient_id,
								:placeholder_amount,
								:placeholder_unit
								)",
								array
								(
									"placeholder_recipe_id" => $_SESSION["newrecipeid"],
									"placeholder_ingredient_id" => $_SESSION["ingredient_id"],
									"placeholder_amount" => $this->formData["quantity"],
									"placeholder_unit" => $finalunit
								)
							);						
					}
					else
					{
						$newingredient_id =$db->sql_insert
											("insert into ingredient_table
												(ingredient)values(:placeholder_ingredient)",
												array
												(
													"placeholder_ingredient"=>$ingredientname
												)	
											); 
						######### To check ingredient id ####################
					    $_SESSION["ingredient_id"] = $newingredient_id;					
						#print_r( $_SESSION["ingredient_id"]);			
											
						######## Inserting in  quantity table also  ###################
						$db->sql_insert
							("insert into quantity_table 
								(recipe_id,ingredient_id,amount,unit_id)
								values
								(
								:placeholder_recipe_id,
								:placeholder_ingredient_id,
								:placeholder_amount,
								:placeholder_unit
								)",
								array
								(
									"placeholder_recipe_id" => $_SESSION["newrecipeid"],
									"placeholder_ingredient_id" => $_SESSION["ingredient_id"],
									"placeholder_amount" => $this->formData["quantity"],
									"placeholder_unit" => $finalunit
								)
							);
						$this->content .="<div style='color:green; text-align:center;'><h5>The ingredient has been saved</h5></div>";
					}	
					
			#$this->content .= file_get_contents("templates/add_ingredients_form.html");
			$this->content .= "<a href ='?action=addRecipe&modus=addingredient&newrecipeid='".$_SESSION['newrecipeid']."''>Add More ingredient</a>";  
	
}	
?>