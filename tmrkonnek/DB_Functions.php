<?php

class DB_Functions
{
    
    private $db;
    
    function __construct()
    {
        require_once "DB_Connect.php";
        
        $this->db = new DB_Connect();
        $this->db->connect();
        mysql_set_charset('utf8');
    }
    
    function __destruct()
    {
    }
	
	public function storeImageId($mobileNumber,$qbUserId,$imageId)	{
		 
		  if (!empty($mobileNumber) && !empty($qbUserId) && !empty($imageId)) {
			  
			$query = "SELECT * FROM new_users WHERE mobile_number ='$mobileNumber'";
            $result = mysql_query($query) or die(mysql_error());
            $number_of_row = mysql_num_rows($result);
			if($number_of_row>0){
				 $query = "UPDATE new_users SET qb_userid='$qbUserId',imageid='$imageId' WHERE mobile_number='$mobileNumber'";
                mysql_query($query);
				 $response = array(
                'Tag' => 'success',
                'responseCode' => '0',
                'Message' => 'Image id updated successfully');
            return $response;
			}
			else{
				 $response = array(
                'Tag' => 'success',
                'responseCode' => '0',
                'Message' => 'Invalid mobile number');
            return $response;
				
			}
				  
		  }
		  else{
			  
			  $response = array(
                'Tag' => 'success',
                'responseCode' => '1',
                'Message' => ' INVALID PARAMETER'
            );
            return $response;
			  
		  }
		
	}
	
	public function downloadImageId($qbUserId)	{
		 
		  if (!empty($qbUserId)) {
			  
			$query = "SELECT imageid FROM new_users WHERE qb_userid ='$qbUserId'";
            $result = mysql_query($query) or die(mysql_error());
            $number_of_row = mysql_num_rows($result);
			if($number_of_row>0){
				 $result = mysql_fetch_array($result);
                 $imageId   = $result['imageid'];
				
				 $response = array(
                'Tag' => 'success',
                'responseCode' => '0',
				'imageId' => $imageId,
                'Message' => 'IMAGE ID RECEIVED');
            return $response;
			}
			else{
				 $response = array(
                'Tag' => 'success',
                'responseCode' => '0',
				'imageId' => null,
                'Message' => 'INVALID QBUSER');
            return $response;
				
			}
				  
		  }
		  else{
			  
			  $response = array(
                'Tag' => 'success',
                'responseCode' => '1',
				'ImageId' => null,
                'Message' => 'PARAMETER EMPTY'
            );
            return $response;
			  
		  }
		
	}
    
