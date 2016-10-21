<?php
include("dblib.php");
include("clublib.php");

$club_row=checkUserSession("members", "login", $_SESSION["session"]["login"]);
$message="";

?>



<html>
<head>
	
	<title>View Club</title>
</head>
<body>

	<?php
	include("publicnav.inc");
	?>

<div class="container">


	<div class="row">
		<div class="col m8">
			<p>
				
				<?php
					if($message!=""){print "<b>$message</b><p>";}
					if($_SESSION["session"]["error"]!=""){print "<b>".$_SESSION["session"]["error"]."</b>";}
				?>


				<ul class="coll">
				    <li>
				      <div class="coll-header">All Clubs</div>
				      <div class="coll-body"><p><?php printClubs(); ?></p></div>
				    </li>
				    <li>
				      <div class="coll-header">My Club</div>
				      <div class="coll-body"><p><?php printClubDetails($_SESSION["session"]["club_id"]); ?></p></div>
				    </li>
				  </ul>
	
				
			</p>
		</div>
		<div class="col m4"><?php include("createevent.php"); ?></div>
	</div>
	
</div>



<!-- <script src="js/materialize.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
<!-- <script src="js/init.js"></script> -->
<script src="js/myjs.js"></script>

	
</body>
</html>


