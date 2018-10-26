@extends( 'master' )

@section( 'title', 'Reset password' )

{{--@section( 'class_status', 'active' )--}}

@section( 'content' )

    <h1>Reset password</h1>

    @if ( ! empty( $user->errors ) )
        <p>Errors:</p>
        <ul>
            @foreach( $user->errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="/password/reset-password" id="formPassword">

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        </div>

        <button class="btn btn-default" type="submit">Reset password</button>

    </form>

@stop

@section( 'js' )
    <script src="//cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
    <script src="/js/hideShowPassword.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/reset_validation.js"></script>
@stop