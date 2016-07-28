<?php 
	session_start();

$link;
function connectToDB(){
	//connects to mySQL server 
	global $link;
	$link=mysql_connect("localhost","newaccount","newpass") or die("Couldn't connect to database:\t".mysql_error());
	mysql_select_db("Organizer",$link) or die("Couldn't open Oranizer:".mysql_error());
}
function addArea($area){
	global $link;
	$result= mysql_query(" INSERT INTO areas(value) VALUES('$area')", $link);
	return mysql_insert_id($result);
}
function addType($type){
	global $link;
	$result= mysql_query(" INSERT INTO types(value) VALUES('$type')", $link);
	return mysql_insert_id($result);
}

function getRow($table, $fnam, $fval){
	//fetches a row from given table whose given column has value $fval
	global $link;
	connectToDB();
	$result=mysql_query("SELECT * FROM $table WHERE $fnam='$fval' ", $link);
	$result=mysql_fetch_array( $result );
	if(!$result){
		return ;
	}
	return $result;
}

function newUser( $login, $pass){
	///adds new user and club to database
	global $link;
	$result= mysql_query(" INSERT INTO members(login, password) VALUES('$login', '$pass')", $link);
	$result= mysql_insert_id($link);
	
	$result= mysql_query(" INSERT INTO clubs(user_id) VALUES('$result')", $link);
	return mysql_insert_id($link);
}
function addPostPhoto( $photoAddr, $post_id){
	///adds new photo along with a post 
	global $link;
	connectToDB();
	$result= mysql_query(" INSERT INTO photos( photoAddr, post_id) VALUES('$photoAddr', '$post_id')", $link);
	return mysql_insert_id($link);
}
function updateMemberInfo($column, $value, $refcol, $refval){
	global $link;
	$result= mysql_query(" UPDATE members SET $column='$value' WHERE $refcol='$refval' ", $link) or die(mysql_error());
}
function writeOptionList( $table, $id){
	//to print list of types and areas in form <select> from types and areas tables
	global $link;
	$result=mysql_query("SELECT * FROM $table", $link);
	if(!$result)
	{
		print "failed to open $table<p>";
		return false;
	}
	while($a_row=mysql_fetch_row($result))
	{
		print "<option value=\"$a_row[1]\" ";
		if($id==$a_row[1]){print "selected";}
		print ">$a_row[0]\n</option>";
	}
}

