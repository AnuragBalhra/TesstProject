<?php
include("dblib.inc");
include("clublib.php");
SetVariables();


$club_row=checkUserSession("members", "login", $_SESSION["session"]["login"]);
$message="";


if(!isset($_REQUEST["notif_id"])){
	$_SESSION["session"]["error"]=" user does not exist";
	header("Location:showNotifications.php");
	exit;
}
if(isset($_REQUEST["response"])){
	requestResponse( $_REQUEST["response"], $_REQUEST["notif_id"] );
}
?>


<html>
<head>
	
</head>

<body>

	<?php

include("publicnav.inc");
?>

<?php
				if($message!=""){print "<b>$message</b><p>";}
				if($_SESSION["session"]["error"]!=""){print "<b>".$_SESSION["session"]["error"]."</b><p>";$_SESSION["session"]["error"]="";}
			?>



<div class="container">

	<div class="row">
		<?php readNotification($_REQUEST["notif_id"]);?>
		<a href="<?php echo $_SERVER["PHP_SELF"]."?response=accept&notif_id=".$_REQUEST["notif_id"] ;?>" class="waves-effect waves-light btn">Accept</a>
		<a href="<?php echo $_SERVER["PHP_SELF"]."?response=reject&notif_id=".$_REQUEST["notif_id"] ;?>" class="waves-effect waves-light btn">Reject</a>
	</div>
</div>





<!-- <script src="js/materialize.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
<!-- <script src="js/init.js"></script> -->
<script src="js/myjs.js"></script>

</body>
</html>