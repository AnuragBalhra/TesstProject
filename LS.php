<?php 

include("dblib.inc");
include("clublib.php");
SetVariables();

if(isset($_REQUEST["like"])){ 
	 echo "<span class='number' >".like($_REQUEST["like"])."</span>Unlike"; 
	}

if(isset($_REQUEST["Unlike"])){
 echo "<span class='number' >".Unlike($_REQUEST["Unlike"])."</span>like";
}

if(isset($_REQUEST["share"])){
 echo "<span class='number' >".share($_REQUEST["share"])."</span>share";
	

}


if(isset($_REQUEST["comment"])){
		addComment($_REQUEST["comment"], $_REQUEST["post_id"], $_SESSION["session"]["login"], "posts");
		//header("Location:".$_SERVER["PHP_SELF"]."?event_id=".$_REQUEST["event_id"]);
	}



//		part of unsucessful attempt to fetch posts using ajax
// if(isset($_REQUEST["time"])){
//  echo fetchPostsData($_REQUEST["user_id"], $_REQUEST["time"]);
//}
?>