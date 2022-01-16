<?php
namespace pagecontrol;

use Classes\PDO\Database;
use Classes\form_generator\formgenerator;
use Classes\form_generator\Formfield;
use Classes\User;


use Classes\Files;
use Classes\Filemanager;

class Pagecontrol
{
	public $action     = "";                        //page select
	public $formData   = array();                   //form data
	public $template   = "templates/basic.html";    //html-page
	public $content    = "No content is there";     //page contente of the pages
	
	public function selectPage($page)
	{
		$this->action = $page;
		
	
		switch($this->action)
		{
			case "home":				$this->actionHome(); 			break;
			case "searchresult":		$this->actionSearchResult(); 	break;
			case "fullrecipe":			$this->actionFullRecipe(); 		break;
			case "find":				$this->actionFind();   			break;
			case "addRecipe":			$this->actionAddRecipe(); 		break;
			case "admin":				$this->actionAdmin(); 			break;
			case "login":				$this->actionLogin();			break;
			case "profile":				$this->actionProfile();			break;
			case "logout":				$this->actionLogout();			break;
			case "register":			$this->actionRegister();		break;
			case "contact":				$this->actionContact();			break;
			case "feedback":			$this->actionFeedback();		break;
			case "impressum":			$this->actionImpressum();		break;
			case "agb":					$this->actionAGB();				break;
			case "download":			$this->actionDownload();		break;
			case "outdated":			$this->actionOutdated();		break;
			default:					$this->actionPageNotFound();
		}
		 //get template
		 $string = file_get_contents($this->template);
		 
		 //echo $zeichenkette;
		$logout_string = "";
		$login_string = "";
		$addRecipe_string ="";
		$admin_string ="";
		$feedback_string ="";
		$profile_string ="";
		
		if(isset($_SESSION["userno"]))
		{
			$logout_string = '<a href="index.php?action=logout"><img class="topheader_img" src="image/icon.png" alt="" >Logout</a>';
			#print_r($_SESSION["userno"]);
			$db = new Database();
			$usertyp =$db->sql_select("select user_type from user_table where userno = ".$_SESSION["userno"]);
			#print_r($usertyp);
			$_SESSION['user_type']=$usertyp[0]["user_type"];
			#print_r($_SESSION['user_type']);
			
			
			##############------------Seprating navigation for different users-----------------#############################
			
			
			if($_SESSION['user_type']==='admin')
			{
				$addRecipe_string = '<a  href="index.php?action=addRecipe"><img class="nav_img" src="image/bowl.png" alt="">AddRecipe</a>';
				$admin_string = '<a  href="index.php?action=admin"><img class="nav_img" src="image/man.png" alt="" >Admin</a>';
				$profile_string = '<a  href="index.php?action=profile"><img class="nav_img" src="image/profil.png" alt="" >Profile</a>';
			}
			else
			{
				$feedback_string = '<a  href="index.php?action=feedback"><img class="nav_img" src="image/stars.png" alt="" >Feedback</a>';
				$profile_string = '<a  href="index.php?action=profile"><img class="nav_img" src="image/profil.png" alt="" >Profile</a>';
			}
		}
		else
		{
			$login_string = '<a href="index.php?action=login"><img class="topheader_img" src="image/login.png" alt="" >Login</a>';
		}
		
		$string = suchen_und_ersetzen("__#__ADDRECIPE__#__", $addRecipe_string,	$string);
		$string = suchen_und_ersetzen("__#__ADMIN__#__", $admin_string,	$string);
		$string = suchen_und_ersetzen("__#__FEEDBACK__#__", $feedback_string,	$string);
		$string = suchen_und_ersetzen("__#__USERPROFILE__#__", $profile_string,	$string);
		
		
		
		$string = suchen_und_ersetzen("__#__LOGIN__#__", $login_string,	$string);
		$string = suchen_und_ersetzen("__#__LOGOUT__#__", $logout_string,	$string);
		
		 $replacement_text =suchen_und_ersetzen("__#__CONTENT__#__",$this->content, $string);
		 return $replacement_text;
	}

#####################################################################################################################################
	
	protected function actionHome()
	{
		
		#$this->content = file_get_contents("templates/home.html");
		switch(@$_GET["modus"])
		{
			case "fullrecipe":   include("fullrecipe.php");        break;
			default:      		 include("home.php");      
		}
	}
	protected function actionSearchResult()
	{
		if(isset($_SESSION["searchword"]))
		{
			include("searchresult.php");
		}
		else
		{
			
			include("home.php"); 
		}
	}
	protected function actionFullRecipe()
	{
	}
	