function updateOrg(  $id, $name, $area, $type, $mail, $description){
	//to  set all details of current user's club
	global $link;
	$query=" UPDATE clubs set name='$name', area='$area', type='$type', mail='$mail', description='$description' WHERE id='$id' ";
	$result=mysql_query($query, $link);
	if(!$result)
	{
		die( " updateOrg update Error:".mysql_error() );
	}
}
function addEvent($etype, $earea, $ename, $evenue, $edescription, $club_id){
	//adds a new event of current club
	global $link;
	$query=" INSERT INTO events(etype, earea, ename, evenue, edescription, club_id)  VALUES('$etype', '$earea', '$ename', '$evenue', '$edescription', '$club_id') ";
	$result=mysql_query($query, $link);

	$club_row=getRow("clubs", "id", $club_id);
	$club_name=$club_row["name"];
	$arr =mysql_query(" SELECT id FROM members ", $link);
	while($user_row=mysql_fetch_row($arr))
	{$user_id=$user_row[0];

		$result= mysql_query(" INSERT INTO notifications(notification, user_id, status) VALUES ('$club_name Club has created a new event ', '$user_id', 'unread') ",$link) or die(mysql_error());
	}
	if(!$result)
	{
		die( " updateOrg update Error:".mysql_error() );
	}
}
function printEvents(){
	//prints list of all clubs
	global $link;
	$arr =mysql_query(" SELECT * FROM events ", $link);
	$row=mysql_fetch_row($arr);
	while($row){
		
		echo "<a href='eventDetails.php?event_id=".$row[0]."'><div class='eventCard'><b><h5>".$row[4]."</h5></b><br>club id :<b>".$row[9]." </b> </a><br></div>";
			$row=mysql_fetch_row($arr);
	}
}
function printClubEvents($club_id){
	//prints list of all clubs
	global $link;
	$arr =mysql_query(" SELECT * FROM events WHERE club_id='$club_id' ", $link);
	$row=mysql_fetch_row($arr);
	while($row){
		
		echo "<a href='eventDetails.php?event_id=".$row[0]."'><div class='clubCard'><b><h5>".$row[4]."</h5></b><br>club id :<b>".$row[9]." </b> </a><br></div>";
			$row=mysql_fetch_row($arr);
	}
}
function printClubs(){
	//prints list of all clubs
	global $link;
	$arr =mysql_query(" SELECT * FROM clubs ", $link);
	$row=mysql_fetch_row($arr);
	while($row){
		$owner=getRow("members", "id", $row[6]);
		echo "<a href='clubDetails.php?club_id=".$row[0]."'><div class='clubCard'><b><h5>".$row[1]."</h5></b>	<br>".$row[5]."<br>club owner :<b>".$owner[1]." </b> </a><br><br></div>";
			$row=mysql_fetch_row($arr);
	}
}
function printClubDetails($club_id){
	//to print all details of given clu_id
	global $link;
	$club_row=getRow("clubs", "id", $club_id);
	echo "<h1>".$club_row["name"]."</h1>";
	echo "Club id: ".$club_row["id"]."<br>";
	echo "Club type: ".$club_row["type"]."<br>";
	echo "Club area: ".$club_row["area"]."<br>";
	echo "Club e-mail: ".$club_row["mail"]."<br>";
	echo "Club description: ".$club_row["description"]."<br>";
	echo "Owner id: ".$club_row["user_id"]."<br>";
}
function getDP($login){
	//prints DP of current user
	global $link;
	$row =mysql_fetch_array(mysql_query(" SELECT * FROM members WHERE login='$login' ", $link ) );
	echo "<img src=' ".$row["DP"]." ' alt='DP' class='responsive-img '>";
}
function addComment($comment, $post_id, $user, $comment_on){
	//to add a comment on a post
	global $link;
	$user_row=getRow("members", "login", $user );
	$user_id=$user_row["id"];
	$result= mysql_query(" INSERT INTO comments(description, post_id, user_id, comment_on) VALUES ('$comment', '$post_id', '$user_id', '$comment_on') ", $link) or die(mysql_error());
	$post= mysql_query(" SELECT * FROM posts WHERE id='$post_id' ", $link) or die(mysql_error());
	$comments=mysql_fetch_row($post)[7];//returns number of comments
	$comments=$comments+1;
	echo "add no of comments=".$comments."<br>";
	mysql_query(" UPDATE posts SET comments='$comments' WHERE id='$post_id' ",$link) or die(mysql_error());

}
function printComments( $post_id, $comment_on){
	//to print all comments on given post
	global $link;
	$result= mysql_query(" SELECT * FROM comments WHERE comment_on='$comment_on' And post_id='$post_id' ", $link) or die(mysql_error());
	//	echo "no error till now<br>";
		$row=mysql_fetch_row($result);
		while($row){
			$event_row=getRow($comment_on, "id", $row[2]);//
			$owner=getRow("members", "id", $row[3]);
			echo "<a href='viewProfile.php?user_id=".$owner[0]."'><br><b><div class='smallDPholder'>";
			getDP($owner[1]);
			echo "</div>".$owner[5]."</b></a><br><div>".$row[1]."</div>";
				$row=mysql_fetch_row($result);
		}
	}


function printLatestComments( $post_id, $comment_on, $lastComment_id){
	//to print all comments with id>lastComment_id on given post
	global $link;
	$result= mysql_query(" SELECT * FROM comments WHERE comment_on='$comment_on' And post_id='$post_id' And id>'$lastComment_id' ", $link) or die(mysql_error());
		$row=mysql_fetch_row($result);
		while($row){
			$event_row=getRow($comment_on, "id", $row[2]);//
			$owner=getRow("members", "id", $row[3]);
			echo "<a href='viewProfile.php?user_id=".$owner[0]."'><br><b><div class='smallDPholder'>";
			getDP($owner[1]);
			echo "</div>".$owner[5]."</b></a><br><div>".$row[1]."</div>";
				$row=mysql_fetch_row($result);
		}

	}


