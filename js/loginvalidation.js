$(document).ready(function() {
    $("#loginform").validate({
        debug: true,
        rules: {
            email: {
                required: true,
                email: true
            },
            pwd: {
                required: true,
            }
        },
        errorClass: "text-danger",
        submitHandler: submitForm
    });

    function submitForm() {
        var data = $("#loginform").serialize();
        $.ajax({
            type: 'POST',
            url: 'validation.php',
            data: data,
            dataType: "json",
            beforeSend: function() {
                $("#error").fadeOut();
                $("#btnLogin").html('<span class="glyphicon glyphicon-transfer"></span>please wait ...');
            },
            success: function(response) {
                if (response == "2") {
                    $("#error").fadeIn(1000, function() {
                        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> Email or password is incorrect!</div>');
                        $("#btnLogin").html('Login');
                    });
                } else if (response == "logged-in") {
                    $("#btnLogin").html('<img src="images/ajax-loader.png" style="width:30px; height:30px;" />   Signing In ...');
                    setTimeout(function() {
                        document.location.href = "myaccount.php"
                    }, 500);
                } else {

                }
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
        return false;
    }
});