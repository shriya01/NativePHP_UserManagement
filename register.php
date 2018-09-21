<?php include('header.php');
if (isset($_SESSION['email'])) {
    header('location:myaccount.php');
}
 ?>
<div class="container register_container">
	<div class="col-sm-6">
		<div id="error" class="text-danger">

		</div>
		<form action="" id="registerform" class="form-signin" method="post">
			<div class="form-group">
				<label for="fname">First Name:</label>
				<input type="text" class="form-control" name="fname" id="fname">
			</div>
			<div class="form-group">
				<label for="lname">Last Name:</label>
				<input type="text" class="form-control" name="lname" id="lname">
			</div>
			<div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" name="email" id="email">
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" name="pwd" id="pwd">
			</div>
			<div class="form-group">
				<label for="pwd2">Confirm Password:</label>
				<input type="password" class="form-control" name="pwd2" id="pwd2">
			</div>
			<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-default" value="REGISTER">Register</button> 
		</form> 
	</div>
</div>
<?php include('footer.php'); ?>
<script type="text/javascript" src="http://localhost/php/Training/PHP/user_management/js/registrationvalidation.js"></script>