function addPost($post, $login){
	global $link;
	$owner=getRow("members", "login", $login);
	$user_id=$owner["id"];
	$result= mysql_query(" INSERT INTO posts(post, user_id) VALUES ('$post','$user_id') ", $link) or die(mysql_error());
	return mysql_insert_id($link);
}
function printPost($post_id){
	global $link;
	$post_Details=getRow("posts","id",$post_id);
	$owner=getRow("members", "id", $post_Details[2]);
	echo "
	<!--  printpost starts here  -->
	";
	echo "<div class='postCard'><a href='viewProfile.php?user_id=".$owner[0]."'><br><b><div class='smallDPholder'>";
	getDP($owner[1]);
	echo "</div>".$owner[5]."</b></a><br><span class='time'> ".$post_Details[3]." </span><div>".$post_Details[1]."</div>";
	printPostPhotos($post_id);

	echo "<hr style='align:center;border-color:#FEFEFE;'>";
	$user_id=$_SESSION["session"]["id"];
	$result=mysql_query(" SELECT * FROM likes WHERE user_id='$user_id' And post_id='$post_id' ",$link);
	$likes_row=mysql_fetch_row($result);
	if(!empty($likes_row[0])){
		echo "<a class='like' rel='unlikepost".$post_Details[0]." '> ";
	if($post_Details[5]!=0){echo "<span class='number'> ".$post_Details[5]."</span>";}
	echo "Unlike </a>";
	}
	else{
	echo "<a class='like' rel='likepost".$post_Details[0]." '> ";
	if($post_Details[5]!=0){echo "<span class='number'> ".$post_Details[5]."</span>";}
	echo "like </a>";
	}

	echo "<a class='comment' rel='commentpost".$post_Details[0]." '> ";
	if($post_Details[7]!=0){echo "<span class='number'> ".$post_Details[7]." </span>";}
	echo "comments </a>";
	echo "<a class='share' rel='sharepost".$post_Details[0]."'> ";
	if($post_Details[4]!=0){echo "<span class='number'> ".$post_Details[4]."</span>";}
	echo "share </a>";
	echo "<div class='commentsection' >";
	printComments( $post_Details[0], "posts");
	echo "<div class='commentarea'>";
	echo "</div>";?>
	<br><b>Comments</b><br><br>

			<textarea name="comment" class="comments" wrap="virtual">comment</textarea></br>
				<a class="addcomment" class="waves-effect waves-light btn" rel="commentpost<?php echo $post_Details["id"];?>">Comment</a>
	<?php
	echo "</div></div>";
	echo "
	<!--    print post ends here  -->

	";
}
function printSharedPosts( $post_id, $user_id){
	$sharedBy=getRow("members","id",$user_id);
	echo "<div class='shareCard'><a href='viewProfile.php?user_id=".$sharedBy[0]."'><br><b><div class='smallDPholder'>";
	getDP($sharedBy[1]);
	echo "</div>".$sharedBy[5]."</b></a> shared a post.<br>";
	printPost($post_id);
	echo " </div>";
}
function printLikedPosts( $post_id, $user_id){
	$likedBy=getRow("members","id",$user_id);
	echo "<div class='shareCard'><a href='viewProfile.php?user_id=".$likedBy[0]."'><br><b><div class='smallDPholder'>";
	getDP($likedBy[1]);
	echo "</div>".$likedBy[5]."</b></a> liked a post.<br>";
	printPost($post_id);
	echo " <br></div>";
}
function printPostPhotos($photoPost_id){
	global $link;
	$result=mysql_query(" SELECT photoAddr FROM photos WHERE post_id='$photoPost_id' ",$link);
	if(isset($result)){
		echo"<div class='photoCard'>";
		while($photo=mysql_fetch_row($result)){
			echo "<img src=' ".$photo[0]." ' alt=' ".$photo[0]." ' class='responsive-img'>";
		}
		echo"</div><br>";
	}	
	else{echo "hehehe";}
}
function printPosts($user_id ){
	//to print all posts of a user
	global $link;
	// first select all posts, shares, likes of user whose wall has to be printed
	$result=" SELECT id,user_id,IsShare,time FROM posts WHERE user_id='$user_id' UNION SELECT post_id,user_id,IsShare,time FROM shares WHERE user_id='$user_id' UNION SELECT post_id,user_id,IsShare,time FROM likes WHERE user_id='$user_id' ";
	// now select all friends of given user
	$friends=mysql_query(" SELECT user1_id FROM friends WHERE (status='success' And user2_id='$user_id') UNION SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id') ",$link) or die(mysql_error() );
	
	// now select all posts, shares, likes of all friends one by one
	while($arr=mysql_fetch_row($friends)){
		$value=$arr[0];//this is the user_id of friend 
		$result= " SELECT id,user_id,IsShare,time FROM posts WHERE user_id='$value' UNION SELECT post_id,user_id,IsShare,time FROM shares WHERE user_id='$value' UNION SELECT post_id,user_id,IsShare,time FROM likes WHERE user_id='$value' UNION  ".$result."  ";
	}
	$result= $result." ORDER BY time DESC";
	$result= mysql_query( $result, $link) or die(mysql_error());


	while(	$row=mysql_fetch_row($result)){	
		if($row[2]=='1'){
			// IsShare== 0 means original post
			// 1 means shared post
			// 2 means photo post
			// 3 means likedpost
			printSharedPosts($row[0],$row[1]);
		}
		else if($row[2]=='3'){
			printLikedPosts($row[0],$row[1]);
		}
		else{
			printPost($row[0]);	
		}
	}
}


// ************			part of unsucessful attempt to fetch posts using ajax      *******************//



