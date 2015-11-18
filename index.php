<?php
	include 'config.php';
	include 'include/country_code.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?> <?php echo $subtitle; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?php echo $bootstrap_cdn; ?>/3.3.5/css/bootstrap.min.css">
	<script src="<?php echo $jquery_cdn; ?>/1.11.3/jquery.min.js"></script>
	<script src="<?php echo $bootstrap_cdn; ?>/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="include/custom.css">
</head>

<body>
	<div class="container">
		<div class="page-header text-center">
			<h1><?php echo $title ?></h1>
		</div><!-- /page-header -->
	</div><!-- /container -->
	
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3" role="main">
				<div class="form-horizontal" role="form">
				<div class="form-group">
					<label class="control-label col-sm-5 col-xs-5" for="commonName">Common Name:*</label>
					<div class="col-sm-7 col-xs-7">
						<input type="text" class="form-control" id="commonName" placeholder="gidcs.net ( must be your domain name! )" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-5 col-xs-5" for="organizationName">Organization (in English):*</label>
					<div class="col-sm-7 col-xs-7">          
						<input type="text" class="form-control" id="organizationName" placeholder="GIDCS.Net" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-5 col-xs-5" for="organizationalUnitName">Department:*</label>
					<div class="col-sm-7 col-xs-7">          
						<input type="text" class="form-control" id="organizationalUnitName" placeholder="IT Dept" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-5 col-xs-5" for="localityName">City:*</label>
					<div class="col-sm-7 col-xs-7">          
						<input type="text" class="form-control" id="localityName" placeholder="Los Angeles" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-5 col-xs-5" for="stateOrProvinceName">State:*</label>
					<div class="col-sm-7 col-xs-7">          
						<input type="text" class="form-control" id="stateOrProvinceName" placeholder="California" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-5 col-xs-5" for="emailAddress">Email:*</label>
					<div class="col-sm-7 col-xs-7">          
						<input type="text" class="form-control" id="emailAddress" placeholder="admin@gidcs.net" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-5 col-xs-5" for="countryName">Country:*</label>
					<div class="col-sm-7 col-xs-7">          
						<select class="form-control" id="countryName" required>
<?php foreach ($country as $key => $value) { ?>
							<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3">
					<button class="btn btn-lg btn-primary btn-block" type="button" id="Submit">Submit</button>
				</div>
				</div>
			</div><!-- /main -->
		</div><!-- /row -->
	</div><!-- /container -->
	
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body">
					<p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<footer class="footer">
		<div class="container text-center">
			<p class="text-muted">Designed by <a href="http://www.guyusoftware.com" target="_blank">LKS</a> and <a href="http://www.gidcs.net" target="_blank">GIDCS.Net</a>.</p>
		</div><!-- /container -->
	</footer>
	
	<?php include 'include/js.php'; ?>
</body>
</html>