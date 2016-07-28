

$(document).ready(function(){
	$(".coll-header").first().addClass("active");
    $(".coll-header").first().next(".coll-body").css("display","block");
	$(".post-header").first().addClass("active");
    $(".post-header").first().next(".post-body").css("display","block");


    $(".coll-header").click(function(){
    	$(".coll-header").removeClass("active");
    	$(this).addClass("active");
    	$(".coll-body").css("display","none");
        $(this).next(".coll-body").css("display","block");
        $(this).parent("li").siblings("li").children("textarea").val("");
    });
    
        // like and unlike functions
        $('.like').click( function() {
            var target=$(this);
            var rel=$(this).attr("rel");
            var x=rel.split("post");
            var str=x[1];
            var option=x[0];

            // alert(str+"  "+option);            
            if(option=="like"){
              $(this).text("Unlike");
              like(target, str);
              $(this).attr("rel","unlikepost"+str);
            }
            else{
              unlike(target, str);
              $(this).attr("rel","likepost"+str);
              $(this).text("Like");
            }
            
          });
        // share function
        $('.share').click( function() {
            var target=$(this);
            var rel=$(this).attr("rel");
            var x=rel.split("post");
            var str=x[1];
            var option=x[0];

            share(target,str);
            
          });
        // comment function
        $('.comment').click( function() {
            $(this).siblings(".commentsection").toggle();
          });
        $('.addcomment').click( function() {
            var comment=$(this).siblings("textarea").val();
            var rel=$(this).attr("rel");
            var x=rel.split("post");
            var str=x[1];
            var option=x[0];
            if(comment!=""){
              addComment(comment, str);
            }
          });
        

        
              
});

  
  // function Comment(commentVal, post_id){
  // if(commentVal != ""){
  //   $.ajax({
  //     type: "GET",
  //     url: "LS.php?actionflag=comment&comment=" + commentVal+"&post_id="+contact_id
  //     });
  //   }
  // }


    function like(target, post_id){
    var xhttp=new XMLHttpRequest();
        xhttp.open("GET","LS.php?like="+post_id,true);
        xhttp.send();

        xhttp.onreadystatechange=function(data){        
         if (xhttp.readyState == 4 && xhttp.status == 200) {
           target.html(xhttp.responseText);
        }
        }
    }
    function unlike(target, post_id){
    var xhttp=new XMLHttpRequest();
        xhttp.open("GET","LS.php?Unlike="+post_id,true);
        xhttp.send();

        xhttp.onreadystatechange=function(data){        
         if (xhttp.readyState == 4 && xhttp.status == 200) {
           target.html(xhttp.responseText);
        }
        }
    }
    function share(target, post_id){
    var xhttp=new XMLHttpRequest();
        xhttp.open("GET","LS.php?share="+post_id,true);
        xhttp.send();

        xhttp.onreadystatechange=function(data){        
         if (xhttp.readyState == 4 && xhttp.status == 200) {
           target.html(xhttp.responseText);
        }
        }
    }
    function addComment(comment, post_id){
    var xhttp=new XMLHttpRequest();
        xhttp.open("GET","LS.php?comment="+comment+"&post_id="+post_id,true);
        xhttp.send();
      }


// To fetch and print latest posts using ajax
// $(document).ready(function(){
//   startFetchPosts();
// });

// function startFetchPosts(){
//   setInterval( function() { printPosts(); }, 1000 );
// }

//     var time=0;
//     function printPosts(){
//       alert("start");
//         //first fetch json object containing all post details
//         var xhttp=new XMLHttpRequest();
//         xhttp.open("GET","LS.php?time="+time+"user_id="+user_id,true);
//         xhttp.send();
//         xhttp.onreadystatechange=function(data){
//           var string="";
//            if (xhttp.readyState == 4 && xhttp.status == 200) {
//             var json=JSON.parse(xhttp.responseText);        
//             var i=1;
//             post_id=json[0];
//             alert(post_id);
//             if(json[i]!=""){
//                 while(json[i] ){
//                     string=100*i+"\t"+string;
//                   i=i+1;
//                }
//              }
//              alert(string);
//         }
//       }
//     }
