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
class NetChg{
                        

                        function getNetChg($urlString, $no ) {
                        
                                     $FCPO = array();
                                    
                                     $curl = curl_init();
                                     
                                     curl_setopt($curl, CURLOPT_URL, $urlString);
                              
                                     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                     
                                     $result=curl_exec ($curl);
                              
                                     $error = curl_error($curl);
                              
                                     $errorno = curl_errno($curl);
                              
                                     curl_close ($curl);  
                                    
                                  
                  
                                    if(preg_match("/<table\swidth='650'\sborder='0'\scellpadding='3'\scellspacing='0'\sclass='tableright'> ?.* <\/table>/isx",$result,$matches)) {
                                     
                                     
                                 
                                     if($data = preg_split("/<tr ?.*/",$matches[0])){
                                    
                                         
                                           $from = 2;
                                           $to = $no + 2 ;
                                           
                                           for($i = $from; $i<$to; $i++){
                                                 
                                                

                                                 preg_match_all("/(<div .*>)(.*)(<\/div>)/",$data[$i], $record);
                                                 
                                                  
                                                 $CHG[$i-2] = array('CHANGE'=>$record[2][1]);
                                                 
                                                
                                                
                                                  
                                     } 
                                       
                                    }
                                     
                                     
                                     
                                      }
                                               
                                              
                                   return $CHG;         
                                    }
                                    }
                                      
                         
                                                       
            

 $Obj = new NetChg();
 echo '<pre>';
 // For open auction 
//print_r($Obj->getNetChg('http://www.cbot.com/cbot/pub/page/0,3181,1272,00.html', 4));
// For Electronics
print_r($Obj->getNetChg('http://www.cbot.com/cbot/pub/page/0,3181,1325,00.html', 4));




