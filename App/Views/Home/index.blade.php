@extends( 'master' )

@section( 'title', 'Home' )


@section( 'css' )

@stop

@section( 'content' )

    <h1>Welcome</h1>

    @if ( $current_user )
        Hello {{ $current_user->name }}.
    @else
    <a href="/signup/new">Sign up</a> or <a href="/login">Log in</a>
    @endif

@stop