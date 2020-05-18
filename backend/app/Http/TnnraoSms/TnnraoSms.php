<?php
namespace App\Http\TnnraoSms;
class TnnraoSms {

     private  $authkey =  'yIr6ZZC8adPKWtAIitkU';     
     public function  __construct(){

     }
  public function sendSms($message,$mobilenumbers){
	  //$mobilenumbers --commasupprated
	  $messagemob = urlencode($message);
	  $url = "http://tnnraocreations.com/otphttp.php?authkey=".$this->authkey."&mobiles=".$mobilenumbers."&message=".$messagemob."&sender=imgftg&route=4&country=91";
	 //Initialize cURL.
	  $ch = curl_init();
	 //Set the URL that you want to GET by using the CURLOPT_URL option.
	  curl_setopt($ch, CURLOPT_URL, $url);
	 //Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 //Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	 //Execute the request.
	  $data = curl_exec($ch);
	 //Close the cURL handle.
	  curl_close($ch); 
	  return $data; 
  }
}

?>
