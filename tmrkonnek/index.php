<?php

if (isset($_GET['tag']) && $_GET['tag'] != '') {
    $tag = $_GET['tag'];
    
    require_once 'DB_Functions.php';
    $db = new DB_Functions();
    
    if ($tag == 'login') {
        
        $name          = $_GET['name'];
		$mobileNumber = $_GET['mobileNumber'];
		$country       = $_GET['country'];
        
        $response      = $db->login($name, $mobileNumber, $country);
        print(json_encode($response));
    }
	
	
	else if ($tag == 'profileupdate') {
        
        $name          = $_GET['name'];
		$mobileNumber       = $_GET['mobileNumber'];
		$email               = $_GET['email'];
		$dateOfBirth       = $_GET['dateOfBirth'];
		$gender              = $_GET['gender'];
		$city              = $_GET['city'];
		$country              = $_GET['country'];
		$zipcode             = $_GET['zipcode'];
        
        $response            = $db->profile($name,$mobileNumber, $email,$dateOfBirth, $gender, $city, $country, $zipcode);
        print(json_encode($response));
    }
	else if ($tag == 'verifyOTP') {
        
        
		$mobileNumber = $_GET['mobileNumber'];
		$otp = $_GET['otp'];
		
		$response      = $db->verifyOTP($mobileNumber,$otp);
        print(json_encode($response));
    }
	else if ($tag == 'reSendOtp') {
        
        
		$mobileNumber = $_GET['mobileNumber'];
		$otp = rand(10000, 9999);
		$response      = $db->sendSms($mobileNumber,$otp);
        print(json_encode($response));
    }
	
	
	else if ($tag == 'UploadImageId') {
        
        
		$mobileNumber = $_GET['mobileNumber'];
		$qbUserId = $_GET['qbUserId'];
		$imageId = $_GET['imageId'];
		
		$response      = $db->storeImageId($mobileNumber,$qbUserId,$imageId);
        print(json_encode($response));
    }
	
	else if ($tag == 'downloadImageId') {
       
		$qbUserId = $_GET['qbUserId'];
		$response      = $db->downloadImageId($qbUserId);
        print(json_encode($response));
    }
	
	else
	{
	echo " Access Denied";	
	}
    } 
	else {
    echo "Access Denied  not set";
}
?>