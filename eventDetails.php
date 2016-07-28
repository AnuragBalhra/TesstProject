<?php
include("dblib.inc");
include("clublib.php");
SetVariables();
$message="";
if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="comment"){
	if(!empty($_REQUEST["comment"])){
		addComment($_REQUEST["comment"], $_REQUEST["event_id"], $_SESSION["session"]["login"], "events");
		//header("Location:".$_SERVER["PHP_SELF"]."?event_id=".$_REQUEST["event_id"]);
	}
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
	<?php

	$event_id=$_REQUEST["event_id"];
	$event_row=getRow("events", "id", $event_id);
	echo "<h1>".$event_row["ename"]."</h1>";
	echo "event id: ".$event_row["id"]."<br>";
	echo "event type: ".$event_row["etype"]."<br>";
	echo "event area: ".$event_row["earea"]."<br>";
	echo "event date: ".$event_row["edate"]."<br>";	
	echo "event venue: ".$event_row["evenue"]."<br>";
	echo "event address: ".$event_row["eaddress"]."<br>";
	echo "event zip: ".$event_row["ezip"]."<br>";
	echo "event description: ".$event_row["edescription"]."<br>";
	echo "Club id: ".$event_row["club_id"]."<br>";
	?>

	<br>
	<b>Comments</b><br>
	<?php 
	printComments( $event_id, "events");
	?><br>

	<form name="commentsform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<input type="hidden" name="actionflag" value="comment">
			<input type="hidden" name="event_id" value="<?php echo $event_id ?>">
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