<?php
include("dblib.php");
include("clublib.php");
SetVariables();


if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="suggest" ){
	$result=getSuggestions($_REQUEST["table"],$_REQUEST["value"]);
	echo $result;
}

?>