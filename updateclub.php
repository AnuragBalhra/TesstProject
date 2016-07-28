<?php
include("dblib.inc");
include("clublib.php");

$club_row=checkUserSession("members", "login", $_SESSION["session"]["login"]);
$message="";

if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="update")
{
	if(empty($_REQUEST["name"])){$message="You must have a club name<br>";}
	if(!getRow( "areas", "id", $_REQUEST["area"])){ $message="Panic: Area code not found<br>";}
	if(!empty($_REQUEST["type"])){
		$row=getRow("types","value",$_REQUEST["type"]);
		if(!isset($row) ){
			$area_id=addType($_REQUEST["type"]);
		}
	}
	if($message=="")
	{
		updateOrg( $_SESSION["session"]["club_id"], $_REQUEST["name"], $_REQUEST["area"], $_REQUEST["type"], $_REQUEST["mail"], $_REQUEST["description"]);
		header("Location:members.php?".SID);
		exit;
	}
	
}

?>



<html>
<head>
	
	<title>Update your club Details!</title>
</head>
<body>


<?php
include("publicnav.inc");
?>

<div class="container">

	<div class="row">
		<div class="col m8">
			<p>
				<b>Amend Club Information</b>

			<?php
				if($message!=""){print "<b>$message</b><p>";}
				if($_SESSION["session"]["error"]!=""){print "<b>".$_SESSION["session"]["error"]."</b><p>";}
			?>

			<form action="<?php print htmlspecialchars($_SERVER["PHP_SELF"]) ; ?>">
				<p>

					<input type="hidden" name="actionflag" value="update">
					<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
					<div class="row">
						<div class="col m2">
							Club Name:
						</div>
						<div class="col m8">
							<input type="text" name="name" value="<?php if(isset($_REQUEST['name'])) print $_REQUEST['name']; ?>" >
						</div>
					</div>
				</p>
				<p>
					<div class="row">
						<div class="col m2">
					Club area:<br>
						</div>
						<div class="col m8">

					<select name="area" class="browser-default">
						<?php 
						writeOptionList("areas", $_REQUEST["area"]) 
						?>

						<select>
						</div>
					</div>
				</p>
				<p>
					<div class="row">
						<div class="col m2">

					Club type:<br>
						</div>
						<div class="col m8">
						<input type="text" name="type" value="<?php if(isset($_REQUEST['type'])){ echo $_REQUEST['type'] ;}?>"><br><br>
		
						</div>
					</div>
				</p>
				<p>
					<div class="row">
						<div class="col m2">
					Contact E-mail:<br>
						</div>
						<div class="col m8">
					<input type="text" name="mail" value="<?php if(isset($_REQUEST['mail'])) print $_REQUEST['mail'] ; ?>" >
						</div>
					</div>
				</p>
				<p>
					<div class="row">
						<div class="col m2">
					Club Description:<br>
						</div>
						<div class="col m8">
					<textarea name="description" rows="5" cols="30" wrap="virtual">
						<?php //if(isset($_REQUEST['description'])) print $_REQUEST['description']; ?> 
				</textarea>
						</div>
					</div>
				</p>

				<p>
					<div class="row">
						<div class="col m4 push-m8">
							<input type="submit" class="waves-effect waves-light btn" value="update">
						</div>
					</div>
				</p>
			</form>
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


