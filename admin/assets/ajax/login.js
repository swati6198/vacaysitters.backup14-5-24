$('#btn-superadminlogin').click(function () {
    $("#superadmin-login").validate({
        rules:
            {
                userEmail: {
                    required: true,
                    email: true,
                },
                userPassword: {
                    required: true,
                },
            },
        messages:
            {
                userEmail: {
                    required: "Required Field",
                    email: "E-Mail Must Contain @.",
                },
                userPassword: {
                    required: "Required Field",
                },
            },
        submitHandler: submitForm
    });

    /* handle form submit */
    function submitForm() {
        var data = $("#superadmin-login").serialize();
        $.ajax({
            type: 'POST',
            url: 'include/login.php',
            data: data,
            beforeSend: function () {
                $("#error").fadeOut();
                $('#btn-superadminlogin').prop('disabled', true);
                $("#btn-superadminlogin").html('Checking Credentials...');
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.message == "Login") {
                    $("#error").fadeIn(1000, function () {
                        $("#error").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>' + data.message + '</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        $('#btn-superadminlogin').prop('disabled', true);
                        $("#btn-superadminlogin").html('Redirecting..');
                        window.location.href = 'dashboard.php';
                    });
                } else {
                    $("#error").fadeIn(1000, function () {
                        $("#error").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>' + data.message + '</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        $('#btn-superadminlogin').prop('disabled', false);
                        $("#btn-superadminlogin").html('Retry');
                    });
                }
            }
        });
        return false;
    }
});