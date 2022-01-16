<?php

function suchen_und_ersetzen($suche, $ersatz, $vorlage)
{
	$ersetzte_zeichenkette = str_replace($suche, $ersatz, $vorlage); 
	return $ersetzte_zeichenkette;				   
}
function anfang_gross_schreiben($zeichenkette)
{
	return ucfirst($zeichenkette);
}
?>