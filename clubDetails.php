<?php
include("dblib.inc");
include("clublib.php");
SetVariables();
if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="comment"){
	if(!empty($_REQUEST["comment"])){
		addComment($_REQUEST["comment"], $_REQUEST["club_id"], $_SESSION["session"]["login"], "clubs");
		//header("Location:".$_SERVER["PHP_SELF"]."?event_id=".$_REQUEST["event_id"]);
	}
}

?>


<html>
<head>
		<script>
	
	</script>
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
	<?php

	$club_id=$_REQUEST["club_id"];
	printClubDetails($club_id);
	?>

	<br>
	<b>Comments</b><br>
	<?php 
	printComments( $club_id, "clubs");
	?><br>

	<form name="commentsform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input type="hidden" name="actionflag" value="comment">
			<input type="hidden" name="club_id" value="<?php echo $club_id ?>">
		<textarea name="comment" class="comments" wrap="virtual">comment</textarea></br>
				<input type="submit" class="waves-effect waves-light btn" value="Comment">
	</form>
</div>



<!-- <script src="js/materialize.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
<!-- <script src="js/init.js"></script> -->
<script src="js/myjs.js"></script>


</body>
</html>