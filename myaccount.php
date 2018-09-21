<?php 
include('header.php');
include('CoreModel.php');
if(isset($_SESSION['email'])) {
	$obj1 = new CoreModel;
	$result = $obj1 -> selectDataFromTwoTable('firstname,lastname,user_image', 'users', 'users_profile_detail', 'left', 'users.user_id=users_profile_detail.user_id WHERE email=\''.$_SESSION['email'].'\''); ?>  
	<div class="container">
		<div class="col-sm-4">
			<h2>MyAccount</h2>
			<?php        foreach ($result as $value) {
				?>
				<img style="width: 100px; height: 100px; border:1px solid black;" src="images/<?php echo isset($result[0]['user_image']) ? $result[0]['user_image'] : 'no-image.png'; ?>"  alt="">
				<div><b>Name:-</b><?php echo ucwords($result[0]['firstname'])." ".ucwords($result[0]['lastname']); ?></div>
				<?php
			}
		}?>
	</div>
</div>
<?php include('footer.php');
