<?php 
include('header.php'); ?>
<?php 
if (isset($_SESSION['email'])) { 
	header('location:userlist.php');
}
else
{?>
<div class="container">
	<div class="col-sm-6">

	<div id="error" class="text-danger">
		
	</div>


		<form action="" id="loginform" method="post">
			<div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" name="email" id="email">
			</div>
			<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" name="pwd" id="pwd">
			</div>
			<button type="submit" id="btnLogin" name='btnLogin' class="btn btn-default" value="LOGIN">LOGIN</button>
		</form> 
	</div>
</div>
 <?php
}
include('footer.php'); ?>
<script type="text/javascript" src="http://localhost/Training/PHP/user_management/js/loginvalidation.js"></script>