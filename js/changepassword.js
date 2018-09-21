$(document).ready(function() {
    $('#changepasswordform').validate({
        debug: true,
        rules: {
            oldpwd: {
                required: true
            },
            newpwd: {
                required: true,
                minlength: 8,
                maxlength: 15
            },
            newpwd2: {
                required: true,
                minlength: 8,
                maxlength: 15,
                equalTo: newpwd
            }
        },
        errorClass: "text-danger",
        submitHandler: submitForm
    });

    function submitForm() {
        var data = $("#changepasswordform").serialize();
        $.ajax({
            type: 'POST',
            url: 'validation.php',
            data: data,
            dataType: "json",
            beforeSend: function() {
                $("#error").fadeOut();
                $("#btnChangePwd").html('<span class="glyphicon glyphicon-transfer"></span>please wait ...');
            },
            success: function(response) {
                if (response == "3") {
                    $("#btnChangePwd").html('Change Password');
                    $("#error").show();
                    $("#error").html('<div class="alert alert-danger">Password is incorrect</div>');
                    setTimeout(function() {
                        $('#error').fadeOut('slow');
                    }, 5000);
                } else if (response == "password-changed") {
                    $("#btnChangePwd").html('<img src="images/ajax-loader.png" style="width:30px; height:30px;" />  Changing Password ...');
                    $("#success").html('<div class="alert alert-success">Password Updated Successfully</div>');

                    setTimeout(function() {
                        $('#success').fadeOut('fast');
                    }, 1000);
                }
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
        return false;
    }
});