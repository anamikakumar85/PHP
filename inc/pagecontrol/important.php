if(isset($this->formData["recipe_submit_btn"]))
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
			$this->content .= "<form action='?action=addRecipe' method='post'>
								<input type='hidden' name='newrecipeid' value= '".$insert_id."'>
								<input type='submit' name='more' value= 'More'>
									</form>";	
									


		
		}
		
		 */
		
		/*
		
		 else if(isset($this->formData["newrecipeid"]))
		{
			#print_r($this->formData["newrecipeid"]);
			$_SESSION['newrecipeid'] = $this->formData["newrecipeid"];
			$this->content = file_get_contents("templates/add_ingredients_form.html");
		}
		else if(isset($this->formData["Add_More_ingredient_btn"]))
		{		
			#print_r($_SESSION['newrecipeid']);
			$db = new Database();
			
		
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
					
			$this->content .= file_get_contents("templates/add_ingredients_form.html");
			
		}	
		else if(isset($this->formData["ingredient_submit_btn"]))
		{
			
			$this->content = "<h1>The Process for adding new recipe is finished</h1>";
			unset($_SESSION["newrecipeid"]);
			unset($_SESSION["ingredient_id"]);
		} 
		else
		{
			$this->content .= file_get_contents("templates/add_recipe_form.html");
			
		} */
