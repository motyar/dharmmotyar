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
class FCPO{
                        

                        function getFCPO($urlString, $no ) {
                        
                                     $FCPO = array();
                                    
                                     $curl = curl_init();
                                     
                                     curl_setopt($curl, CURLOPT_URL, $urlString);
                              
                                     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                     
                                     $result=curl_exec ($curl);
                              
                                     $error = curl_error($curl);
                              
                                     $errorno = curl_errno($curl);
                              
                                     curl_close ($curl);  
                                    
                                      
                  
                                    if(preg_match("/<table\sborder=0\swidth=100%\scellspacing=0\scellpadding=2> ?.* <\/table>/isx",$result,$matches)) {
                                     
                                     
                                     if($data = preg_split("/<tr ?.*/",$matches[0])){
                                    
                                     
                                           $from = 2;
                                           $to = $no + 2 ;
                                           
                                           for($i = $from; $i<$to; $i++){
                                                 preg_match_all("/(<span .*>)(.*)(<\/span>)/",$data[$i], $record);
                                                 
                                                 $FCPO[$i-2] = array('LAST'=>$record[0][7],'CHANGE'=>$record[0][9]);
                                                
                                                // echo $record[0][7]."///".$record[0][9];echo '<hr>';
                                                  //return $FCPO; 
                                     } 
                                       
                                    }
                                     
                                     
                                     
                                      }
                                               
                                              
                                     return $FCPO;           
                                    }
                                    }
                                      
                         
                                                       
            

 $Obj = new FCPO();
 echo '<pre>';
print_r($Obj->getFCPO('http://bpd.bursastation.com/prices.pl?derivatives=1&code=FCPO', 2));




