<?php
include("dblib.inc");
include("clublib.php");

$club_row=checkUserSession("members", "login", $_SESSION["session"]["login"]);
$message="";

if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="event")
{
	if(empty($_REQUEST["ename"])){$message="You must have a event name<br>";}
	if(!getRow( "areas", "id", $_REQUEST["earea"])){ $message="Panic: Area code not found<br>";}
	if(!getRow( "types", "id", $_REQUEST["etype"])){ $message="Panic: Type code not found<br>";}
	if($message=="")
	{
		addEvent($_REQUEST["etype"], $_REQUEST["earea"], $_REQUEST["ename"], $_REQUEST["evenue"], $_REQUEST["edescription"], $_SESSION["session"]["id"]);
		header("Location:members.php?".SID);
		exit;
	}
}

?>



<html>
<head>
	
	<title>See club Events!</title>
</head>
<body>

<?php
include("publicnav.inc");
?>


<div class="container">

	<div class="row">
		<div class="col m8">
			<p>
				<h4>Latest Club Events</h4>

			<?php
				if($message!=""){print "<b>$message</b><p>";}
				if($_SESSION["session"]["error"]!=""){print "<b>".$_SESSION["session"]["error"]."</b><p>";$_SESSION["session"]["error"]="";}
			?>


			<ul class="coll">
				    <li>
				      <div class="coll-header">All Events</div>
				      <div class="coll-body"><?php printEvents(); ?></div>
				    </li>
				    <li>
				      <div class="coll-header">My Events</div>
				      <div class="coll-body"><?php printClubEvents($_SESSION["session"]["club_id"]); ?></div>
				    </li>
			</ul>
	

			
		</p>
		</div>
		<div class="col m4">
			<?php
			include("createevent.php");
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


