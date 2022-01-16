<?php

use Classes\PDO\Database;
use Classes\form_generator\formgenerator;
use Classes\form_generator\Formfield;
use Classes\User;


use Classes\Files;
use Classes\Filemanager;
#################################################################

$results_per_page = 8;

if (isset($_GET["page"])) 
{
	$page  = $_GET["page"]; 
} 
else { $page=1; };
$start_from = ($page-1) * $results_per_page; 


$table_above = file_get_contents("templates/admin_table_above.html");


// Suchen und ersetzen
$table_above  = suchen_und_ersetzen("__SEARCH_CATEGORIE__", @$_POST["search_categorie"], $table_above );
$table_above  = suchen_und_ersetzen("__SEARCH_SUBCATEGORIE__", @$_POST["search_subcategorie"], $table_above );
$table_above  = suchen_und_ersetzen("__SEARCH_RECIPE__", @$_POST["search_recipe"], $table_above );
$table_above  = suchen_und_ersetzen("__SEARCH_DIFFICULTY__", @$_POST["search_difficulty"], $table_above );
$table_above  = suchen_und_ersetzen("__SEARCH_DATE__", @$_POST["search_date"], $table_above );


$this->content .= $table_above;

$db =new Database();


					/*select sub_categorie_table.sub_categorie , recipe_table.* FROM sub_categorie_table 
					INNER join recipe_table ON sub_categorie_id =sub_categorie_table.sno*/
		$index = $db-> sql_select("select categorie_table.categorie ,sub_categorie_table.sub_categorie , recipe_table.* 
								FROM categorie_table INNER join sub_categorie_table ON 
								categorie_table.sno = sub_categorie_table.categorie_id 
								INNER join recipe_table ON recipe_table.sub_categorie_id = sub_categorie_table.sno
								
								WHERE
										categorie LIKE '%".@$_POST["search_categorie"]."%'
										AND
										sub_categorie LIKE '%".@$_POST["search_subcategorie"]."%'
										AND
										recipe LIKE '%".@$_POST["search_recipe"]."%'
										AND
										difficulty_level LIKE '%".@$_POST["search_difficulty"]."%'
										AND
										date LIKE '%".@$_POST["search_date"]."%'
								order by sno LIMIT $start_from, $results_per_page
								
								");
								
								#LIMIT $start_from, $results_per_page
								
								
								
		foreach($index as $nr => $sno)
		{
			$string = file_get_contents("templates/admin_table_middle.html");
			
			$exchange_array = array(	"__SNO__"				=> $sno["sno"],
										"__CATEGORIE__"			=> $sno["categorie"],
										"__SUBCATEGORIE__"		=> $sno["sub_categorie"],
										"__RECIPE__"			=> $sno["recipe"],
										"__DIFFICULTY__"		=> $sno["difficulty_level"],
										"__DATE__"				=> $sno["date"],
										"__FOTO__"				=> $sno["photo"]
									);
									
			foreach($exchange_array as $placeholder => $exchangevalue)
			{
				$string = suchen_und_ersetzen($placeholder,$exchangevalue, $string);
			}
			$this->content .= $string;
			
		}
		
		
		$this->content .= file_get_contents("templates/admin_table_below.html");
		
 		$index = $db-> sql_select("select COUNT(sno) AS total FROM recipe_table");
		#print_r($index);
		#print_r($index[0]["total"]);
		
		$total_pages = ceil($index[0]["total"] / $results_per_page);
		#print_r($total_pages);
		for ($i=1; $i<=$total_pages; $i++) 
		{  // print links for all pages
            $this->content .= "<a href='index.php?action=admin&page=".$i."'";
            if ($i==$page) 
			$this->content .= " class='curPage'";
            $this->content .= ">".$i."</a> "; 
		
		};  
		
		
	?>