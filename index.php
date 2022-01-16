
<?php
session_start();
require_once("inc/functions/string_functions.inc.php");
#require_once("inc/classes/form_generator/formgenerator.php");
#require_once("inc/pagecontrol/pagecontrol.php");
#require_once("inc/classes/PDO/Database.php");



function autoLoad($name)
{
	$pfad ="inc/".$name.".php";
	$pfad = "inc" . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $name) . ".php";
	#echo "<h1>$name => $pfad</h1>";
	if(file_exists($pfad))
	{
		require_once($pfad);
	}
}

spl_autoload_register("autoLoad"); // Automatisches Laden aktivieren

if(!isset($_GET["action"]))
{
	$_GET["action"] = "home";
}
	
$controller = new pagecontrol\Pagecontrol();
echo $controller->selectPage($_GET["action"]);


?>
