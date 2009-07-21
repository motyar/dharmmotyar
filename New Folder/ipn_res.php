<?php    
  include_once("includes/auth.php");
	  if(empty($HTTP_POST_VARS)){
		exit;
   }
// database settings      
      
      //$paypal_email = "seller@paypalsandbox.com";
      $paypal_email = "";
      
      // email address where script should send notifications
      $error_email = "";
      
      $company = ''; 

      // email header
      $em_headers  = "From: from_name \n";		
      $em_headers .= "Reply-To: $paypal_email\n";
      $em_headers .= "Return-Path: $paypal_email\n";
      $em_headers .= "Organization: $company\n";
      $em_headers .= "X-Priority: 3\n";                                 
// -----------------
   include_once("includes/top.php");
  require("includes/classes/ipn_class.php");  
  $paypal_info = $HTTP_POST_VARS;
  $paypal_ipn = new paypal_ipn($paypal_info);
  foreach ($paypal_ipn->paypal_post_vars as $key=>$value) {	
      if (getType($key)=="string") {
		eval("\$$key=\$value;");
	}
}
$paypal_ipn->send_response();
$paypal_ipn->error_email = $error_email;

if (!$paypal_ipn->is_verified()) {
	$paypal_ipn->error_out("Bad order (PayPal says it's invalid)" . $paypal_ipn->paypal_response , $em_headers  , $txn_id );
	die();
}

switch( $paypal_ipn->get_payment_status() )
{
	
      case 'Pending':
		
		$pending_reason=$paypal_ipn->paypal_post_vars['pending_reason'];
					
		if ($pending_reason!="intl") {
			$paypal_ipn->error_out("Pending Payment - $pending_reason", $em_headers , $txn_id );
			break;
		}                     
                      
                                    
	case 'Completed': 		                                    
            
            if ($paypal_ipn->paypal_post_vars['txn_type']=="reversal") {
			$reason_code=$paypal_ipn->paypal_post_vars['reason_code'];
			$paypal_ipn->error_out("PayPal reversed an earlier transaction.", $em_headers , $txn_id );
			// you should mark the payment as disputed now
		} else {                    
                     global $db ; 
                    $transactionArray = $db->Execute("select", "SELECT txn_id from paypal_table where txn_id ='".$txn_id ."'");     
                if(!$transactionArray){
                    $insert_sql = $db->Execute("insert" , "INSERT INTO `paypal_table` (`txn_id` , `payment_date` , `payer_status` , `verify_sign` ) VALUES  ('$txn_id' ,  '$payment_date'  ,'$payer_status' ,'$verify_sign' ) ")  ;        
                    $paypal_ipn->success_Msg("This was a successful transaction", $em_headers , $txn_id );			
			    // you should add your code for sending out the download link to your customer at $payer_email here.
			 
                   } else if($transactionArray){
                        $paypal_ipn->error_out("This was a duplicate transaction", $em_headers , $txn_id );				
                   } else {
				$paypal_ipn->error_out("Someone attempted a sale using a manipulated URL", $em_headers  , $txn_id );	
               } 
          }
		break;
		
	case 'Failed':
		// this will only happen in case of echeck.
		$paypal_ipn->error_out("Failed Payment", $em_headers , $txn_id );
	break;

	case 'Denied':
		// denied payment by us
		$paypal_ipn->error_out("Denied Payment", $em_headers  , $txn_id  );
	break;

	case 'Refunded':
		// payment refunded by us
		$paypal_ipn->error_out("Refunded Payment", $em_headers  , $txn_id );
	break;

	case 'Canceled':
		// reversal cancelled
		// mark the payment as dispute cancelled		
		$paypal_ipn->error_out("Cancelled reversal", $em_headers  , $txn_id );
	break;

	default:
		// order is not good
		$paypal_ipn->error_out("Unknown Payment Status - " . $paypal_ipn->get_payment_status(), $em_headers , $txn_id );
	break;    

} 

?>
