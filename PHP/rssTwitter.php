<?php

	$doc = new DOMDocument();
	$doc->load('http://twitter.com/statuses/user_timeline/29941232.rss');
	$arrFeeds = array();
	foreach ($doc->getElementsByTagName('item') as $node) {
		$itemRSS = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
			);
		array_push($arrFeeds, $itemRSS);
	}
	echo '<pre>';
print_r($arrFeeds);
?>


