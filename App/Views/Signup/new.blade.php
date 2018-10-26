@extends( 'master' )

@section( 'title', 'Signup' )

{{--@section( 'class_status', 'active' )--}}

@section( 'content' )

    <h1>Signup</h1>

    @if ( ! empty( $user->errors ) )
        <p>Errors:</p>
        <ul>
            @foreach( $user->errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="/signup/create" id="formSignup">

        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" id="inputName" class="form-control" name="name" placeholder="Name" autofocus value="{{ $user->name or '' }}" required>
        </div>

        <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" value="{{ $user->email or '' }}" required>
        </div>

        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        </div>

        <button class="btn btn-default" type="submit">Sign up</button>

    </form>

@stop

@section( 'js' )
    <script src="//cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
    <script src="/js/hideShowPassword.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/signup_validation.js"></script>
@stop