@extends( 'master' )

@section( 'title', 'Admin Profile' )

@section( 'content' )

    <h1>Admin Profile</h1>

    <dl class="dl-horizontal">
        <dt>Name</dt>
        <dd>{{ $user->name }}</dd>
        <dt>email</dt>
        <dd>{{ $user->email }}</dd>
    </dl>

    <a href="/admin/profile/edit">Edit</a>

@stop