<?php

use Classes\PDO\Database;
use Classes\form_generator\formgenerator;
use Classes\form_generator\Formfield;
use Classes\User;


use Classes\Files;
use Classes\Filemanager;
#######################################################################################
$db =new Database();

#############  ##############################

$string = file_get_contents("templates/searchresult_above.html");

$string = suchen_und_ersetzen("__BACK_LINK__", 
'<a href="index.php?action=home"><img border="0" alt="Back" src="image/pfeile.png" width="30" height="30" ></a>', $string);

#$this->content ="<h4>search result</h4>";

#print_r($_SESSION["searchword"]);
$index = $db-> sql_select("select categorie_table.categorie ,sub_categorie_table.sub_categorie , recipe_table.* 
								FROM categorie_table INNER join sub_categorie_table ON 
								categorie_table.sno = sub_categorie_table.categorie_id 
								INNER join recipe_table ON recipe_table.sub_categorie_id = sub_categorie_table.sno
								
								WHERE
										categorie LIKE '%".$_SESSION["searchword"]."%'
										OR
										sub_categorie LIKE '%".$_SESSION["searchword"]."%'
										OR
										recipe LIKE '%".$_SESSION["searchword"]."%'
										OR
										difficulty_level LIKE '%".$_SESSION["searchword"]."%'
										OR
										content LIKE '%".$_SESSION["searchword"]."%'
								order by sno 
								
								");
								
$counter =count($index); /////////for counting total no of search results
$string  = suchen_und_ersetzen("__COUNT__",$counter, $string );							
$string  = suchen_und_ersetzen("__SEARCH_WORD__",$_SESSION["searchword"], $string );							

$this->content = $string;
##########################################################################
$i=0;

	foreach($index as $nr => $sno)
	{
	#$counter++;
		$string= file_get_contents("templates/searchresultmid.html");
		$photo = "<img id ='imgsize' src = 'uploads/". $sno["photo"]."'/>";
		####### for adding no of cloumns in a rows###########
		if($i%4== 0)			
		{	
			$this->content .="<tr>";
		}
		
		$exchange_array = array( "__PHOTO_GRID__"   => $photo,
								 "__RECIPE_NAME__"  => $sno["recipe"],
								 "__SNO__"  		=> $sno["sno"]
								);
			
		foreach($exchange_array as $placeholder => $exchangevalue)
			{
				$string = suchen_und_ersetzen($placeholder,$exchangevalue, $string);
			}
		$this->content .= $string;
		if($i%4== 3)			
		{	
			$this->content .="</tr>";
		}
		$i++;	
	
	}

$this->content .= file_get_contents("templates/searchresultbelow.html");





?>