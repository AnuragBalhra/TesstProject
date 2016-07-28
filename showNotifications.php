<?php
include("dblib.inc");
include("clublib.php");
SetVariables();


$club_row=checkUserSession("members", "login", $_SESSION["session"]["login"]);
$message="";

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
				<?php printNotifications(); ?>
			</div>
	</div>
</div>




<!-- <script src="js/materialize.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
<!-- <script src="js/init.js"></script> -->
<script src="js/myjs.js"></script>


</body>
</html>