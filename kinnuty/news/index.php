<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="content-language" content="">
	<link rel="shortcut icon" href="images/orange.gif" >
    <title>Kinnuty</title>
    <link rel="stylesheet" type="text/css" href="../style/mobile.css">
  </head>
  <body>
      <?php include_once('../includes/Xheader.php'); ?>
<div class="title-icon platform">
  <img src="../images/kinnutynews.png" alt="orangefull" id="grow" height="65px" width="65px">
</div>
<div class="title-title">
  <h3>
Kinnuty news for you
</h3>
</div>
<div class="g-section g-tpl-100-100">
  <div class="g-unit g-first">
    <div class="mgc-p">
				<p><strong>Share</strong> your education material with all kinutizens. Download and submit notes, papers, and other study matterials for free. Stay connected with your friends and college with Kinnuty alerts and other kinnuty products.
				Stay connected with your friends and college with Kinnuty alerts and other
				kinnuty products. Check below to find out which products are available
				from <strong>kinnuty</strong>. To find out more be a <strong>Kinnutizen</strong></p>
    <div class="g-section hr">

 <?php include_once('../includes/g_unit.php'); ?>

   <div class="g-section hr">
 </div>
 </div>
 </div>
  </div>


</div>
<?php
class TwiterRSS{
var $url= "http://news.google.com/news?pz=1&ned=in&hl=hi&topic=n&output=rss";

      function getRSS(){
      	$doc = new DOMDocument();
      	$doc->load($this->url);
      	$arrFeeds = array();
      	foreach ($doc->getElementsByTagName('item') as $node) {
      	echo $node->getElementsByTagName('description')->item(0)->nodeValue;
   
      	}
    
     }
}
$news = new TwiterRSS();
$news->getRSS();
?>

<div class="g-section hr">
  <h3>Help &amp; Discuss</h3>
<div class="help">
  <ul id="help-center">
    <li>Learn more in the <a  href="http://groups.google.com/group/kinnuty">Help Centre</a></li>
    <li>Ask your questions in our <a href="http://groups.google.com/group/kinnuty">Help Forum</a></li>
    <li><a href="../ideas/index.php">Share your ideas</a></li>
  </ul>
</div>
</div>
	<?php include_once('../includes/Xfooter.php');?>
  </body>
  </html>



