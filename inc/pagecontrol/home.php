<?php

use Classes\PDO\Database;
use Classes\form_generator\formgenerator;
use Classes\form_generator\Formfield;
use Classes\User;


use Classes\Files;
use Classes\Filemanager;
#######################################################################################
$db =new Database();



############# Form Validation ##############################
$failer =0;
if(isset($_POST["filter"]))
		{  
			if($_POST["search"]== "")
			{
				$failer++;
				$word_failer = "<span class='fehlertext'>Please write a keyword to search!</span>";
				
			}
		}

if(!isset($_POST["filter"]) || $failer>0)
{
	
unset($_SESSION["searchword"]);

$above_table= file_get_contents("templates/home_above.html");
		
$above_table = suchen_und_ersetzen("__SEARCH_WORD__", @$_POST["search"], $above_table );
$above_table = suchen_und_ersetzen("__SEARCH_WORD_ERROR__",@$word_failer, $above_table );
$this->content = $above_table;

###########  Photo gallery ####################################
$index = $db-> sql_select("select * from recipe_table ORDER BY date DESC  LIMIT 12");
$i=0;
	foreach($index as $nr => $sno)
	{
		$string= file_get_contents("templates/home_mid.html");
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
$this->content .= file_get_contents("templates/home_below.html");

}
else
{
	$_SESSION["searchword"] = @$_POST["search"];
	include("searchresult.php");
}
?>