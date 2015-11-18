<?php

	$title = 'Online CSR Generator';
	$subtitle = 'Powered by GIDCS.Net';
	$mail_username = 'your_email@gmail.com';
	$mail_password = 'your_password';
	$mail_server = 'ssl://smtp.gmail.com';
	$mail_port = '465';
	$smtp_enable = 1; //please use smtp mode if you can
	$debug_mode = 0;
	$bootstrap_cdn = '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap';
	$jquery_cdn = '//cdnjs.cloudflare.com/ajax/libs/jquery';
	//$bootstrap_cdn = '//maxcdn.bootstrapcdn.com/bootstrap';
	//$jquery_cdn = '//ajax.googleapis.com/ajax/libs/jquery';
	
	//openssl config
	$openssl_config = array(
		"digest_alg" => "sha256",
		"private_key_bits" => 2048,
		'private_key_type' => OPENSSL_KEYTYPE_RSA
	);

?>
