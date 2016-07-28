<?php
include("dblib.inc");
include("clublib.php");
SetVariables();

if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="chat")
	{sendMessage($_REQUEST["chat"], $_REQUEST["receiver_id"]);}


if(isset($_REQUEST["msg_id"]) && isset($_REQUEST["contact_id"]))
	{$result=chat::getchats($_REQUEST["msg_id"],$_REQUEST["contact_id"]);
	readMessage($_REQUEST["contact_id"]);
	echo $result;}

if(isset($_REQUEST["friends"]) )
	{$result=chat::fetchChatContacts($_REQUEST["friends"]);
	echo $result;}

?>