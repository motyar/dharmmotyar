<?php
  function databaseconnect() {
  $conn=mysql_connect("localhost","root","");
   mysql_select_db("student",$conn);}

?>