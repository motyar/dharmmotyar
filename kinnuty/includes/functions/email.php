<?php 
	
	function mailWelcome($name, $email){
		global $mail;
		global $emailDisclaimer;	
		global $remoteLocation;
		$body = '<html>
					<body>
						<TABLE border=0 cellSpacing=0 cellPadding=0 width=600 align=center>	
							<TBODY>
								<TR>
									<TD> 
										<P style = "FONT-FAMILY: Arial, Helvetica, sans-serif; COLOR: #666666; FONT-SIZE: 10px;">You have received this email because it contains important 
                       information about your new ProductGuardDog.com account. To make sure that you receive emails from us, please add <A href="mailto:customerservice@productguarddog.com" target=_blank>customerservice@productguarddog.com</A> to your address book. </P>
									</TD>
								</TR>  
								<TR>
									<TD>
										<TABLE border=0 cellSpacing=1 cellPadding=0 width=600 bgColor=#000000 align=center>
											<TBODY>
												<TR>
													<TD bgColor=#ffffff valign=top>
														<TABLE border=0 cellSpacing=0 cellPadding=0 width=600>
															<TBODY>
																<TR>
																	<TD colSpan=3><IMG src="'.$remoteLocation.'/images/logo.jpg" width=461 height=95></TD>
																</TR>
																<TR>
																	<TD width=18>&nbsp;</TD>
																	<TD vAlign=top width=561>
																		<FONT color=#000000 size=-1  face="Arial, Helvetica, sans-serif">
																			<P>&nbsp;</P>
																			<P><STRONG>Dear '.$name.',</STRONG><BR/></P>
																			<p>On behalf of our employees and service providers that keep your home appliances, electronics and personal computers in good working order, welcome to ProductGuardDog! Please, enjoy a good night’s sleep.</p>
																			<P>Companion Property &amp; Casualty Group, with over thirty years of service in the insurance business, works with us to protect and repair your appliances, electronics and computers. Click here to learn more about Companion Property &amp; Casualty Group. </P>
														                    <P>Your Product Guard Dog Production Plan provides you with the most affordable way to protect all of your eligible appliances, electronics and computers. Companion Property &amp; Casualty Group and Tier One, with its network of over 30,000 repair and service centers throughout North America, teamed up with the manufacturer to provide you with the protection you want for up to four years.</P> 
																			<P>To start registering your products, please <A href="'.$remoteLocation.'/memberlogin.php">log in</A> to our Customer Service Center using your email address and the password you selected when you enrolled.</P></FONT>
																			<TABLE border=0 cellSpacing=1 cellPadding=3 width=570 bgColor=#000000>
																				<TBODY>
																				<TR>
													                              <TD bgColor=#e0e0e0>&nbsp;</TD>
													                              <TD bgColor=#c0c0c0 vAlign=top><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Must be <BR>purchased new</FONT></TD>
													                              <TD bgColor=#c0c0c0 vAlign=top><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Price $5000<BR>or less</FONT></TD>
													                              <TD bgColor=#c0c0c0 vAlign=top><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Minimum <BR>Manufacturers <BR>Warranty</FONT></TD>
													                              <TD bgColor=#c0c0c0 vAlign=top><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Product <BR>Eligibility</FONT></TD>
													                              <TD bgColor=#c0c0c0 vAlign=top><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Registered on Product Guard Dog</FONT></TD>
																				  <TD bgColor=#c0c0c0 vAlign=top><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Coverage Period</FONT></TD>
																				</TR>      
																				<TR>
													                              <TD bgColor=#c0c0c0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">For products purchased BEFORE you signed up on <BR>Product Guard Dog</FONT></TD>
																				  <TD bgColor=#e0e0e0 vAlign=center align=middle><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Yes</FONT></TD>
																				  <TD bgColor=#e0e0e0 vAlign=center align=middle><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Yes</FONT></TD>
																			      <TD bgColor=#e0e0e0 vAlign=center align=middle><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">1 Year</FONT></TD>
																				  <TD bgColor=#e0e0e0 vAlign=center align=middle><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">If Covered Product was purchased up to 60 days prior to sign up</FONT></TD>
																				  <TD bgColor=#e0e0e0 vAlign=center align=middle><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Date of <BR>sign-up</FONT></TD>
																				  <TD bgColor=#e0e0e0 vAlign=center align=middle><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">4 years from product purchase date</FONT></TD>
																				</TR>
																				<TR>
																					<TD bgColor=#c0c0c0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">For products purchased AFTER you signed up on <BR>Product Guard Dog</FONT></TD>
																					<TD bgColor=#e0e0e0 vAlign=center align=middle><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Yes</FONT></TD>
																					<TD bgColor=#e0e0e0 vAlign=center align=middle><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Yes</FONT></TD>
																					<TD bgColor=#e0e0e0 vAlign=center align=middle><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">180 Days</FONT></TD>
																					<TD bgColor=#e0e0e0 vAlign=center align=middle><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">If Covered Product is purchased after sign-up</FONT></TD>
																					<TD bgColor=#e0e0e0 vAlign=center align=middle><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Within 30 days</FONT></TD>
																					<TD bgColor=#e0e0e0 vAlign=center align=middle><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">4 years from product purchase date</FONT></TD>
																				</TR>
																				</TBODY>
																				</TABLE>
																				<FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">
																				<P>Thank you for selecting Product Guard Dog. Should you have any questions concerning your Service Plan, please call our customer service center at 877-662-8947. For your convenience, our center is open</P>
																				<P align=center><STRONG>Monday-Friday 8:00 AM to 8:00 PM (EST), Saturday-Sunday 11:00 AM-7:00 PM (EST).</STRONG></P>
																				<P>Sincerely,<br/><STRONG>The Product Guard Dog Team </STRONG><BR></P>
																				<P>&nbsp;</P>
																				</FONT>
																			</TD>
																			<TD vAlign=top width=21>&nbsp;</TD>
												                        </TR>
																		<TR>
																			<TD>&nbsp;</TD>
																			<TD vAlign=top>
																				<P style = " FONT-FAMILY: Arial, Helvetica, sans-serif; COLOR: #666666; FONT-SIZE: 10px;">Unfortunately, this e-mail is an automated notification, which is unable to receive replies. We re happy to help you with any questions or concerns you may have. Please contact us directly at <A href="mailto:customerservice@productguarddog.com" target=_blank>customerservice@productguarddog.com</A>.</P>
																				<P>&nbsp;</P>
																			</TD>
												                            <TD vAlign=top>&nbsp;</TD>
																		</TR>
																	</TBODY>
																</TABLE>
															</TD>
														</TR>
													</TBODY>
												</TABLE>
											</TD>
										</TR>
									</TBODY>
								</TABLE>
								<P>&nbsp;</P>
							</BODY>
						</HTML>';    
						$mail->ClearAll();				
                        $mail->AddReplyTo("no-reply@productguarddog.com", "Presidents Office");
						$mail->SetFrom("justin@productguarddog.com", "Presidents Office");
						$mail->Subject = "Welcome to the ProductGuardDog Program";
						$mail->AddAddress($email);
						$mail->AddBCC("khariwal.rohit@gmail.com");
						$mail->MsgHTML($body);				
                        $mail->Send();
	}	
  
	function sendVerification($name, $email, $url){
		global $emailDisclaimer;
		global $mail;
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 				<head>
					<title>Welcome Product Guard Dog </title>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />						
				</head>
	  			<body>
				<p>Thank you for subscribing to the ProductGuardDog.</p>
				<p>Please click on the link below to confirm your subscription.<br/><a href="'.$url.'">'.$url.'</a></p>
				<p><br/>The ProductGuardDog Team</p>
				</body></html>';
		$mail->ClearAll();
		$mail->AddReplyTo("no-reply@productguarddog.com");
		$mail->SetFrom("sales@productguarddog.com", "Sales");
		$mail->Subject = "Please verify subscription to ProductGuardDog";
		$mail->AddAddress($email, $name);
        $mail->MsgHTML($body);
		$mail->Send();
		
	}
	
	function prodconfirmation($name, $email, $productName, $productgroup, $category, $type, $manufacture, $modelno, $other, $price, $period, $purchaseDate, $customerId, $desc){ 
		global $emailDisclaimer;
		global $mail;
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 	         <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 				<head>
		 			<title>New Product Registered | ProductGuardDog</title>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />						
				</head>
	  			<BODY>
					<TABLE border=0 cellSpacing=0 cellPadding=0 width=600 align=center>
						<TBODY>
							<TR>
								<TD>
									<P style="FONT-FAMILY: Arial, Helvetica, sans-serif; COLOR: #666666; FONT-SIZE: 10px"; align=center>This email contains important information about your Product Guard Dog account.</P>
								</TD>
							</TR>
							<TR>
								<TD>
									<TABLE border=0 cellSpacing=1 cellPadding=0 width=600 bgColor=#000000 align=center>
										<TBODY>
											<TR>
												<TD bgColor=#ffffff vAlign=top>
													<TABLE border=0 cellSpacing=0 cellPadding=0 width=600>
														<TBODY>
															<TR>
																<TD colSpan=3>
																	<IMG src="logo.jpg" width=461 height=95>
																</TD>
															</TR>
															<TR>
																<TD width=18>&nbsp;</TD>
																<TD vAlign=top width=561><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">
																<P>&nbsp;</P>
																<P>Dear '.$name.',</P>
																<P>Welcome to ProductGuardDog. We would like to take this opportunity to thank you for doing business us. With our low cost of $14.95 a month, you will a have peace of mind for all your new electronics. </P>
																<P>The following information has been registered: </P></FONT>
																<TABLE border=0 cellSpacing=1 cellPadding=0 width=550 bgColor=#c0c0c0 align=center height=56>
																<TBODY>
																<TR>
																	<TD bgColor=#e0e0e0>
																	<TABLE border=0 cellSpacing=0 cellPadding=3 width=542 bgColor=#c0c0c0 height=56>
																		<TBODY>
																		<TR>
																			<TD bgColor=#e0e0e0 width=73><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Product: </FONT>
																			</TD>
																			<TD bgColor=#e0e0e0 width=179>&nbsp;</TD>
																			<TD bgColor=#e0e0e0 width=298>&nbsp;</TD>
																		</TR>
																		<TR>
																			<TD bgColor=#e0e0e0>&nbsp;</TD>
																			<TD bgColor=#e0e0e0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Nickname / Description: </FONT></TD>
																			<TD bgColor=#e0e0e0>'.$productName.'</TD>
																		</TR>
																		<TR>
																			<TD bgColor=#e0e0e0>&nbsp;</TD>
																			<TD bgColor=#e0e0e0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Product Group: </FONT></TD>
																			<TD bgColor=#e0e0e0>'.$productgroup.'</TD>
																		</TR>
																		<TR>
																			<TD bgColor=#e0e0e0>&nbsp;</TD>
																			<TD bgColor=#e0e0e0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Category: </FONT></TD>
																			<TD bgColor=#e0e0e0>'.$category.'</TD>
																		</TR>
																		<TR>
																			<TD bgColor=#e0e0e0>&nbsp;</TD>
																			<TD bgColor=#e0e0e0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Type: </FONT></TD>
																			<TD bgColor=#e0e0e0>'.$type.'</TD>
																		</TR>
																		<TR>
																			<TD bgColor=#e0e0e0>&nbsp;</TD>
																			<TD bgColor=#e0e0e0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Manufacturer:</FONT></TD>
																			<TD bgColor=#e0e0e0>'.$manufacture.'</TD>
																		</TR>
																		<TR>
																			<TD bgColor=#e0e0e0>&nbsp;</TD>
																			<TD bgColor=#e0e0e0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Model No: </FONT></TD>
																			<TD bgColor=#e0e0e0>'.$modelno.'</TD>
																		</TR>
																		<TR>
																			<TD bgColor=#e0e0e0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Other: </FONT></TD>
																			<TD bgColor=#e0e0e0>'.$other.'</TD>
																			<TD bgColor=#e0e0e0>&nbsp;</TD>
																		</TR>
																		<TR>
																			<TD bgColor=#e0e0e0>&nbsp;</TD>
																			<TD bgColor=#e0e0e0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Purchase Price:</FONT></TD>
																			<TD bgColor=#e0e0e0>'.$price.'</TD>
																		</TR>
																		<TR>
																			<TD bgColor=#e0e0e0>&nbsp;</TD>
																			<TD bgColor=#e0e0e0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Manufacturer Warranty Period:</FONT></TD>
																			<TD bgColor=#e0e0e0>'.$period.'</TD>
																		</TR>
																		<TR>
																			<TD bgColor=#e0e0e0>&nbsp;</TD>
																			<TD bgColor=#e0e0e0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Purchase Date: </FONT></TD>
																			<TD bgColor=#e0e0e0>'.$purchaseDate.'</TD>
																		</TR>
																		<TR>
																			<TD bgColor=#e0e0e0>&nbsp;</TD>
																			<TD bgColor=#e0e0e0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Customer No:</FONT></TD>
																			<TD bgColor=#e0e0e0>'.$customerId.'</TD>
																		</TR>
																		<TR>
																			<TD bgColor=#e0e0e0>&nbsp;</TD>
																			<TD bgColor=#e0e0e0><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">Coverage Description:</FONT></TD>
																			<TD bgColor=#e0e0e0>'.$desc.'</TD>
																		</TR>
																	</TBODY>
																</TABLE>
															</TD>
														</TR> 
														</TBODY>
													</TABLE>
													<FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">
													<P>Once again, welcome, and for your convenience you may call or email us at: <BR>877-662-8947 <BR>
													<A href="mailto:customerservice@ProductGuardDog.com" target=_blank>customerservice@ProductGuardDog.com</A>.</P>
													<P>Sincerely,</P></FONT><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">
													<P><STRONG>The ProductGuardDog Team </STRONG><STRONG><BR></P> 
													<P>&nbsp;</P>
													</FONT>
												</TD>
												<TD vAlign=top width=21>&nbsp;</TD>
											</TR>
											<TR>
												<TD>&nbsp;</TD>
												<TD vAlign=top><P style = "FONT-FAMILY: Arial, Helvetica, sans-serif; COLOR: #666666; FONT-SIZE: 10px" ; >Unfortunately, this e-mail is an automated notification, which is unable to receive replies. We \'re happy to help you with any questions or concerns you may have. Please contact us directly at 
												<A href="mailto:customerservice@productguarddog.com" target=_blank>customerservice@productguarddog.com</A>.</P>
												<P>&nbsp;</P></TD>
												<TD vAlign=top>&nbsp;</TD>
											</TR>
										</TBODY>
									</TABLE>
								</TD></TR>
							</TBODY>
                         </TABLE>
                        </TD></TR>
                        </TBODY>
                       </TABLE>
                    <!-- add Footer --> 
                    <P>&nbsp;</P>
                  </body>             
             </html>';	       
      $mail->ClearAll(); 
  	  $mail->AddReplyTo("sales@productguarddog.com", "Sales");
	  $mail->SetFrom("sales@productguarddog.com", "Sales");
	  $mail->Subject = "New Product Registered - ProductGuardDog";
	  $mail->AddAddress($email, $name);
   	  $mail->AddBCC("khariwal.rohit@gmail.com");
      $mail->MsgHTML($body);
      $mail->Send();		
	}

	   
