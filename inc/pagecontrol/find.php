<?php

use Classes\PDO\Database;
use Classes\form_generator\formgenerator;
use Classes\form_generator\Formfield;
use Classes\User;


use Classes\Files;
use Classes\Filemanager;
#######################################################################################

$string = file_get_contents("templates/find_above.html");
$this->content .= $string;


$db =new Database();


$index = $db-> sql_select("select * from categorie_table ");
$i=0;
	foreach($index as $nr => $sno)
	{
		$string= file_get_contents("templates/find_mid.html");
		#$photo = "<img id ='imgsize' src = 'uploads/". $sno["photo"]."'/>";
		####### for adding no of cloumns in a rows###########
		if($i%2== 0)			
		{	
			$this->content .="<tr>";
		}
		
		$exchange_array = array( "__CATEGORIE_NAME__"   =>  $sno["categorie"]
								#"__SUB_CATEGORIE_NAME__"  => $sno["sub_categorie"]
								# "__SNO__"  		=> $sno["sno"]
								);
	
		foreach($exchange_array as $placeholder => $exchangevalue)
			{
				$string = suchen_und_ersetzen($placeholder,$exchangevalue, $string);
			}
		$this->content .= $string;
		
		
		/* $sub_cat = $db-> sql_select("select * from sub_categorie_table ");
		foreach($sub_cat as $nr => $seq)
		{

			$exchange_array = array( #"__CATEGORIE_NAME__"   =>  $nr["categorie"],
									"__SUB_CATEGORIE_NAME__"  => $seq["sub_categorie"]
									# "__SNO__"  		=> $sno["sno"]
									);
		
			foreach($exchange_array as $placeholder => $exchangevalue)
				{
					$string = suchen_und_ersetzen($placeholder,$exchangevalue, $string);
				}
			$this->content .= $string;
		} 
		 */
		
		
		
		
		
		
		if($i%2== 1)			
		{	
			$this->content .="</tr>";
		}
		$i++;	
			
	}
$this->content .= file_get_contents("templates/find_below.html");
















?>