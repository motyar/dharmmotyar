<?php
set_time_limit(0);

/*************************************************************************************************************************************
Author - Dharmveer Motyar
web - dharmmotyar.000space.com
chat - dharmmotyar@gmail.com
mail me - dharmmotyar@gmail.com
this is a class to send sms to send sms in india..
step1.- register urself on http://www.indyarocks.com
step2.- register ur mobile to send free sms.
step3.- use this class.
*************************************************************************************************************************************/

class SMS {

	private $user="";

	private $pass="";

	private $toMobile="";

	private $msg="";


      private $postUrlLogin="http://www.indyarocks.com/loginchk.php";
	
      private $postUrlSendmsg="http://www.indyarocks.com/mvas/send_msgs.php";

	private $refererLogin="http://www.indyarocks.com/profile/profile_main.php";

	private $refererSendMsg="http://www.indyarocks.com/profile/profile_main.php";

	private $cookiefile="";

	private $userAgent="mozilla";

	

	

	/**

	 * Constructor: Creates cookie file and user agent string.

	 *

	 * @param string $cookiePath (Optional) path of the cookie file where login info is stored from indyarockes

	 * @param string $userAgent (Optional) User agent string. defaults to mozilla.

	 *

	 */

	 

	public function __construct($cookiePath="", $userAgent="") {

		if(!empty($cookiePath))

			$this->cookiefile = $cookiePath;

		else

			$this->cookiefile ="cookies.txt";

		

		if (!file_exists($this->cookiefile)) {

			$fp = fopen($this->cookiefile,"w+");

			fwrite($fp,"");

			fclose($fp);

		}

		switch ($userAgent) {

			case 'mozilla':

				$this->userAgent='Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3';break;

			case 'ie':

				$this->userAgent='Mozilla/5.0 (Windows; U; MSIE 7.0; Windows NT 6.0; en-US)';break;

			case '':

				$this->userAgent='Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3';break;

			default:

				$this->userAgent=$userAgent;

		}

	}

	

	/**

	 * login : Logs in to indyarocks using provided username and password

	 *

	 * @param string $user (must) indyarocks username

	 * @param string $pass (must) indyarocks password

	 *

	 */

	 

	public function login($user, $pass) {

		$this->user = $user;

		$this->pass = $pass;
		
            $postFields = 'username='.$this->user.'&pass='.$this->pass.'&online=y&x=5&y=12&invitor=&emailencryp=';



		$output = $this->postFields($postFields, $this->postUrlLogin, $this->refererLogin);

		return $output;

	}

	

	/**

	 * sendSMS : This method sends SMS

	 *

	 * @param string $toMobile (must) The mobile number u want to send sms to.

	 * @param string $msg (must) Message to be sent through SMS

	 *

	 */

	 

	public function sendSMS($urname, $toMobile, $msgs) {

		$this->toMobile=$toMobile;

		$this->msg = urlencode(substr($msgs,0,140));  # Message should not exceed more than 118 characters

            $hiddencode = $this->getHiddenCode();
            
	      $postFields ='name='.$urname.'&frno='.$this->toMobile.'&message3='.$this->msg.'&send=3&msg='.$this->msg.'&type=3&phoneverify=1&hidden_code='.$hiddencode;
		 

		$output = $this->postFields($postFields, $this->postUrlSendmsg, $this->refererSendMsg);

		return $output;
                                                                
	}
	
	
	function getHiddenCode(){
	
	$response = $this->postFields('', 'http://www.indyarocks.com/mvas/sms.php', '');
      preg_match('/<input type="hidden" name="hidden_code" id="hidden_code" value="(.*)" \/>/', $response, $result );
      return $result[1];
	                                                                                
   }
	

	/**

	 * postFields : This method posts the $postFields to $url and uses $referer

	 * This method uses curl function to post the required fields to the url

	 *

	 * @param string $postFields (must) Fields to be posted to mycantos

	 * @param string $url (must) URL to send the foelds to,

	 * @param string $referer (must) set the referer  url

	 *

	 */

	 

	public function postFields($postFields, $url, $referer) {

		$ch = curl_init();    # Initialize a CURL session.

		curl_setopt($ch, CURLOPT_URL, $url);  # The URL to fetch.
	

		curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent); # Set the userAgent here

		curl_setopt($ch, CURLOPT_POST, 1); # Do a regular HTTP POST. The data should be url encoded

		curl_setopt($ch, CURLOPT_POSTFIELDS,$postFields); # Fields to be poted to the above set url

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  # set this to return the transfer as a  string

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); # set this to follow any Location: header 

		curl_setopt($ch, CURLOPT_REFERER, $referer); # Set the referer url here

		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiefile); # The name of the file  containing the cookie data. 

		curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookiefile); # The name of a file to save  all internal cookies to when the connection closes.

		$output = curl_exec($ch);  # store the contents of the fetched url
            echo curl_error($ch);
		curl_close($ch);  # close curl resource, 
		
	

		return $output; # Return the output

	}

}

?> 
