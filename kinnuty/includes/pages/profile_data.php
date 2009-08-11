<?php
include('../includes/function.php');
//include('../pages/session.php');

    databaseconnect();
 class ProfileData {
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
	 private $EditFirstName;
	 private $EditSeconName;
	 private $EditClass;
	 private $EditCollege;
	 private $EditCity;
	 private $EditTitle;
	 private $check;
 public function __construct() {
    $this->check='me';
    $result=mysql_query("SELECT * FROM record WHERE iduser='$_SESSION[userid]'");
  while($row=mysql_fetch_array($result)) {
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
  }
      $result=mysql_query("SELECT * FROM login WHERE id='$_SESSION[userid]'");
  while($row=mysql_fetch_array($result)) {
	  $this->EditFirstName=$row['firstname'];
      $this->EditSeconName=$row['lastname'];
	   $this->EditCollege=$row['collegename'];
	  $this->EditCity=$row['cityname'];

  }

 }
 }
 ?>