    public function login($name, $mobileNumber, $country)
    {
		
       
        $api_key = $this->generateApiKey();
        $userid  = uniqid('', true);
		
		
        
        if (!empty($name) && !empty($mobileNumber) && !empty($country)) {
			
            
            $query      = "SELECT mobile_number FROM  new_users WHERE mobile_number='$mobileNumber'";
			
            $result     = mysql_query($query);
            $no_of_rows = mysql_num_rows($result);
            
            if ($no_of_rows > 0) {
                $query = "UPDATE new_users SET first_name='$name',mobile_number='$mobileNumber',Country='$country',updated_at=NOW() WHERE mobile_number='$mobileNumber'";
                mysql_query($query);
                
                $query  = "SELECT first_name,mobile_number,country,userid,updated_at FROM new_users WHERE mobile_number='$mobileNumber'";
                $result = mysql_query($query);
                
                $no_of_rows = mysql_num_rows($result);
                if ($no_of_rows > 0) {
                    $result        = mysql_fetch_array($result);
                    $name    = $result['first_name'];
                    $mobileNumber = $result['mobile_number'];
                    $country       = $result['country'];
                    $userId        = $result['userid'];
                    $updatedAt    = $result['updated_at'];
                    $response      = array(
                        'Tag' => 'success',
                        'responseCode' => '0',
                        'Message' => ' UPDATE SUCCESS',
                        'name' => $name,
                        'mobileNumber' => $mobileNumber,
                        'country' => $country,
                        'userId' => $userId,
                        'updatedAt' => $updatedAt
                    );
					$otp = rand(1000, 9999);
                    $this->sendSms($mobileNumber,$otp);
                    return $response;
                    
                } else {
                    $response = array(
                        'Tag' => 'success',
                        'responseCode' => '1',
                        'Message' => ' UPDATE FAILURE',
                        'name' => null,
                        'mobileNumber' => null,
                        'country' => null,
                        'userId' => null,
                        'updatedAt' => null
                    );
                    return $response;
                    
                }
                
                $response = array(
                    'Tag' => 'success',
                    'responseCode' => '1',
                    'Message' => ' Invalid MOBILE_NUMBER'
                );
                return $response;
            } else {
				
                $query  = "insert into new_users(userid,first_name,mobile_number,country,apikey,status,created_at) values('$userid','$name','$mobileNumber','$country','$api_key','0',NOW())";
                $result = mysql_query($query);
				$query  = "SELECT first_name,mobile_number,country,userid,created_at FROM new_users WHERE mobile_number='$mobileNumber'";
                $result = mysql_query($query);
				
                $no_of_rows = mysql_num_rows($result);
                if ($no_of_rows > 0) {
                    $result        = mysql_fetch_array($result);
                    $name    = $result['first_name'];
                    $mobileNumber = $result['mobile_number'];
                    $country       = $result['country'];
                    $userId        = $result['userid'];
                    $createdAt    = $result['created_at'];
                    $response      = array(
                        'Tag' => 'success',
                        'responseCode' => '0',
                        'Message' => ' INSERT SUCCESS',
                        'name' => $name,
                        'mobileNumber' => $mobileNumber,
                        'country' => $country,
                        'userId' => $userid,
                        'createdAt' => $createdAt
                    );
					$otp = rand(10000, 9999);
                    $this->sendSms($mobileNumber,$otp);
					
                    return $response;
                    
                } else {
                    $response = array(
                        'Tag' => 'success',
                        'responseCode' => '11',
                        'Message' => ' INSERT FAILURE',
                        'name' => null,
                        'mobileNumber' => null,
                        'country' => null,
                        'userId' => null,
                        'createdAt' => null
                    );
                    return $response;
                    
                }
                
            }
        } else {
            $response = array(
                'Tag' => 'success',
                'responseCode' => '1',
                'Message' => ' Invalid Parameters'
            );
            return $response;
            
        }
        
    }
    
