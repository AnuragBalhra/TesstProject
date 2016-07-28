// This is a project created purelyfor learning and practising HTML,Css(Materialize),Javascript(Jquery),Ajax,Mysql and Php
// Projecte created by Anurag Balhra(B.Tech student at IIT Jodhpur)

Database structure:-
	Organiser (Database)
	Tables:
		-areas(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
			value VARCHAR(8)
			)
		-clubs(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
			name VARCHAR(50),
			type CHAR(3),
			area CHAR(3),
			mail VARCHAR(50),
			description TEXT,
			user_id INT,
			time TIMESTAMP
			)
		-comments(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
			description TEXT,
			post_id INT,
			user_id INT,
			comment_on VARCHAR(8),		//to denote the wether comment is made on events, posts etc
			time TIMESTAMP
			)
		-events(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
			etype CHAR(3),
			earea CHAR(3),
			edate INT,
			ename VARCHAR(100),
			evenue VARCHAR(100),
			eaddress VARCHAR(255),
			ezip VARCHAR(20),
			edescription TEXT,
			club_id INT,
			)
		-friends(
			user1_id INT,
			user2_id INT,
			status VARCHAR(8),			// succes if request accepted or pending if not rejected and block if blocked
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			time TIMESTAMP
			)
		-likes(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			user_id INT,
			post_id INT,
			time TIMESTAMP
			)
		-members(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			login VARCHAR(8),
			password VARCHAR(8),
			DP TEXT,
			sess_id TEXT,
			firstname VARCHAR(8),
			lastname VARCHAR(8),
			dob date,
			online INT,					//0 if offline else 1
			time TIMESTAMP,
			sess_id TEXT
			)
		-messages(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			msg TEXT,
			sender_id INT,
			receiver_id INT,
			status INT,					//0 if unread else 1
			time TIMESTAMP
			)
		-notifications(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			notification TEXT,
			user_id INT,
			status INT,					//read or unread 
			request_id INT,				//the id of friend request due to which notification is generated
			time TIMESTAMP			
			)
		-photos(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			photoADDR TEXT,				//holds URL of uploaded photo
			post_id INT,
			time TIMESTAMP			
			IsShare INT 				//0 for original post, 1 for shared post and 2 for photopost				
			)
		-posts(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			post TEXT,					//holds written content of post
			user_id INT,
			time TIMESTAMP,			
			shares INT,					//no of shares of this post
			likes INT,					//no of likes this post
			IsShare INT,				//0 for original post, 1 for shared post and 2 for photopost
			comments INT 				//no of comments on this post
			)
		-shares(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			user_id INT,
			post_id TEXT,				//holds id of original post
			time TIMESTAMP,			
			IsShare INT 				//0 for original post, 1 for shared post and 2 for photopost
			)
		-types(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			type VARCHAR(30)			//holds types values for events or clubs
			)

FILES Structure:-
	-TestProject
		-css
			materialize.min.css			//predefined css for using materialize
			mycss.css
		-js
			init.js						//to initialize all javascript functions required for materialize
			jquery.min.js 				//predefined js file to include jquery
			materialize.min.js			//predefined js for using materialize
			mycss.js
		-uploads
	
		FILES::
			chat.php 
			clubDetails.php
			clublib.php
			createevent.php
			dblib.php
			eventDetails.php
			index.php
			login.php
			join.php
			logOut.php
			LS.php 						//php file to hold all Likes ,Shares or Comments
			members.php
			postDetails.php
			publicnav.php 				//holds the top nav bar and all include statements
			Readme.txt
			readNotification.php
			showMsg.php
			showNotifications.php
			updateclub.php
			updateprofile.php
			viewclubs.php
			viewprofile.php
