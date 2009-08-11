<?php
  include('includes/function.php');
  //include('session.php');
    databaseconnect();

 $id='';
 $pix='';
 $college='';
 $name='';
 $image='';
 $name1='';
 $picture1='';
 $totalrow='';
 $userId='';
 $friendId='';
 $friendName='';
 $friendPicture='';

    if(isset($_GET['frndadd'])) {
     $result=mysql_query("SELECT * FROM frndreq WHERE id='$_REQUEST[frndadd]'");
	  while($row=mysql_fetch_array($result)){

		  $userId=$row['recid'];
	      
            $friendId=$row['senderid'];
		  $recid_add=$row['senderid'];
		 
		  $friendName=$row['sendername'];
	  }
       $result=mysql_query("SELECT * FROM record WHERE iduser='$friendId'");
	    while($row=mysql_fetch_array($result)) {
		 
		 $friendPicture=$row['picture'];
		}

    addTo_List($userId ,$friendId ,$friendName ,$friendPicture);
	deletereq($_REQUEST['frndadd']);
	}
      if(isset($_GET['frndreject'])) {
         deletereq($_REQUEST['frndreject']);
	}




  if(isset($_GET['request'])) {
       deletereq($_REQUEST[request]);
     $result=mysql_query("SELECT * FROM record WHERE iduser='$_REQUEST[request]'");
	 while($row=mysql_fetch_array($result)){
		 $name=$row['firstname'];
	     $image=$row['picture'];
	 }
     $result="INSERT INTO friendlist(userid,friendid,friendname,picture) VALUES('$_SESSION[userid]','$_REQUEST[request]','$name','$image')";
	      mysql_query($result);

       $result=mysql_query("SELECT * FROM record WHERE iduser='$_SESSION[userid]'");
	    while($row=mysql_fetch_array($result)){
			$name1=$row['firstname'];
		    $image1=$row['picture'];
		}
       $result="INSERT INTO friendlist(userid,friendid,friendname,picture) VALUES('$_REQUEST[request]','$_SESSION[userid]','$name1','$image1')";
	      mysql_query($result);

  }

  function deletereq($del) {
 $result="DELETE FROM frndreq WHERE id='$del'";
   mysql_query($result);
	 

  }

 ?>
 <html>
 <head>
 <title></title>
 <style>
.sendreq a{
   font-size:9px;
   text-decoration:none;
   background:#000000;
   color:#FFFFFF;
   padding:4px 4px 4px 4px;
   margin-left:15px;
   }
   .sendreq a:hover{
   color:#000000;
   background:#FFFFFF;
   }
   
   
 </style>


 </head>
 <body>
 <?php
     
 



    $result=mysql_query("SELECT * FROM frndreq WHERE recid='48'");
	$totalrow=mysql_num_rows($result);
	
	if($totalrow>0) {
?>
<fieldset style="padding-top:1px; font-size:25px; background-color:black; color:white; border:0px;"><center>
  FRIEND REQUEST</center></fieldset>

     <?php

      ?><table><?php
     $result=mysql_query("SELECT * FROM frndreq WHERE recid='48'");
	 while($row=mysql_fetch_array($result)) {
		 ?><tr><td valign=top><?php
     $id=$row['senderid']; 
        hello($id);	
	 echo "Request:-".$row['reqmsg'];?><br><?php
     echo "By:-".$row['sendername']; 
	 echo "</td>"; 
	 ?>
	 <td class="btn"><div class="sendreq">
 <a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=reqbox&frndadd=<?php echo $row['id']?>">
  Add To List</a>
 
 </div></td>
 	 <td class="btn"><div class="sendreq">
 <a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=reqbox&frndreject=<?php echo $row['id']?>">
  No Thanks</a>
 
 </div></td>
 
 </tr><?php
	 }
                         
 ?>
 </table>

 <?php }
 else   {
 ?>
 <fieldset style="padding-top:1px; font-size:25px; background-color:black; color:white; border:0px;"><center>
  FRIEND REQUEST</center></fieldset>
 <fieldset style="height:120; width:720; float:left; background-image:url(background.jpg); font-size:18px; background-attachment:fixed; border:0px none; color:red; font-size:19;">

  No Friend Request For You...
	 </fieldset>
	 </fieldset>
<?php
 }
  function hello($id) {
  $result=mysql_query("SELECT * FROM record WHERE iduser='$id'");
	 while($row=mysql_fetch_array($result)) 
	  echo "<img src='$row[picture]' height=100 width=140/>";
   	  echo "</td><td style='padding-top:-4px;'>";
	 ?>
	  <?php	
  }
	
   
  function addTo_List($userid ,$friendid ,$friendname ,$picture) {   
	   $result="INSERT INTO friendlist(userid,friendid,friendname,picture) VALUES('$userid','$friendid','$friendname','$picture')";
		   mysql_query($result);
        }





 ?>

 
 </body>
 </html>