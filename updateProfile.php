<?php

include("dblib.inc");
include("clublib.php");
SetVariables();
if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="updateProfile" ){
	if(isset($_FILES["fileToUpload"]["tmp_name"])){
		$target_dir = "uploads/";
		$target_file = $target_dir.time() . basename($_FILES["fileToUpload"]["name"]);

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$imageFileType=strtolower($imageFileType);
		
		// Check if image file is a actual image or fake image
		// if(isset($_POST["submit"])) {
		//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		//     if($check !== false) {
		//         echo "File is an image - " . $check["mime"] . ".";
		//         $uploadOk = 1;
		//     } else {
		//         echo "File is not an image.";
		//         $uploadOk = 0;
		//     }
		// }

		// Check if file already exists
		echo $imageFileType;
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 50000000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		        updateMemberInfo("DP", $target_file, "login", $_SESSION["session"]["login"]);
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}
	if(!empty($_REQUEST["firstname"])){
		updateMemberInfo("firstname", $_REQUEST["firstname"], "login", $_SESSION["session"]["login"]);
	}
	if(!empty($_REQUEST["lastname"])){
		updateMemberInfo("lastname", $_REQUEST["lastname"], "login", $_SESSION["session"]["login"]);
	}
	if(!empty($_REQUEST["dob"])){
		updateMemberInfo("dob", $_REQUEST["dob"], "login", $_SESSION["session"]["login"]);
	}
	if(!empty($_REQUEST["area"])){
		$row=getRow("areas","value",$_REQUEST["area"]);
		if(isset($row) && !empty($row)){
			updateMemberInfo("area_id", $row["id"], "login", $_SESSION["session"]["login"]);
		}
		else{
			$area_id=addArea($_REQUEST["area"]);
			updateMemberInfo("area_id", $area_id, "login", $_SESSION["session"]["login"]);
		}
	}
	header("Location:viewProfile.php?user_id=".$_SESSION["session"]["id"]);

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
	<form actiion="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data" >
		<h2>Update Profile</h2>
		<input type="hidden" name="actionflag" value="updateProfile">
		<input type="hidden" name="<?php echo session_name();?>" value="<?php echo session_id();?>">
		Firstname: <input type="text" name="firstname" value="<?php if(isset($_REQUEST['firstname'])){ echo $_REQUEST['firstname'] ;}?>"><br><br>
		Lastname: <input type="text" name="lastname" value="<?php if(isset($_REQUEST['lastname'])){ echo $_REQUEST['lastname'] ;}?>"><br><br>
		DateOfBirth:<input type="text" name="dob" value="<?php if(isset($_REQUEST['dob'])){ echo $_REQUEST['dob'] ;}?>"><span style="font-size:10px;color:lightgrey">[yyyy-mm-dd]</span><br><br>
		Area: <input type="text" class="suggest" name="area" value="<?php if(isset($_REQUEST['area'])){ echo $_REQUEST['area'] ;}?>"><br><br>
		
			Select DP to upload:<input type="file" name="fileToUpload" id="fileToUpload"><br><br>
				<input type="submit" class="waves-effect waves-light btn" value="Update">
		
	</form>
</div>




<!-- <script src="js/materialize.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
<!-- <script src="js/init.js"></script> -->
<script src="js/myjs.js"></script>

</body>
</html>