/*function refundreq($firstName, $lastName, $email , $date ) {
global $mail;
global $emailDisclaimer;		
$body = '<html>
            <body>
             <TABLE border=0 cellSpacing=0 cellPadding=0 width=600 align=center>
             <TBODY>
              <TR>
                <TD>
                  <TABLE border=0 cellSpacing=1 cellPadding=0 width=600 bgColor=#000000 align=center>
                  <TBODY>
                  <TR>
                    <TD bgColor=#ffffff vAlign=top>
                    <TABLE border=0 cellSpacing=0 cellPadding=0 width=600>
                    <TBODY>
                    <TR>
                      <TD colSpan=3><IMG src="logo.jpg" width=461 height=95 ></TD>
                    </TR>
                    <TR>
                      <TD width=18>&nbsp;</TD>
                      <TD vAlign=top width=561><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">
                        <P>&nbsp;</P>
                        <P align=right><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">
                        <DIV align=left>'.$date.'</DIV></FONT><P></P>
                        <P>ARI Holdings <BR>1002 E Newport Center Drive, Suite 
                        202<BR>Deerfield Beach, FL 33442<BR></P>
                        <P>'.$firstName.' '.$lastName.'<BR>111 Somewhere Avenue<BR>Anycity, AC 010101<BR></P>
                        <P>Reference: Refund Request<BR></P>
                        <P>Dear '.$firstName.' '.$lastName.' ,<BR></P>
                        <P>We are in receipt of your Refund Request Form. It will be processed in the up coming days. A refund request does not guarantee that a refund will be issued. All requests will be reviewed by the Enrollment Department to determine if a refund is due.</P>
                        <P>The processing time for all refund requests is approximately six weeks from the date the written request is received by ARI Holdings. Your circumstances will be carefully reviewed and should your request meet our refund policies, your refund will be processed within six weeks of receipt. You will be notified via email of decision made, thus it is imperative to keep us informed of any changes made to your email address. </P>
                        <P>Refunds will be delivered to the credit card on file. No cash refunds will be issued.<BR></P>
                        <P>Respectfully,</P>
                        <P>&nbsp;</P></FONT><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif"> 
                        <P><STRONG>The Product Guard Dog Team </STRONG><STRONG><BR></P>
                        <P>&nbsp;</P>
                       </FONT>
                      </TD>
                      <TD vAlign=top width=21>&nbsp;</TD>
                   </TR>
                 </TBODY>
                </TABLE>
                </TD></TR>
               </TBODY>
             </TABLE>
            </TD></TR>
          </TBODY>
         </TABLE>
       <!-- add Footer -->
       <P>&nbsp;</P>
     </body>             
   </html>';  
    $mail->ClearAll();
	$mail->AddReplyTo("justin@ProductGuardDog.com", "Presidents Office");
	$mail->SetFrom("justin@ProductGuardDog.com", "Presidents Office");
	$mail->Subject = "Welcome to Product Guard Dog ";
	$mail->AddAddress($email, $firstName." ".$lastName);
	$mail->AddBCC("khariwal.rohit@gmail.com");
    $mail->MsgHTML($body);;
    $mail->Send();		
 }
  
  
	function Cancelmail($name, $email, $id, $canceldate){
		global $emailDisclaimer;
		global $mail;
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 				<head>
					<title>Cancellation | ProductGuardDog</title>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />						
				</head>
	  			<BODY>
					<TABLE border=0 cellSpacing=0 cellPadding=0 width=600 align=center>
					<TBODY>
						<TR>
							<TD>
								<TABLE border=0 cellSpacing=1 cellPadding=0 width=600 bgColor=#000000 align=center>
								<TBODY>
								<TR>
									<TD bgColor=#ffffff vAlign=top>
										<TABLE border=0 cellSpacing=0 cellPadding=0 width=600>  
										<TBODY>
											<TR>
												<TD colSpan=3><IMG src="logo.jpg" width=461 height=95></TD>
											</TR>
											<TR>
												<TD width=18>&nbsp;</TD>
												<TD vAlign=top width=561>
												<FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">
												<P>&nbsp;</P>
												<P>Dear '.$name.',<BR></P>
												<P>We would like to take this opportunity to thank you for doing business ProductGuardDog.</P>
												</FONT>
												<TABLE border=0 cellSpacing=1 cellPadding=4 width=550 bgColor=#c0c0c0 align=center height=56>
												<TBODY>
												<TR>
													<TD bgColor=#e0e0e0>
														<P align=center><STRONG><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">This email serves as a confirmation. <BR>Your Membership No: '.$id.' has been cancelled as of '.$canceldate .'</FONT></STRONG></P></TD></TR></TBODY></TABLE>
														<FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">
														<P>As per our Customer Agreement, you will be refunded for the remainder of the month, unless you have an opened claim. All coverage under your Plan terminates immediately on the date of your cancellation. </P>
														<P>PLEASE NOTE - Your agreement CAN NOT be reinstated. <BR>For your convenience, you may call us at: 877-662-8947. As always, we appreciate your business</P>
														<P>&nbsp;</P>
														<P>Sincerely,</P></FONT><FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif"><P>&nbsp;</P>
														</FONT>
														<FONT color=#000000 size=-1 face="Arial, Helvetica, sans-serif">
														<P><STRONG>The Product Guard Dog Team </STRONG><STRONG><BR></P>
														<P>&nbsp;</P>
														</FONT>
													</TD>
													<TD vAlign=top width=21>&nbsp;</TD>
												</TR>
											</TBODY>
										</TABLE>
									</TD>
								</TR>
                              </TBODY>
                            </TABLE>
                         </TD></TR>   
                        </TBODY>
                     </TABLE>
                  <!-- add Footer   --> 
                   <P>&nbsp;</P>                       
                 </body>             
             </html>';		               
          	$mail->ClearAll();
			$mail->AddReplyTo("justin@productguarddog.com", "Presidents Office");
			$mail->SetFrom("justin@productguarddog.com", "Presidents Office");
			$mail->Subject = "Welcome to Product Guard Dog ";
			$mail->AddAddress($email, $name);
			$mail->AddBCC("khariwal.rohit@gmail.com");
            $mail->MsgHTML($body);
			$mail->Send();		
	} */
	
	function sendPasswordLink($name, $url, $email){
		global $emailDisclaimer;
		global $mail;
		$body = '<html><body>
                        <p>Dear '.$name.',</p>
                        <p>Please <a href="'.$url.'">Click here</a> to change your password. Thank you for using ProductGuardDog</p>
                        <br />
                        <p>Sincerely,<br />
                        The ProductGuardDog Team</p>
						<br/>
						<br/>'.$emailDisclaimer.'
                       </body>
				</html>';	
		$mail->ClearAll();
		$mail->AddReplyTo("password@productguarddog.com", "Security Department");
		$mail->SetFrom("password@productguarddog.com", "Security Department");
		$mail->Subject = "ProductGuardDog - Password Reminder";
		$mail->AddAddress($email, $name);
		$mail->MsgHTML($body);
		$mail->Send();				
	}	
?>