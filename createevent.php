<?php

if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="event")
{
	if(empty($_REQUEST["ename"])){$message="You must have a event name<br>";}
	if(!getRow( "areas", "id", $_REQUEST["earea"])){ $message="Panic: Area code not found<br>";}
	if(!getRow( "types", "id", $_REQUEST["etype"])){ $message="Panic: Type code not found<br>";}
	if($message=="")
	{	addEvent($_REQUEST["etype"], $_REQUEST["earea"], $_REQUEST["ename"], $_REQUEST["evenue"], $_REQUEST["edescription"], $_SESSION["session"]["club_id"]);
		header("Location:members.php?".SID);
		exit;
	}
}
?>
<html>
<head>

  </head>
  <body>
<div class="right" >
<b>Create Event</b>

<form action="<?php print htmlspecialchars($_SERVER["PHP_SELF"]) ; ?>">
		<input type="hidden" name="actionflag" value="event">
		<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
		<div class="row">
			<div class="col m3">
				Event Name:
			</div>
			<div class="input-field col m9">
				<input type="text" name="ename" value="<?php if(isset($_REQUEST['name'])) print $_REQUEST['name']; ?>" id="e_name" class="validate">
			</div>
		<div>
		
		<div class="row">
			<div class="col m3">
				Event Area:
			</div>
			<div class=" input-field col m9">
			<select name="earea" class="browser-default">
				<?php 
				writeOptionList("areas", $_REQUEST["earea"]) 
				?>		
			</select>
			</div>
		</div>

		<div class="row">
			<div class="col m3">
				Event type:
			</div>
			<div class="col m9">
				<select name="etype" class="browser-default">
				<?php 
				writeOptionList("types", $_REQUEST["etype"]) 
				?>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col m3">
				Event venue :
			</div>
			<div class="col m9">
				<input type="text" name="evenue" value="<?php if(isset($_REQUEST['mail'])) print $_REQUEST['mail'] ; ?>" >
			</div>
		</div>

		<div class="row">
			<div class="col m3">
				Event Description:<br>
			</div>
			<div class="col m9">
				<textarea name="edescription" rows="5" cols="30" wrap="virtual" class="materialize-textarea"><?php if(isset($_REQUEST['edescription'])){print $_REQUEST['edescription'];} ?> </textarea>
			</div>
		</div>
		
		<div class="row">
			<div class="col m4 push-m4">
				<input type="submit" class="waves-effect waves-light btn" value="Create">
			</div>
		</div>
</form>
</div>

</div>



<!-- <script src="js/materialize.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
<!-- <script src="js/init.js"></script> -->
<script src="js/myjs.js"></script>


</body>
</html>