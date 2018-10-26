$(function() {

    $('#formPassword').validate({
        rules: {
            password: {
                required: true,
                minlength: 8,
                validPassword: true
            }
        },
        messages: {
            email: {
                remote: 'email already taken'
            }
        }
    });

});