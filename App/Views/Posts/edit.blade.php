@extends( 'master' )

@section( 'title', 'Posts' )

@section( 'content' )
    <h1>Welcome</h1>
    <p>Hello from a BladeOne template, Posts-Edit</p>

    <ul>
        @foreach( $params as $param )
            <li>{{ $param }}</li>
        @endforeach
    </ul>

@stop