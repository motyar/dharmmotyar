<?php
class paypal_ipn
{
	var $paypal_post_vars;
	var $paypal_response;
	var $timeout;
	var $error_email;
	
	function paypal_ipn($paypal_post_vars) {
		$this->paypal_post_vars = $paypal_post_vars;
		$this->timeout = 120;
	}

	function send_response()
	{
		$fp = fsockopen("www.sandbox.paypal.com", 80, &$errno, &$errstr, 120);                  		
            if (!$fp) {
			$this->error_out("PHP fsockopen() error: " . $errstr , "");
		} else {			
                  foreach($this->paypal_post_vars as $key => $value) {
				if (@get_magic_quotes_gpc()) {
					$value = stripslashes($value);
				}
				$values[] = "$key" . "=" . urlencode($value);			              
                  }
			$response = @implode("&", $values);			
                  $response .= "&cmd=_notify-validate";			
                  fputs( $fp, "POST /cgi-bin/webscr HTTP/1.0\r\n"); 
			fputs( $fp, "Content-Type: application/x-www-form-urlencoded\r\n" ); 
			fputs( $fp, "Content-Length: " . strlen($response) . "\r\n\r\n"); 
			fputs( $fp, "$response\n\r" ); 
			fputs( $fp, "\r\n" );			
                  $this->send_time = time();
			$this->paypal_response = ""; 
			// get response from paypal
			while (!feof($fp)) {
                        $this->paypal_response .= fgets( $fp, strlen($fp));                             
				if ($this->send_time < time() - $this->timeout) {
					$this->error_out("Timed out waiting for a response from PayPal. ($this->timeout seconds)" , "");
				}			   
                  }                       
			fclose( $fp );                     
            }
                           
	}
	
	function is_verified() {		
            if( ereg("VERIFIED", $this->paypal_response) )
			return true;
		else
			return false;
	} 

	function get_payment_status() {		                         
            
            return $this->paypal_post_vars['payment_status'];
	}

	function success_Msg($message, $em_headers , $txn_id  )
	{	
            global $db ; 	
            $date = date("D M j G:i:s T Y", time());
		$message .= "\n\nThe following data was received from PayPal:\n\n";
		@reset($this->paypal_post_vars);
		while( @list($key,$value) = @each($this->paypal_post_vars)) {
			$message .= $key . ':' . " \t$value\n";
		}            
            mail($this->error_email, "[$date] paypay_ipn notification", $message, $em_headers);
	}
    function error_out($message, $em_headers ,  $txn_id )
	{	
	       global $db ; 
            $db->Execute("insert" , "INSERT INTO `logs` (`transaction_id` , `message` , `loggedon` ) VALUES  ('$txn_id' ,'$message', now()) ")  ;        
            $date = date("D M j G:i:s T Y", time());
		$message .= "\n\nThe following data was received from PayPal:\n\n";
		@reset($this->paypal_post_vars);
		while( @list($key,$value) = @each($this->paypal_post_vars)) {
			$message .= $key . ':' . " \t$value\n";
		}            
            mail($this->error_email, "[$date] paypay_ipn notification", $message, $em_headers);
	}	
	
} 

?>