	protected function actionFind()
	{
		$this->content = "<h1>Find here</h1>";
		include("find.php");
	}
	protected function actionAddRecipe()
	{
		$this->content = "<h1>New Recipe Details</h1>";
		
		##########----input from administration_detail page to add more ingredients-------#################
		if(isset($_GET["newrecipeid"]))
		{
		$_POST["newrecipeid"] = $_GET["newrecipeid"];
		
		}  
		 $this->formData = $_POST;
		//when the form will be sent
		
		
		
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
						"placeholder_recipe"=>$this->formData["recipe"],
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
			
		} 

		
		
		
		
		
		/* switch(@$_GET["modus"])
		{
			case "addingredient":       include("addingredient.php");       			   break;
			default:      		 		include("addrecipe.php");      
		} */
		
		
		
		
		
		
	}
	

	
	protected function actionAdmin()
	{
		$this->content = "<h1>Admin Task</h1>";

		
		if(isset($_POST["subcatnr"]))
			{
				
				$teil = explode(";", $_POST["subcatnr"]);
				$subcatnr = $teil[0];
				$subcat = $teil[1];
				$db = new Database();
				$db->sql_update("update recipe_table set sub_categorie_id = '".$subcatnr."' 
								where sno='".$_POST["recipeid"]."'");
				
				$this->content .= "<div style='color:red;'>The Sub Categorie has been set new!</div>";									  
			}
		

		if(isset($_POST["savechanges"]))
			{
				$db = new Database();

				$file = new Files($_FILES["changephoto"]);
				$filemanager = new Filemanager();
				
			
			#########----Asking for change of photo or not------####################
				#print_r($_POST["defaultrecipephoto"]);
				
				$radioval =$_POST["change_confirm"];
				if($radioval =="YES")
				{
					$photo = $filemanager->file_upload($file->getFileinfo());
				}
				else if($radioval =="NO")
				{
					$photo = $_POST["defaultrecipephoto"];
				}
					
				#print_r($file); #########-----------:sql injections
				$db->sql_update("update recipe_table set 
								recipe = :recipe, 
								content = :content,      
								difficulty_level = :difficulty_level,
								photo = :photo
								where sno=:recipeid",
								array(
								 "recipe" => $_POST["recipename"],
								 "content" => $_POST["content"],
								 "difficulty_level" => $_POST["level"],
								 "photo" => $photo,
								 "recipeid" => $_POST["recipeid"]
								)
								);	
				$this->content .= "<div style='color:red;'>The data have been changed!</div>";		
			}
	
		if(isset($_POST["delete"]))
		{
			$db = new Database();
			$this->content .= $db->sql_delete("delete from recipe_table where sno = ".$_POST["recipeid"]);
			$this->content .= $db->sql_delete("delete from quantity_table where recipe_id = ".$_POST["recipeid"]);
			$this->content .= "<div style='color:red;'>The file is deleted!</div>";	
		}
		
		if(isset($_POST["editchanges"]))
		{
			$db = new Database();
			
			#########-----for saving the value (first letter in gross)
			$ingredientname = anfang_gross_schreiben($_POST['ingredientname']);
			$Quantityterm = anfang_gross_schreiben($_POST['unit']);
			$oldingredientid = $_POST['ingredientid'];
			
			
			#$unit=$_POST["unit"];
			#$unit_id =$db->sql_select
			#("select nr from unit_table WHERE term = '".$unit."'");
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
			
			
			#print_r($_POST["recipeid"]);
			
			
			$checkchange=$db->sql_select
			("select * from ingredient_table WHERE ingredient LIKE '$ingredientname'");
			
			if(count($checkchange) == 1)
			{
				$this->content .="<div style='color:green; text-align:center;'><h5>The ingredients are updated<br/>
									</h5></div> ";
				
				######### To check ingredient id ####################

				$_SESSION["changed_ingredient_id"] = $checkchange[0]["sno"];

				$db->sql_update("update quantity_table set 
					recipe_id = :recipe_id,
					ingredient_id = :ingredient_id ,      
					amount = :amount,
					unit_id = :unit
					where ingredient_id=:oldingredientid",
					array(	
					"recipe_id" => $_POST["recipeid"],
					 "ingredient_id" => $_SESSION["changed_ingredient_id"],
					 "amount" => $_POST["amount"],
					 "unit" =>$finalunit,
					 "oldingredientid" => $oldingredientid
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
				$_SESSION["changed_ingredient_id"] = $newingredient_id;					
						
				$db->sql_update("update quantity_table set 
					recipe_id = :recipe_id,
					ingredient_id = :ingredient_id ,      
					amount = :amount,
					unit_id = :unit
					where ingredient_id=:oldingredientid",
					array(	
					"recipe_id" => $_POST["recipeid"],
					 "ingredient_id" => $_SESSION["changed_ingredient_id"],
					 "amount" => $_POST["amount"],
					 "unit" =>$finalunit,
					 "oldingredientid" => $oldingredientid
					)
					);
				$this->content .="<div style='color:green; text-align:center;'><h5>The ingredients are updated<br/>
									</h5></div> ";
			}
		}
		
		if(isset($_POST["remove"]))
		{
			$db = new Database();
			$this->content .= $db->sql_delete("delete  from quantity_table where ingredient_id = ".$_POST["ingredientid"]);
			$this->content .= "<div style='color:red;'>The ingredient for the recipe is deleted!</div>";	
		}
		
		
		


		#Presentation
		switch(@$_GET["modus"])
		{
			
			case "details":      include("administration_details.php");       			  break;
			case "delete":       include("administration_deleteconfirmation.php");        break;
			case "change":       include("ingredient_change.php");       			      break;
			case "remove":       include("ingredient_remove.php");       			      break;
			default:      		 include("administration.php");      
		}
	}	
	
	protected function actionLogin()
	{
		 include("login.php");
		/* if(isset($_POST["login_form"]))
		{
			$db = new Database();
			$user = $db->sql_select("select * from user_table where user_id =:login",
											array("login" => $_POST['login']));
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
					$this->content = "<h1>Login failed</h1>";
				}
			}
		}
		else
		{
			$this->content = "<h1>Please login here</h1>";
			$this->content .= file_get_contents("templates/login_form.html");
			
		} */
	}
	protected function actionProfile()
	{	
		$this->content = file_get_contents("templates/user_profile.html");
		#$this->content .= "<h1>You have Successfully logged in</h1>\n";
		#$this->content .= $_SESSION["userno"];
	}	
	
	
	
	protected function actionLogout()
	{
		#$this->content = "<h1>Logout</h1>";
		unset($_SESSION["userno"]);
		#$this->content .= "You have been successfully logged out";
		include("home.php");
		
	}	
	
	
	protected function actionRegister()
	{
		#$this->content = "<h1>Please Register here</h1>";
		if(isset($_POST["Register"]))
		{   
			$db = new Database();
			$insert_id = $db->sql_insert("insert into user_table (first_name, last_name,user_id,user_password) values(?,?,?,?);",
			array($_POST["Firstname"],$_POST["Lastname"],$_POST["UserID"],$_POST["Password"]));
			$this->content = "You are register";
			#echo $insert_id;
		}
		else
		{
			$string = file_get_contents("templates/register.html");
			#require_once("inc/classes/form_generator/formgenerator.php");
		 	$this->content = "<h1>Please Register here</h1>";  
			
			$replacement_text =suchen_und_ersetzen("__#__FORM__#__",$this->content, $string);
			
			$form = new Formgenerator("Register","");
			$form->add_field(new Formfield("Firstname","text",""));
			$form->add_field(new Formfield("Lastname","text",""));
			$form->add_field(new Formfield("UserID","text",""));
			$form->add_field(new Formfield("Password","password",""));
			$form->add_field(new Formfield("Password Repeat","password",""));
			$this->content = $replacement_text.$form->generate_code("Complete Registration"); 
			#$this->content .= $replacement_text;
		}
	}
	protected function actionContact()
	{
		$this->content = "<h1>Contact us here</h1>";
		
		#$this->content = file_get_contents("templates/home.html");
	}
	protected function actionFeedback()
	{
		$this->content = "<h1>Feedback Form</h1>";
		$this->formData = $_POST;
		if(isset($this->formData["feedback_send"]))
		{  
			$storable_string = serialize($this->formData);
			$filename = uniqid("feedback_");  //filename- feedback_5b28d75206bec	
			file_put_contents("feedback/$filename.txt",$storable_string);
			$this->content .= "Data will be saved";
		}
		else
		{	
			$this->content .= file_get_contents("templates/feedback_form.html");
		}
	}
	protected function actionImpressum()
	{
		$this->content = "<h1>Impressum</h1>";
		#$this->content = file_get_contents("templates/home.html");
	}
	protected function actionAGB()
	{
		$this->content = "<h1>AGB</h1>";
		#$this->content = file_get_contents("templates/home.html");
	}
	protected function actionDownload()
	{
		$this->content = "<h1>Download</h1>";
		header("Location: downloads/download.php");
	}		
	protected function actionOutdated()
	{
		$this->content = "<h1>Veraltet</h1>";
		header("Expires: Mon, 16 Sep 2019 14:00:00 GMT");
	}		
	protected function actionPageNotFound()
	{
		$this->content = "<h1>Page not Found</h1>";
		header("HTTP/1.1 404 Not Found"); // Fehlerseite
	}					
}
	?>