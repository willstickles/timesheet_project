@extends( 'master' )

@section( 'title', 'Daily Timesheet' )

@section( 'content' )

    <h1>Timesheets</h1>

    <p>Welcome, {{ $current_user->name }}</p>

    <a href="/timesheet/add-new">Submit Timesheet</a>
@stop