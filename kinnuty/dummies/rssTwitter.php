<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
/*****************************************************************************************************************************************************
Author - Dharmveer Motyar
web - dharmmotyar.000space.com
chat - dharmmotyar@gmail.com
mail me - dharmmotyar@gmail.com
This is the class parse 
$url is the url of your rss feed xml
this class actually works for you twitter RSS
*****************************************************************************************************************************************************/
class TwiterRSS{
var $url= "http://news.google.com/news?pz=1&ned=in&hl=hi&topic=n&output=rss";
      function getRSS(){
      	$doc = new DOMDocument();
      	$doc->load($this->url);
      	$arrFeeds = array();
      	foreach ($doc->getElementsByTagName('item') as $node) {
      	echo $node->getElementsByTagName('description')->item(0)->nodeValue;
      		$itemRSS = array ( 
      			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
      			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
      			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
      			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
      			);
      		array_push($arrFeeds, $itemRSS);
      	}
      	echo '<pre>';
      //print_r($arrFeeds);
      return $arrFeeds; 
     }
}
$news = new TwiterRSS();
$news->getRSS();
?>


