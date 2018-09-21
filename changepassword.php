<?php
include('header.php'); if (isset($_SESSION['email'])): ?>
<div class="container">
	<div class="col-sm-6">
	<div id="error"></div>
	<div id="success"></div>
		<form action="" id="changepasswordform" class="changepasswordform" method="post">
			<div class="form-group">
				<label for="oldpwd">Old Password:</label>
				<input type="password" class="form-control" name="oldpwd" id="oldpwd">
			</div>
			<div class="form-group">
				<label for="newpwd">New Password:</label>
				<input type="password" class="form-control" name="newpwd" id="newpwd">
			</div>
			<div class="form-group">
				<label for="newpwd2">Confirm New Password:</label>
				<input type="password" class="form-control" name="newpwd2" id="newpwd2">
			</div>
			<button type="submit" id="btnChangePwd" name='btnChangePwd' class="btn btn-default" value="changepassword">CHANGE PASSWORD</button>
		</form> 
	</div>
</div>
<?php
else :
    ?>
<div class="container">
	<h2>You need permission to access this page.</h2><a href="login.php">Login Here</a>
</div>
<?php
endif;
include('footer.php');
?>
<script type="text/javascript" src="http://localhost/php/Training/PHP/user_management/js/changepassword.js"></script>