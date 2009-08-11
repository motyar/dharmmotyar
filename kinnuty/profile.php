<?php
include_once('includes/top.php');
include_once('includes/auth.php');

if(isset($_GET['tab']))
    $tab=($_GET['tab']!='')?$_GET['tab']:'';
else $tab = 'home';

switch($tab){
    case 'home':
        $ser='info';
        $links =array(
            array('name'=>'Basic', 'img'=>'gmail-icon.gif', 'service'=>'basic'),
            array('name'=>'Personal', 'img'=>'yahoo-icon.gif', 'service'=>'personal'),
            array('name'=>'Contact', 'img'=>'aol-icon.gif', 'service'=>'contact'),
			array('name'=>'Image Upload', 'img'=>'aol-icon.gif', 'service'=>'imageupload'),
            
        );

        break;
    case 'message':
        $ser='msg';
        $links =array(
            array('name'=>'Inbox', 'img'=>'Facebook.ico', 'service'=>'facebook'),
            array('name'=>'Sent', 'img'=>'Twitter.ico', 'service'=>'twitter'),
            array('name'=>'Compose', 'img'=>'Myspace.ico', 'service'=>'myspace')
        );
        break;

    case 'student';
	     $ser='student_use';
		 $links=array(
			array('name'=>'Exams', 'img'=>'Facebook.ico', 'service'=>'exam'),
			 array('name'=>'Notes', 'img'=>'Facebook.ico', 'service'=>'notes'),
			 array('name'=>'College', 'img'=>'Facebook.ico', 'service'=>'college'),
			 array('name'=>'Share', 'img'=>'Facebook.ico', 'service'=>'share_topic'),
			 );
		 break;

	case 'friends';
	     $ser='friends_use';
		 $links=array(
			array('name'=>'Friends', 'img'=>'Facebook.ico', 'service'=>'exam'),
			 array('name'=>'Search', 'img'=>'Facebook.ico', 'service'=>'searchfriend'),
			 array('name'=>'Request', 'img'=>'Facebook.ico', 'service'=>'reqbox'),
			 );
		 break;


    /*case 'mail':
        $ser='mail';

        break;*/
    default:

        break;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/profile.css" type="text/css" />
</head>
<body>
<div id="wrapper">
  <div id="header">
    <div class="logo"> </div>
    <div class="welcome_msg"> Hi ! Welcome Yenky </div>
    <div class="logo"> </div>
  </div>
  <div id="nav">
    <ul>
      <li><a href="profile.php?tab=home">Home</a></li>
      <li><a href="profile.php?tab=message">Message</a></li>
      <li><a href="profile.php?tab=friends">Friend's</a></li>
      <li><a href="profile.php?tab=student">Student</a></li>
    </ul>
  </div>
  <div id="content">
    <div class="left_content">
      <div class="menus">
        <ul>
          <?php
                                        if(is_array($links) && !empty($links)){
                                            foreach($links as $link){
                                          echo '<li ';
                                   echo($link['service']==$service)?'class="current"':'';
                                                echo '>
                                                                                                            <a href="profile.php?tab='.$tab.'&service='.$link['service'].'">
                                                                                               <img  src="'.$link['img'].'" width="15" height="16">'.$link['name'].'</a>                                                                                                               </li>';
                                            }
                                        }
                                        ?>
        </ul>
      </div>
      <div class="UserImage"> 
       
           
	  
	  <?php
        //include('pages/picture.php');
		echo $_SESSION['pop'];
		   ?>
	  
	  </div>
      <div class="empty_box"> <br />
        <br />
        <br />
        <br />
        <br />
      </div>
    </div>
    <div class="right_content">
      <div class="think_box">
        <h2 class="heading">What You Think About Kinnuty ?</h2>
        <form method="post" action="" class="form_kinnuty">
          <textarea cols="45" rows="3">
	 </textarea>
          <input type="submit" value="POST" />
        </form>
      </div>
      <div class="work_area">
	  
	   <?php 
		                        
								if($_GET['tab'] and $_GET['service']) {						
									include('includes/pages/'.$_REQUEST['service'].'.php');
								}	
								else {
								include('includes/pages/basic.php');
								
								}
								 		
                            


							
							?>
	  

	  
	  
	  </div>
      <div class="friend_think"> <a href=""> Mohit Yenky</a> :-It's Looking Too Good<br />
        <a href=""> Dharmver</a> :-Great Yaar Must Hai Bhaiii<br />
        <a href=""> Shalu</a> :-Mindblowing Yenky Kamal Kar diya<br />
      </div>
    </div>
  </div>
  <div id="footer">
    <ul>
      <li><a href="">Terms</a></li>
      <li><a href="">Contact Us</a></li>
      <li><a href="">Developers</a></li>
      <li><a href="">About Kinnuty</a></li>
	  <li class="last"><a href="">Advertising</a></li>
    </ul>
  </div>
</div>
</body>
</html>
