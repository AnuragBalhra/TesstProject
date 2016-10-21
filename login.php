<?php
include("dblib.php");
include("clublib.php");

$message="";

if(isset($_SESSION["session"]["logged_in"]) && $_SESSION["session"]["logged_in"]==true){
	$_SESSION["session"]["error"]="Already logged in";
	header("Location:index.php");
	exit();
}
else{

	SetVariables();
// echo"123";
	// echo "checking session vars<br>";
	// echo $_SESSION["session"]["id"]."<br>";
	// echo $_SESSION["session"]["login"]."<br>";
	// echo $_SESSION["session"]["password"]."<br>checking done<br><br><br>";


	if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="login")
	{
			if(empty($_REQUEST["login"]) || empty($_REQUEST["password"]) ){$message="You must fill all fields<br>";}

			else if(!getRow("members","login",$_REQUEST["login"])){$message="Login Username does not exist.Try another<br>";}
			else if(empty($message))
			{
				$member_row=checkUser("members", "login", $_REQUEST["login"]);
				$club_row=getRow("clubs", "user_id", $member_row["id"]);
				$result=updateMemberInfo("sess_id", session_id(), "login", $_SESSION["session"]["login"]);
				cleanMemberSession( $member_row["id"], $_REQUEST['login'], $_REQUEST['password'], $club_row["id"] );
				$ip=$_SERVER["REMOTE_ADDR"];
				$result=updateMemberInfo("sess_ip", $ip, "login", $_SESSION["session"]["login"]);

				$_SESSION["session"]["logged_in"]=true;
				flipOnlineState();
				header("Location:index.php?".SID);
				exit();
			}
	}
}
?>



<html>
<head>
	
	<title>Login your club Details!</title>
</head>
<body>



<?php
include("publicnav.inc");
?>


<div class="container">

		<h1 style="color:blue">Log in</h1>

<?php
	if($message!=""){print "<b>$message</b><p>";}
	if(isset($_SESSION["session"]["error"]) && $_SESSION["session"]["error"]!=""){print "<b>".$_SESSION["session"]["error"]."</b><p>";$_SESSION["session"]["error"]="";}
?>
<b>
<div class="row center">
	<form  name="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ;?>" method="post">
		<input type="hidden" name="actionflag" value="login">
		<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?> ">
		<div class="row">
			<div class="col s2">
				E-mail:
			</div>
			<div class="col s4">
				<input type="text" name="login" value="<?php if(isset($_SESSION['session']['login'])) print $_SESSION['session']['login']; ?>"  >
			</div>
		</div>
		<div class="row">
			<div class="col s2">
				Password:
			</div>
			<div class="col s4">
				<input type="password" name="password" value="" maxlength="16">
			</div>
		</div>
		<div class="row">
			<div class="col s6">
				<input type="submit" class="waves-effect waves-light btn" value="login" >
			</div>
		</div>
	</form>
</div>
</b>
</div>



<!-- <script src="js/materialize.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
<!-- <script src="js/init.js"></script> -->
<script src="js/myjs.js"></script>


</body>
</html>