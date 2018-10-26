@extends( 'master' )

@section( 'title', 'Forgot password' )

@section( 'content' )

    <h1>Request password reset</h1>

    <form action="/password/request-reset" method="post">

        <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" autofocus required>
        </div>

        <button class="btn btn-default" type="submit">Send password reset</button>
    </form>

@stop