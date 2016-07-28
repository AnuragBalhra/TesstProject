<?php
include("dblib.inc");
include("clublib.php");
// SetVariables();

$club_row=checkUserSession("members", "login", $_SESSION["session"]["login"]);
$message="";

if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="post")
{	
	//echo"actionflag test pass<BR>";
	if(empty($_REQUEST["post"]) && empty($_REQUEST["post_2"]) && empty($_REQUEST["postPhoto"])){$message=" You can't have empty post <br>";}
	if($message==""  && !empty($_REQUEST["post"]))
	{	
		// echo"post 1 done";
		addPost( $_REQUEST["post"], $_SESSION["session"]["login"] );
		// header("Location:index.php?".SID);
		// exit;
	}
	else if($message==""  && (!empty($_REQUEST["post_2"]) || !empty($_REQUEST["postPhoto"]))){
		// echo "trying photo post<br>";
		// echo $_FILES["postPhoto"]["tmp_name"];
		if(isset($_FILES["postPhoto"])){
		// echo"photo set trying to upload...<br>";
		$target_dir = "uploads/";
		$target_file = $target_dir .time(). basename($_FILES["postPhoto"]["name"]);

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$imageFileType=strtolower($imageFileType);
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
		    if (move_uploaded_file($_FILES["postPhoto"]["tmp_name"], $target_file)) {
		    	// echo "I'm in<br>posted the photo";
		    	// echo $_REQUEST["post_2"]."<br><br>".$_SESSION["session"]["login"]."<br>";
				$post_id=addPost( $_REQUEST["post_2"], $_SESSION["session"]["login"] );
				// echo "<br>gotpost id ".$post_id."<br>";
		        addPostPhoto( $target_file, $post_id);
		    }
		     else {
		        echo "Sorry, there was an error uploading your file.";
		    	}
			}
		}
		else {
			addPost( $_REQUEST["post_2"], $_SESSION["session"]["login"] );
		}	
	}
}

?>



<html>
<head>
    
	
	<title>HomePage!</title>
</head>
<body>


<?php
include("publicnav.inc");
?>

<div class="row">
	<div class="col m2">
		<br>
		<?php printLeftPane();?>
	</div>
	<div class="col m6">
<div class=" row ">

	<?php
				if($message!=""){print "<b>$message</b><p>";}
				if($_SESSION["session"]["error"]!=""){print "<b>".$_SESSION["session"]["error"]."</b><p>";$_SESSION["session"]["error"]="";}
			?>


		<div class="col m12 " style="background-color:#F5F4F5;">
			<p>
				<b>Whats in you mind today?</b>

			
				
					
					<ul class="coll" style="height:200px;">
				    <li>
				      <div class="coll-header">Add Post: </div>
				      <div class="coll-body">

				      	<form action="<?php print htmlspecialchars($_SERVER["PHP_SELF"]) ; ?>" method="post" >
			
		      				<input type="hidden" name="actionflag" value="post">
							<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
			

				    	
							<textarea name="post" wrap="virtual"><?php if(isset($_REQUEST['post'])) print $_REQUEST['post']; ?></textarea>
			
							<br><br><br><br>
							<div class="row">
								<div class="col m4 push-m8">
									<input type="submit" class="waves-effect waves-light btn" value="Add Post">
								</div>
							</div>	
							
						</form>
						
						</div>
				    </li>
				    <li>
				      <div class="coll-header" id="postPhoto">Upload Photo</div>
				      <div class="coll-body">
				      	

				      	<form action="<?php print $_SERVER['PHP_SELF'] ; ?>" method="post"  enctype="multipart/form-data">
			
		      				<input type="hidden" name="actionflag" value="post">
							<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">

							<textarea name="post_2" wrap="virtual"><?php if(isset($_REQUEST['post'])) print $_REQUEST['post']; ?></textarea>
							<p id="post_photo">
								<input type="file" name="postPhoto" id="postPhoto"><br><br>
							</p>

							<div class="row">
								<div class="col m4 push-m8">
									<input type="submit" class="waves-effect waves-light btn" value="Add Post">
								</div>
							</div>	
							
						</form>
				  </li>
				  </ul>
	

<script src="js/jquery.min.js"></script>
	<script src="js/myjs.js"></script>
			


			<div class="row">
				<div id ="Wall">
					<?php
					printPosts($_SESSION["session"]["id"]);
					?>
				</div>
			</div>
		</div>
	</div>
</div>

		<div class="col m4">
			<div class="row">
				<div class="col m12"><h5>My Latest Events</h5><?php printClubEvents($_SESSION["session"]["club_id"]) ;?></div>
			</div>
			<div class="row">
				<div class="col m12"><h5>All Users</h5><?php printAllUsers() ;?></div>
			</div >
		</div>

	</div>
</div>


<?php include"footer.html"; ?>


<!-- <script src="js/materialize.min.js"></script> -->
<!-- <script src="js/init.js"></script> -->

<script>
//		unsuccessful attempt to fetch posts using ajax 
//		function not completed because database is extensively used while printing post details and everything cannot be fetched using json object


// $(document).ready(function(){
//   startFetchPosts();
// });

// function startFetchPosts(){
//   setInterval( function() { printPosts(); }, 1000 );
// }

//     var time=0;
//     function printPosts(){
//         //first fetch json object containing all post details
//         var xhttp=new XMLHttpRequest();
//         xhttp.open("GET","LS.php?time="+time+"&user_id="+<?=$_SESSION["session"]["id"]; ?>,true);
//         xhttp.send();
//         xhttp.onreadystatechange=function(data){

//           var string="";
//            if (xhttp.readyState == 4 && xhttp.status == 200) {

//             var json=JSON.parse(xhttp.responseText);        
//             var i=1;
//             if(json[0]){
// 	            	time=json[0].time;
// 	            if(json[i]!=""){
// 	                while(json[i] ){
// 	                	string="<div class='postCard'><a href='viewProfile.php?user_id="+json[i].user_id+"'><br><b><div class='smallDPholder'> <img src=' "+json[i].user_DP+"' alt='DP' class='responsive-img'> </div>"+json[i].user_id+"</b></a><br><span class='time'> "+json[i].time+" </span><div>"+json[i].post+"</div>";
	                	
// 	                	strin=string+"<hr style='align:center;border-color:#FEFEFE;'>";
// 	                    string=json[i].id+string;
// 	                  i=i+1;
// 	               }
// 	             }
// 	             $("#Wall").html(string);
//          	}
//         }
//       }
//     }
</script>


</body>
</html>


