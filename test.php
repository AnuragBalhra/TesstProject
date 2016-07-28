<?php
include("clublib.php");
include("dblib.inc");
SetVariables();
?>
<html>
<head>
<link href="css/mycss.css" rel="stylesheet">
<link href="css/materialize.min.css" rel="stylesheet">
</head>
<body>  
    <script src="js/jquery.min.js"></script>

<div class="onlinefriendsholder">
 <div id="onlinefriendsheader">Online Friends</div>
  <div id="onlinefriends">
    <?php Chat::printChatContacts();?>
  </div>
</div>


<!-- <div id="chatbox_">
<div id="chatboxheader">Friend</div>
<div id="chatbox" class="messages" ></div>
<input type="hidden" id="contact_id" name="contact_id" value="<?php echo $_REQUEST['contact_id'] ?>">
  <div class="belowChat"><textarea name="msg" id="chatInput"></textarea>
<button value="chat" id="btnSend" >chat</button>
</div>
</div> -->


	 <script>
    function getOnlineFriends(){
    // alert("1");

    //to fetch list of Online friends
    var xhttp=new XMLHttpRequest();
    xhttp.open("GET","chattest.php?friends=1",true);
    xhttp.send();
    xhttp.onreadystatechange=function(data){
      var string="";
       if (xhttp.readyState == 4 && xhttp.status == 200) {
        var json=JSON.parse(xhttp.responseText);        
        var i=0;
        if(json.on!=""){
            while(json.on[i] ){
              string=string+"<div class='row chat contact' style='margin:0px;padding:0px;'><input type='hidden'  value='"+json.on[i][0]["id"]+"'><div class='col m4 '><div class='smallDPholder'><img src=' "+json.on[i][0]["dp"]+"' alt='dp' class='responsive-img'></div></div><div class='col m7 name '> "+json.on[i][0]["fn"]+" "+json.on[i][0]["ln"];
              if(json.on[i][0]["msg"]!=0){
                string=string+"<div style='display:inline-block;color:white;font-size:0.7em;background-color:#EE0000;padding:0 5 0 5px;' class='circle' > "+json.on[i][0]["msg"]+"</div>";
              }
              string=string+"</div></div>";
              i=i+1;
           }
         }
       string=string+"<br><div id='onlinefriendsheader'>Offline friends</div><br>";      
    //to fetch list of offline friends
       if(json.off!=""){
           i=0;
           while(json.off[i] ){
              string=string+"<div class='row chat contact' style='margin:0px;padding:0px;'><input type='hidden'  value='"+json.off[i][0]["id"]+"'><div class='col m4 '><div class='smallDPholder'><img src=' "+json.off[i][0]["dp"]+"' alt='dp' class='responsive-img'></div></div><div class='col m7 name '> "+json.off[i][0]["fn"]+" "+json.off[i][0]["ln"];
              if(json.off[i][0]["msg"]!=0){
                string=string+"<div style='display:inline-block;color:white;font-size:0.7em;background-color:#EE0000;padding:0 5 0 5px;' class='circle' > "+json.off[i][0]["msg"]+"</div>";
              }
              string=string+"</div></div>";

              i=i+1;
           }
         }

    $("#onlinefriends").html(string );  
     
     }
   }
  }
   </script>
  <script>
  $(document).ready(function() {
  

  // To start fetching the chat contacts dynamically
  getFriends();

  $("body").on("click",'#btnSend', function() {
    sendChatText($(this));
    $('#chatInput').val("");
  });


  });


// making use of instances to get better chat functionality
  var chatboxes=[];
$('body').on('click','.contact', function(){
	var boxtitle="#chatbox_"+$(this).children("input").val();
	var contactname=$(this).children(".name").text();
  	if($(boxtitle).length>0){
  		if($(boxtitle).children("#chatbox").css('display')=="none"){$(boxtitle).children("#chatbox,.belowChat").css('display',"inline-block");$(boxtitle).children("#chatboxheader").css("background-color","blue");}
  		else{$(boxtitle).children("#chatbox,.belowChat").css("display","none");$(boxtitle).children("#chatboxheader").css("background-color","white");}
  		return;
  	}
  	else{
  		$("<div/>").addClass("ChatArea").attr("id","chatbox_"+$(this).children("input").val() ).html("<div id='chatboxheader'>"+contactname+"</div><div id='chatbox' class='messages' ></div><input type='hidden' id='contact_id' name='contact_id' value='"+$(this).children('input').val()+"'><div class='belowChat'><textarea name='msg' id='chatInput'></textarea><button value='chat' id='btnSend' >chat</button></div>").appendTo("body");
  		right=200+chatboxes.length*210+"px";
  		$(boxtitle).css('display',"inline-block");
  		$(boxtitle).css('position',"fixed");
  		$(boxtitle).css("bottom","0px");
  		$(boxtitle).css("right",right);
  		chatboxes.push(boxtitle);
  			startChat(boxtitle);
  	}
} );


  

  function startChat(boxtitle){
  setInterval( function() { getChatText(boxtitle); }, 1000);
      setScroll();
  }
  function sendChatText(refbox){

  var chatInput = refbox.siblings('#chatInput').val();
  var contact_id=refbox.parent("div").siblings('input').val();
  alert(contact_id+"     " + chatInput);
  if(chatInput != ""){
    $.ajax({
      type: "GET",
      url: "chattest.php?actionflag=chat&chat=" + chatInput+"&receiver_id="+contact_id
      });
    }
  }

    var LastReadChat=0;

	function getChatText(boxtitle){
  var contact_id=$(boxtitle).children('input').val();
    var xhttp=new XMLHttpRequest();
		xhttp.open("GET","chattest.php?msg_id="+LastReadChat+"&contact_id="+contact_id,true);
		xhttp.send();
		xhttp.onreadystatechange=function(data){
        
			 if (xhttp.readyState == 4 && xhttp.status == 200) {

        var json=JSON.parse(xhttp.responseText);
        var session_id=json[0];
        var string="";
        
       var i=1;
        while(json[i]){

          if(session_id==json[i].sender_id){
            string="<div class='chatCard'><div class='card-panel teal white-text right'> "+json[i].msg+"</div></div>";
          }
          else{
            string="<div class='chatCard'><div class='card-panel white teal-text ' style='float:left;'> "+json[i].msg+"</div></div>"; 
          }

          $(boxtitle).children("#chatbox").html($(boxtitle).children("#chatbox").html()+string) ;  
          LastReadChat=json[i].id;
          i=i+1;
        
        }
      if(json[0].msg!=null){
          $('#chatbox').scrollTop($('#chatbox')[0].scrollHeight);
      }
        
        }
		}

	}



  function getFriends(){
  setInterval( function() { getOnlineFriends(); }, 100000);
  }


  function setScroll(){
    $('#chatbox').scrollTop($('#chatbox')[0].scrollHeight);
  }

  $("#onlinefriendsheader").click(function(){
        $("#onlinefriends").toggle();
    });
  $("body").on("click","#chatboxheader", function(){
    $(this).siblings("div").toggle();
  });
	</script>
	<script src="js/materialize.min.js"></script>
  <script>

  $(document).ready(function(){
    $('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
  });

  
  </script>
</body>
</html>

