setInterval(function(){
                            
  var now = new Date() ;
  var end = '<?php echo $result->end; ?>' * 1000;
   console.log(now);

   var offset = end - now;
   var hours = parseInt(offset/(60*60*1000))%24;
   console.log(hours);
   var minutes = parseInt(offset/(60*1000))%60;
   var second= parseInt(offset/1000)%60;
   var myDivTime=document.getElementById("test_timeer");
   myDivTime.innerHTML = hours 
   myDivTime.innerHTML += ":" 
   myDivTime.innerHTML += minutes
   myDivTime.innerHTML += ":" 
   myDivTime.innerHTML += second;
   });