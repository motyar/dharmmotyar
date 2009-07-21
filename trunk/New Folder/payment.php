<?php   
/* 
  This class is used to do payment operation  
*/
   include("includes/classes/phpPayPal.0.5.2.php"); 
/* @ This method is used to pay by Recurring Method 
   @ Method return the unique Profile Id .   
*/ 
 function payByPayPal($amount, $cnum, $ctype, $expdate, $fname, $lname, $add1, $city, $state, $zip, $country ,$email , $cv2 = ''){
		$result = array();
		$paypal = new phpPayPal();		
            //$paypal->ip_address = $_SERVER['REMOTE_ADDR'];
		$paypal->amount_total = number_format($amount,2);
		$paypal->amount_shipping = '0.00';
		$paypal->credit_card_number = $cnum;
		$paypal->credit_card_type = $ctype;
		$paypal->expire_date = $expdate;
		$paypal->first_name = $fname;
		$paypal->last_name = $lname;
		$paypal->address1 = $add1;
		$paypal->city = $city;
		$paypal->state = $state;
		$paypal->postal_code = $zip;		
		$paypal->country_code = $country;
		$paypal->billing_period = 'Day' ; 
        $paypal->email  = $email  ;
		$paypal->billing_frequency = '1' ; 
		$paypal->startdate =   date('Y-m-d H:i:s', time()+1);
        $paypal->description = 'recurringwarrantyreceiveFromInfoshore';
        $paypal->cvv2_code = $cv2 ;
		 /*Add Order Items (NOT required) - Name, Number, Qty, Tax, Amt
		   Repeat for each item needing to be added
		   $paypal->addItem('Item Name', 'Item Number 012', 1, 0, '50.49');
		   Perform the payment */
		   $paypal->CreateRecurringPaymentsProfile();            
		                 
            if($paypal->Response['ACK'] == "Success"){
			return array("ack" => 1, "profile_id" => $paypal->Response['PROFILEID']);
		}else{
			return array("ack" => 0, "msg" => $paypal->Error['LONGMESSAGE']);
		}
	}   
/* calling way    
$result = payByPayPal('1.00','4255751217530791','Visa','042019','Pardeep','Singhal','Los angle','NY','NY','85445','US' , 'pardeepsingal1@gmail.com' , '321');
  print_r($result); 
*/



/* @ This method is used to Update buyer recurring Billing Profile 
   @ Method return the unique Profile Id .   
   @ in this method Before Update the profile buyer Profile ID neccessary Bcz Profile ID change according timestamp so  payByPayPal() method calling in this method 
*/ 

function  UpdateprfileByPayPal($nfname , $nlname , $nadd1 , $ncity, $nstate ,$nzip , $ncountry , $nctype , $ncnum , $expMonth , $expYear ,$note , $profile_id ,  $cv2 = ''){                        
           if(strlen($profile_id) > 0 ){
            $response = array();		
            $paypal = new phpPayPal();		
            //$paypal->ip_address = $_SERVER['REMOTE_ADDR'];
            $paypal->first_name = $nfname;
			$paypal->last_name = $nlname;
			$paypal->address1 = $nadd1;
			$paypal->city = $ncity;
			$paypal->state = $nstate;
			$paypal->postal_code = $nzip;		
			$paypal->country_code = $ncountry;
			$paypal->credit_card_type = $nctype;
			$paypal->credit_card_number = $ncnum;
			$paypal->expire_month = $expMonth;
			$paypal->expire_year = $expYear ;
			$paypal->note = $note ; 
			$paypal->profileID = $profile_id;           
            $paypal->cvv2_code = $cv2 ;
			   /*  $paypal->amount_total = number_format($amount,2);		
               $paypal->amount_shipping = '0.00';		
		   $paypal->billing_period = 'Month' ; 
               $paypal->billing_frequency = '4' ; 
		   $paypal->startdate =  '2009-9-6T0:0:0'; 
               $paypal->description = 'recurringwarrantyreceiveFromInfoshore';  
          */            
	   /*    Add Order Items (NOT required) - Name, Number, Qty, Tax, Amt
		   Repeat for each item needing to be added
		   $paypal->addItem('Item Name', 'Item Number 012', 1, 0, '50.49');
		   Perform the payment 
          */
	      $paypal->UpdateRecurringPaymentsProfile();            		                 
            if($paypal->Response['ACK'] == "Success"){
			return array("ack" => 1, "profile_id" => $paypal->Response['PROFILEID']);
		}else{
			return array("ack" => 0, "msg" => $paypal->Error['LONGMESSAGE']);
		}
         }   
     }      

/*
$response = UpdateprfileByPayPal('Rohit' , 'Khariwal','Los angle' ,'NY','NY','85445' ,'US' , 'Visa' , '4255751217530791' , '05' , '2017' ,'exprire credit cart' ,'I%2d9T14WVTDU7JD' , '231');
 print_r($response);
*/

?>