// function fetchPostsData($user_id, $time ){
// 	//to fetch Data of all posts of a user
// 	global $link;
// 	// first select all posts, shares, likes of user whose wall has to be printed
// 	$result=" SELECT id,user_id,IsShare,time FROM posts WHERE user_id='$user_id' And time>'$time' UNION SELECT post_id,user_id,IsShare,time FROM shares WHERE user_id='$user_id' And time>'$time' UNION SELECT post_id,user_id,IsShare,time FROM likes WHERE user_id='$user_id' And time>'$time' ";
// 	// now select all friends of given user
// 	$friends=mysql_query(" SELECT user1_id FROM friends WHERE (status='success' And user2_id='$user_id') UNION SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id') ",$link) or die(mysql_error() );
	
// 	// now select all posts, shares, likes of all friends one by one
// 	while($arr=mysql_fetch_row($friends)){
// 		$value=$arr[0];//this is the user_id of friend 
// 		$result= " SELECT id,user_id,IsShare,time FROM posts WHERE user_id='$value' And time>'$time' UNION SELECT post_id,user_id,IsShare,time FROM shares WHERE user_id='$value' And time>'$time' UNION SELECT post_id,user_id,IsShare,time FROM likes WHERE user_id='$value' And time>'$time' UNION  ".$result."  ";
// 	}
// 	$result= $result." ORDER BY time DESC";
// 	$result= mysql_query( $result, $link) or die(mysql_error());


// 	//	$arr will hold data as a json object
// 	//	for posts it contains all post Details
// 	$arr=array();
// 	$time=0;
// 	while(	$row=mysql_fetch_array($result)){	
// 		if($time==0){array_push($arr, array("time"=>$row["time"] ));$time=$row["time"];}
// 		if($row["IsShare"]=='1'){
// 			// IsShare== 0 means original post
// 			// 1 means shared post
// 			// 2 means photo post
// 			// 3 means likedpost
// 			$share_user=getRow("members","id", $row["user_id"]);
// 			$post_row=getRow("posts", "id", $row[0]);
// 			$user=getRow("members","id", $post_row["user_id"]);

// 			array_push($arr, array( "IsShare"=>$row["IsShare"], "id"=>$post_row["id"], "post"=>$post_row["post"], "user_id"=>$post_row["user_id"], "user_DP"=>$user["DP"], "time"=>$post_row["time"], "likes"=>$post_row["likes"], "shares"=>$post_row["shares"], "comments"=>$post_row["comments"], "share_user_id"=>$row["user_id"], "share_user_DP"=>$share_user["DP"], "share_time"=>$row["time"]  ) );
// 		}
// 		else if($row["IsShare"]=='3'){
// 			$post_row=getRow("posts", "id", $row[0]);
// 			$like_user=getRow("members","id", $row["user_id"]);
// 			$user=getRow("members","id", $post_row["user_id"]);

// 			array_push($arr, array( "IsShare"=>$row["IsShare"], "id"=>$post_row["id"], "post"=>$post_row["post"], "user_id"=>$post_row["user_id"], "user_DP"=>$user["DP"], "time"=>$post_row["time"], "likes"=>$post_row["likes"], "shares"=>$post_row["shares"], "comments"=>$post_row["comments"], "like_user_id"=>$row["user_id"], "like_user_DP"=>$like_user["DP"], "like_time"=>$row["time"]  ) );
// 		}
// 		else if($row["IsShare"]=='2'){
// 			$photos=array();
// 			$user=getRow("members","id", $post_row["user_id"]);

// 			$photoAddr=mysql_query(" SELECT photoAddr FROM photos WHERE post_id='$photoPost_id' ",$link);
// 			$i=0;
// 			while($var=mysql_fetch_array($photoAddr)){
// 				array_push($photos, "photo".$i=$var["photoAddr"]);
// 			}
// 			array_push($arr, array( "IsShare"=>$row["IsShare"], "id"=>$row["id"], "post"=>$row["post"], "user_id"=>$row["user_id"], "user_DP"=>$user["DP"], "time"=>$row["time"], "likes"=>$row["likes"], "shares"=>$row["shares"], "comments"=>$row["comments"], "photos"=>$photos  ) );
// 		}
// 		else{
// 			$post_row=getRow("posts", "id", $row["id"]);
// 			$user=getRow("members","id", $post_row["user_id"]);
// 			array_push($arr, array( "IsShare"=>$post_row["IsShare"], "id"=>$post_row["id"], "post"=>$post_row["post"], "user_id"=>$post_row["user_id"], "user_DP"=>$user["DP"], "time"=>$post_row["time"], "likes"=>$post_row["likes"], "shares"=>$post_row["shares"], "comments"=>$post_row["comments"]  ) );
// 		}
// 	}
// 	return json_encode($arr);
// }






