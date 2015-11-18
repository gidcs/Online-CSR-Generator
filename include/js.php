<script>

function ModalActive(title, body) {
	$("#myModal .modal-title").html(title);
	$("#myModal .modal-body").html(body);
	$("#myModal").modal();
}

function UrlProcessing(url){
	var commonName = url;
	if(commonName.substring(0,7)=="http://"){
		commonName = commonName.substring(7);
	}
	if(commonName.substring(0,8)=="https://"){
		commonName = commonName.substring(8);
	}
	if(commonName.substring(0,4)=="www."){
		commonName = commonName.substring(4);
	}
	return commonName;
}

$('button#Submit').on('click',function(){
	$(this).attr('disabled', 'disabled');
	var commonName = $('input#commonName').val();
	var organizationName = $('input#organizationName').val();
	var organizationalUnitName = $('input#organizationalUnitName').val();
	var localityName = $('input#localityName').val();
	var stateOrProvinceName = $('input#stateOrProvinceName').val();
	var emailAddress = $('input#emailAddress').val();
	var countryName = $('select#countryName').val();

	// check if all exist
	if(!commonName || !organizationName || !organizationalUnitName || !localityName || !stateOrProvinceName || !emailAddress || !countryName ){
		var header_string = "Big Failure";
		var body_string = "<p>Invalid Input!</p>";
		ModalActive(header_string,body_string);
	}
	else{
		// take away protocol and www
		commonName = UrlProcessing(commonName);

		// call api to do thing
		$.get('api.php',{
			commonName: commonName, 
			organizationName: organizationName,
			organizationalUnitName: organizationalUnitName,
			localityName: localityName,
			stateOrProvinceName: stateOrProvinceName,
			emailAddress: emailAddress,
			countryName: countryName
		}, function(data){
			// check if blank
			if(!data){
				var temp_string = "Api Failed!";
				ModalActive(temp_string,temp_string);
			}
			else{
				// check status 
				if(data.status==0){
					var header_string = "Big Failure";
					var body_string = "<p>Invalid Input!</p>";
					ModalActive(header_string,body_string);
				}
				else if(data.status>=1){
					var header_string = "Good Job";
					var body_string;
					var private_key_string, csr_string;
					if(data.status==2){
						body_string = "<p>Generated CSR & Private Key have emailed to you.<br/> \
								Please check your mailbox.</p> \
								<p>Private Key: <br />";
					}
					else{
						body_string = "<p>CSR & Private Key is generated.<br/> \
								But, it failed when sending email to you.</p> \
								Please copy it by yourself.</p> \
								<p>Private Key: <br />";
					}
					private_key_string = data.private_key.replace(/\n/g, "<br />");
					csr_string = data.csr.replace(/\n/g, "<br />");
					body_string += private_key_string + "</p>";
					body_string += "<p>CSR: <br />";
					body_string += csr_string + "</p>";
					ModalActive(header_string,body_string);
				}
			}
		});
	}
	$(this).removeAttr("disabled");
});
</script>