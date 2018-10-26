@extends( 'master' )

@section( 'title', 'Posts' )

@section( 'content' )

    <h1>Posts</h1>

    <ul>
        @foreach( $posts as $post )
            <li>
                <h2>{{ $post['title'] }}</h2>
                <p>{{ $post['content'] }}</p>
            </li>
        @endforeach
    </ul>

@stop