function like($post_id){
	global $link;
	$user_id=$_SESSION["session"]["id"];
	$result= mysql_query(" INSERT INTO likes( user_id, post_id ) VALUES ('$user_id', '$post_id') ", $link) or die(mysql_error());	
	$post_row=mysql_query(" SELECT likes FROM posts WHERE id='$post_id' ", $link);
	$likes=mysql_fetch_row($post_row)[0];
	$likes=$likes+1;
	mysql_query(" UPDATE posts SET likes='$likes' WHERE id='$post_id' ",$link) or die(mysql_error());
	return $likes;
}
function Unlike($post_id){
	global $link;
	$user_id=$_SESSION["session"]["id"];
	$result= mysql_query(" DELETE FROM likes WHERE user_id='$user_id' And post_id ='$post_id' ", $link) or die(mysql_error());	
	$post_row=mysql_query(" SELECT likes FROM posts WHERE id='$post_id' ", $link);
	$likes=mysql_fetch_row($post_row)[0];
	$likes=$likes-1;
	mysql_query(" UPDATE posts SET likes='$likes' WHERE id='$post_id' ",$link) or die(mysql_error());
	return $likes;
}
function share($post_id){
	global $link;
	$user_id=$_SESSION["session"]["id"];
	$result= mysql_query(" INSERT INTO shares( user_id, post_id ) VALUES ('$user_id', '$post_id') ", $link) or die(mysql_error());	
	$post_row=mysql_query(" SELECT shares FROM posts WHERE id='$post_id' ", $link);
	$shares=mysql_fetch_row($post_row)[0];
	$shares=$shares+1;
	mysql_query(" UPDATE posts SET shares='$shares' WHERE id='$post_id' ",$link) or die(mysql_error());
	return $shares;
	
}

function printNotifications( ){
	//to print all unread notifications of current user
	global $link;
	$user_id=$_SESSION["session"]["id"];
	$result= mysql_query(" SELECT * FROM notifications WHERE user_id='$user_id' ", $link) or die(mysql_error());
	while($row=mysql_fetch_row($result)){
		echo "<div class='row'><div class='col m8'>".$row[3];
		if($row[3]=='unread'){echo "<b>";}
		echo "<a href='readNotification.php?notif_id=".$row[0]."'>";
		echo $row[1]."</a></div></div>";
		if($row[3]=='unread'){echo "</b>";}
	}
}
function readNotification($notif_id){
	//to change status of a notification from unread to read
	global $link;
	$result= mysql_query(" SELECT * FROM notifications WHERE id='$notif_id' ", $link) or die(mysql_error()) ;
	$row=mysql_fetch_row($result);
	if(!empty($result)){
		echo "notif_id<h1>".$row[0]."</h1>".$row[1];
		mysql_query(" UPDATE notifications SET status='read' WHERE id='$notif_id' ",$link) or die(mysql_error());
	}
}

