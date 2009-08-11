<?php
     session_start();
       include('../includes/function.php');     
       databaseconnect();
	   $wrong=false;
	   $result=mysql_query('SELECT * FROM login');
       while($row=mysql_fetch_array($result)) {
            if($_REQUEST['txtLogin']==$row['user_name'] and $_REQUEST['txtPassword']==$row['user_pass'])  {				
					  $_SESSION['pop']=$row['id'];
					  $_SESSION['usernam']=$row['user_name'];
		               //header('location:http://localhost/kinnuty_com/check_session.php');	*/	echo "Sdfgsdfg"	   				             ;
					   /*echo "sdfg";
					   echo $_SESSION['pop'];
					   echo $_SESSION['usernam'];*/
					   header('profile1.php');
					   $wrong=true;
					   }   
					   
	            }

             if(!$wrong) {
			 header('Location:http://kinnuty.000space.com/index.php?wrong=yes');
			 }
	  




?>