$(function() {

    var userId = "{{ $user->id }}";

    console.log( 'USERID: ' + userId );

    $('#formProfile').validate({
        rules: {
            name: 'required',
            email: {
                required: true,
                email: true,
                remote: {
                    url: '/account/validate-email',
                    data: {
                        ignore_id: function() {
                            return userId;
                        }
                    }
                }
            },
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