function sendRequest($user2_id){
	//for sending a friend request
	global $link;
	$user1_id=$_SESSION["session"]["id"];
	$user1_name=mysql_fetch_array(mysql_query(" SELECT * FROM members WHERE id='$user1_id' ", $link) )["firstname"];
	$arr =mysql_query("SELECT * FROM friends WHERE user1_id='$user1_id' And user2_id='$user2_id' ", $link) or die(mysql_error()) ;
	$arr2 =mysql_query("SELECT * FROM friends WHERE user1_id='$user2_id' And user2_id='$user1_id' ", $link) or die(mysql_error()) ;
	$row=mysql_fetch_array($arr);
	$row2=mysql_fetch_array($arr2);
	if(empty($row) && empty($row2)){
		// echo "testing";	
		$result= mysql_query(" INSERT INTO friends(user1_id, user2_id, status) VALUES ('$user1_id','$user2_id', 'pending') ",$link) or die(mysql_error());
		$request_id=mysql_insert_id($link);
		$result= mysql_query(" INSERT INTO notifications(notification, user_id, status, request_id) VALUES ('$user1_name has sent you a friend request ', '$user2_id', 'unread', $request_id) ",$link) or die(mysql_error());
	}
}
function requestResponse( $response, $notif_id){
	//for responding to a friend request
	global $link;
	$user2_id=$_SESSION["session"]["id"];
	$user2_name=mysql_fetch_array(mysql_query(" SELECT * FROM members WHERE id='$user2_id' ", $link) )[5]." ".mysql_fetch_array(mysql_query(" SELECT * FROM members WHERE id='$user2_id' ", $link) )[6];
	$var =mysql_query(" SELECT * FROM notifications WHERE id='$notif_id' ", $link);
	$request_id =mysql_fetch_array($var)[4];
	$friends_Result=mysql_query(" SELECT * FROM friends WHERE id='$request_id' ", $link);
	$request_Row=mysql_fetch_array($friends_Result);
	$user1_id=$request_Row["user1_id"];
	$status=$request_Row["status"];
	if($status=='pending'){
		if($response=='accept'){
			$result= mysql_query(" UPDATE friends SET status='success' WHERE id='$request_id' ",$link) or die(mysql_error());
			$result= mysql_query(" INSERT INTO notifications(notification, user_id, status) VALUES ('$user2_name has accepted your friend request ', '$user1_id', 'unread') ",$link) or die(mysql_error());
	}
		else if($response=='reject'){$result= mysql_query(" DELETE FROM friends WHERE (user1_id='$user1_id' And user2_id='$user2_id' And status='pending') ",$link) or die(mysql_error());}
		
	}
}
function unreadNotifications(){
	//returns total number of unread notifications
	global $link;
	$user_id=$_SESSION["session"]["id"];
	$cnt=0;
	$result=mysql_query(" SELECT * FROM notifications WHERE (status='unread' And user_id='$user_id') ",$link) or die(mysql_error() );
	while($row=mysql_fetch_row($result)){
		$cnt=$cnt+1;
	}
	return $cnt;
}
function printFriendsList($user_id){
	//print friends list of given user
	global $link;
	//$result=mysql_query(" SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id')",$link) or die(mysql_error() );
		$result=mysql_query(" SELECT user1_id FROM friends WHERE (status='success' And user2_id='$user_id') UNION SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id') ",$link) or die(mysql_error() );
	
	
	while($arr=mysql_fetch_row($result)){
		$value=$arr[0];
		$user_row=getRow("members", "id", $value);
		echo "<div class='row'><div class='col m6'><a href='viewProfile.php?user_id=".$user_row["id"]."'><b><div class='smallDPholder'>";
			getDP($user_row["login"]);
			echo "</div>".$user_row["firstname"]." ".$user_row["lastname"]."</b></a><br></div></div>";
	
	}
}
function printAllUsers(){
	//prints list of all users
	global $link;
	$result=mysql_query(" SELECT * FROM members ",$link) or die(mysql_error() );
		// $result=mysql_query(" SELECT user1_id FROM friends WHERE (status='success' And user2_id='$user_id') UNION SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id') ",$link) or die(mysql_error() );
	
	
	while($arr=mysql_fetch_row($result)){
		// $user_row=getRow("members", "id", $value);
		echo "<div class='row'><div class='col m6'><a href='viewProfile.php?user_id=".$arr[0]."'><b><div class='smallDPholder'>";
			getDP($arr[1]);
			echo "</div>".$arr[5]." ".$arr[6]."</b></a><br></div></div>";
	
	}
}
function areFriends($user1_id, $user2_id){
	//returns true if both users are not friends
	global $link;
	$result=mysql_query(" SELECT * FROM friends WHERE (user1_id='$user1_id' And user2_id='$user2_id') UNION SELECT * FROM friends WHERE (user1_id='$user2_id' And user2_id='$user1_id') ",$link) or die(mysql_error() );
	
	$arr=mysql_fetch_row($result);
	if(empty($arr)){$friends="no";}
	else{$friends="yes";}

	if($friends=="no"){
		return 1;
	}
	else{
		return 0;
	}	
}
function isOnline($user_id){
	global $link;
	
	$arr=mysql_query(" SELECT online FROM members WHERE id='$user_id'  ",$link) or die(mysql_error() );
	$result=mysql_fetch_array($arr);
	return $result["online"];
}

