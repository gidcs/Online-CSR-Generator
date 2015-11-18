<?php
include "config.php";
require_once "Mail.php";

if(!($debug_mode)){
	header('Content-Type: application/json');
}

$dn = array(
    "countryName" => "",
    "stateOrProvinceName" => "",
    "localityName" => "",
    "organizationName" => "",
    "organizationalUnitName" => "",
    "commonName" => "",
    "emailAddress" => ""
);

$status = 0;
// 0 -> failed to generate
// 1 -> failed to mail
// 2 -> success

if(isset($_GET["countryName"]))
	$dn["countryName"]=$_GET["countryName"];
if(isset($_GET["stateOrProvinceName"]))
	$dn["stateOrProvinceName"]=$_GET["stateOrProvinceName"];
if(isset($_GET["localityName"]))
	$dn["localityName"]=$_GET["localityName"];
if(isset($_GET["organizationName"]))
	$dn["organizationName"]=$_GET["organizationName"];
if(isset($_GET["organizationalUnitName"]))
	$dn["organizationalUnitName"]=$_GET["organizationalUnitName"];
if(isset($_GET["commonName"]))
	$dn["commonName"]=$_GET["commonName"];
if(isset($_GET["emailAddress"]))
	$dn["emailAddress"]=$_GET["emailAddress"];


//if empty string is not in array
//then valid to generate csr
if(!in_array("", $dn)){

	// Generate a new private key
	$privkey = openssl_pkey_new($openssl_config);
	// Show any errors that occurred here
	if($debug_mode){
		if(!($privkey)){
			while (($e = openssl_error_string()) !== false) {
		 		$e . "\n";
			}
			exit(-1);
		}
	}
	// Get private key value
	openssl_pkey_export($privkey, $privkey_out);
	
	// Generate a certificate signing request
	$csr = openssl_csr_new($dn, $privkey, $openssl_config);
	// Show any errors that occurred here
	if($debug_mode){
		if(!($csr)){
			while (($e = openssl_error_string()) !== false) {
		 		$e . "\n";
			}
			exit(-1);
		}
	}
	// Get csr value
	openssl_csr_export($csr, $csr_out);
	
	// Preparing Mail
	$order   = array("\r\n", "\n", "\r");
	$replace = '<br />';
	
	$from = $mail_username; //change this to your email address
	$to = $dn["emailAddress"];
	$subject = "CSR and SSL Private Key for ".$dn["commonName"] ;
	$body = "Dear Customer,<br>";
	$body .= "Thank you for choosing us to generate your CSR and SSL Private Key.<br>";
	$body .= "Please keep this in a safe place!<br>";
	$body .= "We provide most cheapest SSL Certificates and we can beat any competitor price for you.<br><br>";
	$body .= "SSL Private Key:<br>";
	$body .= str_replace($order, $replace, $privkey_out);
	$body .= "<br>CSR:<br>";
	$body .= str_replace($order, $replace, $csr_out);
	$body .= "<br>Have a nice day and Best Regards,<br>";
	$body .= "LKS<br>";
	$body .= "<a href=\"http://www.gidcs.net/\">GIDCS.Net</a>";

	// Preparing header fields
	$headers = array(
		'From' => $from,
		'To' => $to,
		'Subject' => $subject,
		'MIME-Version' => '1.0',
        	'Content-Type' => "text/html; charset=utf-8"
	);

	// Decide sending mode
	if(!($smtp_enable)){
		$mail_object = Mail::factory('mail');
	}
	else{			
		$mail_object = Mail::factory('smtp', array(
		        'host' => $mail_server,
		        'port' => $mail_port,
		        'auth' => true,
		        'username' => $mail_username, //your gmail account
		        'password' => $mail_password // your password
		));
	}	
	
	// Send the mail
	$mail = $mail_object->send($to, $headers, $body);
	if (PEAR::isError($mail)) {
		$status = 1;
		if($debug_mode){
	  		echo "<p>".$mail->getMessage()."</p>";
	  	}
	}
	else {
		$status = 2;
		if($debug_mode){
			echo "Message successfully sent!<br>";
		}
	}
	
	//Debug information
	if($debug_mode){
		if(!($smtp_enable)){
			echo "Mail mode!!!!!<br>";
		}
		else{
			echo "SMTP mode!!!!!<br>";
		}
		echo "Mail to: ".$to."<br>";
		echo "Subject: ".$subject."<br>";
		echo "Message: ".$body."<br>";
		echo "Headers: ".var_dump($headers)."<br>";
		echo "Status: ".$status."<br>";
	}
	
	$arr = array('status' => $status, 'private_key' => $privkey_out, 'csr' => $csr_out);
}
else{
	$arr = array('status' => $status, 'private_key' => '', 'csr' => '');
}
	// Output Json 
	echo json_encode($arr);
?>