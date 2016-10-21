<?php
include("dblib.php");
include("clublib.php");


$club_row=checkUserSession("members", "login", $_SESSION["session"]["login"]);
$message="";
if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="msg"){
	if(!empty($_REQUEST["msg"])){
		sendMessage($_REQUEST["msg"], $_REQUEST["sender_id"]);
		header("Location:".$_SERVER["PHP_SELF"]."?sender_id=".$_REQUEST["sender_id"]);
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


<div class="container">

	<div class="row">
			<div class="col m4">
				<?php printContacts(); ?>
			</div>
			<div class="col m6">
				
				<div class="row messages" style="height:60%;overflow:auto;">
					<div class="col m12 ">
						<?php 
							if(isset($_REQUEST["sender_id"])){
							readMessage($_REQUEST["sender_id"]);
							printMsg($_REQUEST["sender_id"]);
						?>
					</div>
				</div>
				<div class="row" style="height:10%;overflow:hidden;">
					<form action="<?php print htmlspecialchars($_SERVER["PHP_SELF"]) ; ?>" method="post">
					
						<input type="hidden" name="actionflag" value="msg">
						<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
						<input type="hidden" name="sender_id" value="<?php echo $_REQUEST["sender_id"] ;?> ">

						<div class="row">
							<div class="col m2">
						Send Message: <br>
							</div>
							<div class="col m8">
						<textarea name="msg" rows="1" cols="100" wrap="virtual" style="width:100%;height:100%;"><?php if(isset($_REQUEST['msg'])) print $_REQUEST['msg']; ?></textarea>
							</div>
							<div class="col m2 ">
								<input type="submit" style="width:50%;height:50%;margin:15 0 0 0px;background-color:#00BBBB;color:white;" value=">" class="circle">
							</div>
						</div>
					
					</form>
				</div>
					<?php
				}
				?>
			</div>
	</div>
</div>




<!-- <script src="js/materialize.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
<!-- <script src="js/init.js"></script> -->
<script src="js/myjs.js"></script>
<script>
// $(document).ready(
//   function(){
//     $('.messages').scrollTop($('.messages')[0].scrollHeight);
//   }
//   );
</script>
</body>
</html>