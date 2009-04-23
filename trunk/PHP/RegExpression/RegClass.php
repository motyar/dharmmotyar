<?php
/*
* By Dharmveer MOtyar
* dvmotyar@yahoo.co.in
* 16 April 2009
* This class uses regular expersion
* and string function to parse desired 
* result string from the result from curl
*/
set_time_limit(0);
class getKLCI{
                        

                        function KLCI($urlString ) {
                                    
                                     $curl = curl_init();
                                     
                                     curl_setopt($curl, CURLOPT_URL, $urlString);
                              
                                     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                     
                                     $result=curl_exec ($curl);
                              
                                     $error = curl_error($curl);
                              
                                     $errorno = curl_errno($curl);
                              
                                     curl_close ($curl);  
                                      
                                 
                                     if(preg_match("/<b>KLCI:.*<[^a-z]b><br>/",$result,$matches)){
                                                
                                                
                                                $Found = substr($matches[0],strpos($matches[0],':'));
                                                
                                                  
                                                  //$Found = ': Changasase (KIJHHHasas)';
                                                  //echo $Found;
                                                  
                                                $KLCI = substr($Found, strpos($Found,':')+1, strpos($Found,'(')-1);
                                              
                                                $chageLenght =  strpos($Found,')')- strpos($Found,'(') - 1;
                                               
                                                $change =  substr($Found, strpos($Found,'(')+1,$chageLenght);
                                                
                                                $KLCI = array('klci'=>$KLCI,
                                                             'change'=>$change);
                                                             
                                                return $KLCI ;
                                                
                                                
                                    }
                                      
                        }
                                                       
            }

 $Obj = new getKLCI();
print_r($Obj->KLCI('http://bph.bursastation.com/homepage_right_frame.pl'));



?>