    public function profile($name,$mobileNumber, $email,$dateOfBirth, $gender, $city, $country, $zipcode)
    {
        
        
        if (!empty($name) && !empty($mobileNumber) && !empty($email) && !empty($dateOfBirth) && !empty($gender) && !empty($city) && !empty($country) && !empty($zipcode)) {
            
            $query = "SELECT * FROM new_users WHERE mobile_number ='$mobileNumber'";
            
            $result = mysql_query($query) or die(mysql_error());
            $number_of_row = mysql_num_rows($result);
            if ($number_of_row > 0) {
                
                $query = " UPDATE new_users SET first_name='$name',mobile_number='$mobileNumber',
					  email='$email', date_of_birth='$dateOfBirth', gendar='$gender', city='$city',country='$country', zipcode='$zipcode',updated_at=NOW() WHERE mobile_number ='$mobileNumber'";
                mysql_query($query);
				$query  = "SELECT userid,first_name,mobile_number,email,date_of_birth,gendar,city,country,zipcode,created_at,updated_at FROM new_users WHERE mobile_number='$mobileNumber'";
                $result = mysql_query($query);
				$no_of_rows = mysql_num_rows($result);
				
				if($no_of_rows>0)
				{
					$result        = mysql_fetch_array($result);
					$userId        = $result['userid'];
                    $name    = $result['first_name'];
                    
                    $mobileNumber       = $result['mobile_number'];
                    $email        = $result['email'];
                    $dateOfBirth    = $result['date_of_birth'];
					$gender    = $result['gendar'];
					$city    = $result['city'];
					$zipcode    = $result['zipcode'];
					$country    = $result['country'];
					$createdAt    = $result['created_at'];
					$updatedAt    = $result['updated_at'];
					$response = array(
                    'Tag' => 'success',
                    'responseCode' => '0',
                    'Message' => 'USER PROFILE UPDATED SUCCESSFULLY',
                    'userId' => $userId,
					'name' => $name,
                    
                    'mobileNumber' => $mobileNumber,
                    'email' => $email,
                    'dateOfBirth' => $dateOfBirth,
                    'gender' => $gender,
                    'city' => $city,
                    'zipcode' => $zipcode,
					'country' => $country,
					'createdAt' =>$createdAt,
                    'updatedAt' =>$updatedAt 
                );
                return $response;
					
				}
				else
				{
					$response = array(
                    'Tag' => 'success',
                    'responseCode' => '1',
                    'Message' => 'PROFILE UPDATED FAILURE',
					'userId'   => null,
                    'name' => null,
                    'mobileNumber' => null,
                    'email' => null,
                    'dateOfBirth' => null,
                    'gender' => null,
                    'city' => null,
                    'zipcode' => null,
					'country' => null,
                    'createdAt' =>null,
                    'updatedAt' =>null					
                );
					
				}
                
                
            } else 
			{
                
                $response = array(
                    'Tag' => 'success',
                    'responseCode' => '1',
                    'Message' => ' Invalid Mobile Number'
                );
                
                return $response;
            }
            
        } else {
            $response = array(
                'Tag' => 'success',
                'responseCode' => '1',
                'Message' => ' INVALID PARAMETER'
            );
            return $response;
            
        }
        
    }
	
	
	
	public function sendSms($mobile, $otp) {
		
    $otp_prefix = ':';

    //Your message to send, Add URL encoding here.
   
	$message = urlencode("Hello! Welcome to Konnek2. Your OTP is '$otp_prefix $otp'");

    $response_type = 'json';

    //Define route 
    $route = "4";
    
    //Prepare you post parameters
    $postData = array(
        'authkey' => '164437A3TndzhHm596112d7',
        'mobiles' => $mobile,
        'message' => $message,
        'sender' => 'KONNEK',
	    'route' => $route,
        'response' => $response_type
    );

//API URL
    $url = "https://control.msg91.com/sendhttp.php";

// init the resource
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
    ));


    //Ignore SSL certificate verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


    //get response
    $output = curl_exec($ch);

    //Print error if any
    if (curl_errno($ch)) {
        echo 'error:' . curl_error($ch);
    }

    curl_close($ch);
	$response = array(
                    'Tag' => 'success',
                    'responseCode' => '0',
                    'Message' => ' OTP Success'
                );
				return $response;
}
	
    private function generateApiKey()
    {
        return md5(uniqid(rand(), true));
    }
	
	public function verifyOTP($mobileNumber,$otp)
 {
 
    $url='https://control.msg91.com/api/verifyRequestOTP.php?';
    
     $authkey ='151118Afr0mG4PO5592a9514';
     $data = array(  
     "authkey" => $authkey,
      "mobile" => $mobileNumber,
      "otp" => $otp,
      );
    
  
    $ch = curl_init();
    curl_setopt_array($ch, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $data
                 //,CURLOPT_FOLLOWLOCATION => true
      ));
   //Ignore SSL certificate verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    //get response
    $output = curl_exec($ch);
 $response = json_decode($output, true);
 
       if ($response["type"] == "success") {
         
         $otpResponse = array(
                    'Tag' => 'success',
                    'responseCode' => '0',
                    'Message' => 'OTP Verified'
                );
         
       } else {
          $otpResponse = array(
                    'Tag' => 'Failure',
                    'responseCode' => '1',
                    'Message' => ' Invalid valid OTP'
                );
       }
  
   //Print error if any 
    if(curl_errno($ch)){ 
     echo 'error: ' . curl_error($ch);
     return curl_error($ch);
   }
  
   curl_close($ch);
   
   return $otpResponse;
 }
}


?>