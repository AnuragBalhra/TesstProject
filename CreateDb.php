<?php
//echo "Hey<br>";
//server name ,username and passwrod for create secure connections follows
   $dbhost = 'localhost';
   $dbuser = '';
   $dbpass = '';

#Create a mySQL connection
   $conn = mysql_connect($dbhost,$dbuser,$dbpass);
 
#give error if connection not established 
   if(! $conn ) {
      die('Could not connect: ' . mysql_error());
   }
   
echo 'Connected successfully<br>';
   
//Creating A Database using mysql_query()
   $sql = 'CREATE Database organiser';
   $retval = mysql_query( $sql, $conn ) or die("could not create db".mysql_error());


if(! mysql_select_db( 'organiser',$conn )){echo " not selected";}

//Check if Database test_db exists and throw error if Database could not be created
  if(! mysql_select_db( 'organiser' ))
	{
	   
	   if(! $retval ) {
	      die('Could not create database: ' . mysql_error());
	   }
	   
	   echo "Database test_db created successfully\n";
	}

//Creating a table in Database
 $sel = 'SELECT emp_id, emp_name, emp_salary FROM employee';
  if(! $sel)
	{
	$sql = 'CREATE TABLE Random( '.
	      'id INT NOT NULL AUTO_INCREMENT, '.
	      'name VARCHAR(20) NOT NULL, '.
	      'password VARCHAR(20) NOT NULL,'.
	      'primary key ( id ))';
	   mysql_select_db('organiser');
	   $retval = mysql_query( $sql, $conn );
	
	$sql2='CREATE TABLE areas(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, value VARCHAR(8) )';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());
	   
	$sql2='CREATE TABLE clubs(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,name VARCHAR(50),type CHAR(3),area CHAR(3),mail VARCHAR(50),description TEXT,user_id INT,time TIMESTAMP)';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());
	   
	$sql2='CREATE TABLE comments(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, description TEXT,post_id INT,user_id INT,comment_on VARCHAR(8),time TIMESTAMP)';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());
	   
	$sql2='CREATE TABLE events(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, etype CHAR(3),earea CHAR(3),edate INT,ename VARCHAR(100),evenue VARCHAR(100),eaddress VARCHAR(255),ezip VARCHAR(20),edescription TEXT,club_id INT)';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());
	
	$sql2='CREATE TABLE friends(user1_id INT,user2_id INT,status VARCHAR(8),id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,time TIMESTAMP)';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());

	$sql2='CREATE TABLE likes(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,user_id INT,post_id INT,time TIMESTAMP)';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());

	$sql2='CREATE TABLE members(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,login VARCHAR(8),password VARCHAR(8),DP TEXT,sess_id TEXT,firstname VARCHAR(8),lastname VARCHAR(8),dob date,online INT,time TIMESTAMP,sess_id TEXT)';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());

	$sql2='CREATE TABLE messages(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,msg TEXT,sender_id INT,receiver_id INT,status INT,time TIMESTAMP)';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());

	$sql2='CREATE TABLE notifications(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,notification TEXT,user_id INT,status INT,request_id INT,time TIMESTAMP)';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());

	$sql2='CREATE TABLE photos(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,photoADDR TEXT,post_id INT,time TIMESTAMPIsShare INT )';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());

	$sql2='CREATE TABLE posts(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,post TEXT,user_id INT,time TIMESTAMP,shares INT,likes INT,IsShare INT,comments INT)';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());

	$sql2='CREATE TABLE shares(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,user_id INT,post_id TEXT,time TIMESTAMP,IsShare INT )';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());

	$sql2='CREATE TABLE types(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,type VARCHAR(30))';   	
   	$retval = mysql_query( $sql, $conn ) or die(mysql_error());

	   if(! $retval ) {
	      die('Could not create table: ' . mysql_error());
	   }
	   
	   echo "All Tables created successfully\n";
	}
          



 
  mysql_close($conn);
?>
