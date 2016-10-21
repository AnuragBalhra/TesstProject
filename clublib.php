<?php
// echo "ClubLibOpening";
// if(!isset($_SESSION["session"])){session_start();}	 
function SetVariables( ){
	// echo "SetVariables Working";
	connecttoDB();
	if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="login")
{
	 $_SESSION["session"]=array(
	 	"user_id"=>"",
	 	"login"=>$_REQUEST["login"],
	 	"password"=>$_REQUEST["password"],
	 	"logged_in"=>false,
	 	"sess_id"=>session_id(),
	 	"club_id"=>"",
	 	"error"=>""
	 	);
	// echo "SetVars begins<br>";
	// echo $_SESSION["session"]["id"]."<br>";
	// echo $_SESSION["session"]["login"]."<br>";
	// echo $_SESSION["session"]["password"]."<br>";
	// echo $_SESSION["session"]["logged_in"]."<br>";
	// echo $_SESSION["session"]["sess_id"]."<br>";
	// echo "SetVars ends<br><br>";
	
}
}
	 
function cleanMemberSession( $user_id, $login, $pass, $club_id )
{
	$_SESSION["session"]["id"]=$user_id;
	$_SESSION["session"]["login"]=$login;
	$_SESSION["session"]["password"]=$pass;
	$_SESSION["session"]["logged_in"]=false;
	$_SESSION["session"]["club_id"]=$club_id;
	$_SESSION["session"]["error"]="";
	// echo "set session vars for user with id =$id<br>";
}

function checkUser($table, $column, $value)
{
	// echo "ok now checking user for given session vars:<br>";
	// echo $_SESSION["session"]["id"]."<br>";
	// echo $_SESSION["session"]["login"]."<br>";
	// echo $_SESSION["session"]["password"]."<br><br>";
	
	$_SESSION["session"]["logged_in"]=false;
	$club_row=getRow( $table, $column, $value);
	// echo "got following club_row from getRow:<br>";
	// foreach($club_row as $key=>$value){
	// 		echo "$key => $value <br>";
	// 	}
	// 	echo"<br><br>";


	if(	!$club_row || $club_row["login"]!=$_SESSION["session"]["login"] || $club_row["password"]!=$_SESSION["session"]["password"])
	{
		echo "authenticationn error <br>".$club_row["login"]."	".$_SESSION["session"]["login"]." || ".$club_row["password"]." ".$_SESSION["session"]["password"];
		$_SESSION["session"]["error"]="Invalid Username/password use another";
		header("Location:login.php");
		exit();
	}
	else{
		$_SESSION["session"]["logged_in"]=true;
		return $club_row;
	}
}

function checkUserSession($table, $column, $value)
{
	$_SESSION["session"]["logged_in"]=false;
	$club_row=getRow( $table, $column, $value);

	if(	!$club_row || $club_row["sess_id"]!=session_id() )
	{
		session_destroy();
		$_SESSION["session"]["error"]="Please Login to view this page";
		header("Location:login.php");
		exit();
	}
	$_SESSION["session"]["logged_in"]=true;
	return $club_row;
}
?>