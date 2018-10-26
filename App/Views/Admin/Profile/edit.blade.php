@extends( 'master' )

@section( 'title', 'Admin Profile' )

@section( 'content' )

    <h1>Admin Profile</h1>

    @if ( ! empty( $user->errors ) )
        <p>Errors:</p>
        <ul>
            @foreach( $user->errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="/profile/update" id="formProfile">

        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" id="inputName" class="form-control" name="name" placeholder="Name" value="{{ $user->name or '' }}" required>
        </div>

        <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" value="{{ $user->email or '' }}" required>
        </div>

        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" aria-describedby="helpBlock">
            <span id="helpBlock" class="help-block">Leave blank to keep current password</span>
        </div>

        <button class="btn btn-default" type="submit">Save</button>
        <a href="/profile/show">Cancel</a>

    </form>

@stop

@section( 'js' )
    <script src="//cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
    <script src="/js/hideShowPassword.min.js"></script>
    <script src="/js/app.js"></script>

    <script>
        $(document).ready(function(){

            var userId = "{{ $user->id }}";

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
    </script>
@stop