<?php

$name   = $_POST["name"];
$phone  = $_POST["phone"];
$email  = $_POST["email"];
$subject= $_POST["subject"];
$message= $_POST["message"];

$chkphone 	= strlen($phone);
$chkhttp 	= strpos($message,"http");


if($chkphone >= 10  && $chkhttp == "" ){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$sToken = "dVMs1wMCDBQcQbZRdbhY1t11eJWsPwqOVT2igtSNobU";
	$sMessage = "ลูกค้าติดต่อ💰\n".$name."\n".$phone."\n".$email."\n::".$subject."\n$message".$message;

	
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 

	//Result error 
	if(curl_error($chOne)) 
	{ 
		echo 'error:' . curl_error($chOne); 
	} 
	else { 
		$result_ = json_decode($result, true); 
		//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
	} 
  curl_close( $chOne );
}   
?>

