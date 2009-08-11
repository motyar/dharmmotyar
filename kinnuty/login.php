<?php
include_once('includes/top.php');
if(isset($_POST['pass'])){
	
	if($_POST['pass']!='' && $_POST['userid']!=''){
	$userinfo = $db->Execute("select","SELECT * FROM login WHERE `user_name`='".trim($_POST['userid'])."' AND `user_pass`='".trim($_POST['pass'])."'");
	//print_r($userinfo); exit;
	if(isset($userinfo[0]['id']) && $userinfo[0]['id']!=''){
		$_SESSION['user_id'] = $userinfo[0]['id'];
			echo '<script>javascript:window.location.href="profile.php";</script>';
		
	}
	else{
	
	echo '<script>javascript:window.location.href="login.php?error=true";</script>';
	}
  }
	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
<title>KinnuTy Login</title>
</head>
<body>
  <form id="Form1" name="Form1" action="login.php" method="post">

                        User Name
                        <input class="textbox340" name="userid" id="userid" value="" type="text">
			
                        Password
                        <input class="textbox340" name="pass" id="txtPassword" value="" type="password">
			   
			        <input alt="Login" type="submit">
			    
                    <a href="">Lost your password?</a>
                   
                    <a href="" target="_blank">Not yet a Member?</a>
                 </form>

</body>
</html>