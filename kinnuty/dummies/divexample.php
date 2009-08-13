<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <script src="http://dharmmotyar.googlecode.com/svn/trunk/js/jquery.js"></script>
  <script>
  $(document).ready(function(){
    $("div").click(function () {
                         
                               
                                var cssObj = { 'visibility' : 'hidden' }
                                $(this).css(cssObj);
                      
                        
                    
                       
                             //     var color = $(this).css("background-color");      
                             //    $("#result").html("That div is <span style='color:" +
                           //     color + ";'>" + color + "</span>.");
                            
                            
                            //  alert('fi;');
                            
                  });
                  
                  
                  
      
       $("#grow").click(function () { //alert('fi');
                                 
                              //var srcs = $(this).attr("src");     
                             // $("#result").html(srcs);
                             
                             
                           //  $('#grow').animate({ height: 200, width: 200 }, "slow", function(){
                               
                        //      })
                         
                         
                       //  $('#grow').slideDown('slow');
                        
                      //  $("#result").load("Google.htm");     //loades a page in a div
                       
                       $.post("http://localhost/kinnuty/sms/smsme.php", { msg: "DHarm" } ); // sends post field to the script
                      
                      //   $.post("some.php", function(data){ alert("Data Loaded: " + data); });    // gets data same as ajaxRequest
                      
                      // $.post("some.php", { text: "John", time: "2pm" }, function(data){ alert(data); }, "xml");
                        
               /*   var resp = $.ajax({
                                  url: 'sms/smsme.php',
                                  type: 'POST',
                                  dataType: 'script',
                                  timeout: 1000,
                                  data: "msg=byAjaxJQ",
                                  error: function(){
                                                      alert('Error loading document');
                                                      },
                                  success: function(script){
                                                      alert(script);
                                                }
                                   }).responseText;  */
                              
                          
//
                         });
                          
                          
                             
                             
      
                  
  });
 // $(window).unload( function () { //alert("Bye now!"); } );    

  </script>
  <style>
  div { width:60px; height:60px; margin:5px; float:left; }
  </style>
</head>
<body>
  <span id="grow"> ghfgh</span>
  <div style="background-color:blue;visibility:visible; " ></div>
  <div style="background-color:rgb(15,99,30);"></div>
  <div style="background-color:#123456;"></div>
  <div style="background-color:#f11;"></div>
  
  <img src="smash-rss.gif" >
</body>
</html>
