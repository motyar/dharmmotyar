<?php
	$url = "http://api.warrantyfeed.com/FetchWarrantyCatalog.php?key=YkSoEyAq&category=web";
		// create a new curl resource
	    $ch = curl_init();
		// set URL to download
	    curl_setopt($ch, CURLOPT_URL, $url);
		// remove header? 0 = yes, 1 = no
	    curl_setopt($ch, CURLOPT_HEADER, 0);
		// should curl return or print the data? true = return, false = print
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// timeout in seconds
	    curl_setopt($ch, CURLOPT_TIMEOUT, 45); 
		// download the given URL, and return output
	    $output = curl_exec($ch);
	    $error = curl_error($ch);
	    echo $error;
		// close the curl resource, and free system resources
	    curl_close($ch);
	    
	    echo $output;
          ?>
