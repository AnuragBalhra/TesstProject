<?php
include("dblib.inc");
include("clublib.php");
SetVariables();


if(!isset($_REQUEST["user_id"])){
	$_SESSION["session"]["error"]=" user does not exist";
	header("Location:viewclubs.php");
	exit;
}
if(isset($_REQUEST["user2_id"]) && $_SESSION["session"]["id"]!=$_REQUEST["user2_id"]){
	sendRequest($_REQUEST["user2_id"]);
}

?>


<html>
<head>
	
</head>

<body>

	<?php

include("publicnav.inc");
?>



	<div class="row">
		<?php if($_REQUEST["user_id"]==$_SESSION["session"]["id"]){
			?>

		
		<a href="updateProfile.php">
		
			<?php } ?>
			<div class="col m2 push-m1" style="min-width:200px;">
				<?php $memberInfo=getRow("members", "id", $_REQUEST["user_id"] ); ?>
				<div class="userDetails" >
				
				<h2>
					<?php echo $memberInfo["login"] ;?>
					
					<?php

					if(isOnline($_REQUEST["user_id"])==1){echo "<div style='background-color:green;width:10px;height:10px;display:inline-block;font-size:0.2em;color:green;' class='circle'>online</div>";}
					else{echo "<div style='background-color:red;width:10px;height:10px;display:inline-block;font-size:0.2em;color:red;' class='circle'>offline</div>";}
					?>
				</h2>
				Firstname: <?php echo $memberInfo["firstname"] ?><br><br>
				Lastname: <?php echo $memberInfo["lastname"] ?><br><br>
				DateOfBirth: <?php echo $memberInfo["dob"] ?><br><br>
				Area: <?php $row=getRow("areas","id",$memberInfo["area_id"]);echo $row["value"] ;?><br><br>
				<?php
				if(areFriends($_REQUEST["user_id"], $_SESSION["session"]["id"] ) ){
					if($_SESSION["session"]["id"]!=$_REQUEST["user_id"] && empty($_REQUEST["user2"])){
						echo "<a href='".$_SERVER["PHP_SELF"]."?user_id=".$_REQUEST["user_id"]."&"."user2_id=".$_REQUEST["user_id"]." ' class='waves-effect waves-light btn'>Add Friend</a>";
					}	
					
				}
				else if(areFriends($_REQUEST["user_id"], $_SESSION["session"]["id"] )==1){
					echo "<a class='waves-effect waves-light btn grey'>Friend request sent</a>";
				}
				else{
					echo "<a class='waves-effect waves-light btn grey'>Friends :-)</a>";
				}
				?>
				</div>
			</div>
			<div class="col m6 push-m1">
				<img src="<?php echo $memberInfo["DP"] ?>" class="responsive-img">
			</div>

		<?php if($_REQUEST["user_id"]==$_SESSION["session"]["id"]){
			?>

		</a>

			<?php } ?>

	</div>
	<div class="row">

		<div class="col m2 push-m1">
			
				<br>
				<h5>Friend's List:</h5>
				<?php
					printFriendsList($_REQUEST["user_id"]);
				?>
		</div>
		<div class="col m6 push-m1">
			<br>
				<h5>Latest Posts:</h5>
			<div class="row">
				<?php
				printPosts($_REQUEST["user_id"]);
				?>
			</div>
		</div>
	</div>




<!-- <script src="js/materialize.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
<!-- <script src="js/init.js"></script> -->
<script src="js/myjs.js"></script>


</body>
</html>