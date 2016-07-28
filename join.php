<?php
include("dblib.inc");
include("clublib.php");

$message="";
SetVariables();
if(isset($_SESSION["session"]["logged_in"]) && $_SESSION["session"]["logged_in"]==true){
	$_SESSION["session"]["error"]="Already logged in";
	header("Location:index.php");
	exit();
}
else{

	if(isset($_GET["actionflag"]) && $_GET["actionflag"]=="join")
	{

		if(empty($_GET["login"]) || empty($_GET["password"]) ||empty($_GET["password2"])){$message="You must fill all fields<br>";}	
		else if($_GET['password']!=$_GET['password2']){$message="Your Passwords did not match<br>";}
		else if(getRow("members","login",$_GET['login'])){$message="Login Username already exists.Try another<br>";}
		else if(empty($message))
		{
			$id=newUser( $_GET['login'], $_GET['password'] );
			//cleanMemberSession( $id, $_GET['login'], $_GET['password'] );
			header("Location:login.php?".SID);
			exit();
		}
	}
}
?>

<html>
<head>
	
	<title>Join!</title>
</head>
<body>

<?php
include("publicnav.inc");
?>

<div class="container">


<p>
	<h1 style="color:blue">SignUp</h1>

<?php
	if($message!=""){print "<b>$message</b><p>";}
	if(isset($_SESSION["session"]["error"]) && $_SESSION["session"]["error"]!=""){print "<b>".$_SESSION["session"]["error"]."</b></p>";$_SESSION["session"]["error"]="";}
?>

<p>
	<form action="<?php print htmlspecialchars($_SERVER["PHP_SELF"]) ; ?>" >
		<input type="hidden" name="actionflag" value="join">
		<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?> ">
		<div class="row">
			<div class="col s2">
				Login Id:
			</div >
			<div class="col s4">
				<input type="text" name="login" value="<?php if(isset($_GET['login'])) print $_GET['login']; ?>" >
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
			<div class="col s2">
				Confirm Password:
			</div>
			<div class="col s4">
		<input type="password" name="password2" value="" maxlength="8">
			</div>
		</div>
		<div class="row">
			<div class="col s6">
				<input type="submit" class="waves-effect waves-light btn" value="SignUp" >
			</div>
		</div>
</form>
</div>



<!-- <script src="js/materialize.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
<!-- <script src="js/init.js"></script> -->
<script src="js/myjs.js"></script>


</body>
</html>