function allUnreadMessages(){
	//returns total number of unread messages
	global $link;
	$user_id=$_SESSION["session"]["id"];
	$cnt=0;
	$result=mysql_query(" SELECT * FROM messages WHERE (status='unread' And receiver_id='$user_id') ",$link) or die(mysql_error() );
	while($row=mysql_fetch_row($result)){
		$cnt=$cnt+1;
	}
	return $cnt;
}
function unreadMessages($sender_id){
	//returns total number of unread messages
	global $link;
	$receiver_id=$_SESSION["session"]["id"];
	$cnt=0;
	$result=mysql_query(" SELECT * FROM messages WHERE (status='unread' And receiver_id='$receiver_id' And sender_id='$sender_id') ",$link) or die(mysql_error() );
	while($row=mysql_fetch_row($result)){
		$cnt=$cnt+1;
	}
	return $cnt;
}
function printMsg($sender_id ){
	//to print all messages of current user
	global $link;
	$receiver_id=$_SESSION["session"]["id"];
	$result= mysql_query(" SELECT * FROM messages WHERE (sender_id='$sender_id' And receiver_id='$receiver_id') Or (sender_id='$receiver_id' And receiver_id='$sender_id')", $link) or die(mysql_error());
	while($row=mysql_fetch_row($result)){
		echo "<div class='row '><div class='col m8 ";
		if($row[2]==$_SESSION["session"]["id"]){echo "right";}
		echo" ' style='position:relative;top:0px;left:0px;'><div class='card-panel ";
		if($row[2]==$_SESSION["session"]["id"]){echo "teal white-text";}
		else {echo "white teal-text";}
		echo" '><p> ";
		if($row[3]=='unread'){echo "<b>";}
		echo $row[1]."</a><span class='time' style='position:absolute;bottom:12%;right:5%;'>";
		echo $row[5]." </span></div></div></div>";
		if($row[3]=='unread'){echo "</b>";}
	}
}
function readMessage($sender_id){
	//to change status of a notification from unread to read
	global $link;
	$receiver_id=$_SESSION["session"]["id"];
	$result= mysql_query(" UPDATE messages SET status='1'  WHERE sender_id='$sender_id' And receiver_id='$receiver_id' ", $link) or die(mysql_error()) ;
	//echo "messages read <br>";
}
function sendMessage($msg, $receiver_id){
	//to send a message to $user2_id
	global $link;
	$sender_id=$_SESSION["session"]["id"];
	$result= mysql_query(" INSERT INTO messages(msg, sender_id, receiver_id, status) VALUES ('$msg ', '$sender_id', '$receiver_id', '0') ",$link) or die(mysql_error());
	echo "message sent<br>";

}
function printContacts(){
	//print friends list of given user
	global $link;
	$user_id=$_SESSION["session"]["id"];
	//$result=mysql_query(" SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id')",$link) or die(mysql_error() );
		$result=mysql_query(" SELECT user1_id FROM friends WHERE (status='success' And user2_id='$user_id') UNION SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id') ",$link) or die(mysql_error() );
	
	
	while($arr=mysql_fetch_row($result)){
		$value=$arr[0];
		$user_row=getRow("members", "id", $value);
		echo "<div class='row'><div class='col m6'><a href='showMsg.php?sender_id=".$user_row["id"]."'><b><div class='smallDPholder'>";
			getDP($user_row["login"]);
			echo "</div>".$user_row["firstname"]." ".$user_row["lastname"];
			if(unreadMessages($user_row["id"])!=0){
				echo "<div style='display:inline-block;color:white;font-size:0.7em;background-color:#EE0000;padding:0 5 0 5px;' class='circle' > ".unreadMessages($user_row["id"])."</div>";
			}
			echo "</b></a><br></div></div>";
	
	}
}

function flipOnlineState(){
	global $link;
	$user_id=$_SESSION["session"]["id"];
	$user_row=getRow("members", "id", $user_id);
	echo $user_id."<br>".$user_row["online"];
	if($user_row["online"]==0){

		$result=mysql_query(" UPDATE  members set online='1' WHERE id='$user_id' ",$link) or die(mysql_error() );
		echo "signing in.....<br>";
	}
	else{
		$result=mysql_query(" UPDATE  members set online='0' WHERE id='$user_id' ",$link) or die(mysql_error() );
		echo "signing off.....<br>";
	}
	// exit();
	//$result=mysql_query(" SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id')",$link) or die(mysql_error() );
		$result=mysql_query(" SELECT user1_id FROM friends WHERE (status='success' And user2_id='$user_id') UNION SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id') ",$link) or die(mysql_error() );
	
}
// function getLatestChats($sender_id, $msg_id){
// 	global $link;
// 	$receiver_id=$_SESSION["session"]["id"];
// 	$result= mysql_query(" SELECT * FROM messages WHERE id>'$msg_id' And ( (sender_id='$sender_id' And receiver_id='$receiver_id') Or (sender_id='$receiver_id' And receiver_id='$sender_id') ) ", $link) or die(mysql_error());

// 	while($row=mysql_fetch_row($result)){
// 		echo "<div class='row '><div class='col m8 ";
// 		if($row[2]==$_SESSION["session"]["id"]){echo "right";}
// 		echo" '><div class='card-panel red-text '><p> ";
// 		if($row[3]=='unread'){echo "<b>";}
// 		echo $row[1]."</a></div></div></div>";
// 		if($row[3]=='unread'){echo "</b>";}
// 	}	
// }

