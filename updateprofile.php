<?php
include('header.php'); if (isset($_SESSION['email'])):
include('CoreModel.php');
$obj1 = new CoreModel;
$result = $obj1 -> selectDataFromTwoTable('firstname,lastname,user_image', 'users', 'users_profile_detail', 'left', 'users.user_id=users_profile_detail.user_id WHERE email=\''.$_SESSION['email'].'\'');
foreach ($result as $key) {
    ?>
    <div class="container">
        <div id="error"></div>
        <div id="success"></div>
        <div class="col-sm-6">
            <h4 class="text-info">
                Email address is primary field for login so you can not change it
            </h4> 
            <form action="" id="updateform" method="post">
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" class="form-control" name="fname" id="fname" value="<?php echo isset($key['firstname'])?$key['firstname']:''; ?>">
                </div>
                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input type="text" class="form-control" name="lname" id="lname" value='<?php echo isset($key['lastname'])?$key['lastname']:''; ?>'>
                </div>
                <button type="submit" name="btnUpdate" class="btn btn-default" value="Update">UPDATE</button> 
            </form> 
        </div>
    </div>
    <?php
} else :
?>
<div class="container">
    <h2>You need permission to access this page.</h2><a href="login.php">Login Here</a>
</div>
<?php
endif;
include('footer.php');?>
<script type="text/javascript">
$(document).ready(function() {
    $("#updateform").validate({
        rules: {
            fname: "required",
            lname: "required",
        },
        errorClass: 'text-danger',
        submitHandler: submitForm
    });

    function submitForm() {
        var data = $("#updateform").serialize();
        console.log(data);
        $.ajax({
            type: 'POST',
            url: 'validation.php',
            data: data,
            dataType: "json",
            beforeSend: function() {
                $("#error").fadeOut();
                $("#btnUpdate").html('<span class="glyphicon glyphicon-transfer"></span>   please wait ...');
            },
            success: function(response) {
                console.log(response);
                if (response == "4") {
                    $("#error").fadeIn(1000, function() {
                        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span></div>');
                        $("#btnUpdate").html('UPDATE');
                          
                    });
                    setTimeout(function() {
                        $('#error').fadeOut('fast');
                    }, 1000);
                } else if (response == "profile-updated") {
                    $("#btnUpdate").html('<img src="images/ajax-loader.png" style="width:30px; height:30px;" />   Updating Profile ...');
                     $('#success').fadeIn('fast');
                    $("#success").html('<div class="alert alert-success">Profile Updated Successfully</div>');
                    setTimeout(function() {
                        $('#success').fadeOut('fast');
                    }, 1000);
                } else {

                }
            },
            error: function(xhr) {

            }
        });
        return false;
    }
});
</script>