<?php
   include('class/profile_data.php');
      
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="css/home.css" type="text/css" />
<title>Kinnty Basic Info</title>
</head>
<body>
<?php

       $ob1=new ProfileData();
        $ob1->Picture_me();

?>

</body>
</html>