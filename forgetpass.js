$(document).ready(function () {
    // if both username and phone number input is not empty, enable submit
    $('#username, #phone').keyup(function () {
        if ($('#username').val() != '' && $('#phone').val() != '') {
            // check if phone number matches regex pattern 
            if (($('#phone').val().match(/^01[0-9]{8}$/)) || ($('#phone').val().match(/^01[0-9]{9}$/)) ) {
                $('#submit').prop('disabled', false);
                $('#error').hide();
            }
            else {
                $('#error').show();
                $('#submit').prop('disabled', true);
            } 
        } else {
            $('#submit').prop('disabled', true);
        }
    });
    // click submit ajax post to backend and show the next form
    $('#submit').click(function () {
        $('#notFound').hide();
        $('#loadCheck').show();
        var formData = {
            username : $('#username').val(),
            phone : $('#phone').val()
        }
        $.ajax({
            type: "POST",
            url: "forgetpass.php",
            data: formData,
            success: function(){
                $('#checkForm').hide();
                $('#loadCheck').hide();
                $('#changeForm').show();
            },
            error: function(){
                $('#notFound').show();
                $('#loadCheck').hide();
            }
      });
    });
    // password validation
    $('#passwordConfirm').keyup(function () {
        if ($('#password').val() != $('#passwordConfirm').val()) {
            $('#errorPass').show();
            $('#passSubmit').prop('disabled', true);
        }
        else{
            $('#errorPass').hide();
            $('#passSubmit').prop('disabled', false);
        }
    });
    // append username when posting form
    $('form#updatePassword').submit(function () {
        $('form#updatePassword').append('<input name="username" type="hidden" value="'+$('#username').val()+'" />');
    });
});