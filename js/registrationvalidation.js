$(document).ready(function() {
    $("#registerform").validate({
        rules: {
            fname: "required",
            lname: "required",
            email: {
                required: true,
                email: true
            },
            pwd: {
                required: true,
                minlength: 8,
                maxlength: 15
            },
            pwd2: {
                required: true,
                minlength: 8,
                maxlength: 15,
                equalTo: pwd
            },
        },
        errorClass: 'text-danger',
        submitHandler: submitForm
    });

    function submitForm() {
        var data = $("#registerform").serialize();
        $.ajax({
            type: 'POST',
            url: 'validation.php',
            data: data,
            dataType: "json",
            beforeSend: function() {
                $("#error").fadeOut();
                $("#btnSubmit").html('<span class="glyphicon glyphicon-transfer"></span>   sending ...');
            },
            success: function(response) {
                if (response == "1") {
                    $("#error").fadeIn(1000, function() {
                        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>   Sorry email already taken !</div>');
                        $("#btnSubmit").html('Register');
                    });
                } else if (response == "registered") {
                    $("#btnSubmit").html('<img src="images/ajax-loader.png" style="width:30px; height:30px;" />   Signing Up ...');
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