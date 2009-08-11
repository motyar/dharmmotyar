<?php
 databaseconnect();
 class FriendData {
	 private $Name;
	 private $LastName;
	 private $Title;
	 private $Class;
	 private $College;
	 private $Birthday;
	 private $Image;
	 private $AboutMe;
	 private $LifeAim;
	 private $Books;
	 private $BestFriend;
	 private $BestTeacher;
	 private $BestGF;
	 private $RequestMsg;
	 private $CellNumber;
	 private $PhoneNumber;
	 private $Email;
	 private $Address;
	 private $Gender;
	 private $Bday;
	 private $Bmonth;
	 private $CityName;
	 private $search_friend_idd;

 public function __construct($Find) {
    $_SESSION['search_friend_id']=$Find;
	$this->search_friend_idd=$Find;	
     $result=mysql_query("SELECT * FROM record WHERE iduser='$Find'");
  while($row=mysql_fetch_array($result)) {
	  
    $this->Name=$row['firstname'];
	$this->Title=$row['title'];
    $this->LastName=$row['lastname'];
	
	$this->College=$row['collegename'];
	$this->Stclass=$row['class'];
    $this->AboutMe=$row['AboutMe'];
	$this->LifeAim=$row['lifeaim'];
	$this->Books=$row['Books'];
	$this->BestFriend=$row['favouritef'];
	$this->BestTeacher=$row['favouritet'];
	$this->BestGF=$row['closegf'];
	$this->RequestMsg=$row['friendrm'];
    $this->CellNumber=$row['contactn'];
    $this->PhoneNumber=$row['HomeNumber']; 
	$this->Email=$row['email'];
    $this->Address=$row['address'];
	$this->EditClass=$row['class'];
    $this->EditTitle=$row['title'];  
	$this->Image=$row['picture'];
  }
    $this->LoginData($Find);
  
  }

 
 





  public function FriendSetData($Find) {
	 
         $result=mysql_query("SELECT * FROM record WHERE iduser='$Find'");
  while($row=mysql_fetch_array($result)) {
	  
    $this->Name=$row['firstname'];
	$this->Title=$row['title'];
    $this->LastName=$row['lastname'];
	$this->College=$row['collegename'];
	$this->Stclass=$row['class'];
    $this->AboutMe=$row['AboutMe'];
	$this->LifeAim=$row['lifeaim'];
	$this->Books=$row['Books'];
	$this->BestFriend=$row['favouritef'];
	$this->BestTeacher=$row['favouritet'];
	$this->BestGF=$row['closegf'];
	$this->RequestMsg=$row['friendrm'];
    $this->CellNumber=$row['contactn'];
    $this->PhoneNumber=$row['HomeNumber']; 
	$this->Email=$row['email'];
    $this->Address=$row['address'];
	$this->EditClass=$row['class'];
    $this->EditTitle=$row['title'];  
	$this->Image=$row['picture'];
  }
  $this->LoginData($Find);
  //$this->ShowData();
  }
    public function LoginData($Find) {
	  $result=mysql_query("SELECT * FROM login WHERE id='$Find'");
      while($row=mysql_fetch_array($result)) {
	   $this->Gender=$row['gender'];
	   $this->Bday=$row['bday'];
	   $this->Bmonth=$row['bmonth'];
	   $this->CityName=$row['cityname'];
	

	}	    
	} 


	public function ShowFr_Personal() {
		?>
	  <font size=4 color=#4A6B9A>
 <center><?php echo "Profile: ".$this->Name." ".$this->LastName ?></center>
 </font>
 <font size=4 color=#ED3349>
   About Me:-<?php echo $this->AboutMe ?> </font><br>
	<table><tr>
 <td valign="top" style="color:black; font-size:17px; padding-left:9px;"><label>Life Aim:-</label><?php echo $this->LifeAim; ?><br><br>
<label> Books:</label> <?php echo $this->Books; ?><br><br>
<label> Best Friend's:</label><?php echo $this->BestFriend;  ?><br><br>
 <label>Best Teacher: </label><?php echo $this->BestTeacher; ?><br><br>
 <label>Best GirlFriend: </label><?php echo $this->BestGF; ?><br><br>
<label> Friend Request Message:</label> <?php echo $this->RequestMsg ;?>
 </td></tr>
 </table>	<br/><br/>
<a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&frndshowbasic=<?php echo $_SESSION['search_friend_id'] ?>" id='bio' style="color:red;float:left;">BASIC</a>
<a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&frndshowpersonal=<?php echo $_SESSION['search_friend_id']?>" id='bio' style="color:red;float:left; padding-left:25px;">PERSONAL</a>
 <a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&frndshowcontact=<?php echo $_SESSION['search_friend_id']?>" id='bio' style="color:red;float:left; padding-left:25px;">Contact</a>
 <div class="sendreq">
 <a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&frndrequest=<?php echo $_SESSION['search_friend_id']?>">
  Add As Friend</a>
 
 </div>







 <?php 
	}
	  
 public function ShowFr_Contact() {
	 ?>

	 <font size=4 color=#4A6B9A>
 <center><?php echo "Profile: ".$this->Name." ".$this->LastName ?></center>
 </font>


  <table><tr>

 <td valign="top" style="color:black; font-size:17px; padding-left:9px;">
<label> Cell Number:-</label>
 <?php echo $this->CellNumber; ?></font><br><br>
 <label> 
 Phone Number:</label>  <?php echo $this->PhoneNumber; ?><br><br>
 <label> Email:</label> <?php echo $this->Email;  ?><br><br>
 <label> Address:</label> <?php 
	     echo wordwrap($this->Address, 25, '<br>', true);
	 ?>
 </td></tr>
 </table>	
<a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&frndshowbasic=<?php echo $_SESSION['search_friend_id'] ?>" id='bio' style="color:red;float:left;">BASIC</a>
<a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&frndshowpersonal=<?php echo $_SESSION['search_friend_id']?>" id='bio' style="color:red;float:left; padding-left:25px;">PERSONAL</a>
 <a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&frndshowcontact=<?php echo $_SESSION['search_friend_id']?>" id='bio' style="color:red;float:left; padding-left:25px;">Contact</a>

<div class="sendreq">
 <a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&frndrequest=<?php echo $_SESSION['search_friend_id']?>">
  Add As Friend</a>
 
 </div>

  <?php
 
 }







	
	  
	  
	  
	  public function ShowData() {
		  ?>   
		  
 <font size=4 color=#4A6B9A>
 <center><?php echo "Profile: ".$this->Name." ".$this->LastName ?></center>
 </font>
 <font size=4 color=#ED3349>
 Title:-<?php echo $this->Title ?> </font><br>
 <table><tr><td>
 <img src='<?php echo $this->Image?>' height=140 width=130></img></td>
 <td valign="top" style="color:black; font-size:17px;"><label>Name:-</label><?php echo $this->Name." ".$this->LastName ?><br><br>
 <label>Class:</label><?php echo $this->Stclass ?><br><br>
<label> College:</label> <?php  echo $this->College ?><br><br>
 
 <label>Birthday:</label> <?php echo $this->Bday ?>-<?php echo $this->Bmonth ?>
 </td></tr>
 <tr><td style="color:#4D4E17;"><?php echo $this->Gender ?>,
 <?php echo $this->CityName ?><br>Rajasthan,India</td></tr>
 </table>	
 <a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&frndshowbasic=<?php echo $_SESSION['search_friend_id'] ?>" id='bio' style="color:red;float:left;">BASIC</a>
 <a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&frndshowpersonal=<?php echo $_SESSION['search_friend_id']?>" id='bio' style="color:red;float:left; padding-left:25px;">PERSONAL</a>

 <a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&frndshowcontact=<?php echo $_SESSION['search_friend_id']?>" id='bio' style="color:red;float:left; padding-left:25px;">Contact</a>


 <div class="sendreq">
 <a href="http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&frndrequest=<?php echo $_SESSION['search_friend_id']?>">
  Add As Friend</a>
 
 </div>
 <?php
	 }
     
   function Send_Request($Request_Msg){
    ?> 
	 <div class="reqbox" style="float:left;
	 padding:0px;
	 margin:0px;
	 width:320px;
	 height:220px;
	 "><label style="float:left; padding-left:45px; color:#000000; font-size:13px;">
	Type Request Message</label>
	<form method='post'   
	     action='http://localhost/kinnuty_com/profile1.php?tab=friends&service=searchfriend&friendid=<?php echo $_SESSION['search_friend_id']?>'   
	     style="float:left; padding-left:45px;">	       
       <textarea cols=28 rows=5 name='Request_Msg'>
	    You can Add me As Good Friend...
	   </textarea>
	   <input type='submit' value='Send' name='reqsend'/>
	   </form>
	   </div>
	   <?php

   }
  
  
  
  
  
  
  }
  

?>
<head>
<script language="javascript">

  function Send_Request(){
newwindow2=window.open('hello.html','name','height=200,width=350,left=820,top=300,resizable =0');
	var tmp = newwindow2.document;
	tmp.write('<html><head><title>Send Request Message</title>');
    tmp.write("<php echo 'sdfgdf' ?>");
	tmp.write('</body></html>');
	tmp.close();

 }


</script>

</head>