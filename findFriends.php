<?php

include("dblib.inc");
include("clublib.php");
SetVariables();
if(isset($_REQUEST["actionflag"]) && $_REQUEST["actionflag"]=="suggest" ){
	$result=getSuggestions($_REQUEST["table"],$_REQUEST["value"]);
	echo $result;
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
		<div class="col m8"><h5>All Users</h5><br><br><?php printAllUsers();?></div>
		<div class="col m4">
	<form actiion="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" >
		<h2>Find Friends</h2>
		<input type="hidden" name="actionflag" value="findFriends">
		<input type="hidden" name="<?php echo session_name();?>" value="<?php echo session_id();?>">
		<div style="position:relative;top:0px;left:0px;height:90px;">
			Name: <input type="text" class="suggest" id="friendsuggest"  name="name" value="<?php if(isset($_REQUEST['name'])){ echo $_REQUEST['name'] ;}?>" onclick="changeTable('members')"><br><br>
			<div id="friend" class="suggestion" style="z-index:100000;"></div>
		</div>
		<div style="position:relative;top:0px;left:0px;height:90px;">
			Area: <input type="text" class="suggest" id="areasuggest" name="area" value="<?php if(isset($_REQUEST['area'])){ echo $_REQUEST['area'] ;}?>" onclick="changeTable('areas')"><br><br>
			<div id="area" class="suggestion"></div>
		</div>
		
			<div class="row"><div class="col m4">	<input type="submit" class="waves-effect waves-light btn" value="Find" id="btnSend">
			</div></div>
	</form>
</div>
</div>




<!-- <script src="js/materialize.min.js"></script> -->
    <script src="js/jquery.min.js"></script>
<!-- <script src="js/init.js"></script> -->
<script src="js/myjs.js"></script>



	<script>
  var table; 
  $(document).ready(function() {
	  // $('#btnSend').click( function() {
	  //   getFriends();
	  // });

	  $("body").on("keyup",'#friendsuggest', function() {
	   		 var value=$(this).val();
	   		 $(this).siblings(".suggestion").css("display","block");
	   		getSuggestions('friend',value);
	  });
	  $("body").on("keyup",'#areasuggest' , function() {
	   		 var value=$(this).val();
	   		getSuggestions('area',value);
	  });
  });

  function changeTable(value){
  	table=value;
  }

	function getSuggestions(output, value){
		

		var x=$('#'+output);
		if(value==""){
          x.html("");  
			return;
		}
		x.html("");
    var xhttp=new XMLHttpRequest();
		xhttp.open("GET","test3.php?actionflag=suggest&table="+table+"&value="+value,true);
		xhttp.send();
		xhttp.onreadystatechange=function(data){
        
			 if (xhttp.readyState == 4 && xhttp.status == 200) {

        var json=JSON.parse(xhttp.responseText);
        var string="";
        
       var i=0;
        while(json[i]){
	if(output=='friend'){string=string+"<div class='row'><div class='col m3'><img src=' "+json[i].DP+"' alt='DP' class='responsive-img'></div><div class='col m6' >"+json[i].firstname + " "+json[i].lastname+"</div></div>";}
	else if(output=='area'){string=string+"<div class='row'><div class='col m12'>"+json[i].value +"</div></div>";}
            
          i=i+1;
        }
         var temp=x.html();
          x.html(temp+string);

        }


		}

	}

	$("body").on("click",".suggestion .row", function(){
		var v=$(this).text();
		$(this).parent(".suggestion").siblings("input").val(v);
		$(this).parent(".suggestion").html();
		$(this).parent(".suggestion").toggle();
	})
	$("body").on("blur","input", function(){
			// $(".suggestion").css("display","none");
	})

	</script>


</body>
</html>