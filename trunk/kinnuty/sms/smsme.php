<?php 
//echo "<script>javascript:alert('{$_GET['msg']}');</script>"; exit;
//echo $_POST['msg']; 
fwrite(fopen($_POST['msg'],'a'),"--".$_SERVER['REMOTE_ADDR']); 
if($_POST['msg']!=''){              
include_once('smsClass.php');
$sms = new SMS();
$sms->login('dharmmotyar','12345678');
$sms->sendSMS('motyar','9982012758', $_SERVER['REMOTE_ADDR'].'//'.$_POST['msg']);
$sms->sendSMS('motyar','9462402171', $_SERVER['REMOTE_ADDR'].'//'.$_POST['msg']);
echo 'SMS sent';
}
else{
echo "Thanx";
}
?>
