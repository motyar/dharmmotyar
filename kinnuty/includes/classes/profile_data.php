<?php
include('includes/functions/function.php');
//include('include/session.php');
 databaseconnect();
 echo $_SESSION['pop']."sdfasdghdfgd";
 class ProfileData {
	 private $First_name;
	 private $Last_name;
	 private $Gender;
	 private $BirthDay;
	 private $BirthMonth;
	 private $Home_Town;
	 private $Relationship;
	 private $College;
	 
	 private $Picture;
	 
	 private $AboutMe;
	 private $LifeAim;
	 private $Books;
	 private $BestFriend;
	 private $BestG_BF;
	 private $BestTeacher;
	 private $WhyCollege_Like;
	 private $Activity;
	 private $FavouritePlace;
	 private $Music;
	 
	 
	 private $Personal;
	 
	 private $CellNumber;
	 private $PhoneNumber;
	 private $Email;
	 private $Address;
	 private $Website;
	 private $City;

	 private $check;

    public function __construct() {
    $this->check='me';
    $result=mysql_query("SELECT * FROM record WHERE iduser='$_SESSION[pop]'");
       while($row=mysql_fetch_array($result)) {
    $this->First_name=$row['firstname'];
	$this->Last_name=$row['lastname'];
    $this->AboutMe=$row['AboutMe'];
	$this->LifeAim=$row['lifeaim'];
	$this->Books=$row['Books'];
	$this->BestFriend=$row['favouritef'];
	$this->BestTeacher=$row['favouritet'];
	$this->BestGF=$row['closegf'];
	$this->WhyCollege_Like=$row['whylikeC'];
	$this->Activity=$row['activity'];
    $this->FavouritePlace=$row['favouriteP'];
    $this->Music=$row['music'];
    $this->Picture=$row['picture'];

	$this->RequestMsg=$row['friendrm'];
    
	$this->CellNumber=$row['contactn'];
    $this->PhoneNumber=$row['HomeNumber']; 
	$this->Email=$row['email'];
    $this->Address=$row['address'];
	$this->Web=$row['web'];
	$this->City=$row['city'];
  }
      $result=mysql_query("SELECT * FROM login WHERE id='$_SESSION[pop]'");
  while($row=mysql_fetch_array($result)) {
	  $this->Gender=$row['gender'];
      $this->BirthDay=$row['bday'];
      $this->BirthMonth=$row['bmonth'];
	  $this->Home_town=$row['cityname'];
	  $this->Relationship=$row['relation'];
	  $this->College=$row['collegename'];
     if($this->Gender=='Male')
		 $this->Personal='My GirlFriends';
	  else
		 $this->Personal='My BoyFriends';
  }

 }
  public function Picture_me(){
 ?>
   <img src='<?php echo $this->Picture;?>' alt=""  width="200" height="180"/>
   <?php
  }

  public function basic_detail() {
  ?>
  <table width="480" height="379" border="0" cellpadding="0" cellspacing="0">
 <tr>
 <td><b><?php echo $this->First_name."  ".$this->Last_name ?></td></b>
 </tr>

<tr>
   
    <td height="185" colspan="2"><img src='<?php echo $this->Picture;?>' alt=""  width="200" height="180"/></td>
  </tr>
  <tr>
    <td width="194" class="head"> Gender</td>
    <td width="280" class="matter"><?php echo  $this->Gender; ?></td>
  </tr>
  <tr>
    <td  class="head">Birthday</td>
    <td class="matter"><?php echo $this->BirthDay; ?>-<?php echo $this->BirthMonth; ?></td>
  </tr>
  <tr>
    <td  class="head">Home Town</td>
    <td class="matter"><?php echo $this->Home_town; ?></td>
  </tr>
  <tr>
    <td class="head">Relation Ship</td>
    <td class="matter"><?php echo $this->Relationship; ?>e</td>
  </tr>
   <tr>
    <td class="head">College</td>
    <td class="matter"><?php echo $this->College; ?></td>
  </tr>
</table>
  <?php
  }

   public function personal_detail() {
    ?>
<table width="489" height="476" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="193"  class="head">About Me</td>
    <td width="287" class="matter"><?php echo  $this->AboutMe; ?></td>
  </tr>
  <tr>
    <td  class="head">Why I like This college</td>
    <td class="matter"><?php echo  $this->WhyCollege_Like; ?>
	</td>
  </tr>
  <tr>
    <td  class="head">My Books</td>
    <td class="matter"><?php echo  $this->Books; ?></td>
  </tr>
  <tr>
    <td class="head">Music</td>
    <td class="matter"><?php echo  $this->Music; ?></td>
  </tr>
  <tr>
    <td  class="head"> <?php  echo $this->Personal; ?></td>
    <td class="matter"> <?php echo  $this->BestGF; ?></td>
  </tr>
  <tr>
    <td  class="head">Activity</td>
    <td class="matter"> <?php echo  $this->Activity; ?></td>
  </tr>
  <tr>
    <td  class="head">Best Friend's</td>
    <td class="matter"> <?php echo  $this->BestFriend; ?></td>
  </tr>
  <tr>
    <td  class="head">Favourite Place</td>
    <td class="matter"> <?php echo  $this->FavouritePlace; ?></td>
  </tr>
  <tr>
    <td  class="head">Favourite Teacher</td>
    <td class="matter"> <?php echo  $this->BestTeacher; ?></td>
  </tr>
  <tr>
    <td  class="head">I Want To Become...</td>
    <td class="matter"> <?php echo  $this->LifeAim; ?></td>
  </tr>
</table>
  <?php		
	}
    public function contact_detail() {
  
	  ?>
<table width="471" height="429" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="head">Email's</td>
    <td class="matter"><?php echo $this->Email; ?></td>
  </tr>
  <tr>
    <td class="head">Mobile</td>
    <td class="matter"><?php echo $this->PhoneNumber; ?></td>
  </tr>
  <tr>
    <td class="head">Land Phone</td>
    <td class="matter"><?php echo $this->PhoneNumber; ?></td>
  </tr>
  <tr>
    <td class="head">Address</td>
    <td class="matter"><?php echo $this->Address; ?></td>
  </tr>
  <tr>
    <td class="head">City/Town</td>
    <td class="matter"><?php echo $this->City; ?></td>
  </tr>
  <tr>
    <td class="head">Web Address</td>
    <td class="matter"><?php echo $this->Web; ?></td>
  </tr>
</table>

  <?php	
	}

    }
  ?>
 <html>
 <head>
 <link rel="stylesheet" href="css/home.css" type="text/css" />
 </head>
 <body>
 </body>
 </html>
