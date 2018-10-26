@extends( 'master' )

@section( 'title', 'Profile' )

@section( 'content' )

    <h1>Profile</h1>

    <dl class="dl-horizontal">
        <dt>Name</dt>
        <dd>{{ $user->name }}</dd>
        <dt>email</dt>
        <dd>{{ $user->email }}</dd>
    </dl>

    <a href="/profile/edit">Edit</a>

@stop