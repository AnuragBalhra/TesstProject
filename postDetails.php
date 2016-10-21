<?php
include("dblib.php");
include("clublib.php");
SetVariables();
$message="";
if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="comment"){
	if(!empty($_REQUEST["comment"])){
		addComment($_REQUEST["comment"], $_REQUEST["post_id"], $_SESSION["session"]["login"], "posts");
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

	$post_id=$_REQUEST["post_id"];
	printPost($post_id);
	?>

	<br>
	<?php 
	printComments( $post_id, "posts");
	?><br>

	<form name="commentsform" action="<?php echohtmlspecialchars($_SERVER["PHP_SELF"]) ;?>" method="post">
		<input type="hidden" name="actionflag" value="comment">
			<input type="hidden" name="post_id" value="<?php echo $post_id ?>">
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