<?php
include("dblib.php");
include("clublib.php");


$club_row=checkUserSession("members", "login", $_SESSION["session"]["login"]);
// $message="";
// if(isset($_POST["actionflag"]) && $_POST["actionflag"]=="chat"){
// 	if(!empty($_POST["chat"])){
// 		echo $_POST['chat'];
// 		//sendMessage($_REQUEST["chat"], $_SESSION["session"]["id"]);
// 		//header("Location:".$_SERVER["PHP_SELF"]."?sender_id=".$_REQUEST["sender_id"]);
// 	}
// }

getLatestChats($_GET["sender_id"], $_GET["chat_id"]);


?>

