

<html>
<head>
  <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
<link href="css/mycss.css" rel="stylesheet">
  
<link href="css/materialize.min.css" rel="stylesheet">

</head>
<body>

<nav class="blue darken-4">
<div class="nav-wrapper" >
	<ul class="right  " style="margin-right:20px;">
		<?php
		if(!isset($_SESSION["session"]["id"])){
		?>
      	<li><a href="login.php?<?php print SID ?> "> Login </a></li>

      	<li><a href="join.php?<?php print SID ?> "> Join </a></li>
    
        <?php	
		}
		else{

		?>
        <li><a href="viewProfile.php?user_id=<?php echo $_SESSION["session"]["id"]?>">
					<div class="smallDPholder">
						<?php getDP($_SESSION["session"]["login"]); ?>
					</div>
					<span style='font-size:13px;letter-spacing:0.1px;'>
					<?php
					echo $_SESSION["session"]["login"]."";
					
					?>
					</span>
				</a>
			</li>
			<li><a href="findFriends.php">Find Friends</a></li>
			<li><a href="showMsg.php"> <b><h4><?php echo allUnreadMessages()  ?></h4></b> </a></li>
			<li><a href="showNotifications.php"> <b><h4><?php echo unreadNotifications();  ?></h4></b> </a></li>
			<li><a href='logOut.php'>Log Out</a></li>
				<?php
			}
			?>
    </ul>
    <ul class="left hide-on-med-and-down navigation " style="margin-right:20px;">
		<li><a href="index.php?<?php print SID ?> "> Home</a></li>

		<?php 
		if(isset($_SESSION["session"]["id"])){
		?>
		<li><a href="updateclub.php?<?php print SID ?> "> Update Club</a></li>
		<li><a href="viewProfile.php?user_id=<?php echo $_SESSION["session"]["id"] ;?>"> Profile </a></li>

		<?php
		}
		?>
		<li><a href="viewclubs.php?<?php print SID ?> "> Clubs </a></li>
		<li><a href="members.php?<?php print SID ?> ">  Events </a></li>

	
	</ul>
	<ul id="nav-mobile" class="side-nav">
		<li><a href="index.php?<?php print SID ?> "> Home</a></li>

		<?php 
		if(isset($_SESSION["session"]["id"])){
		?>
		<li><a href="updateclub.php?<?php print SID ?> "> Update Club</a></li>
		<li><a href="viewProfile.php?user_id=<?php echo $_SESSION["session"]["id"] ;?>"> Profile </a></li>

		<?php
		}
		?>
		<li><a href="viewclubs.php?<?php print SID ?> "> Clubs </a></li>
		<li><a href="members.php?<?php print SID ?> ">  Events </a></li>

      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    
</div>
</nav>



    <script src="js/jquery.min.js"></script>
    <script src="js/materialize.min.js"></script>
  <script src="js/init.js"></script>

<?php
if(isset($_SESSION["session"]["id"])){
include ("chat.php");
}
?>




</body>
</html>