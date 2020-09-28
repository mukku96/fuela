<!DOCTYPE html>

<html lang="en">

<head>

	<title><?php if(!empty($title)) { echo $title;} ?></title>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->	

	<?php echo link_tag([ "rel"=>"icon", "type"=>"image/png", "href"=>"public/assets/images/icons/favicon.ico"])?>

<!--===============================================================================================-->

	<?php echo link_tag([ "rel"=>"stylesheet", "type"=>"text/css", "href"=>"public/assets/vendor/bootstrap/css/bootstrap.min.css"])?>

<!--===============================================================================================-->

	<?php echo link_tag([ "rel"=>"stylesheet", "type"=>"text/css", "href"=>"public/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css"])?>

<!--===============================================================================================-->

	<?php echo link_tag([ "rel"=>"stylesheet", "type"=>"text/css", "href"=>"public/assets/css/util.css"])?>

	<?php echo link_tag([ "rel"=>"stylesheet", "type"=>"text/css", "href"=>"public/assets/css/main.css"])?>

<!--===============================================================================================-->

</head>

<body>

	

	<div class="limiter">

		<div class="container-login100">

			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">

				<form class="login100-form validate-form" name="reset-form" id="reset-form" method="post" action="<?php echo base_url('api/do-reset-passowrd/'.$user_id); ?>">

					<span class="login100-form-title p-b-33">

						Reset Password

					</span>

					<div id="error_msg"></div>

			

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">

						<input class="input100" type="password" name="password" id="password" placeholder="New Password" autocomplete="off">

						<span class="focus-input100-1"></span>

						<span class="focus-input100-2"></span>

					</div>



                    <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">

						<input class="input100" type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" autocomplete="off">

						<span class="focus-input100-1"></span>

						<span class="focus-input100-2"></span>

					</div>



					<div class="container-login100-form-btn m-t-20">

						<button class="login100-form-btn" type="submit">

							Submit

						</button>

					</div>

				</form>

			</div>

		</div>

	</div>

	



	

<!--===============================================================================================-->

<script type="text/javascript" src="<?php echo base_url('public/assets/vendor/jquery/jquery-3.2.1.min.js');?>" ></script>

<!--===============================================================================================-->

	<script type="text/javascript" src="<?php echo base_url('public/assets/vendor/bootstrap/js/popper.js');?>"></script>

	<script type="text/javascript" src="<?php echo base_url('public/assets/vendor/bootstrap/js/bootstrap.min.js');?>"></script>

<!--===============================================================================================-->

	<script type="text/javascript" src="<?php echo base_url("public/assets/js/main.js");?>" ></script>

	<script type="text/javascript" src="<?php echo base_url("public/assets/js/Event.js");?>" ></script>

<!--===============================================================================================-->

</body>

</html>