function getSuggestions($table, $value ){
	global $link;
	$user_id=$_SESSION["session"]["id"];
	if($table=='members'){
		$result= mysql_query(" SELECT id,firstname,lastname,DP FROM $table WHERE id!='$user_id' And (firstname LIKE '%{$value}%' OR lastname LIKE '%{$value}%') And NOT EXISTS(SELECT * FROM friends WHERE ($table.id = friends.user1_id And '$user_id'=friends.user2_id And friends.status='success') Or ($table.id = friends.user2_id And '$user_id'=friends.user1_id And friends.status='success')  )  ", $link) or die(mysql_error());

		$arr=array();
		while($return=mysql_fetch_array($result))
		{	
			array_push($arr, $return);
		}
		return json_encode($arr);
	}
	else if($table=='areas'){
		$result= mysql_query(" SELECT id,value FROM $table WHERE value LIKE '%{$value}%'  ", $link) or die(mysql_error());

		$arr=array();
		while($return=mysql_fetch_array($result))
		{	
			array_push($arr, $return);
		}
		return json_encode($arr);
	}
}



class Chat{
	public $chatWith;
	public $user;

	public function _constructor($user_id){
		$this->$chatWith=$user_id;
		$user=$_SESSION["session"]["id"];
		echo $this->chatWith."<br>";

	}

	public function printChatContacts(){
		//print friends list of given user right on the server
		//***Note: this function increases the amount of data being sent by server as it sends same HTML data on every function call
		global $link;
		$user_id=$_SESSION["session"]["id"];
		//$result=mysql_query(" SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id')",$link) or die(mysql_error() );
		$result=mysql_query(" SELECT user1_id FROM friends WHERE (status='success' And user2_id='$user_id') UNION SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id') ",$link) or die(mysql_error() );
			
			
			while($arr=mysql_fetch_row($result)){
				$value=$arr[0];
				$user_row=getRow("members", "id", $value);
				echo "<div class='row chat contact' style='margin:0px;padding:0px;'><input type='hidden'  value='".$user_row["id"]."'><div class='col m4 '><div class='smallDPholder'>";
					getDP($user_row["login"]);
					echo "</div></div><div class='col m7 name '> ".$user_row["firstname"]." ".$user_row["lastname"];
					if(unreadMessages($user_row["id"])!=0){
						echo "<div style='display:inline-block;color:white;font-size:0.7em;background-color:#EE0000;padding:0 5 0 5px;' class='circle' > ".unreadMessages($user_row["id"])."</div>";
					}
					echo "</div></div>";
			
			}
		}
	public function fetchChatContacts($online){
		//sends friends list of given user using json and prints it on client side using jquery 
		//***Note: this function saves user data as it reduces the amount of data being sent by server by reducing the amount of HTML send everytime
		global $link;
		$user_id=$_SESSION["session"]["id"];
		//$result=mysql_query(" SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id')",$link) or die(mysql_error() );
		$result=mysql_query(" SELECT user1_id FROM friends WHERE (status='success' And user2_id='$user_id') UNION SELECT user2_id FROM friends WHERE (status='success' And user1_id='$user_id') ",$link) or die(mysql_error() );
			
			
			$arr =array("on"=>array(),"off"=>array());
			while($return=mysql_fetch_array($result))
			{	
				$user_row=getRow("members", "id", $return["user1_id"]);
				$details=array();
					array_push($details,array("id"=>$user_row["id"], "fn"=>$user_row["firstname"], "ln"=>$user_row["lastname"], "dp"=>$user_row["DP"],"msg"=>unreadMessages($user_row["id"]  ) ) );
				if($user_row["online"]=='1'){
					array_push($arr["on"], $details);
				}
				else{
					array_push($arr["off"], $details);
				}
			}
				return json_encode($arr);
			

		}
	public function getChats($msg_id, $sender_id ){
		global $link;
		$receiver_id=$_SESSION["session"]["id"];

		$result= mysql_query(" SELECT id,msg,sender_id FROM messages WHERE id>'$msg_id' And( (sender_id='$sender_id' And receiver_id='$receiver_id') Or (sender_id='$receiver_id' And receiver_id='$sender_id') ) ", $link) or die(mysql_error());

		$arr=array();
		array_push($arr, $_SESSION["session"]["id"] );
		while($return=mysql_fetch_array($result))
		{	
			array_push($arr, $return);
		}
		return json_encode($arr);
	}
}

function printLeftPane(){
	//	prints the left portioon of the index page
	$user_row=getRow("members", "id", $_SESSION["session"]["id"]);
	?>
	<div class="card" style="padding-top:10px;padding-bottom:1px;">
		<div class="row"><div class="col m5"><img src="<?=$user_row["DP"];?>" alt="DP" class="responsive-img"></div>
	<div class="col m7"><?=$user_row["firstname"]." ".$user_row["lastname"];?>
		</div>
	</div>
	</div>
	<div class="card" style="padding-top:10px;padding-bottom:1px;">
		<div class="row"><div class="col m12">
			Favourites</div></div>
			<div class="row">
	<div class="col m7">
		<a href="members.php">Events</a>
		</div>
	</div>
	</div>
	<?php

}

?>